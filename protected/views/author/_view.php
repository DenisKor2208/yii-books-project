<div class="view">
  <h3><?php echo CHtml::link(CHtml::encode($data->full_name), array('view', 'id' => $data->id)); ?></h3>
  <p>Книг: <?php echo count($data->books); ?></p>
</div>