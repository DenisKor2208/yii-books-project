<?php

class m260226_104951_create_subscriptions_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('subscriptions', array(
			'id' => 'INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'author_id' => 'INT UNSIGNED NOT NULL',
			'phone' => 'VARCHAR(20) NOT NULL',
			'created_at' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'UNIQUE KEY unique_subscription (author_id, phone)',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');

		$this->addForeignKey('fk_subscription_author', 'subscriptions', 'author_id', 'authors', 'id', 'CASCADE', 'CASCADE');
	}

	public function down()
	{
		$this->dropForeignKey('fk_subscription_author', 'subscriptions');
		$this->dropTable('subscriptions');
	}
}
