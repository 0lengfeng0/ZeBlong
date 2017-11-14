<?php
namespace app\admin\controller;


class Setting extends Common
{
    //基础设定
    public function basic()
    {
        if(request()->isPost()){
            //ajax修改

        }
        //读取基础设定内容
        $setting = new \app\common\model\Setting();
        $condition = [
            'varkey'    =>  'basic',
        ];
        $info = $setting->getSetting($condition);
        if(empty($info)){
            return $this->error('读取基础设置失败');
        }
        $info = unserialize($info->getAttr('vardata'));
        $this->assign('basic',$info);
        return $this->fetch();
    }

    //重置密码
    public function passWord()
    {

        return $this->fetch();
    }
}