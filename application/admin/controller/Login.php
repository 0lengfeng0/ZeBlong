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
        if(!empty(cookie("ZeBlong_admin_info"))){
            $cookie_info = cookie("ZeBlong_admin_info");
            $user = new User();
            $res =  $user->getUserInfo(['name'=>$cookie_info['name']],'name,pwd,salt,is_admin,status');
            if(!empty($res) && $res->status != 2){
                if($res->pwd == $cookie_info['pwd']){
                    session('ZeBlong_admin_info',$cookie_info);
                    return $this->redirect('Index/index');
                }
            }
            cookie("ZeBlong_admin_info",null);
        }

        if($this->request->isPost()){
            //登录验证
            $name = input('post.name');
            if(empty($name)){
                return show(false,'请输入用户名');
            }
            $pwd = input('post.pwd');
            if(empty($pwd)){
                return show(false,'请输入密码');
            }
            $remember = input('post.remember');
            //验证密码
            $user_info = $this->checkLog($name,$pwd);
            if(!empty($user_info->pwd)){
                //登陆成功，存session
                $save_arr = [
                    'name'  =>  $user_info->name,
                    'pwd'   =>  $user_info->pwd,
                ];
                session('ZeBlong_admin_info',$save_arr);
                if($remember){
                    //记住密码[cookie],7天过期
                    cookie("ZeBlong_admin_info",$save_arr,604800);
                }
                return show(true,'登录成功');
            }else{
                return $user_info;
            }
        }
        return $this->fetch();
    }

    /**
     * 登录验证
     */
    private function checkLog($name,$pwd)
    {
        $user = new User();
        //先查询用户信息
        $user_info = $user->getUserInfo(['name'=>$name],'name,pwd,salt,is_admin,status');
        if(empty($user_info)){
            return show(false,'用户不存在');
        }
        if($user_info->status == 2){
            return show(false,"账户已被封禁");
        }
        $md5pwd = md5Str(trim($pwd),$user_info->salt);
        if($md5pwd != $user_info->pwd){
            return show(false,'密码错误');
        }

        return $user_info;
    }
}