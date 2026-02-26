<?php
class Subscription extends CActiveRecord
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'subscriptions';
	}

	public function rules()
	{
		return array(
			array('author_id, phone', 'required'),
			array('phone', 'length', 'max' => 20),
			array('author_id', 'numerical', 'integerOnly' => true),
			array('phone', 'unique', 'criteria' => array(
				'condition' => 'author_id = :author_id',
				'params' => array(':author_id' => $this->author_id),
			), 'message' => 'Этот номер уже подписан на данного автора'),
			array('phone', 'match', 'pattern' => '/^\+?[0-9]{10,15}$/', 'message' => 'Введите корректный номер телефона'),
			array('author_id, phone, created_at', 'safe', 'on' => 'search'),
		);
	}

	public function relations()
	{
		return array(
			'author' => array(self::BELONGS_TO, 'Author', 'author_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'author_id' => 'Автор',
			'phone' => 'Телефон',
			'created_at' => 'Дата подписки',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;
		$criteria->compare('author_id', $this->author_id);
		$criteria->compare('phone', $this->phone, true);
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}
