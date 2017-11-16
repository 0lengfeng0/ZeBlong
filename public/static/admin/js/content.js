$(function(){
    //初始化页面表格
    var oTable = new TableInit();
    //表格列参数
    var columns = [
        {
            field : 'checked',
            checkbox : true
        },
        {
            field:'id',
            title:'编号'
        },
        {
            field:'title',
            title:'标题',
            sortable:true

        },
        {
            field:'cate_name',
            title:'分类',
        },
        {
            field:'create_time',
            title:'创建时间',
            sortable:true,
            // formatter:function(value,row,index){
            //     return formatDate(value);
            // }
        },
        {
            field:'update_time',
            title:'更新时间',
            sortable:true,
            // formatter:function(value,row,index){
            //     return formatDate(value);
            // }
        },
        {
            field:'id',
            title:'操作',
            formatter:function(value,row,index){
                return "<button class='btn btn-sm btn-danger del_cat' data-id='"+row.id+"'>" +
                    "<span class='glyphicon glyphicon-remove' aria-hidden='true'></span> 删除" +
                    "</button> " +
                    "<a href='"+SCOPE.edit_content_url+"?id="+row.id+"' class='btn btn-sm btn-info' data-id='"+row.id+"'>" +
                    "<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> 编辑" +
                    "</a>";
            }
        }
    ];
    oTable.queryParams = function(params){
        return {
            limit : params.limit,   //页面大小
            offset: params.offset,  //页码
            order : params.order,   //排序规则
            sort  : params.sort,    //排序字段名
            search: params.search,   //搜索参数
            category : $("#category_select").val()
        };
    };
    oTable.Init("#content_table",SCOPE.get_content_url,columns,"#toolbar");

    //表格分类筛选change事件
    $("#category_select").change(function(){
        $("#content_table").bootstrapTable('refresh');
    });

    //表格单行删除按钮
    $(document).on('click','.del_cat',function(){
        var id = $(this).data('id');     //数据id
        ajaxdel(id);
    });
    //表格多行删除
    $("#del_all_btn").click(function(){
        //获取所有被选中的行
        var choose_obj = $('#content_table').bootstrapTable('getSelections');
        var id = new Array();
        $.each(choose_obj,function(i,e){
            id.push(e.id);
        });
        id = id.join(',');
        ajaxdel(id);
    });


});

//删除ajax
function ajaxdel(ids) {
    var id = ids;   //数据id
    var layer_confirm = layer.confirm('确认删除吗？', {
        btn: ['确定', '取消'] //按钮
    }, function () {
        layer.close(layer_confirm);
        //弹出一个loading层
        var layer_alert = layer.load();
        $.ajax({
            type: 'POST',
            data: {'id': id},
            url: SCOPE.del_content_url,
            dateType: 'json',
            success: function (res) {
                layer.close(layer_alert);
                if (res.status == false) {
                    layer.msg(res.msg, {icon: 5});
                } else {
                    layer.msg(res.msg, {icon: 6});
                    $("#content_table").bootstrapTable('refresh');
                }
            }

        });
    });
}
