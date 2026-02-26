<?php

/**
 * Формирование отчётов.
 *
 * ТОП-10 авторов по количеству книг за указанный год.
 *
 * @package application.controllers
 */
class ReportController extends CController
{
  /**
   * Отображает форму выбора года и таблицу с результатами.
   *
   * Если передан параметр year, выполняется запрос к БД для получения списка
   * авторов, отсортированных по убыванию количества книг, выпущенных в этом году.
   *
   * @return void
   */
  public function actionIndex()
  {
    $year = Yii::app()->request->getQuery('year', date('Y'));
    $dataProvider = null;

    if ($year) {
      $sql = "
                SELECT a.full_name, COUNT(*) as books_count
                FROM books b
                JOIN book_author ba ON b.id = ba.book_id
                JOIN authors a ON a.id = ba.author_id
                WHERE b.year = :year
                GROUP BY a.id
                ORDER BY books_count DESC
                LIMIT 10
            ";

      $command = Yii::app()->db->createCommand($sql);
      $command->bindParam(':year', $year, PDO::PARAM_INT);
      $authors = $command->queryAll();

      $dataProvider = new CArrayDataProvider($authors, [
        'keyField'   => 'full_name',
        'pagination' => false,
      ]);
    }

    $this->render('index', [
      'year'         => $year,
      'dataProvider' => $dataProvider,
    ]);
  }
}
