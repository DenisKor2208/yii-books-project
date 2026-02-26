<div class="view">
  <h3><?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id' => $data->id)); ?></h3>
  <p>Год: <?php echo CHtml::encode($data->year); ?></p>
  <?php if (!empty($data->photo)): ?>
    <img src="<?php echo $data->photo; ?>" style="max-width: 100px;">
  <?php endif; ?>
  <p>Авторы:
    <?php
    $authors = array();
    foreach ($data->authors as $author) {
      $authors[] = CHtml::link(CHtml::encode($author->full_name), array('author/view', 'id' => $author->id));
    }
    echo implode(', ', $authors);
    ?>
  </p>
</div>