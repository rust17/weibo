$(function(){
    $('#user').datagrid({
        url : ThinkPHP['MODULE'] + '/User/getList',
        fit : true,
        fitColumns : true,
        rownumbers : true,
        border : false,
        striped : true,
        toolbar : '#user_tool',
        pagination : true,
        pageList : [10,20,30,40,50],
        pageNumber : 1,
        pageSize : 10,
        sortName : 'create',
        sortOrder : 'DESC',
        columns : [[
            {
                field : 'id',
                title : '编号',
                width : 100,
                checkbox : true,
            },
            {
                field : 'username',
                title : '用户名',
                width : 100,
            },
            {
                field : 'email',
                title : '电子邮件',
                width : 100,
            },
            {
                field : 'domain',
                title : '个性域名',
                width : 100,
            },
            {
                field : 'create',
                title : '注册时间',
                width : 100,
                sortable : true,
            },
            {
                field : 'last_login',
                title : '最后登录时间',
                width : 100,
                sortable : true,
            },
            {
                field : 'last_ip',
                title : '最后登录ip',
                width : 100,
            },
        ]],
    });

    user_tool = {
        search : function(){
            $('#user').datagrid('load',{
                username : $.trim($('input[name="username"]').val()),
                date_from : $('input[name="date_from"]').val(),
                date_to : $('input[name="date_to"]').val(),
            })
        },
        reload : function(){
            $('#user').datagrid('reload');
        },
    };
})