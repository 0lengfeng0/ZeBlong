/**
 * Created by xs-01 on 2017/11/13.
 */
// var wx_code_config = {
//     language : 'zh',                                  //语言
//     uploadUrl:SCOPE.upload_url,                     //上传URL
//     allowedFileExtensions: ['jpg', 'gif', 'png'],   //接收的文件后缀
//     uploadExtraData:{"type":3},                     //额外参数
//     uploadAsync: true, //默认异步上传
//     showUpload:false, //是否显示上传按钮
//     showRemove :false, //显示移除按钮
//     showPreview :true, //是否显示预览
//     showCaption:false,//是否显示标题
//     dropZoneEnabled: false,//是否显示拖拽区域
//     minImageWidth: 50, //图片的最小宽度
//     minImageHeight: 50,//图片的最小高度
//     maxImageWidth: 1000,//图片的最大宽度
//     maxImageHeight: 1000,//图片的最大高度
//     maxFileSize:3072,//单位为kb，如果为0表示不限制文件大小
//     minFileCount: 0,
//     maxFileCount:1, //表示允许同时上传的最大文件个数
//     enctype:'multipart/form-data',
//     validateInitialCount:true,
//     previewFileIcon: "<iclass='glyphicon glyphicon-king'></i>",
//     msgFilesTooMany: "选择上传的文件数量({n}) 超过允许的最大数值{m}！",
// };

// 上传控件配置参数
var projectfileoptions = {
    uploadUrl:SCOPE.upload_url,                     //上传URL
    uploadExtraData:{"type":3},                     //额外参数
    uploadAsync: true, //默认异步上传
    showUpload:false, //是否显示上传按钮
    showRemove :false, //显示移除按钮
    showPreview :true, //是否显示预览
    showCaption:false,//是否显示标题
    dropZoneEnabled: false,//是否显示拖拽区域
    language : 'zh',
    autoReplace:true,
    allowedPreviewTypes : [ 'image' ],
    allowedFileExtensions : [ 'jpg', 'png', 'gif','jpeg' ],
    minFileCount: 0,
    maxFileSize : 3072,
    maxFileCount:1, //表示允许同时上传的最大文件个数
    validateInitialCount:true,
    msgFilesTooMany: "选择上传的文件数量({n}) 超过允许的最大数值{m}！",
    enctype:'multipart/form-data',
};
$(function(){
    //上传控件初始化及相关事件
    $('input[class=projectfile]').each(function() {
        var ele = $(this);
        var imageurl = $(this).attr("value");
        projectfileoptions.uploadExtraData = {"name":$(this).attr('name'),"type":3};
        if (imageurl) {
            var op = $.extend({
                initialPreview : [ // 预览图片的设置
                    "<img src='" + imageurl + "' class='file-preview-image img-responsive'>", ]
            }, projectfileoptions);

            $(this).fileinput(op);
        } else {
            $(this).fileinput(projectfileoptions);
        }
        $(this).on("filebatchselected", function(event, files) {
            //自动上传
            //  console.log(event);
            // console.log(files);
            $(this).fileinput("upload");
        }).on("fileuploaded", function (event, data, previewId, index){
            //异步成功回调
            if(data.response.status != true){
                layer.msg(data.response.msg,{icon:5});
            }else{
                // ele.val(data.response.data.path).data('id',data.response.data.id);
                ele.parents('.form-group').find("input[type='hidden']").val(data.response.data.path).data('id',data.response.data.id);
            }
        }).on("filesuccessremove",function(event,id){
            ele.parents('.form-group').find("input[type='hidden']").val("").data("");
        }).on("fileerror", function(event, data, previewId, index){
            //异步失败回调
            layer.msg('上传失败',{icon:5});
        });
    });

    //表单提交事件
    $("#basic_btn").click(function(){
        var post_data = $("#basic_form").serialize();
        $.ajax({
            type    :   'POST',
            data    :   post_data,
            url     :   SCOPE.post_basic_url,
            dataType:   'json',
            success :   function(res){
                if(res.status == false){
                    layer.msg('修改失败',{icon:5});
                }else{
                    layer.msg('修改成功',{icon:6});
                }
            }
        });
    });
});

