<?php
namespace app\admin\controller;

class Setting extends Common
{
    //基础设定
    public function basic()
    {

        return $this->fetch();
    }

    //重置密码
    public function passWord()
    {

        return $this->fetch();
    }
}