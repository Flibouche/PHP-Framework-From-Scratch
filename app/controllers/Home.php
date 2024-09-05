<?php

class Home extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
        $model = new Model;
        $arr['name'] = "Bob";

        $result = $model->where($arr);

        show($result);

        $this->view('home');
    }
}
