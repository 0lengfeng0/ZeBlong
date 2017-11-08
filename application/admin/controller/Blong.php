<?php
namespace app\admin\controller;

class Blong extends Common
{
    //分类
    public function category()
    {
        $this->assign('_title','分类管理');
        return $this->fetch();
    }

    //博文
    public function content()
    {

        $this->assign('_title','博文管理');
        return $this->fetch();
    }
}