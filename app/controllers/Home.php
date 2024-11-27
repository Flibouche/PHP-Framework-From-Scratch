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
        $file = 'pexels-felicity-tai-7966072.jpg';

        $data['file'] = $file;
        $image = new \Model\Image();
        $image->getThumbnail($file, 200, 1000);
        $data['thumbnail'] = $image->getThumbnail($file, 80, 80);
        $this->view('home', $data);
    }
}
