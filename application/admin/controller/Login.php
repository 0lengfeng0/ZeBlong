<?php
namespace app\admin\controller;

use app\common\model\User;
use think\Controller;

//登录相关
class Login extends Controller
{
    //登录页
    public function index()
    {
        //验证是否存在session
        if(session("?ZeBlong_admin_info")){
            return redirect('Index/index');
        }
        //验证是否存在cookie


        if($this->request->isPost()){
            $user = new User();
            //登录验证
            $name = input('post.name');
            if(empty($name)){
                return show(false,'请输入用户名');
            }
            //先查询用户信息
            $user_info = $user->getUserInfo(['name'=>$name],'pwd,salt,id_admin,status');
            if(empty($user_info)){
                return show(false,'登录失败');
            }
            

            $pwd = input('post.pwd');
            if(empty($pwd)){
                return show(false,'请输入密码');
            }
            $remember = input('post.remember');
        }
        return $this->fetch();
    }
}