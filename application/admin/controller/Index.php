<?php
namespace app\admin\controller;



class Index extends Common
{
    //首页
    public function index()
    {
        return $this->fetch();
    }
}