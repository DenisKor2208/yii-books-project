<?php
class Book extends CActiveRecord
{
	public $author_list; // для хранения выбранных ID авторов в форме
	public $image; // для загрузки файла

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'books';
	}

	public function rules()
	{
		return array(
			array('title, year', 'required'),
			array('year', 'numerical', 'integerOnly' => true, 'min' => 1000, 'max' => 2100),
			array('isbn', 'length', 'max' => 20),
			array('photo', 'length', 'max' => 255),
			array('description', 'safe'),
			// Правило для загрузки изображения
			array('image', 'file', 'types' => 'jpg, jpeg, png, gif, webp', 'allowEmpty' => true, 'maxSize' => 2 * 1024 * 1024), // 2MB
			// Правило для списка авторов (для валидации)
			array('author_list', 'safe'),
			// Поиск
			array('title, year, isbn', 'safe', 'on' => 'search'),
		);
	}

	public function relations()
	{
		return array(
			'authors' => array(self::MANY_MANY, 'Author', 'book_author(book_id, author_id)'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Название',
			'year' => 'Год выпуска',
			'description' => 'Описание',
			'isbn' => 'ISBN',
			'photo' => 'Обложка',
			'author_list' => 'Авторы',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;
		$criteria->compare('title', $this->title, true);
		$criteria->compare('year', $this->year);
		$criteria->compare('isbn', $this->isbn, true);
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	protected function beforeSave()
	{
		if (parent::beforeSave()) {
			// Если загружено новое фото, сохраняем имя файла
			if ($this->image instanceof CUploadedFile) {
				$fileName = md5(uniqid()) . '.' . $this->image->extensionName;
				$uploadPath = Yii::getPathOfAlias('webroot') . '/uploads/books/';
				if (!is_dir($uploadPath)) {
					mkdir($uploadPath, 0777, true);
				}
				$this->image->saveAs($uploadPath . $fileName);
				$this->photo = '/uploads/books/' . $fileName;
			}
			return true;
		}
		return false;
	}

	protected function afterDelete()
	{
		parent::afterDelete();
		// Удаляем файл фото при удалении книги
		if (!empty($this->photo)) {
			$filePath = Yii::getPathOfAlias('webroot') . $this->photo;
			if (is_file($filePath)) {
				unlink($filePath);
			}
		}
	}
}
