var textEditor;         //编辑器变量
$(function(){
    //初始化md编辑器
    textEditor = editormd("markdown",{
        // markdown: md,               //初始内容
        height  : 640,              //初始高度
        codeFold : true,            //代码折叠
        syncScrolling : "single",
        emoji: true,
        path    : SCOPE.editormd_path_url
    });
    //表单提交事件
    $("#content_btn").click(function(){
        var title = $("input[name='title']").val();                     //标题
        var author = $("input[name='author']").val();                   //作者
        var category_id = $("select[name='category_id']").val();         //分类id
        var contentDetail = $("textarea[name='contentDetail']").val();  //文章内容
        var id = $("input[name='id']").val() ? $("input[name='id']").val() : "";
        //表单验证
        if(!title){
            layer.msg('请输入标题',{icon:7});
            return false;
        }
        if(title.length > 50 || title.length < 0){
            layer.msg('标题超出字数限制[0-50]',{icon:7});
            return false;
        }
        if(!author){
            layer.msg('请输入作者',{icon:7});
            return false;
        }
        if(author.length > 10 || author.length < 0 ){
            layer.msg("作者长度超出限制[0-10]",{icon:7});
            return false;
        }
        if(!category_id){
            layer.msg("请选择分类");
            return false;
        }
        if(!contentDetail){
            layer.msg("请输入文章内容",{icon:7});
            return false;
        }
        var postData = {
            'title'         :   title,
            'author'        :   author,
            'category_id'   :   category_id,
            'contentDetail' :   contentDetail,
            'id'            :   id
        };
        //post
        $.ajax({
            type    :   'POST',
            data    :   postData,
            url     :   SCOPE.due_content_url,
            dataType:   'json',
            success :   function(res){
                if(res.status == false){
                    layer.msg(res.msg,{icon:5});
                    return false;
                }else{
                    layer.msg(res.msg,{icon:6},function(){
                        self.location=document.referrer;
                    });
                }
            }
        });
    });
});
