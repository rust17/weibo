/**
 * Created by lenovo on 2016/8/7.
 */
$(function(){
    //登录页背景随机
    //var rand = Math.floor(Math.random() * 5)+1;
    //$('body')
    //    .css('background','url('+ThinkPHP['IMG']+'/login_bg'+rand+'.jpg)no-repeat')
    //    .css('background-size','100%');
    //登录页的按钮
    $('#login input[type="submit"]').button();

    //创建注册对话框
    $('#register').dialog({
        width : 430,
        height : 370,
        title : '注册新用户',
        modal : true,
        resizable : false,
        autoOpen : false,
        closeText : '关闭',
        buttons : [{
            text : '提交',
            click : function(e){
                $(this).submit();
            }
        }],
    }).validate({
        submitHandler : function(form){
            $(form).ajaxSubmit({
                url: ThinkPHP['MODULE']+'/User/register',
                type : 'POST',
            });
        },
        errorLabelContainer : 'ol.register_errors',
        wrapper : 'li',
        showErrors : function(errorMap,errorList){
            var errors = this.numberOfInvalids();
            if(errors > 0){
                $('#register').dialog('option','height',errors * 20 +370);
            }else{
                $('#register').dialog('option','height',370);
            }
            this.defaultShowErrors();
        },
        highlight : function (element, errorClass) {
            $(element).css('border','1px solid red');
            $(element).parent().find('span').html('*').removeClass('succ');
        },
        unhighlight : function(element,errorClass){
            $(element).css('border','1px solid #ccc');
            $(element).parent().find('span').html('&nbsp').addClass('succ');
        },
        rules : {
            username : {
                required : true,
                minlength : 2,
                maxlength : 20,
                remote : {
                    url : ThinkPHP['MODULE']+'/User/checkUsername',
                    type : 'POST',
                    beforeSend : function(){
                        $('#username').next().html('&nbsp;').removeClass('succ').addClass('loading');
                    },
                    complete : function(jqXHR){
                        if(jqXHR.responseText == 'true'){
                            $('#username').next().html('&nbsp;').removeClass('loading').addClass('succ');
                        }else{
                            $('#username').next().html('*').removeClass('loading').removeClass('succ');
                        }
                    }
                },
            },
            password : {
                required : true,
                minlength : 6,
                maxlength : 30,
            },
            repassword : {
                required : true,
                equalTo : '#password',
            },
            email : {
                required : true,
                email : true,
                remote : {
                    url : ThinkPHP['MODULE']+'/User/checkEmail',
                    type : 'POST',
                    beforeSend : function(){
                        $('#email').next().html('&nbsp;').removeClass('succ').addClass('loading');
                    },
                    complete : function(jqXHR){
                        if(jqXHR.responseText == 'true'){
                            $('#email').next().html('&nbsp;').removeClass('loading').addClass('succ');
                        }else{
                            $('#email').next().html('*').removeClass('loading').removeClass('succ');
                        }
                    }
                },
            },
        },
        messages : {
            username : {
                required : '账号不得为空',
                minlength : $.format('账号不得小于{0}位'),
                maxlength : $.format('账号不得大于{0}位'),
                remote : '账号被占用',
            },
            password : {
                required : '密码不得为空',
                minlength : $.format('密码不得小于{0}位'),
                maxlength : $.format('密码不得大于{0}位'),
            },
            repassword : {
                required : '密码确认不得为空',
                equalTo : '密码和密码确必须一致',
            },
            email : {
                required : '邮箱不得为空',
                email : '邮箱格式不正确',
                remote : '邮箱被占用',
            },
        },
    });
    //点击注册
    $('#reg_link').click(function(){
        $('#register').dialog('open');
    });
});