<?php
namespace app\common\model;

use think\Model;

class Setting extends Model
{
    /**
     * 读取一条数据
     */
    public function getSetting($condition=[],$field="*")
    {
        $res = $this->where($condition)->field($field)->find();
        return $res;
    }
}