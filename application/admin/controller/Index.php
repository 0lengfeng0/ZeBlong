<?php
namespace app\admin\controller;



class Index extends Common
{
    //首页
    public function index()
    {

        $this->assign('_title','主页');
        return $this->fetch('index');
    }
}