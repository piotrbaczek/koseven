<?php
/**
 * Created by PhpStorm.
 * User: nzpetter
 * Date: 21.03.2018
 * Time: 16:29
 */

return [
    '_hashid' => [
        '_settings' => [
            'class' => '\Hashids\Hashids',
            'arguments' => [
                getenv('HASHID_SALT'),
                11
            ],
        ],
    ],
    '_modelSerializer' => [
        '_settings' => [
            'class' => 'ModelSerializer',
            'arguments' => [
                '%_hashid%'
            ]
        ]
    ]
];