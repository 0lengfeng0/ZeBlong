<?php
namespace app\admin\controller;

use think\Exception;

class Comment extends Common
{
    /**
     * 留言管理
     */
    public function message()
    {
        if(request()->isPost()){
            //AJAX查询
            try{
                $comment = new \app\common\model\Comment();
                $limit = input('post.limit');   //页面大小
                $offset = input('post.offset'); //页码
                $order = input('post.order');   //排序规则
                $sort = input('post.sort');     //排序字段
                $search = input('post.search');      //搜索关键字
                $condition = [
                    'is_del'    =>  0,
                ];
                if(!empty($search)){
                    $condition['ip'] = $search;
                }
                $order_str = 'floor DESC';
                if(!empty($order) && !empty($sort)){
                    $order_str = $sort.' '.$order;
                }
                $page = array(
                    'limit' => $limit,
                    'offset'=> intval($offset/$limit) + 1,
                );
                //查询数据总数
                $count = $comment->getCommentCount($condition);
                if($count === false){
                    exception("获取数据总数失败");
                }
                $join = [
                    ['__MEMBER__ b','b.id='.config('database.prefix').'comment.member_id','left']
                ];
                $field = config('database.prefix').'comment.*,b.nickname';
                //分页查询数据
                $list = $comment->getCommentByPage($condition,$field,$page,$order_str,$join);
                if($list === false){
                    exception("获取数据信息失败");
                }
                $list = json_decode(json_encode($list),true);
                $result = [];
                $result['total'] = $count;
                $result['rows'] = $list;
                return json($result);
            }catch (Exception $e){
                return json(['total'=>0,'rows'=>[]]);
            }
        }
        $this->assign('_title','留言管理');
        return $this->fetch();
    }

    /**
     * 博文评论
     */
    public function blongComment()
    {
        return $this->fetch();
    }

    /**
     * 删除评论
     */
    public function deleteComment()
    {
        try{
            $comment = new \app\common\model\Comment();
            $id = input('post.id');
            if(empty($id)){
                return show(false,'删除失败');
            }
            $condition = [
                'id'    =>  ['in',$id]
            ];
            $data = [
                'is_del'   =>   1
            ];
            $del_res = $comment->editComment($condition,$data);
            if(empty($del_res)){
                return show(false,'删除失败');
            }
            return show(true,'删除成功');
        }catch (Exception $e){
            return show(false,'删除失败');
        }
    }
}