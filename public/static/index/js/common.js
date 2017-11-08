$(function(){
    autoFixHeight();
});
$(window).resize(function(){
    autoFixHeight();
})

//自动调整元素高度
function autoFixHeight()
{
    //窗口高度
    var winHeight = $(window).height();
    $('body').height(winHeight+"px");
    if($(window).width() <= 970){
        $('.right').height((winHeight-$('.left').height())+"px");
    }else{
        $('.right').height("100%");
    }
}