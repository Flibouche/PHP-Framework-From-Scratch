<?php

/**
 * Session class
 * Gets et sets des données dans les superglobales POST et GET
 */

namespace Core;

defined('ROOTPATH') or exit('Access Denied');

class Request
{
    // Fonction qui récupère quelle méthode (post ou get) a été utilisée
    public function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    // Fonction qui check si une méthode post a été utilisée
    public function posted(): bool
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" && count($_POST) > 0) {
            return true;
        }

        return false;
    }

    // Fonction qui récupère une valeur de la superglobale POST
    public function post(string $key = '', mixed $default = ''): mixed
    {
        if (empty($key)) {
            return $_POST;
        } else if (isset($_POST[$key])) {
            return $_POST[$key];
        }

        return $default;
    }

    // Fonction qui récupère une valeur de la superglobale FILES
    public function files(string $key = '', mixed $default = ''): mixed
    {
        if (empty($key)) {
            return $_FILES;
        } else if (isset($_FILES[$key])) {
            return $_FILES[$key];
        }

        return $default;
    }

    // Fonction qui récupère une valeur de la superglobale GET
    public function get(string $key = '', mixed $default = ''): mixed
    {
        if (empty($key)) {
            return $_GET;
        } else if (isset($_GET[$key])) {
            return $_GET[$key];
        }

        return $default;
    }

    // Fonction qui récupère une valeur de la superglobale REQUEST
    public function input(string $key, mixed $default = ''): mixed
    {
        if (isset($_REQUEST[$key])) {
            return $_REQUEST[$key];
        }

        return $default;
    }

    // Fonction qui récupère toutes les valeurs de la superglobale REQUEST
    public function all(): mixed
    {
        return $_REQUEST;
    }
}
