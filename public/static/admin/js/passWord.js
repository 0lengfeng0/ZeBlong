/**
 * Created by xs-01 on 2017/11/15.
 */

$(function(){
    $("#psw_btn").click(function(){
        if(!$("input[name='old_psw']").val()){
            layer.msg('请输入原密码',{icon:5});
            return false;
        }
        if(!$("input[name='new_psw']").val()){
            layer.msg('请输入新密码',{icon:5});
            return false;
        }
        var postData = $("#psw_form").serialize();
        $.ajax({
            type    :   'POST',
            data    :   postData,
            url     :   SCOPE.psw_url,
            dataType:   'json',
            success :   function(res){
                if(res.status == false){
                    layer.msg(res.msg,{icon:5});
                }else{
                    layer.msg('修改成功，请重新登录',{icon:6},function(){
                        window.location.href = SCOPE.logout_url;
                    })
                }
            }
        })
    })
});
