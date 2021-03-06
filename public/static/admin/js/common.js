/**
 * Created by xs-01 on 2017/11/8.
 */
//公共js
$(function(){
     //回车全局搜索
    $("input[name='_globle_search']").keydown(function(e){
        event = e||window.event;
        //回车键的键值为13
        if (event.keyCode==13){
            if(!$(this).val()){
                layer.msg("请输入搜索内容",{icon:7});
                return false;
            }
            var jump_url = $(this).data('jump');
            //查询文章是否存在
            $.ajax({
                type    :   "POST",
                data    :   {title:$(this).val()},
                url     :   $(this).data('url'),
                dataType:   "json",
                success :   function(res){
                    if(res.status == false){
                        layer.msg("文章不存在或已被删除",{icon:5});
                    }else{
                        // alert(res.data.id);
                        window.location.href = jump_url+"?id="+res.data.id;
                    }
                }
            })
        }
    });
});
/**
 * 初始化bootstrap-table表格
 * @type {{Init: oTableInit.Init, queryParams: oTableInit.queryParams}}
 * @param ele 表格元素
 * @param url 表格数据请求地址
 * @param columns 列参数json
 * @param toolbar 工具栏元素
 */
var TableInit = function(){
    var oTableInit = {
        Init : function(ele,url,columns,toolbar){
            $(ele).bootstrapTable({
                url: url,
                method: 'post',
                striped:true,
                toolbar: toolbar ? toolbar : undefined,
                cache:false,
                pagination:true,
                sortable:true,                      //是否启用排序
                undefinedText:'无',
                sortOrder:'desc',
                queryParams:oTableInit.queryParams, //传递参数
                onEditableSave:oTableInit.onEditableSave,
                sidePagination:'server',
                pageNumber:1,
                pageSize:15,
                pageList: [10,15,25,50,100],
                search: true,                       //是否显示表格搜索，此搜索是客户端搜索，不会进服务端，所以，个人感觉意义不大
                strictSearch: true,
                showColumns: true,                  //是否显示所有的列
                showRefresh: true,                  //是否显示刷新按钮
                clickToSelect: true,
                uniqueId: "id",                     //每一行的唯一标识，一般为主键列
                showToggle:true,                    //是否显示详细视图和列表视图的切换按钮
                cardView: false,                    //是否显示详细视图
                columns: columns,                   //列数据
                locales: "zh-CN"
            });
        },
        queryParams : function(params){
            return {
                limit : params.limit,   //页面大小
                offset: params.offset,  //页码
                order : params.order,   //排序规则
                sort  : params.sort,    //排序字段名
                search: params.search   //搜索参数
            };
        }
    };
    return oTableInit;
};

/**
 * 时间戳->时间点[Y-m-d H:i]
 * @param ns 时间戳
 * @returns {string}
 */
function formatDate(ns){
    return new Date(parseInt(ns) * 1000).toLocaleString('chinese',{hour12:false}).replace(/年|月|\//g, "-").replace(/日/g, " ");
}
