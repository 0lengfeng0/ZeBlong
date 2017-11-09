<?php
namespace app\common\model;

use think\Model;

class User extends Model
{
    /**
     * 查询一条用户信息
     */
    public function getUserInfo($condition=[],$field='*')
    {
        $res = $this->where($condition)->field($field)->find();
        return $res;
    }
}