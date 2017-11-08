<?php
namespace app\common\model;

use think\Model;

class Category extends Model
{
    //查询数据总数
    public function getCategoryCount($condition=[])
    {
        $count = $this->where($condition)->count();
        return $count;
    }
    //分页查询数据
    public function getCategoryByPage($condition=[],$page=[],$order='create_time DESC')
    {
        if(empty($page['limit']) || empty($page['offset'])){
            exception('获取分页数据失败');
        }
        $res = $this->where($condition)->order($order)->page($page['offset'].','.$page['limit'])->select();
        return $res;
    }
    //新增数据
    public function addCategory($data = [])
    {
        if(empty($data) || !is_array($data)){
            exception("获取数据失败");
        }
        $res = $this->data($data)->save();
        return $res;
    }
}