<?php

/**
 * Компонент для отправки SMS-уведомлений через сервис smspilot.ru
 *
 * Используется для оповещения подписчиков о выходе новых книг.
 * Настройки (apiUrl, apiKey, sender) задаются в конфигурации приложения.
 */
class SmsNotifier extends CApplicationComponent
{
  /**
   * URL API smspilot.ru
   * @var string
   */
  public $apiUrl;

  /**
   * API-ключ для доступа к сервису
   * @var string
   */
  public $apiKey;

  /**
   * Имя отправителя (подпись)
   * @var string
   */
  public $sender;

  public function init()
  {
    parent::init();
    if (empty($this->apiKey)) {
      throw new CException('Не задан API-ключ для SMS-уведомлений.');
    }
  }

  /**
   * Отправляет SMS-уведомления всем подписчикам авторов указанной книги.
   *
   * @param Book $book объект книги, для которой выходят уведомления
   * @return void
   */
  public function notifyAboutNewBook($book)
  {
    // Собираем ID авторов книги
    $authorIds = [];
    foreach ($book->authors as $author) {
      $authorIds[] = $author->id;
    }

    // Если у книги нет авторов — нечего рассылать
    if (empty($authorIds)) {
      return;
    }

    // Находим все подписки на этих авторов
    $subscriptions = Subscription::model()->findAllByAttributes([
      'author_id' => $authorIds,
    ]);

    // Выделяем уникальные номера телефонов (чтобы не слать дубли)
    $phones = [];
    foreach ($subscriptions as $sub) {
      $phones[$sub->phone] = true;
    }

    $message = 'Вышла новая книга "' . $book->title . '"';
    foreach (array_keys($phones) as $phone) {
      $this->sendSms($phone, $message);
    }
  }

  /**
   * Отправляет одно SMS через API smspilot.ru.
   *
   * @param string $phone номер телефона (может содержать нецифровые символы)
   * @param string $message текст сообщения
   * @return bool true, если отправка успешна, иначе false
   */
  protected function sendSms($phone, $message)
  {
    // Очищаем номер от лишних символов (оставляем только цифры)
    $phone = preg_replace('/[^0-9]/', '', $phone);
    if (empty($phone) || empty($message)) {
      Yii::log(
        'SMS not sent: invalid phone or message',
        CLogger::LEVEL_ERROR,
        'application.sms'
      );
      return false;
    }

    // Формируем параметры запроса
    $params = [
      'send'   => $message,
      'to'     => $phone,
      'from'   => $this->sender,
      'apikey' => $this->apiKey,
      'format' => 'json',
    ];

    $url = $this->apiUrl . '?' . http_build_query($params);

    // Пытаемся отправить запрос: сначала file_get_contents, если разрешено,
    // иначе используем cURL
    if (ini_get('allow_url_fopen')) {
      $response = @file_get_contents($url);
    } else {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_TIMEOUT, 10);
      $response = curl_exec($ch);
      curl_close($ch);
    }

    // Если ответ не получен — сетевой сбой
    if ($response === false) {
      Yii::log("SMS to {$phone}: network error", CLogger::LEVEL_ERROR, 'application.sms');
      return false;
    }

    // Парсим JSON-ответ
    $data = json_decode($response);
    if (isset($data->error)) {
      $errorMsg = isset($data->error->description_ru)
        ? $data->error->description_ru
        : $data->error->description;
      Yii::log(
        "SMS to {$phone} failed: {$errorMsg}",
        CLogger::LEVEL_ERROR,
        'application.sms'
      );
      return false;
    }

    // Если есть server_id — отправка прошла успешно
    if (isset($data->send[0]->server_id)) {
      Yii::log(
        "SMS to {$phone} sent, server_id: " . $data->send[0]->server_id,
        CLogger::LEVEL_INFO,
        'application.sms'
      );
      return true;
    }

    // Неизвестный формат ответа
    Yii::log(
      "SMS to {$phone}: unknown response",
      CLogger::LEVEL_WARNING,
      'application.sms'
    );

    return false;
  }
}
