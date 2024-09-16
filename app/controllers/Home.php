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
        $user = new \Model\User();
        if ($user->validate($_POST)) {
            $user->insert($_POST);
            redirect('login');
        }

        // $user->signup($_POST);

        $data['user'] = $user;
        $this->view('home', $data);
    }
}
