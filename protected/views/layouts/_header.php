<header>
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand" href="<?php echo Yii::app()->homeUrl; ?>">
        <i class="fas fa-book-open"></i> Книжный мир
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link <?php echo (Yii::app()->controller->id == 'site' && Yii::app()->controller->action->id == 'index') ? 'active' : ''; ?>" href="<?php echo Yii::app()->homeUrl; ?>">Главная</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo (Yii::app()->controller->id == 'author') ? 'active' : ''; ?>" href="<?php echo Yii::app()->createUrl('author/index'); ?>">Авторы</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo (Yii::app()->controller->id == 'book') ? 'active' : ''; ?>" href="<?php echo Yii::app()->createUrl('book/index'); ?>">Книги</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo (Yii::app()->controller->id == 'report') ? 'active' : ''; ?>" href="<?php echo Yii::app()->createUrl('report/index'); ?>">Топ авторов</a>
          </li>
          <?php if (Yii::app()->user->isGuest): ?>
            <li class="nav-item">
              <a class="nav-link btn btn-outline-light btn-sm ms-2 px-3" href="<?php echo Yii::app()->createUrl('site/login'); ?>">Вход</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link btn btn-outline-light btn-sm ms-2 px-3" href="<?php echo Yii::app()->createUrl('site/logout'); ?>">Выход</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
</header>