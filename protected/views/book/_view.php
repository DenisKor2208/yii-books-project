<?php

/**
 * @var Book $data
 */
?>
<div class="col-md-6 col-lg-3">
  <div class="card h-100">
    <?php if (!empty($data->photo)): ?>
      <img src="<?php echo $data->photo; ?>" class="card-img-top" alt="Обложка" style="height: 250px; object-fit: cover;">
    <?php else: ?>
      <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
        <i class="fas fa-book fa-4x text-muted"></i>
      </div>
    <?php endif; ?>
    <div class="card-body d-flex flex-column">
      <h5 class="card-title"><?php echo CHtml::encode($data->title); ?></h5>
      <div class="card-meta">
        <span class="badge bg-secondary me-2"><?php echo CHtml::encode($data->year); ?></span>
      </div>
      <p class="text-muted small mb-3">
        Авторы:
        <?php
        $authorLinks = array();
        foreach ($data->authors as $author) {
          $authorLinks[] = CHtml::link(
            CHtml::encode($author->full_name),
            array('author/view', 'id' => $author->id),
            array('class' => 'text-decoration-none')
          );
        }
        echo implode(', ', $authorLinks);
        ?>
      </p>
      <div class="mt-auto">
        <?php echo CHtml::link('Подробнее', array('view', 'id' => $data->id), array('class' => 'btn btn-outline-primary w-100 btn-sm')); ?>
      </div>
    </div>
  </div>
</div>