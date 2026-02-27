<?php
$this->pageTitle = 'Авторы';
?>

<div class="section-header">
  <h2 class="section-title">Авторы</h2>
  <span class="text-muted">
    Найдено <?php echo $dataProvider->totalItemCount; ?> авторов
  </span>
</div>

<?php $this->widget('zii.widgets.CListView', array(
  'dataProvider' => $dataProvider,
  'itemView' => '_view',
  'summaryText' => '',
  'template' => '{items}<div class="pagination-container">{pager}</div>',
  'pager' => array(
    'class' => 'CLinkPager',
    'header' => '',
    'htmlOptions' => array('class' => 'pagination justify-content-center'),
    'selectedPageCssClass' => 'active',
  ),
)); ?>

<?php if (!Yii::app()->user->isGuest): ?>
  <div class="mt-4">
    <?php echo CHtml::link('Добавить автора', array('create'), array('class' => 'btn btn-success')); ?>
  </div>
<?php endif; ?>