<h1>Авторы</h1>

<?php $this->widget('zii.widgets.CListView', array(
  'dataProvider' => $dataProvider,
  'itemView' => '_view',
)); ?>

<?php if (!Yii::app()->user->isGuest): ?>
  <p><?php echo CHtml::link('Добавить автора', array('create')); ?></p>
<?php endif; ?>