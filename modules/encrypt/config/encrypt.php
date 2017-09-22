<?php

return [
	'default' => [
		'type' => Encrypt::TYPE_OPENSSL,
		/**
		 * The following options must be set
		 * string key secret passphrase
		 * string cipher encryption cipher, one of the openssl cipher constants
		 */
		'key' => NULL,
		'cipher' => 'AES-256-CTR'
	],
	'legacy' => [
		'type' => Encrypt::TYPE_MCRYPT,
		/**
		 * The following options must be set:
		 *
		 * string   key     secret passphrase
		 * integer  mode    encryption mode, one of MCRYPT_MODE_*
		 * integer  cipher  encryption cipher, one of the Mcrypt cipher constants
		 */
		'key' => NULL,
		'cipher' => MCRYPT_RIJNDAEL_128,
		'mode' => MCRYPT_MODE_NOFB,
	],
];
