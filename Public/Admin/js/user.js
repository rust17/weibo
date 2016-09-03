$(function(){
    $('#user').datagrid({
        url : ThinkPHP['MODULE'] + '/User/getList',
        fitColumns : true,
        rownumbers : true,
        border : false,
        striped : true,
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
            },
            {
                field : 'last_login',
                title : '最后登录时间',
                width : 100,
            },
            {
                field : 'last_ip',
                title : '最后登录ip',
                width : 100,
            },
        ]],
    });

    user_tool = {
        reload : function(){
            $('#user').datagrid('load');
        },
    };
})