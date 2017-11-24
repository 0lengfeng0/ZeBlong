<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;

class Common extends Controller
{
    /**
     * 构造函数
     * Common constructor.
     * @param Request|null $request
     */
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
            if(!$this->request->isAjax()){
                return $this->redirect("Login/index");
            }else{
                return show(false,'请先登录！');
            }
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