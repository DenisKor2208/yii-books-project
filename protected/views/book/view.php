<?php

/**
 * Страница просмотра книги
 * @var Book $model
 */

$this->pageTitle = $model->title;
?>

<?php // Flash-сообщения 
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

<!-- Back Link -->
<?php echo CHtml::link('<i class="fas fa-arrow-left"></i> К списку книг', array('index'), array(
  'class' => 'back-link',
  'escape' => false,
)); ?>

<!-- Book Detail Card -->
<div class="book-detail-card">
  <!-- Header -->
  <div class="book-detail-header">
    <h1><i class="fas fa-book me-2"></i><?php echo CHtml::encode($model->title); ?></h1>
  </div>

  <!-- Body -->
  <div class="book-detail-body">
    <div class="row">
      <!-- Book Cover -->
      <div class="col-lg-4 mb-4 mb-lg-0">
        <?php if (!empty($model->photo)): ?>
          <img src="<?php echo $model->photo; ?>"
            alt="<?php echo CHtml::encode($model->title); ?>"
            class="book-cover-large img-fluid w-100">
        <?php else: ?>
          <div class="book-cover-placeholder d-flex align-items-center justify-content-center" style="height: 400px; background: #f0f0f0;">
            <i class="fas fa-book fa-4x text-muted"></i>
          </div>
        <?php endif; ?>
      </div>

      <!-- Book Info -->
      <div class="col-lg-8">
        <!-- Meta Information Grid -->
        <div class="book-meta-grid">
          <div class="meta-item">
            <div class="book-info-label">
              <i class="far fa-calendar-alt"></i> Год издания
            </div>
            <div class="book-info-value"><?php echo CHtml::encode($model->year); ?></div>
          </div>
          <?php if (!empty($model->isbn)): ?>
            <div class="meta-item">
              <div class="book-info-label">
                <i class="fas fa-barcode"></i> ISBN
              </div>
              <div class="book-info-value"><?php echo CHtml::encode($model->isbn); ?></div>
            </div>
          <?php endif; ?>
        </div>

        <!-- Action Buttons (for authorized users) -->
        <?php if (!Yii::app()->user->isGuest): ?>
          <div class="book-actions">
            <?php echo CHtml::link('<i class="fas fa-edit me-2"></i>Редактировать', array('update', 'id' => $model->id), array(
              'class' => 'btn btn-action btn-primary-custom',
              'escape' => false,
            )); ?>
            <?php echo CHtml::link('<i class="fas fa-trash-alt me-2"></i>Удалить', array('delete', 'id' => $model->id), array(
              'class' => 'btn btn-action btn-outline-custom',
              'confirm' => 'Вы уверены, что хотите удалить эту книгу?',
              'escape' => false,
            )); ?>
          </div>
        <?php endif; ?>

        <!-- Description -->
        <div class="book-description">
          <h3><i class="fas fa-align-left me-2"></i>Описание</h3>
          <p><?php echo nl2br(CHtml::encode($model->description ?: 'Нет описания.')); ?></p>
        </div>

        <!-- Authors Section -->
        <div class="author-section">
          <h3><i class="fas fa-user-edit me-2"></i>Авторы</h3>
          <div class="d-flex align-items-center gap-3 flex-wrap">
            <?php foreach ($model->authors as $author): ?>
              <?php echo CHtml::link(
                '<i class="fas fa-user-circle fa-2x"></i><span>' . CHtml::encode($author->full_name) . '</span>',
                array('author/view', 'id' => $author->id),
                array('class' => 'author-link')
              ); ?>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>