$(function(){
    $("input").keydown(function(e){
        event = e||window.event;
        if (event.keyCode==13)  //回车键的键值为13
            $("#login_btn").trigger('click'); //调用登录按钮的登录事件
    });
    $("#login_btn").click(function(){
        //表单验证
        if(!$('input[name="name"]').val()){
            $('input[name="name"]').parent(".input-group").addClass('has-error');
        }else{
            $('input[name="name"]').parent(".input-group").removeClass('has-error');
        }
        if(!$('input[name="pwd"]').val()){
            $('input[name="pwd"]').parent(".input-group").addClass('has-error');
        }else{
            $('input[name="pwd"]').parent(".input-group").removeClass('has-error');
        }
        var data = {
            'name'      :   $('input[name="name"]').val(),
            'pwd'       :   $('input[name="pwd"]').val(),
            'remember'  :   $('input[name="remember"]').is(':checked')
        };
        //发post
        $.ajax({
            type:'POST',
            data:data,
            url:SCOPE.login_url,
            dataType:'json',
            success:function(res){
                if(res.status == false){
                    layer.msg(res.msg,{icon:5});
                }else{
                    window.location.href = SCOPE.index_url;
                }
            }
        })
    });
});