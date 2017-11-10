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

    /**
     * 修改一条数据
     */
    public function editUserInfo($condition=[],$data=[])
    {
        if(!is_array($condition) || !is_array($data) || empty($data)){
            exception("获取修改信息失败");
        }
        $res = $this->where($condition)->update($data);
        return $res;
    }
}