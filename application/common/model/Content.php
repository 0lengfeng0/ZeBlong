<?php
namespace app\common\model;

use think\Model;

class Content extends Model
{
    /**
     * 获取数据数量
     */
    public function getContentCount($condition=[])
    {
        $res = $this->where($condition)->count();
        return $res;
    }

    /**
     * 分页取数据
     */
    public function getContentByPage($condition=[],$page=[],$order='a.update_time DESC',$join='',$field="*")
    {
        if(empty($page['limit']) || empty($page['offset'])){
            exception('获取分页数据失败');
        }
        $res = $this->alias('a')->where($condition)->order($order)->page($page['offset'].','.$page['limit']);
        if(!empty($join)){
            $res = $res->join($join);
        }
        $res = $res->field($field)->select();
        return $res;
    }

    /**
     * 修改数据
     */
    public function editContent($condition=[],$data=[])
    {
        if(!is_array($condition) || !is_array($data) || empty($data)){
            exception('获取要修改的数据信息失败');
        }
        $res = $this->where($condition)->update($data);
        return $res;
    }

    /**
     * 获取文章详情数据
     */
    public function getContentDetail($condition=[],$field='*',$join=[])
    {
        $res = $this->alias("a")->where($condition);
        if(!empty($join)){
            $res = $res->join($join);
        }
        $res = $res->field($field)->find();
        return $res;
    }

    /**
     * 新增数据
     */
    public function addContent($data=[])
    {
        if(!is_array($data) || empty($data)){
            exception('获取数据失败');
        }
        $res = $this->data($data)->save();
        return $res;
    }
}