<?php

/**
 * User class
 */
class User
{
    use Model;

    protected $table = 'user';

    protected $allowedColumns = [
        'name',
        'age',
    ];
}
