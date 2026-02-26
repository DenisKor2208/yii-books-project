<?php
$form = $this->beginWidget('CActiveForm', array(
  'id' => 'book-form',
  'enableClientValidation' => true,
  'clientOptions' => array('validateOnSubmit' => true),
  'htmlOptions' => array('enctype' => 'multipart/form-data'),
));
?>

<div>
  <?php echo $form->labelEx($model, 'title'); ?>
  <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
  <?php echo $form->error($model, 'title'); ?>
</div>

<div>
  <?php echo $form->labelEx($model, 'year'); ?>
  <?php echo $form->numberField($model, 'year', array('min' => 1000, 'max' => 2100)); ?>
  <?php echo $form->error($model, 'year'); ?>
</div>

<div>
  <?php echo $form->labelEx($model, 'isbn'); ?>
  <?php echo $form->textField($model, 'isbn', array('size' => 20, 'maxlength' => 20)); ?>
  <?php echo $form->error($model, 'isbn'); ?>
</div>

<div>
  <?php echo $form->labelEx($model, 'description'); ?>
  <?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
  <?php echo $form->error($model, 'description'); ?>
</div>

<div>
  <?php echo $form->labelEx($model, 'image'); ?>
  <?php echo $form->fileField($model, 'image'); ?>
  <?php if (!$model->isNewRecord && !empty($model->photo)): ?>
    <p>Текущее фото: <img src="<?php echo $model->photo; ?>" style="max-width: 100px;"></p>
  <?php endif; ?>
  <?php echo $form->error($model, 'image'); ?>
</div>

<div>
  <?php echo CHtml::label('Авторы', 'author_list'); ?>
  <?php
  $selected = isset($selectedAuthors) ? $selectedAuthors : array();
  echo CHtml::dropDownList('Book[author_list]', $selected, CHtml::listData($authors, 'id', 'full_name'), array(
    'multiple' => 'multiple',
    'size' => 8,
    'style' => 'width: 300px;',
  ));
  ?>
</div>

<div>
  <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
</div>

<?php $this->endWidget(); ?>