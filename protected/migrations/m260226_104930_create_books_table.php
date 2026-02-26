<?php

class m260226_104930_create_books_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('books', array(
			'id' => 'INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'title' => 'VARCHAR(255) NOT NULL',
			'year' => 'YEAR NOT NULL',
			'description' => 'TEXT',
			'isbn' => 'VARCHAR(20)',
			'photo' => 'VARCHAR(255) DEFAULT NULL',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	}

	public function down()
	{
		$this->dropTable('books');
	}
}
