<?php
namespace app\admin\controller;

use app\common\model\Pic;
use think\Exception;

class Upload extends Common
{
    /**
     * 图片上传
     */
    public function imgUpload()
    {
        try{
            $type = input('type');
            if(!in_array($type,['1','2','3'])){
                return show(false,'获取图片类型失败');
            }
            $name = "";     //文件名
            empty(input('name')) ? $name="pic" : $name=input('name');
            $file = request()->file($name);   //获取表单上传文件.
            if($file){
                $info = $file->move(ROOT_PATH.'public'.DS."uploads");   //缓存图片实存
                if($info){
                    //上传成功
                    $save_path = DS."uploads".DS.$info->getSaveName();     //存储路径
                    //存数据库
                    $data = [
                        'url'   =>  $save_path,
                        'type'  =>  $type,
                        'create_time'   =>  time()
                    ];
                    $pic = new Pic();
                    $add_res = $pic->addPic($data);
                    if(empty($add_res)){
                        //存数据库失败
                        @unlink(".".$save_path);
                    }
                    return show(true,"上传成功",['id'=>$pic->id,'path'=>$save_path]);
                }
            }
            return show(false,'上传失败');
        }catch (Exception $e){
            return show(false,'上传失败');
        }
    }



}