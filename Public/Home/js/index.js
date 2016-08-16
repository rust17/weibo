/**
 * Created by lenovo on 2016/8/15.
 */
$(function(){
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
})