<?php defined('SYSPATH') OR die('No direct script access.');

return [
    'merge'           => [Kohana::PRODUCTION, Kohana::STAGING],
    'folder'          => 'build',
    'load_paths'      => [
        Assets::JAVASCRIPT => DOCROOT . 'public' . DIRECTORY_SEPARATOR . 'build' . DIRECTORY_SEPARATOR,
        Assets::STYLESHEET => DOCROOT . 'css' . DIRECTORY_SEPARATOR,
    ],
    'integrity_check' => false,
    'show_paths'      => false,
    'processor'       => [
        Assets::STYLESHEET => 'cssmin',
    ],
    'docroot'         => DOCROOT,
];
