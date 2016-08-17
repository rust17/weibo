/**
 * Created by lenovo on 2016/8/15.
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

    //微博高度保持一致
    if($('.main_left').height()>800){
        $('.main_right').height($('.main_left').height());
        $('#main').height($('.main_left').height());
    }

    //微博发布的按钮
    $('.weibo_button').button().click(function(e){
        if($('.weibo_text').val().length == 0){
            $('#error').html('请输入微博内容...').dialog('open');
            setTimeout(function(){
                $('#error').html('').dialog('close');
                $('.weibo_text').focus();
            },1000);
        }else{
            if(weibo_num()) {
                alert('提交发布');
            }
        }
    });

    //微博输入内容计算字个数
    $('.weibo_text').on('keyup',weibo_num);

    //140字检测
    function weibo_num(){
        var total = 288;
        var len = $('.weibo_text').val().length;
        var temp = 0;
        if(len > 0){
            for(var i = 0;i < len; i++){
                if($('.weibo_text').val().charCodeAt(i) > 255){
                    temp += 2;
                }else{
                    temp ++;
                }
            }
            var result = parseInt((total - temp)/2);
            if(result >= 0) {
                $('.weibo_num').html('您还可以输入<strong>' + result + '</strong>个字');
                return true;
            }
        }else{
            $('.weibo_num').html('已经超过了<strong class="red">' + result + '</strong>个字');
            return false;
        }
    }

    //error
    $('#error').dialog({
        width:190,
        height:40,
        closeonEscape:false,
        modal:true,
        resizable:false,
        draggable:false,
        autoOpen:false,
    }).parent().find('.ui-widget-header').hide();
})