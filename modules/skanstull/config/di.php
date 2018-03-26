<?php
/**
 * Created by PhpStorm.
 * User: nzpetter
 * Date: 21.03.2018
 * Time: 16:29
 */

return [
    '_apiDocument' => [
        '_settings' => [
            'class' => '\Tobscure\JsonApi\Document',
            'methods' => [
                [
                    'setJsonapi', [
                    ['version' => '1.0']
                ]
                ],
            ],
        ]
    ],
    '_apiValidator' => [
        '_settings' => [
            'class' => 'Api_Validator'
        ]
    ],
    '_hashid' => [
        '_settings' => [
            'class' => 'Hashids',
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