<div class="author-item">
  <div>
    <a href="<?php echo Yii::app()->createUrl('author/view', array('id' => $data->id)); ?>" class="author-name">
      <?php echo CHtml::encode($data->full_name); ?>
    </a>
    <div class="author-stats">
      <i class="fas fa-book me-1"></i> Книг: <?php echo count($data->books); ?>
    </div>
  </div>
  <a href="<?php echo Yii::app()->createUrl('author/view', array('id' => $data->id)); ?>" class="btn btn-sm btn-outline-primary">
    Профиль
  </a>
</div>