<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author nzpetter
 */
class Model_User extends Model_Auth_User
{
    /**
     * @inheritdoc
     * @param Jelly_Meta $meta
     */
    public static function initialize(Jelly_Meta $meta)
    {
        // Fields defined by the model
        $meta->fields([
            'id' => Jelly::field('primary'),
            'email' => Jelly::field('email', [
                'label' => 'email address',
                'rules' => [
                    [
                        'not_empty'
                    ]
                ],
                'unique' => TRUE,
            ]),
            'username' => Jelly::field('string', array(
                'label' => 'username',
                'rules' => [
                    [
                        'not_empty'
                    ],
                    [
                        'max_length', [':value', 32]
                    ],
                ],
                'unique' => TRUE,
            )),
            'password' => Jelly::field('password', [
                'label' => 'password',
                'rules' => [
                    [
                        'not_empty'
                    ]
                ],
                'private' => TRUE,
                'hash_with' => [
                    Auth::instance(),
                    'hash'
                ]
            ]),
            'firstname' => Jelly::field('string', [
                'label' => 'firstname',
                'rules' => [
                    ['max_length', [':value', 50]]
                ]
            ]),
            'lastname' => Jelly::field('string', [
                'label' => 'lastname',
                'rules' => [
                    ['max_length', [':value', 50]]
                ]
            ]),
            'address' => Jelly::field('string', [
                'label' => 'address',
                'rules' => [
                    ['max_length', [':value', 50]]
                ]
            ]),
            'home' => Jelly::field('string', [
                'label' => 'home',
                'rules' => [
                    ['max_length', [':value', 5]]
                ]
            ]),
            'flat' => Jelly::field('string', [
                'label' => 'flat',
                'rules' => [
                    ['max_length', [':value', 5]]
                ]
            ]),
            'city' => Jelly::field('string', [
                'label' => 'city',
                'rules' => [
                    ['max_length', [':value', 50]]
                ]
            ]),
            'postcode' => Jelly::field('string', [
                'label' => 'postcode',
                'rules' => [
                    ['max_length', [':value', 10]]
                ]
            ]),
            'phone' => Jelly::field('string', [
                'label' => 'phone',
                'rules' => [
                    ['max_length', [':value', 15]]
                ]
            ]),
            'logins' => Jelly::field('integer', [
                'default' => 0,
                'convert_empty' => TRUE,
                'empty_value' => 0,
            ]),
            'last_login' => Jelly::field('timestamp'),
            'created_at' => Jelly::field('timestamp'),
            'updated_at' => Jelly::field('timestamp'),
            'password_expired' => Jelly::field('timestamp'),
            'password_history' => Jelly::field('json', [
                'label' => 'password_history',
                'default' => '[]',
                'private' => TRUE
            ]),
            'is_deleted' => Jelly::field('boolean', [
                'private' => TRUE
            ]),
            // Relationships to other models
            'country' => Jelly::field('belongsto', [
                'allow_null' => TRUE,
                'default' => NULL
            ]),
            'user_tokens' => Jelly::field('hasmany', [
                'foreign' => 'user_token',
                'private' => TRUE,
            ]),
            'roles' => Jelly::field('manytomany'),
        ]);
    }

}
