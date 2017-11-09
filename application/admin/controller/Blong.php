<?php
namespace app\admin\controller;

use app\common\model\Category;

class Blong extends Common
{
    //分类
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

    //博文
    public function content()
    {

        $this->assign('_title','博文管理');
        return $this->fetch();
    }
}