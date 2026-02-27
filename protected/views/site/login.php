<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Вход';
?>

<!-- Login Container -->
<div class="login-container">
	<div class="login-card">
		<!-- Login Header -->
		<div class="login-header">
			<h1 class="login-title">Вход</h1>
			<p class="login-description">
				Пожалуйста, заполните форму для входа:
			</p>
		</div>

		<?php $form = $this->beginWidget('CActiveForm', array(
			'id' => 'login-form',
			'enableClientValidation' => true,
			'clientOptions' => array(
				'validateOnSubmit' => true,
			),
			'htmlOptions' => array('class' => 'login-form'),
		)); ?>

		<!-- Required Fields Notice -->
		<p class="required-notice">
			Поля, отмеченные <span class="required">*</span>, обязательны.
		</p>

		<!-- Вывод общих ошибок (если есть) -->
		<?php echo $form->errorSummary($model, '', '', array('class' => 'error-message')); ?>

		<!-- Username Field -->
		<div class="form-group">
			<?php echo $form->labelEx($model, 'username', array('class' => 'form-label')); ?>
			<?php echo $form->textField($model, 'username', array(
				'class' => 'form-control',
				'placeholder' => 'Введите логин',
				'autofocus' => true,
			)); ?>
			<?php echo $form->error($model, 'username', array('class' => 'text-danger')); ?>
		</div>

		<!-- Password Field -->
		<div class="form-group">
			<?php echo $form->labelEx($model, 'password', array('class' => 'form-label')); ?>
			<?php echo $form->passwordField($model, 'password', array(
				'class' => 'form-control',
				'placeholder' => 'Введите пароль',
			)); ?>
			<?php echo $form->error($model, 'password', array('class' => 'text-danger')); ?>
		</div>

		<!-- Hint Box -->
		<div class="hint-box">
			<i class="fas fa-info-circle me-2"></i>
			Подсказка: вы можете войти как
			<span class="credential">demo</span>
			<span class="credential">demo</span>
			или
			<span class="credential">admin</span>
			<span class="credential">admin</span>.
		</div>

		<!-- Remember Me Checkbox -->
		<div class="remember-me">
			<?php echo $form->checkBox($model, 'rememberMe', array('id' => 'rememberMe')); ?>
			<?php echo $form->label($model, 'rememberMe', array('for' => 'rememberMe')); ?>
			<?php echo $form->error($model, 'rememberMe'); ?>
		</div>

		<!-- Login Button -->
		<button type="submit" class="btn btn-login">
			<i class="fas fa-sign-in-alt"></i>
			Войти
		</button>

		<?php $this->endWidget(); ?>

		<!-- Login Footer -->
		<div class="login-footer">
			<p class="text-muted mb-2">Нет аккаунта?</p>
			<?php echo CHtml::link('<i class="fas fa-user-plus me-2"></i>Регистрация', array('site/register'), array('escape' => false)); ?>
		</div>
	</div>
</div>