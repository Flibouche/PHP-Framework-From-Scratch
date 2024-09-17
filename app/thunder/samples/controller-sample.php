<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied');

/**
 * {CLASSNAME} class
 */
class {CLASSNAME}
{
    use MainController;

    public function index()
    {
        $this->view('{classname}');
    }
}