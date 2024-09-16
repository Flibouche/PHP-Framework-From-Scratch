<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied');

/**
 * Logout class
 */
class Logout
{
    use MainController;

    public function index()
    {
        $session = new \Core\Session();
        $session->logout();
        redirect('login');
    }
}
