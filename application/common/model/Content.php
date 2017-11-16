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
}