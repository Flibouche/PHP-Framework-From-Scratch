<?php

defined('ROOTPATH') OR exit('Access Denied');

/**
 * _404 class
 */
class _404
{
    use Controller;
    
    public function index()
    {
        echo "404 Page not found controller";
    }
}
