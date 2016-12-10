/**
 * Created by lenovo on 2016/8/7.
 */
$(function(){
    //登录弹窗
    $('#login').dialog({
        title : '后台登陆',
        width : 300,
        height : 180,
        iconCls : 'icon-login',
        modal : true,
        buttons : '#btn',
    });

    //管理员账号
    $('#manager').validatebox({
        required : true,
        missingMessage : '请输入管理员账号',
        invalidMessage : '管理员账号不得为空',
    });

    //管理员密码
    $('#password').validatebox({
        required : true,
        validType : 'length[6,30]',
        missingMessage : '请输入管理员密码',
        invalidMessage : '管理员密码在6-30位之间',
    });

    //加载后定位光标至输入框
    if(!$('#manager').validatebox('isValid')){
        $('#manager').focus();
    }else if(!('#password').validatebox('isValid')){
        $('#password').focus();
    }

    //登录提交
    $('#btn a').click(function(){
        if(!$('#manager').validatebox('isValid')){
            $('#manager').focus();
        }else if(!$('#password').validatebox('isValid')){
            $('#password').focus();
        }else{
            $.ajax({
                url : ThinkPHP['MODULE'] + '/Login/checkManager',
                type : 'POST',
                data : {
                    manager : $('#manager').val(),
                    password : $('#password').val(),
                },
                beforeSend : function (){
                    $.messager.progress({
                        text : '正在尝试登陆...',
                    });
                },
                success : function(data,response,status){
                    $.messager.progress('close');
                    if(data > 0){
                        location.href = ThinkPHP['INDEX'];
                    }else{
                        $.messager.alert('登录失败！','管理员账号或密码不正确','warning',function(){
                            $('#password').select();
                        });
                    }
                },
            })
        }
    });
});