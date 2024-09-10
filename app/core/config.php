<?php

defined('ROOTPATH') OR exit('Access Denied');

if ($_SERVER['SERVER_NAME'] == 'localhost') {

    // Database config
    define('DBNAME', 'php_framework_from_scratch');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBDRIVER', '');

    define('ROOT', 'http://localhost/php-framework-from-scratch/public');
} else {

    // Database config for online website
    define('DBNAME', 'my_db');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBDRIVER', '');

    define('ROOT', 'https://www.mywebsite.com');
}

define('APP_NAME', "My Website");
define('APP_DESC', "Best website on the planet");

// True = afficher les erreurs, False = les cacher
define('DEBUG', true);