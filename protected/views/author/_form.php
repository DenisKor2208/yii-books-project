<?php $form = $this->beginWidget('CActiveForm', array(
  'id' => 'author-form',
  'enableClientValidation' => true,
  'clientOptions' => array(
    'validateOnSubmit' => true,
  ),
)); ?>

<div>
  <?php echo $form->labelEx($model, 'full_name'); ?>
  <?php echo $form->textField($model, 'full_name', array('size' => 60, 'maxlength' => 255)); ?>
  <?php echo $form->error($model, 'full_name'); ?>
</div>

<div>
  <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
</div>

<?php $this->endWidget(); ?>