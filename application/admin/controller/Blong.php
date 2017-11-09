<?php
namespace app\admin\controller;

use app\common\model\Category;
use think\Exception;

class Blong extends Common
{
    /**
     * 分类列表
     * @return mixed|\think\response\Json
     */
    public function category()
    {
        //判断是否为post请求
        if($this->request->isPost()){
            //是post
            $category = new Category();
            try{
                $limit = input('post.limit');   //页面大小
                $offset = input('post.offset'); //页码
                $order = input('post.order');   //排序规则
                $sort = input('post.sort');     //排序字段
                $search = input('search');      //搜索关键字
                $condition = [
                    'is_del'    =>  0,
                    'name'      =>  ['like','%'.$search.'%'],
                ];
                $order_str = 'create_time DESC';
                if(!empty($order) && !empty($sort)){
                    $order_str = $sort.' '.$order;
                }
                $page = array(
                    'limit' => $limit,
                    'offset'=> intval($offset) + 1,
                );
                //查询数据总数
                $count = $category->getCategoryCount($condition);
                if($count === false){
                    exception('获取数据总数失败');
                }
                //按页查询数据
                $list = $category->getCategoryByPage($condition,$page,$order_str);
                if($list === false){
                    exception('获取分类数据失败');
                }

                $result = [];
                $result['total'] = $count;
                $result['rows'] = [];
                if(!empty($list)){
                    foreach ($list as $v){
                        $result['rows'][] = $v->getData();
                    }
                }
                return json($result);
//                return show(true,'获取数据成功',$result);
            }catch (Exception $e){
                return show(false,$e->getMessage());
            }
        }
        $this->assign('_title','分类管理');
        return $this->fetch();
    }

    /**
     * 删除分类[假删除]
     * @param $type 删除类型(1-单条，2-多条)
     * @return mixed
     */
    public function delCategory()
    {
        try{
            $category = new Category();
            $id = input('post.id');
            if(empty($id)){
                return show(false,'删除失败');
            }
            $condition = [
                'id'    =>  ['in',$id]
            ];
            $data = [
                'is_del'    =>  1
            ];
            $del_res = $category->editCategory($condition,$data);
            if(!empty($del_res)){
                return show(true,'删除成功');
            }
            return show(false,'删除失败');
        }catch (Exception $e){
            return show(false,"删除失败");
        }
    }

    /**
     * 添加分类
     * @param $name 分类名
     * @return \think\response\Json
     */
    public function addCategory()
    {
        try{
            $category = new Category();
            $name = input('post.name');
            if(empty($name) || mb_strlen($name) > 10){
                return show(false,'请输入正确的分类名[1-10字]');
            }
            //添加数据
            $data = [
                'name'  =>  $name,
                'create_time'   =>  time(),
                'is_del'    =>  0
            ];
            $add_res = $category->addCategory($data);
            if(empty($add_res)){
                return show(false,'添加失败');
            }
            return show(true,'添加成功');
        }catch(Exception $e){
            return show(false,'添加失败');
        }
    }

    /**
     * 修改分类名
     */
    public function editCategory()
    {
        try{
            $category = new Category();
            $id = input('post.id');
            if(empty($id)){
                return show(false,'删除失败');
            }
            $name = input('post.name');
            if(empty($name) || mb_strlen($name) > 10){
                return show(false,'请输入正确的分类名[1-10字]');
            }
            //修改数据
            $condition = [
                'id'    =>  $id
            ];
            $data = [
                'name'  =>  $name
            ];
            $edit_res = $category->editCategory($condition,$data);
            if($edit_res === false){
                return show(false,'修改失败');
            }
            return show(true,'修改成功');
        }catch (Exception $e){
            return show(false,'修改失败');
        }
    }

    //博文
    public function content()
    {

        $this->assign('_title','博文管理');
        return $this->fetch();
    }
}