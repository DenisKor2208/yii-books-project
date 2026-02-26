<h1>Редактировать книгу</h1>

<?php $this->renderPartial('_form', array(
  'model' => $model,
  'authors' => $authors,
  'selectedAuthors' => isset($selectedAuthors) ? $selectedAuthors : array(),
)); ?>