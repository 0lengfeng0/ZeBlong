<?php
namespace app\index\controller;

//博文相关
class Content extends Common
{
    //博文列表
    public function index()
    {
        return $this->fetch();
    }

    //博文详情
    public function detail()
    {
        return $this->fetch();
    }
}
