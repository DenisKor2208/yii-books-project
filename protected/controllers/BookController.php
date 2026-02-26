<?php

/**
 * Управление книгами.
 *
 * @package application.controllers
 */
class BookController extends CController
{
  /**
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
   * - Гости ('*') могут только просматривать список и детальную страницу книги.
   * - Авторизованные пользователи ('@') могут создавать, редактировать и удалять книги.
   *
   * @return array
   */
  public function accessRules()
  {
    return [
      [
        'allow',
        'actions' => ['index', 'view'],
        'users'   => ['*'],
      ],
      [
        'allow',
        'actions' => ['create', 'update', 'delete'],
        'users'   => ['@'],
      ],
      [
        'deny',
        'users' => ['*'],
      ],
    ];
  }

  /**
   * Отображает список книг с постраничной навигацией.
   *
   * @return void
   */
  public function actionIndex()
  {
    $dataProvider = new CActiveDataProvider('Book', [
      'pagination' => ['pageSize' => 20],
    ]);

    $this->render('index', ['dataProvider' => $dataProvider]);
  }

  /**
   * Отображает детальную страницу книги.
   *
   * @param integer $id ID книги
   * @return void
   * @throws CHttpException
   */
  public function actionView($id)
  {
    $model = $this->loadModel($id);
    $this->render('view', ['model' => $model]);
  }

  /**
   * Создаёт новую книгу (только для авторизованных).
   *
   * При успешном сохранении:
   * - отправляются SMS-уведомления подписчикам;
   *
   * @return void
   */
  public function actionCreate()
  {
    $model = new Book();

    if (isset($_POST['Book'])) {
      $model->attributes = $_POST['Book'];
      $model->image = CUploadedFile::getInstance($model, 'image');

      if ($model->save()) {
        // Сохранение связей с авторами
        if (isset($_POST['Book']['author_list']) && is_array($_POST['Book']['author_list'])) {
          foreach ($_POST['Book']['author_list'] as $authorId) {
            $ba = new BookAuthor();
            $ba->book_id = $model->id;
            $ba->author_id = $authorId;
            $ba->save();
          }
        }

        // Отправка уведомлений подписчикам
        Yii::app()->sms->notifyAboutNewBook($model);

        Yii::app()->user->setFlash('success', 'Книга добавлена');
        $this->redirect(['view', 'id' => $model->id]);
      }
    }

    // Получение списка всех авторов для выпадающего списка в форме
    $authors = Author::model()->findAll();
    $this->render('create', ['model' => $model, 'authors' => $authors]);
  }

  /**
   * Редактирует существующую книгу (только для авторизованных).
   *
   * @param integer $id ID книги
   * @return void
   * @throws CHttpException
   */
  public function actionUpdate($id)
  {
    $model = $this->loadModel($id);

    if (isset($_POST['Book'])) {
      $oldPhoto = $model->photo;
      $model->attributes = $_POST['Book'];
      $model->image = CUploadedFile::getInstance($model, 'image');

      if ($model->save()) {
        // Удаление старых связей с авторами
        BookAuthor::model()->deleteAll('book_id = :book_id', [':book_id' => $model->id]);
        // Добавление новых
        if (isset($_POST['Book']['author_list']) && is_array($_POST['Book']['author_list'])) {
          foreach ($_POST['Book']['author_list'] as $authorId) {
            $command = Yii::app()->db->createCommand();
            $command->insert('book_author', [
              'book_id'   => $model->id,
              'author_id' => $authorId,
            ]);
          }
        }

        // Если загружено новое фото, удаляем старый файл
        if ($model->image instanceof CUploadedFile && !empty($oldPhoto)) {
          $oldFilePath = Yii::getPathOfAlias('webroot') . $oldPhoto;
          if (is_file($oldFilePath)) {
            unlink($oldFilePath);
          }
        }

        Yii::app()->user->setFlash('success', 'Книга обновлена');
        $this->redirect(['view', 'id' => $model->id]);
      }
    }

    // Подготовка данных для формы: список всех авторов и выбранные авторы
    $selectedAuthors = array_keys(CHtml::listData($model->authors, 'id', 'id'));
    $authors = Author::model()->findAll();
    $this->render('update', [
      'model'           => $model,
      'authors'         => $authors,
      'selectedAuthors' => $selectedAuthors,
    ]);
  }

  /**
   * Удаляет книгу (только для авторизованных).
   *
   * @param integer $id ID книги
   * @return void
   * @throws CHttpException
   */
  public function actionDelete($id)
  {
    $model = $this->loadModel($id);
    $model->delete();

    if (!isset($_GET['ajax'])) {
      $returnUrl = isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['index'];
      $this->redirect($returnUrl);
    }
  }

  /**
   * @param integer $id ID книги
   * @return Book
   * @throws CHttpException
   */
  public function loadModel($id)
  {
    $model = Book::model()->findByPk($id);
    if ($model === null) {
      throw new CHttpException(404, 'Книга не найдена');
    }
    return $model;
  }
}
