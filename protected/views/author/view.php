<h1><?php echo CHtml::encode($model->full_name); ?></h1>

<?php // Вывод сообщений (успех/ошибка) после обработки формы подписки 
?>
<?php if (Yii::app()->user->hasFlash('success')): ?>
  <div class="flash-success" style="color: green; border: 1px solid green; padding: 10px; margin-bottom: 10px;">
    <?php echo Yii::app()->user->getFlash('success'); ?>
  </div>
<?php endif; ?>

<?php if (Yii::app()->user->hasFlash('error')): ?>
  <div class="flash-error" style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 10px;">
    <?php echo Yii::app()->user->getFlash('error'); ?>
  </div>
<?php endif; ?>

<h2>Книги автора</h2>

<?php // Список книг автора 
?>
<?php if ($books): ?>
  <ul>
    <?php foreach ($books as $book): ?>
      <li>
        <?php echo CHtml::link(
          CHtml::encode($book->title),
          ['book/view', 'id' => $book->id]
        ); ?>
      </li>
    <?php endforeach; ?>
  </ul>
<?php else: ?>
  <p>У этого автора пока нет книг.</p>
<?php endif; ?>

<?php // Для гостей отображаем форму подписки на новые книги автора 
?>
<?php if (Yii::app()->user->isGuest): ?>
  <h2>Подписаться на новые книги этого автора</h2>

  <?php $form = $this->beginWidget('CActiveForm', [
    'id'     => 'subscription-form',
    'action' => ['subscription/create'],
    'method' => 'post',
  ]); ?>

  <?php // Передаём ID автора скрытым полем 
  ?>
  <?php echo $form->hiddenField($subscription, 'author_id'); ?>

  <div class="row">
    <?php echo $form->labelEx($subscription, 'phone'); ?>
    <?php echo $form->textField($subscription, 'phone', [
      'placeholder' => '+79991234567',
      'size'        => 20,
    ]); ?>
    <?php echo $form->error($subscription, 'phone'); ?>
  </div>

  <div class="row buttons">
    <?php echo CHtml::submitButton('Подписаться'); ?>
  </div>

  <?php $this->endWidget(); ?>

<?php else: ?>
  <?php // Для авторизованных пользователей – ссылки на редактирование и удаление 
  ?>
  <p>
    <?php echo CHtml::link('Редактировать', ['update', 'id' => $model->id]); ?> |
    <?php echo CHtml::link('Удалить', ['delete', 'id' => $model->id], [
      'confirm' => 'Вы уверены, что хотите удалить этого автора?'
    ]); ?>
  </p>
<?php endif; ?>

<?php // К списку авторов 
?>
<p><?php echo CHtml::link('← К списку авторов', ['index']); ?></p>