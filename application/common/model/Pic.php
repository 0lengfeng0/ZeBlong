<?php
namespace app\common\model;

use think\Model;

class Pic extends Model
{
    /**
     * 添加一条数据
     */
    public function addPic($data = [])
    {
        if(!is_array($data) || empty($data)){
            exception('获取添加数据失败');
        }
        $res = $this->data($data)->save();
    }
}