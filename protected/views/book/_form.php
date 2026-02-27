<?php

/**
 * Форма создания/редактирования книги
 * 
 * @var Book $model
 * @var Author[] $authors
 * @var array $selectedAuthors
 */

$this->pageTitle = $model->isNewRecord ? 'Добавить книгу' : 'Редактировать книгу';
?>

<!-- Page Header -->
<div class="edit-page-header">
  <h1 class="edit-page-title">
    <i class="fas fa-edit"></i>
    <?php echo $model->isNewRecord ? 'Добавить книгу' : 'Редактировать книгу'; ?>
  </h1>
</div>

<!-- Flash Messages -->
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
    'id' => 'book-form',
    'enableClientValidation' => true,
    'clientOptions' => array('validateOnSubmit' => true),
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
  )); ?>

  <!-- Book Title -->
  <div class="form-group">
    <?php echo $form->labelEx($model, 'title', array('class' => 'form-label')); ?>
    <?php echo $form->textField($model, 'title', array(
      'class' => 'form-control',
      'placeholder' => 'Введите название книги',
      'maxlength' => 255,
    )); ?>
    <?php echo $form->error($model, 'title', array('class' => 'text-danger')); ?>
  </div>

  <!-- Year and ISBN Row -->
  <div class="form-row">
    <div class="form-col">
      <div class="form-group">
        <?php echo $form->labelEx($model, 'year', array('class' => 'form-label')); ?>
        <?php echo $form->numberField($model, 'year', array(
          'class' => 'form-control',
          'min' => 1000,
          'max' => 2100,
          'placeholder' => '2024',
        )); ?>
        <?php echo $form->error($model, 'year', array('class' => 'text-danger')); ?>
      </div>
    </div>
    <div class="form-col">
      <div class="form-group">
        <?php echo $form->labelEx($model, 'isbn', array('class' => 'form-label')); ?>
        <?php echo $form->textField($model, 'isbn', array(
          'class' => 'form-control',
          'placeholder' => '978-5-17-136406-9',
          'maxlength' => 20,
        )); ?>
        <?php echo $form->error($model, 'isbn', array('class' => 'text-danger')); ?>
      </div>
    </div>
  </div>

  <!-- Description -->
  <div class="form-group">
    <?php echo $form->labelEx($model, 'description', array('class' => 'form-label')); ?>
    <?php echo $form->textArea($model, 'description', array(
      'class' => 'form-control',
      'rows' => 6,
      'placeholder' => 'Введите описание книги',
    )); ?>
    <?php echo $form->error($model, 'description', array('class' => 'text-danger')); ?>
  </div>

  <!-- Image Upload -->
  <div class="form-group">
    <?php echo $form->labelEx($model, 'image', array('class' => 'form-label')); ?>
    <div class="file-upload-wrapper">
      <div class="file-upload-input">
        <?php echo $form->fileField($model, 'image', array('class' => 'form-control', 'accept' => 'image/*')); ?>
      </div>
    </div>
    <?php if (!$model->isNewRecord && !empty($model->photo)): ?>
      <div class="current-image-preview">
        <span class="current-image-label">Текущее фото:</span>
        <img src="<?php echo $model->photo; ?>" alt="Обложка книги" class="img-fluid">
      </div>
    <?php endif; ?>
    <?php echo $form->error($model, 'image', array('class' => 'text-danger')); ?>
  </div>

  <!-- Authors Selection -->
  <div class="form-group">
    <?php echo CHtml::label('Авторы', 'author_list', array('class' => 'form-label')); ?>
    <div class="listbox-container">
      <?php
      $selected = isset($selectedAuthors) ? $selectedAuthors : array();
      echo CHtml::listBox('Book[author_list][]', $selected, CHtml::listData($authors, 'id', 'full_name'), array(
        'class' => 'listbox',
        'multiple' => 'multiple',
        'size' => 5,
      ));
      ?>
      <div class="listbox-help">
        <i class="fas fa-info-circle me-1"></i>
        Удерживайте Ctrl (Cmd на Mac) для выбора нескольких авторов
      </div>
    </div>
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