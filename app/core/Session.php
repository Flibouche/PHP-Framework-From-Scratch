<?php

/**
 * Session class
 * Sauvegarde ou lit des données dans la session actuelle
 */

namespace Core;

defined('ROOTPATH') OR exit('Access Denied');

class Session
{
    public $mainKey = 'APP';
    public $userKey = 'USER';

    // Fonction qui active la session si elle n'est pas déjà active
    private function start_session(): int
    {
        if (session_status() === PHP_SESSION_NONE) {
            return session_start();
        }
        return 1;
    }

    // Fonction qui ajoute des données à la session
    public function set(mixed $keyOrArray, mixed $value = ''): int
    {
        $this->start_session();

        if (is_array($keyOrArray)) {
            foreach ($keyOrArray as $key => $value) {
                $_SESSION[$this->mainKey][$key] = $value;
            }

            return 1;
        }

        $_SESSION[$this->mainKey][$keyOrArray] = $value;

        return 1;
    }

    // Fonction qui récupère des données de la session, défault est retourné si la clé n'existe pas
    public function get(string $key, mixed $default = ''): mixed
    {
        $this->start_session();

        if (isset($_SESSION[$this->mainKey][$key])) {
            return $_SESSION[$this->mainKey][$key];
        }

        return $default;
    }

    // Fonction qui sauvegarde les données user dans la session après un login
    public function auth(mixed $user_row): int
    {
        $this->start_session();

        $_SESSION[$this->userKey] = $user_row;

        return 0;
    }

    // Fonction qui enlèves les données user de la session
    public function logout(): int
    {
        $this->start_session();

        if (!empty($_SESSION[$this->userKey])) {
            unset($_SESSION[$this->userKey]);
        }

        return 0;
    }

    // Fonction qui check si l'utilisateur est connecté
    public function is_logged_in(): bool
    {
        $this->start_session();

        if (!empty($_SESSION[$this->userKey])) {
            return true;
        }

        return false;
    }

    // Fonction qui retourne les données user de la session
    public function user(string $key = '', mixed $default = ''): mixed
    {
        $this->start_session();

        if (empty($key) && !empty($_SESSION[$this->userKey])) {
            return $_SESSION[$this->userKey];
        } else if (!empty($_SESSION[$this->userKey]->$key)) {
            return $_SESSION[$this->userKey]->$key;
        }

        return $default;
    }

    // Fonction qui retourne une donnée d'une clé et la supprime de la session
    public function pop(string $key, mixed $default = ''): mixed
    {
        $this->start_session();

        if (!empty($_SESSION[$this->mainKey][$key])) {
            $value = $_SESSION[$this->mainKey][$key];
            unset($_SESSION[$this->mainKey][$key]);
            return $value;
        }

        return $default;
    }

    // Fonction qui retourne toutes les données de la session
    public function all(): mixed
    {
        $this->start_session();

        if (isset($_SESSION[$this->mainKey])) {
            return $_SESSION[$this->mainKey];
        }

        return [];
    }
}
