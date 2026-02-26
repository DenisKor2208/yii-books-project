<?php

/**
 * Управление авторами.
 *
 * @package application.controllers
 */
class AuthorController extends CController
{
  /**
   * Возвращает фильтры для данного контроллера.
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
   * Определяет правила доступа.
   *
   * @return array
   */
  public function accessRules()
  {
    return [
      [
        'allow',
        'actions' => ['index', 'view'],
        'users'   => ['*'], // все пользователи (включая гостей)
      ],
      [
        'allow',
        'actions' => ['create', 'update', 'delete'],
        'users'   => ['@'], // только авторизованные
      ],
      [
        'deny',
        'users' => ['*'], // запретить всё остальное
      ],
    ];
  }

  /**
   * Отображает список всех авторов.
   *
   * Доступно всем пользователям.
   *
   * @return void
   */
  public function actionIndex()
  {
    $dataProvider = new CActiveDataProvider('Author', [
      'pagination' => [
        'pageSize' => 20,
      ],
    ]);

    $this->render('index', [
      'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Отображает страницу одного автора.
   *
   * Показывает информацию об авторе и список его книг.
   * Для гостей выводится форма подписки на новые книги автора.
   *
   * @param integer $id ID автора
   * @return void
   * @throws CHttpException
   */
  public function actionView($id)
  {
    $model = $this->loadModel($id);

    // Получаем все книги этого автора
    $books = $model->books;

    $subscription = new Subscription();
    $subscription->author_id = $model->id;

    $this->render('view', [
      'model'        => $model,
      'books'        => $books,
      'subscription' => $subscription,
    ]);
  }

  /**
   * Создаёт нового автора.
   *
   * Доступно только авторизованным пользователям.
   *
   * @return void
   */
  public function actionCreate()
  {
    $model = new Author();

    if (isset($_POST['Author'])) {
      $model->attributes = $_POST['Author'];
      if ($model->save()) {
        Yii::app()->user->setFlash('success', 'Автор успешно добавлен');
        $this->redirect(['view', 'id' => $model->id]);
      }
    }

    $this->render('create', [
      'model' => $model,
    ]);
  }

  /**
   * Редактирует существующего автора.
   *
   * Доступно только авторизованным пользователям.
   *
   * @param integer $id ID автора
   * @return void
   * @throws CHttpException
   */
  public function actionUpdate($id)
  {
    $model = $this->loadModel($id);

    if (isset($_POST['Author'])) {
      $model->attributes = $_POST['Author'];
      if ($model->save()) {
        Yii::app()->user->setFlash('success', 'Автор обновлён');
        $this->redirect(['view', 'id' => $model->id]);
      }
    }

    $this->render('update', [
      'model' => $model,
    ]);
  }

  /**
   * Удаляет автора.
   *
   * Доступно только авторизованным пользователям.
   *
   * @param integer $id ID автора
   * @return void
   * @throws CHttpException
   */
  public function actionDelete($id)
  {
    $model = $this->loadModel($id);
    $model->delete();

    // Если запрос не ajax, выполняем редирект
    if (!isset($_GET['ajax'])) {
      $returnUrl = isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['index'];
      $this->redirect($returnUrl);
    }
  }

  /**
   * Загрузка модели автора по ID
   *
   * Если модель не найдена, выбрасывается исключение 404.
   *
   * @param integer $id ID автора
   * @return Author
   * @throws CHttpException
   */
  public function loadModel($id)
  {
    $model = Author::model()->findByPk($id);
    if ($model === null) {
      throw new CHttpException(404, 'Автор не найден');
    }
    return $model;
  }
}
