<h1><?php echo CHtml::encode($model->title); ?></h1>

<?php // Если у книги есть изображение обложки, выводим его 
?>
<?php if (!empty($model->photo)): ?>
  <p><img src="<?php echo $model->photo; ?>" style="max-width: 300px;" alt="Обложка книги"></p>
<?php endif; ?>

<?php // Основные атрибуты книги 
?>
<p><strong>Год:</strong> <?php echo CHtml::encode($model->year); ?></p>
<p><strong>ISBN:</strong> <?php echo CHtml::encode($model->isbn); ?></p>
<p><strong>Описание:</strong><br>
  <?php // nl2br сохраняет переносы строк, encode предотвращает XSS 
  ?>
  <?php echo nl2br(CHtml::encode($model->description)); ?>
</p>

<?php // Список авторов книги
?>
<p><strong>Авторы:</strong></p>
<ul>
  <?php foreach ($model->authors as $author): ?>
    <li>
      <?php echo CHtml::link(
        CHtml::encode($author->full_name),
        ['author/view', 'id' => $author->id]
      ); ?>
    </li>
  <?php endforeach; ?>
</ul>

<?php // Для авторизованных пользователей добавляем кнопки управления 
?>
<?php if (!Yii::app()->user->isGuest): ?>
  <p>
    <?php echo CHtml::link('Редактировать', ['update', 'id' => $model->id]); ?> |
    <?php echo CHtml::link('Удалить', ['delete', 'id' => $model->id], [
      'confirm' => 'Вы уверены, что хотите удалить эту книгу?'
    ]); ?>
  </p>
<?php endif; ?>

<?php
?>
<p><?php echo CHtml::link('← К списку книг', ['index']); ?></p>