<?php
namespace app\admin\controller;



use app\common\model\Content;
use think\Exception;

class Index extends Common
{
    //首页
    public function index()
    {

        $this->assign('_title','主页');
        return $this->fetch('index');
    }

    /**
     * 博文标题搜索
     */
    public function titleSearch()
    {
        if(request()->isPost()){
            try{
                $content = new Content();
                $title = input('post.title');
                $condition = [
                    'title' =>  $title,
                    'is_del'=>  0,
                ];
                $field = 'id';
                $info = $content->getContentDetail($condition,$field,null);
                if(empty($info)){
                    exception("搜索失败或无结果");
                }
                return show(true,'搜索成功',['id'=>$info->id]);
            }catch(Exception $e){
                return show(false,'搜索失败');
            }
        }
    }
}