<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app()->name;
?>

<div class="hero-section text-center">
	<h1 class="hero-title">Добро пожаловать в Книжный мир</h1>
	<p class="lead text-muted mb-4">Ваш персональный каталог литературы. Открывайте новые миры, следите за любимыми авторами и делитесь впечатлениями.</p>
	<div class="d-flex justify-content-center gap-3">
		<?php echo CHtml::link('Смотреть книги', array('book/index'), array('class' => 'btn btn-primary btn-lg px-4')); ?>
		<?php echo CHtml::link('Все авторы', array('author/index'), array('class' => 'btn btn-outline-secondary btn-lg px-4')); ?>
	</div>
</div>

<div class="row g-4 mt-4">
	<div class="col-md-4">
		<div class="card h-100 p-4 text-center">
			<div class="card-body">
				<i class="fas fa-book fa-3x text-primary mb-3"></i>
				<h3 class="h5">Каталог книг</h3>
				<p class="text-muted small">Более 1000 произведений в различных жанрах.</p>
				<?php echo CHtml::link('', array('book/index'), array('class' => 'stretched-link')); ?>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card h-100 p-4 text-center">
			<div class="card-body">
				<i class="fas fa-user-edit fa-3x text-success mb-3"></i>
				<h3 class="h5">Авторы</h3>
				<p class="text-muted small">Профили писателей и библиографии.</p>
				<?php echo CHtml::link('', array('author/index'), array('class' => 'stretched-link')); ?>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card h-100 p-4 text-center">
			<div class="card-body">
				<i class="fas fa-chart-line fa-3x text-warning mb-3"></i>
				<h3 class="h5">Рейтинги</h3>
				<p class="text-muted small">Топ авторов и самые читаемые книги года.</p>
				<?php echo CHtml::link('', array('report/index'), array('class' => 'stretched-link')); ?>
			</div>
		</div>
	</div>
</div>

<div class="row mt-5">
	<div class="col-12">
		<div class="card bg-light border-0">
			<div class="card-body text-center p-4">
				<?php if (Yii::app()->user->isGuest): ?>
					<p class="mb-3"><strong>Вы гость.</strong> Вы можете просматривать книги и авторов, а также подписываться на авторов (на странице автора).</p>
					<p><?php echo CHtml::link('Войти', array('site/login'), array('class' => 'btn btn-primary')); ?></p>
				<?php else: ?>
					<p class="mb-3"><strong>Вы вошли как <?php echo CHtml::encode(Yii::app()->user->name); ?>.</strong> Вам доступно создание, редактирование и удаление.</p>
					<div class="d-flex justify-content-center gap-3">
						<?php echo CHtml::link('Добавить книгу', array('book/create'), array('class' => 'btn btn-success')); ?>
						<?php echo CHtml::link('Добавить автора', array('author/create'), array('class' => 'btn btn-success')); ?>
						<?php echo CHtml::link('Выйти', array('site/logout'), array('class' => 'btn btn-secondary')); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>