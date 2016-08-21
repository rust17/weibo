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
        $('.main_right').height($('.main_left').height() + 30);
        $('#main').height($('.main_left').height() + 30);
    }

    //显示多图配图的居中方案
    if($('.imgs img').width() > 120){
        $('.imgs img').css('left',-($('.imgs img').width()-120)/2);
    }
    if($('.imgs img').height() > 120){
        $('.imgs img').css('top',-($('.imgs img').height()-120)/2);
    }

    //微博发布的按钮
    $('.weibo_button').button().click(function(e){
        var img = [];
        var images = $('input[name=image]');
        var len = images.length;
        for (var i = 0; i < len; i ++){
            img[i] = images.eq(i).val();

        }
        //如果没有上传图片，并且文本框也没有内容
        if(img.length == 0 && $('.weibo_text').val().length == 0){
            $('#error').html('请输入微博内容...').dialog('open');
            setTimeout(function(){
                $('#error').html('').dialog('close');
                $('.weibo_text').focus();
            },1000);
        }else if(img.length > 0 && $('.weibo_text').val().length == 0){
            $('.weibo_text').val('分享图片');
            weibo_ajax_send(img);
        }else{
            if(weibo_num()) {
                weibo_ajax_send(img);
            }
        }
    });

    //ajax提交微博
    function weibo_ajax_send(img){
        $.ajax({
            url : ThinkPHP['MODULE'] + '/Topic/publish',
            type : 'POST',
            data : {
                content : $('.weibo_text').val(),
                img : img,
            },
            beforeSend : function(){
                $('#loading').html('微博发布中...').dialog('open');
            },
            success : function(response,status){
                $('#loading').css('background','url('+ThinkPHP['IMG']+'/success.gif)no-repeat 20px center').html('微博发布成功');
                $('.weibo_pic_content,input[name="image"]').remove();
                $('#pic_box').hide();
                $('.pic_arrow_top').hide();
                $('.weibo_pic_total').text(0);
                $('.weibo_pic_limit').text(8);
                window.uploadCount.clear();
                setTimeout(function(){
                    $('.weibo_text').val('');
                    $('#loading').css('background','url('+ThinkPHP['IMG']+'/loading.gif)no-repeat 20px center').html('...').dialog('close');
                },500);
            },
        });
    }

    //微博输入内容计算字个数
    $('.weibo_text').on('keyup',weibo_num);
    //微博输入内容得到交单计算字个数
    $('.weibo_text').on('focus',function(){
        setTimeout(function(){
            weibo_num()
        },50);
    });

    //140字检测
    function weibo_num() {
        var total = 280;
        var len = $('.weibo_text').val().length;
        var temp = 0;
        if (len > 0) {
            for (var i = 0; i < len; i++) {
                if ($('.weibo_text').val().charCodeAt(i) > 255) {
                    temp += 2;
                } else {
                    temp++;
                }
            }
            var result = parseInt((total - temp) / 2 - 0.5);
            if (result >= 0) {
                $('.weibo_num').html('您还可以输入<strong>' + result + '</strong>个字');
                return true;
            } else {
                $('.weibo_num').html('已经超过了<strong class="red">' + result + '</strong>个字');
                return false;
            }
        }
    }

    //单独点击放大
    $('.img img').click(function(){
        $(this).parent().hide();
        var img_zoom = $(this).parent().next('.img_zoom');
        var img = img_zoom.find('img');
        img_zoom.show();
        img.attr('src',img.attr('data'));
        });

    //点击单独缩小
    $('.img_zoom img').click(function(){
        $(this).parent().hide();
        $(this).parent().prev('.img').show();
    });
    $(' .img_zoom .in a').click(function(){
        $(this).parent().parent().parent().hide();
        $(this).parent().parent().parent().prev('.img').show();
    });

    //多图点击放大
    $('.imgs img').click(function(){
        $('#imgs').dialog('open');
        $('#imgs img').attr('src',$(this).attr('unfold-src'));
    });

    //多张图片的dialog
    $('#imgs').dialog({
        width : 600,
        closeonEscape:false,
        modal:true,
        resizable:false,
        draggable:false,
        autoOpen:false,
    }).parent().find('.ui-widget-header').hide();

    $('#imgs').dialog('widget').css({
        background : '#fafafa',
        border : '1px solid #ccc',
        position : 'fixed',
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