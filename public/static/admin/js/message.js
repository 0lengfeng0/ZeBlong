$(function () {
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
            field:'content',
            title:'内容',

        },
        {
            field:'create_time',
            title:'时间',
            sortable:true
        },
        {
            field:'member_id',
            title:'评论人',
            formatter:function (value,row,index) {
                var str = "";
                if(row.is_anonymous == "1"){
                    str = "匿名";
                }else{
                    str = row.nickname;
                }
                str = str + " ["+row.ip+"]";
                return "<span>"+str+"</span>";
            }
        },
        {
            field:'floor',
            title:'楼层',
            sortable:true,
        },
        {
            field:'id',
            title:'操作',
            formatter:function(value,row,index){
                return "<button class='btn btn-sm btn-danger del_msg' data-id='"+row.id+"'>" +
                    "<span class='glyphicon glyphicon-remove' aria-hidden='true'></span> 删除" +
                    "</button> ";
            }
        }
    ];

    oTable.Init("#message_table",SCOPE.get_message_url,columns,"#toolbar");

    //表格单行删除按钮
    $(document).on('click','.del_msg',function(){
        var id = $(this).data('id');     //数据id
        ajaxdel(id);
    });
    //表格多行删除
    $("#del_all_btn").click(function(){
        //获取所有被选中的行
        var choose_obj = $('#message_table').bootstrapTable('getSelections');
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
            url: SCOPE.del_comment_url,
            dateType: 'json',
            success: function (res) {
                layer.close(layer_alert);
                if (res.status == false) {
                    layer.msg(res.msg, {icon: 5});
                } else {
                    layer.msg(res.msg, {icon: 6});
                    $("#message_table").bootstrapTable('refresh');
                }
            }
        });
    });
}