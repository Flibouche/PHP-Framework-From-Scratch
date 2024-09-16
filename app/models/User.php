<?php

namespace Model;

defined('ROOTPATH') or exit('Access Denied');

/**
 * User class
 */
class User
{
    use Model;

    protected $table = 'user';
    protected $primaryKey = 'id';

    protected $allowedColumns = [
        'email',
        'password',
    ];

    /*****************************
     *  rules include : 
        'required',
        'alpha',
        'email',
        'numeric',
        'unique',
        'symbol',
        'longer_than_8_chars',
        'alpha_numeric',
        'alpha_numeric_symbol',
        'alpha_symbol',
     *
     *****************************/
    protected $validationRules = [
        'email' => [
            'required',
            'email',
            'unique',
        ],
        'username' => [
            'required',
            'alpha_space',
        ],
        'password' => [
            'required',
            'not_less_than_8_chars',
        ],
    ];
}
