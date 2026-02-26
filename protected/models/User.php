<?php

class User extends CActiveRecord
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'users';
	}

	public function rules()
	{
		return array(
			array('username, email', 'required'),
			array('password_hash', 'required', 'on' => 'register'), // только при регистрации
			array('username, email', 'unique'),
			array('email', 'email'),
			array('username, email', 'length', 'max' => 100),
			array('password_hash', 'length', 'max' => 256),
			// поиск
			array('id, username, email, created_at', 'safe', 'on' => 'search'),
		);
	}

	public function relations()
	{
		return array();
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Логин',
			'password_hash' => 'Пароль',
			'email' => 'Email',
			'created_at' => 'Дата регистрации',
		);
	}

	public function beforeSave()
	{
		if (parent::beforeSave()) {
			// Хэшируем пароль только при создании новой записи
			if ($this->isNewRecord && !empty($this->password_hash)) {
				$this->password_hash = CPasswordHelper::hashPassword($this->password_hash);
			}
			return true;
		}
		return false;
	}

	public function validatePassword($password)
	{
		return CPasswordHelper::verifyPassword($password, $this->password_hash);
	}

	public function search()
	{
		$criteria = new CDbCriteria;
		$criteria->compare('id', $this->id, true);
		$criteria->compare('username', $this->username, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('created_at', $this->created_at, true);
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}
