<?php

/**
 * Форма создания/редактирования автора
 * 
 * @var Author $model
 */

$this->pageTitle = $model->isNewRecord ? 'Добавить автора' : 'Редактировать автора';
?>

<!-- Page Header -->
<div class="edit-page-header">
  <h1 class="edit-page-title">
    <i class="fas fa-user-edit"></i>
    <?php echo $model->isNewRecord ? 'Добавить автора' : 'Редактировать автора'; ?>
  </h1>
</div>

<?php
?>
<?php if (Yii::app()->user->hasFlash('success')): ?>
  <div class="alert-custom alert-success">
    <i class="fas fa-check-circle"></i>
    <span><?php echo Yii::app()->user->getFlash('success'); ?></span>
  </div>
<?php endif; ?>
<?php if (Yii::app()->user->hasFlash('error')): ?>
  <div class="alert-custom alert-error">
    <i class="fas fa-exclamation-circle"></i>
    <span><?php echo Yii::app()->user->getFlash('error'); ?></span>
  </div>
<?php endif; ?>

<!-- Edit Form Card -->
<div class="edit-card">
  <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'author-form',
    'enableClientValidation' => true,
    'clientOptions' => array('validateOnSubmit' => true),
    'htmlOptions' => array('class' => ''),
  )); ?>

  <!-- Author Full Name -->
  <div class="form-group">
    <?php echo $form->labelEx($model, 'full_name', array('class' => 'form-label')); ?>
    <?php echo $form->textField($model, 'full_name', array(
      'class' => 'form-control',
      'placeholder' => 'Введите ФИО автора',
      'maxlength' => 255,
      'autofocus' => true,
    )); ?>
    <div class="form-hint">
      <i class="fas fa-info-circle"></i>
      Укажите полное имя автора (Фамилия Имя Отчество)
    </div>
    <?php echo $form->error($model, 'full_name', array('class' => 'text-danger')); ?>
  </div>

  <!-- Form Actions -->
  <div class="form-actions">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array(
      'class' => 'btn btn-save',
      'name' => 'submit',
    )); ?>
    <?php echo CHtml::link('Отмена', array('index'), array('class' => 'btn btn-cancel')); ?>
  </div>

  <?php $this->endWidget(); ?>
</div>