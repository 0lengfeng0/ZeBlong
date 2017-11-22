<?php
namespace app\common\model;

use think\Model;

class ContentDetail extends Model
{
    /**
     * 新增一条数据
     */
    public function addContentDetail($data = [])
    {
        if(!is_array($data)  || empty($data)){
            exception('获取数据为空');
        }
        $res = $this->data($data)->save();
        return $res;
    }

    /**
     * 修改一条数据
     */
    public function editContentDetail($condition=[],$data=[])
    {
        if(!is_array($condition) || !is_array($data) || empty($data)){
            exception('获取修改数据为空');
        }
        $res = $this->where($condition)->update($data);
        return $res;
    }
}