<?php
namespace app\index\controller;

//博客主页
class Index extends Common
{
    //博客主页
    public function index()
    {

        return $this->fetch('index');
    }
}
