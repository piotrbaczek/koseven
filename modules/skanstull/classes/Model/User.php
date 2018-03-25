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
            'password_history' => Jelly::field('json', [
                'label' => 'password_history',
                'default' => '[]',
                'private' => TRUE
            ]),
            'logins' => Jelly::field('integer', [
                'default' => 0,
                'convert_empty' => TRUE,
                'empty_value' => 0,
            ]),
            'last_login' => Jelly::field('timestamp'),
            // Relationships to other models
            'user_tokens' => Jelly::field('hasmany', [
                'foreign' => 'user_token',
                'private' => TRUE,
            ]),
            'country' => Jelly::field('belongsto', [
                'allow_null' => TRUE,
                'default' => NULL
            ]),
            'roles' => Jelly::field('manytomany'),
        ]);
    }

}
