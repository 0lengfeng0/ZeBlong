<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;

class Common extends Controller
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        //验证登录状态
        $this->checkLogin();
    }

    /**
     * 判断登录状态
     */
    public function checkLogin()
    {
        //读取session中的信息
        if(!$this->getLogSession()){
            return $this->redirect("Login/index");
        }
    }

    /**
     * 获取session中的信息
     */
    public function getLogSession()
    {
        if(session('?ZeBlong_admin_info')){
            return session('ZeBlong_admin_info');
        }else{
            return false;
        }
    }
}