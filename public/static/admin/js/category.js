/**
 * Created by xs-01 on 2017/11/8.
 */
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
            field:'name',
            title:'分类名',
            sortable:true,
            editable:true,

        },
        {
            field:'create_time',
            title:'创建时间',
            sortable:true,
            formatter:function(value,row,index){
                return formatDate(value);
            }
        },
        {
            field:'id',
            title:'操作',
            formatter:function(value,row,index){
                return "<button class='btn btn-sm btn-danger del_cat' data-id='"+row.id+"'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span>删除</button>";
            }
        }
    ];
    //表格行编辑事件
    oTable.onEditableSave = function (field, row, oldValue, $el) {
        if(!row.name){
            layer.msg('请输入新分类名',{icon:7});
            return false;
        }
        $.ajax({
            type:'POST',
            data:{'id':row.id,'name':row.name},
            url :SCOPE.edit_cat_url,
            dateType:'json',
            success:function(res){
                if(res.status == false){
                    layer.msg(res.msg,{icon:5});
                }else{
                    layer.msg(res.msg,{icon:6});
                }
            }
        });
    };
    oTable.Init("#content_table",SCOPE.get_table_url,columns,"#toolbar");

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

    //新增按钮
    $("#add_cat_btn").click(function(){
        $('input[name="cat_name"]').val("");
        $("#cat_add_yes_btn").prop('disabled',0).html("确定");
        $('#add_modal').modal('show');
    });
    //模态框确认按钮
    $("#cat_add_yes_btn").click(function(){
        var name = $('input[name="cat_name"]').val();
        if(!name){
            layer.msg("请填写分类名称",{icon:7});
            return false;
        }
        $("#cat_add_yes_btn").prop('disabled',1).html("请稍后");
        $.ajax({
            type:'POST',
            data:{'name':name},
            url :SCOPE.add_cat_url,
            dateType:'json',
            success:function(res){
                $("#cat_add_yes_btn").prop('disabled',0).html("确定");
                if(res.status == false){
                    layer.msg(res.msg, {icon: 5});
                }else{
                    layer.msg(res.msg, {icon: 6});
                    $('#add_modal').modal('hide');
                    $("#content_table").bootstrapTable('refresh');
                }
            }
        })
    });
});

//删除ajax
function ajaxdel(ids)
{
    var id = ids;   //数据id
    var layer_confirm = layer.confirm('确认删除吗？', {
        btn: ['确定','取消'] //按钮
    }, function(){
        layer.close(layer_confirm);
        //弹出一个loading层
        var layer_alert = layer.load();
        $.ajax({
            type:'POST',
            data:{'id':id},
            url :SCOPE.del_td_url,
            dateType:'json',
            success: function(res){
                layer.close(layer_alert);
                if(res.status == false){
                    layer.msg(res.msg, {icon: 5});
                }else{
                    layer.msg(res.msg, {icon: 6});
                    $("#content_table").bootstrapTable('refresh');
                }
            }

        });
    });
}

