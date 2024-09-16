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
            'email',
            'unique',
            'required', // Required à la fin puisque l'ordre des règles est important
        ],
        'username' => [
            'alpha_space',
            'required',
        ],
        'password' => [
            'not_less_than_8_chars',
            'required',
        ],
    ];
}
