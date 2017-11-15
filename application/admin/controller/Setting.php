<?php
namespace app\admin\controller;


use think\Exception;

class Setting extends Common
{
    //基础设定
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
        return $this->fetch();
    }

    //重置密码
    public function passWord()
    {

        return $this->fetch();
    }
}