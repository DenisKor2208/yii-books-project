<?php

class m260226_172743_create_users_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('users', array(
			'id' => 'INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'username' => 'VARCHAR(100) NOT NULL',
			'password_hash' => 'VARCHAR(256) NOT NULL',
			'email' => 'VARCHAR(100) NOT NULL',
			'created_at' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'UNIQUE KEY unique_username (username)',
			'UNIQUE KEY unique_email (email)',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	}

	public function down()
	{
		$this->dropTable('users');
	}
}
