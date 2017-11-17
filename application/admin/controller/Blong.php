<?php
namespace app\admin\controller;

use app\common\model\Content;
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
                    'offset'=> intval($offset/$limit) + 1,
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

    /**
     * 博文列表
     * @return mixed|\think\response\Json|void
     */
    public function content()
    {
        if(request()->isPost()){
            //ajax查询
            try{
                $content = new Content();
                $category = input('post.category');
                $limit = input('post.limit');   //页面大小
                $offset = input('post.offset'); //页码
                $order = input('post.order');   //排序规则
                $sort = input('post.sort');     //排序字段
                $search = input('post.search');      //搜索关键字

                $condition = [
                    'is_del'     =>  0,
                    'title'      =>  ['like','%'.$search.'%'],
                ];
                $cond = [
                    'a.is_del'     =>  0,
                    'a.title'      =>  ['like','%'.$search.'%'],
                ];
                if(!empty($category)){
                    $condition['category_id'] = $category;
                    $cond['a.category_id'] = $category;
                }
                $order_str = 'update_time DESC';
                $or_str = 'a.update_time DESC';
                if(!empty($order) && !empty($sort)){
                    $order_str = $sort.' '.$order;
                    $or_str = 'a.'.$sort.' '.$order;
                }
                $page = array(
                    'limit' => $limit,
                    'offset'=> intval($offset/$limit) + 1,
                );
                //读取博文总数
                $count = $content->getContentCount($condition);
                if($count === false){
                    exception('获取数据总数失败');
                }elseif($count == 0){
                   exception('暂无数据');
                }
                //查询文章数据
                $join = [
                    ['__CATEGORY__ b','category_id=b.id']
                ];
                $field = 'a.*,b.id as cate_id,b.name as cate_name';
                $content_list = $content->getContentByPage($cond,$page,$or_str,$join,$field);
                if($content_list === false){
                    exception('获取数据失败');
                }
//                var_dump(json_encode($content_list));exit;
                $content_list = json_decode(json_encode($content_list),true);   //对象转数组
                $result = [];
                $result['total'] = $count;
                $result['rows'] = $content_list;
                return json($result);
            }catch(Exception $e){
                return json(['total'=>0,'rows'=>[]]);
            }
        }
        //获取全部分类
        $category = new Category();
        $cate_list = $category->getCategoryByCond(['is_del'=>0],'id,name');
        if($cate_list === false){
            return $this->error('获取分类数据失败！');
        }
        $this->assign('category',$cate_list);
        $this->assign('_title','博文管理');
        return $this->fetch();
    }

    /**
     * 删除博文
     */
    public function delContent()
    {
        try{
            $content = new Content();
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
            $del_res = $content->editContent($condition,$data);
            if(!empty($del_res)){
                return show(true,'删除成功');
            }
            return show(false,'删除失败');
        }catch (Exception $e){
            return show(false,"删除失败");
        }
    }

    /**
     * 添加博文
     */
    public function addContent()
    {
        return $this->fetch('contentDetail');
    }

    /**
     * 编辑博文
     */
    public function editContent()
    {
        return $this->fetch('contentDetail');
    }
}