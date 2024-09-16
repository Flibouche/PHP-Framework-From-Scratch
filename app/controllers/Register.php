<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied');

/**
 * Register class
 */
class Register
{
    use MainController;

    public function index()
    {
        $data['user'] = new \Model\User();
        $request = new \Core\Request();

        if ($request->posted()) {
            $data['user']->signup($_POST);
        }

        $this->view('register', $data);
    }
}
