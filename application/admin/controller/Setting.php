<?php
namespace app\admin\controller;


use app\common\model\User;
use think\Exception;

class Setting extends Common
{
    //基础设定[上传图片还存在 BUG]
    public function basic()
    {
        $setting = new \app\common\model\Setting();
        if(request()->isPost()){
            //ajax修改
            $data = [];
            if(!empty(input('zh_name'))){
                $data['zh_name'] = input('zh_name');
            }
            if(!empty(input('en_name'))){
                $data['en_name'] = input('en_name');
            }
            if(!empty(input('head'))){
                $data['head_pic'] = input('head');
            }
            if(!empty(input('sina_wb'))){
                $data['sina_wb'] = input('sina_wb');
            }
            if(!empty(input('wx'))){
                $data['wx_code'] = input('wx');
            }
            if(!empty(input('sign'))){
                $data['sign'] = input('sign');
            }
            $data = ['vardata'=>serialize($data)];
            try{
                $edit_res = $setting->editSetting(['varkey'=>'basic'],$data);
                if($edit_res === false){
                    return show(false,'修改失败');
                }
            }catch (Exception $e){
                return show(false,'修改失败');
            }
            return show(true,'修改成功');
        }
        //读取基础设定内容
        $condition = [
            'varkey'    =>  'basic',
        ];
        try{
            $info = $setting->getSetting($condition);
            if(empty($info)){
                return $this->error('读取基础设置失败');
            }
        }catch (Exception $e){
            return $this->error('读取基础设置失败');
        }
        $info = unserialize($info->getAttr('vardata'));
        $this->assign('basic',$info);
        $this->assign('_title','博客设置');
        return $this->fetch();
    }

    //重置密码
    public function passWord()
    {
        if(request()->isPost()){
            //修改密码
            $old_psw = input('old_psw');
            if(empty($old_psw)){
                return show(false,'请输入原密码');
            }
            $new_psw = input('new_psw');
            if(empty($new_psw)){
                return show(true,"请输入新密码");
            }
            if(!checkPassword($new_psw)){
                return show(false,'密码强度不够');
            }
            //查询原密码是否输入正确
            try{
                $user_info = self::getLogSession();
                $condition = [
                    'name'  =>  $user_info['name'],
                ];
                $field = 'id,pwd,salt';
                $user = new User();
                $admin_info = $user->getUserInfo($condition,$field);
                if(empty($admin_info)){
                    return show(false,'验证密码失败');
                }
                if(md5Str($old_psw,$admin_info->salt) != $admin_info->pwd){
                    return show(false,'原密码不正确');
                }
                //修改密码
                $cond = [
                    'id'    =>  $admin_info->id,
                ];
                $data = [
                    'pwd'   =>  md5Str($new_psw,$admin_info->salt)
                ];
                $edit = $user->editUserInfo($cond,$data);
                if($edit === false){
                    return show(false,'修改失败');
                }
            }catch (Exception $e){
                return show(false,$e->getMessage());
            }

        }
        $this->assign('_title','重置密码');
        return $this->fetch();
    }
}