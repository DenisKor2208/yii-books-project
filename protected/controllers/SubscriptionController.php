<?php

/**
 * Управление подписками гостей на новые книги авторов.
 *
 * Доступен только неавторизованным пользователям (гостям).
 *
 * @package application.controllers
 */
class SubscriptionController extends CController
{
  /**
   *
   * @return array
   */
  public function filters()
  {
    return [
      'accessControl',
    ];
  }

  /**
   * Правила доступа.
   *
   * - Гости ('?') могут только подписываться (actionCreate).
   * - Всем остальным доступ запрещён.
   *
   * @return array
   */
  public function accessRules()
  {
    return [
      [
        'allow',
        'actions' => ['create'],
        'users'   => ['?'], // только гости
      ],
      [
        'deny',
        'users' => ['*'],
      ],
    ];
  }

  /**
   * Обрабатывает подписку гостя на автора.
   *
   * Получает данные из POST-запроса, сохраняет подписку.
   * При успехе или ошибке устанавливает сообщение.
   *
   * @return void
   */
  public function actionCreate()
  {
    $model = new Subscription();

    if (isset($_POST['Subscription'])) {
      $model->attributes = $_POST['Subscription'];
      if ($model->save()) {
        Yii::app()->user->setFlash('success', 'Вы успешно подписались на новые книги автора');
      } else {
        // Выводим общее сообщение ошибки
        Yii::app()->user->setFlash('error', 'Ошибка при подписке');
      }
    }

    // Возврат на страницу, с которой пришёл пользователь (обычно страница автора)
    $this->redirect(Yii::app()->request->urlReferrer);
  }
}
