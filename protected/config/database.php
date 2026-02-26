<?php

// This is the database connection configuration.
return array(
	//'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database
	/*
	'connectionString' => 'mysql:host=localhost;dbname=testdrive',
	'emulatePrepare' => true,
	'username' => 'root',
	'password' => '',
	'charset' => 'utf8',
	*/
	// 'connectionString' => 'mysql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT') . ';dbname=' . getenv('MYSQL_DATABASE'),
	// 'username' => getenv('MYSQL_USER'),
	// 'password' => getenv('MYSQL_PASSWORD'),
	// 'charset' => 'utf8',

	'tablePrefix' => '',
	'connectionString' => 'mysql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT') . ';dbname=' . getenv('DB_NAME'),
	'username' => getenv('DB_USER'),
	'password' => getenv('DB_PASSWORD'),
	'charset' => 'utf8',
	'emulatePrepare' => true,
	'enableProfiling' => true,
	'enableParamLogging' => true,
);
