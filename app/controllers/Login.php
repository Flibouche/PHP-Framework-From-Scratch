<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied');

/**
 * Login class
 */
class Login
{
    use MainController;

    public function index()
    {
        $data['user'] = new \Model\User();
        $request = new \Core\Request();

        if ($request->posted()) {
            $data['user']->login($_POST);
        }

        $this->view('login', $data);
    }
}
