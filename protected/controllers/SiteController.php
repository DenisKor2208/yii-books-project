<?php

/**
 * Site controller.
 *
 * Handles main site actions: index, error, contact, login, logout.
 */
class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 *
	 * @return array
	 */
	public function actions()
	{
		return [
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha' => [
				'class'     => 'CCaptchaAction',
				'backColor' => 0xFFFFFF,
			],
			// page action renders "static" pages stored under 'protected/views/site/pages'
			'page' => [
				'class' => 'CViewAction',
			],
		];
	}

	/**
	 * This is the default 'index' action.
	 */
	public function actionIndex()
	{
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		$error = Yii::app()->errorHandler->error;
		if ($error) {
			if (Yii::app()->request->isAjaxRequest) {
				echo $error['message'];
			} else {
				$this->render('error', $error);
			}
		}
	}

	/**
	 * Displays the contact page.
	 */
	public function actionContact()
	{
		$model = new ContactForm();
		if (isset($_POST['ContactForm'])) {
			$model->attributes = $_POST['ContactForm'];
			if ($model->validate()) {
				$name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
				$subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
				$headers = "From: $name <{$model->email}>\r\n"
					. "Reply-To: {$model->email}\r\n"
					. "MIME-Version: 1.0\r\n"
					. "Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
				Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact', ['model' => $model]);
	}

	/**
	 * Displays the login page.
	 */
	public function actionLogin()
	{
		$model = new LoginForm();

		// AJAX validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// Collect user input data
		if (isset($_POST['LoginForm'])) {
			$model->attributes = $_POST['LoginForm'];
			if ($model->validate() && $model->login()) {
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		$this->render('login', ['model' => $model]);
	}

	/**
	 * Logs out the current user and redirects to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
