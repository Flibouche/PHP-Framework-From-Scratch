<?php

namespace Model;

defined('ROOTPATH') or exit('Access Denied');

/**
 * {CLASSNAME} class
 */
class {CLASSNAME}
{
    use Model;

    protected $table = '{table}';
    protected $primaryKey = 'id';
    protected $loginUniqueColumn = 'email';

    protected $allowedColumns = [
        'username',
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
        'username' => [
            'alpha_space',
            'required', // Required à la fin puisque l'ordre des règles est important
        ],
        'email' => [
            'email',
            'unique',
            'required',
        ],
        'password' => [
            'not_less_than_8_chars',
            'required',
        ],
    ];
}
