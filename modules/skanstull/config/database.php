<?php

return [
	'default' => [
		'type'       => 'MySQLi',
		'connection' => [
			'hostname'   => getenv('DATABASE_HOSTNAME'),
			'database'   => getenv('DATABASE_DB'),
			'username'   => getenv('DATABASE_USER'),
			'password'   => getenv('DATABASE_PASSWORD'),
			'persistent' => FALSE,
			'ssl'        => NULL,
		],
		'table_prefix' => '',
		'charset'      => 'utf8',
		'caching'      => FALSE,
	]
];
