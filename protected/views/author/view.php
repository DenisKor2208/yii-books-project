<?php

/**
 * Страница просмотра автора
 * 
 * @var Author $model
 * @var Book[] $books
 * @var Subscription $subscription
 */

$this->pageTitle = $model->full_name;

// Вычисляем дополнительную статистику
$booksCount = count($books);
$firstBookYear = $booksCount ? min(array_map(function ($book) {
  return $book->year;
}, $books)) : null;
?>

<?php
?>
<?php if (Yii::app()->user->hasFlash('success')): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo Yii::app()->user->getFlash('success'); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>
<?php if (Yii::app()->user->hasFlash('error')): ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?php echo Yii::app()->user->getFlash('error'); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<!-- Author Profile Card -->
<div class="author-profile-card">
  <!-- Header -->
  <div class="author-profile-header">
    <div class="author-avatar">
      <i class="fas fa-user"></i>
    </div>
    <h1><?php echo CHtml::encode($model->full_name); ?></h1>
    <div class="author-stats">
      <div class="stat-item">
        <span class="stat-value"><?php echo $booksCount; ?></span>
        <span class="stat-label"><i class="fas fa-book me-1"></i>Книг</span>
      </div>
      <?php if ($firstBookYear): ?>
        <div class="stat-item">
          <span class="stat-value"><?php echo $firstBookYear; ?></span>
          <span class="stat-label"><i class="fas fa-calendar me-1"></i>Первая книга</span>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- Body -->
  <div class="author-profile-body">
    <!-- Books Section -->
    <section>
      <h2 class="section-title">
        <i class="fas fa-book me-2"></i>Книги автора
      </h2>
      <?php if ($booksCount > 0): ?>
        <ul class="book-list">
          <?php foreach ($books as $book): ?>
            <li class="book-list-item">
              <a href="<?php echo Yii::app()->createUrl('book/view', array('id' => $book->id)); ?>">
                <i class="fas fa-bookmark"></i>
                <span><?php echo CHtml::encode($book->title); ?></span>
              </a>
              <span class="book-year"><?php echo CHtml::encode($book->year); ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <p class="text-muted">У этого автора пока нет книг.</p>
      <?php endif; ?>
    </section>

    <?php if (Yii::app()->user->isGuest): ?>
      <!-- Subscription Section -->
      <section class="subscription-section">
        <h3>
          <i class="fas fa-bell me-2"></i>
          Подписаться на новые книги этого автора
        </h3>
        <?php $form = $this->beginWidget('CActiveForm', array(
          'id' => 'subscription-form',
          'action' => array('subscription/create'),
          'method' => 'post',
          'htmlOptions' => array('class' => 'row'),
        )); ?>

        <?php echo $form->hiddenField($subscription, 'author_id'); ?>

        <div class="col-md-6">
          <div class="form-group">
            <?php echo $form->labelEx($subscription, 'phone', array('class' => 'form-label')); ?>
            <?php echo $form->textField($subscription, 'phone', array(
              'class' => 'form-control',
              'placeholder' => '+79991234567',
            )); ?>
            <?php echo $form->error($subscription, 'phone', array('class' => 'text-danger')); ?>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">&nbsp;</label>
            <?php echo CHtml::submitButton('Подписаться', array(
              'class' => 'btn btn-subscribe w-100',
            )); ?>
          </div>
        </div>

        <small class="text-muted">
          <i class="fas fa-info-circle me-1"></i>
          Вы будете получать уведомления о новых книгах автора на указанный номер
        </small>

        <?php $this->endWidget(); ?>
      </section>
    <?php else: ?>
      <!-- Admin Actions -->
      <section class="admin-actions">
        <div class="d-flex gap-3 mt-4">
          <?php echo CHtml::link('Редактировать', array('update', 'id' => $model->id), array('class' => 'btn btn-primary')); ?>
          <?php echo CHtml::link('Удалить', array('delete', 'id' => $model->id), array(
            'class' => 'btn btn-danger',
            'confirm' => 'Вы уверены, что хотите удалить этого автора?'
          )); ?>
        </div>
      </section>
    <?php endif; ?>

    <!-- Back Link -->
    <?php echo CHtml::link('<i class="fas fa-arrow-left"></i> К списку авторов', array('index'), array(
      'class' => 'back-link',
      'escape' => false,
    )); ?>
  </div>
</div>