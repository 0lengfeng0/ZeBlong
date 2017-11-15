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

    /**
     * 修改一条数据
     */
    public function editSetting($condition=[],$data=[])
    {
        if(!is_array($condition) || empty($condition)){
            exception('获取数据信息失败');
        }

        $res = $this->where($condition)->update($data);
        return $res;
    }
}