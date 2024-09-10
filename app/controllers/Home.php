<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied');

/**
 * Home class
 */
class Home
{
    use MainController;

    public function index()
    {
        $this->view('home');
    }
}
