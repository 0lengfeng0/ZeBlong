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
    //根据id删除数据
    public function delCategory($id_arr = [])
    {
        if(empty($id_arr)){
            exception('获取删除数据信息失败');
        }
        $res = $this->destroy($id_arr);
        return $res;
    }
    //修改数据
    public function editCategory($condition=[],$data=[])
    {
        if(!is_array($condition) || !is_array($data) || empty($data)){
            exception('获取要修改的数据信息失败');
        }
        $res = $this->where($condition)->update($data);
        return $res;
    }
    //按条件取数据
    public function getCategoryByCond($condition=[],$field="*")
    {
        $res = $this->where($condition)->field($field)->select();
        return $res;
    }
}