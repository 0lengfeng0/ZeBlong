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
            sortable:true,
            editable:true,

        },
        {
            field:'cate_name',
            title:'分类',
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
            field:'update_time',
            title:'更新时间',
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
});