<?php
$this->pageTitle = 'Книги';
?>

<div class="section-header">
  <h2 class="section-title">Книги</h2>
  <span class="text-muted">
    <?php
    // Подсчёт показываемого диапазона и общего количества
    $pagination = $dataProvider->getPagination();
    $total = $dataProvider->getTotalItemCount();
    if ($pagination) {
      $start = $pagination->getOffset() + 1;
      $end = min($start + $pagination->getLimit() - 1, $total);
    } else {
      $start = 1;
      $end = $total;
    }
    echo "Показано {$start}-{$end} из {$total} результатов";
    ?>
  </span>
</div>

<?php $this->widget('zii.widgets.CListView', array(
  'dataProvider' => $dataProvider,
  'itemView'     => '_view',
  'summaryText'  => false,
  'itemsTagName' => 'div',
  'itemsCssClass' => 'row g-4',
  'pager'        => array(
    'class'          => 'CLinkPager',
    'header'         => '',
    'htmlOptions'    => array('class' => 'pagination justify-content-center'),
    'selectedPageCssClass' => 'active',
  ),
  'template'     => '{items}<div class="mt-4">{pager}</div>',
)); ?>

<?php if (!Yii::app()->user->isGuest): ?>
  <div class="mt-4">
    <?php echo CHtml::link('Добавить книгу', array('create'), array('class' => 'btn btn-success')); ?>
  </div>
<?php endif; ?>