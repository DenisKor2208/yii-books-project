<?php
class Author extends CActiveRecord
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'authors';
	}

	public function rules()
	{
		return array(
			array('full_name', 'required'),
			array('full_name', 'length', 'max' => 255),
			// поиск
			array('full_name', 'safe', 'on' => 'search'),
		);
	}

	public function relations()
	{
		return array(
			'books' => array(self::MANY_MANY, 'Book', 'book_author(author_id, book_id)'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'full_name' => 'ФИО',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;
		$criteria->compare('full_name', $this->full_name, true);
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}
