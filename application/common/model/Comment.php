<?php
namespace app\common\model;

use think\Model;

class Comment extends Model
{
    /**
     * 查询数据总数
     */
    public function getCommentCount($condition)
    {
        $count = $this->where($condition)->count();
        return $count;
    }

    /**
     * 分页查询数据
     */
    public function getCommentByPage($condition=[],$field="*",$page=[],$order='floor DESC',$join=[])
    {
        if(empty($page['limit']) || empty($page['offset'])){
            exception('获取分页数据失败');
        }
        $res = $this->where($condition)->field($field)->order($order);
        if(!empty($join)){
            $res = $res->join($join);
        }
        $res = $res->page($page['offset'].','.$page['limit'])->select();
        return $res;
    }

    /**
     * 修改一条数据
     */
    public function editComment($condition=[],$data=[])
    {
        if(!is_array($condition) || !is_array($data) || empty($data)){
            exception('获取要修改的数据信息失败');
        }
        $res = $this->where($condition)->update($data);
        return $res;
    }
}