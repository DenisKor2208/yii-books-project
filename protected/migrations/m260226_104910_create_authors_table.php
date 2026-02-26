<?php

class m260226_104910_create_authors_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('authors', array(
			'id' => 'INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'full_name' => 'VARCHAR(255) NOT NULL',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	}

	public function down()
	{
		$this->dropTable('authors');
	}
}
