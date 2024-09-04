<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    define('ROOT', 'http://localhost/php-framework-from-scratch/public');
} else {
    define('ROOT', 'https://www.mywebsite.com');
}
