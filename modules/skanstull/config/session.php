<?php

return [
	'cookie' => [
		'encrypted' => TRUE,
	],
	'native' => [
		'encrypted' => TRUE,
		'lifetime' => 3600,
		//'name' => defined('CFG_SITE_NAME') ? strtolower(constant('CFG_SITE_NAME')) : Session::$default
        'name' => 'skanstull'
	]
];
