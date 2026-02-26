<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app()->name;
?>

<h1>Добро пожаловать в <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
<p>Простой каталог книг с возможностью подписки на новые книги авторов.</p>

<hr>

<h3>Книги</h3>
<ul>
	<li><?php echo CHtml::link('Список книг', array('book/index')); ?></li>
	<?php if (!Yii::app()->user->isGuest): ?>
		<li><?php echo CHtml::link('Добавить книгу', array('book/create')); ?></li>
	<?php endif; ?>
</ul>

<h3>Авторы</h3>
<ul>
	<li><?php echo CHtml::link('Список авторов', array('author/index')); ?></li>
	<?php if (!Yii::app()->user->isGuest): ?>
		<li><?php echo CHtml::link('Добавить автора', array('author/create')); ?></li>
	<?php endif; ?>
</ul>

<h3>Отчёт</h3>
<ul>
	<li><?php echo CHtml::link('ТОП-10 авторов за год', array('report/index')); ?></li>
</ul>

<hr>

<?php if (Yii::app()->user->isGuest): ?>
	<p><strong>Вы гость.</strong> Вы можете просматривать книги и авторов, а также подписываться на авторов (на странице автора).</p>
	<p><?php echo CHtml::link('Войти', array('site/login')); ?></p>
<?php else: ?>
	<p><strong>Вы вошли как <?php echo CHtml::encode(Yii::app()->user->name); ?>.</strong> Вам доступно создание, редактирование и удаление.</p>
	<p><?php echo CHtml::link('Выйти', array('site/logout')); ?></p>
<?php endif; ?>