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
        height : 330,
        title : '注册新用户',
        modal : true,
        resizable : false,
        closeText : '关闭',
        buttons : [{
            text : '提交',
            click : function(e){

            },
        }],
    });
});