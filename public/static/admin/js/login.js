$(function(){
    $("#login_btn").click(function(){
        var data = {
            'name'      :   $('input[name="name"]').val(),
            'pwd'       :   $('input[name="pwd"]').val(),
            'remember'  :   $('input[name="remember"]').attr('checked')
        }

    });
});