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
            sortable:true

        },
        {
            field:'create_time',
            title:'创建时间',
            sortable:true
        },
        {
            field:'id',
            title:'操作',
            formatter:function(value,row,index){
                return "<button class='btn btn-sm btn-danger' data-id='"+row.id+"'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span>删除</button>";
            }
        }
    ];
    oTable.Init("#content_table",SCOPE.get_table_url,columns,"#toolbar");
});

