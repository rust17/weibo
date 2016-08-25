/**
 * Created by lenovo on 2016/8/25.
 */
$(function(){
    //消息和账号的下拉菜单
    $('.app').hover(function(){
        $(this).css({
            background : '#fff',
            color : '#333',
        }).find('.list').show();
    },function(){
        $(this).css({
            background: 'none',
            color: '#fff',
        }).find('.list').hide();
    });

    //error
    $('#error').dialog({
        width:190,
        height:40,
        closeonEscape:false,
        modal:false,
        resizable:false,
        draggable:false,
        autoOpen:false,
    }).parent().find('.ui-widget-header').hide();

    //loading
    $('#loading').dialog({
        width:190,
        height:40,
        closeonEscape:false,
        modal:true,
        resizable:false,
        draggable:false,
        autoOpen:false,
    }).parent().find('.ui-widget-header').hide();

})