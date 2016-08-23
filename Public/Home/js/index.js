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
    for(var i = 0; i < $('.imgs img').length; i++) {
        if ($('.imgs img').eq(i).width() > 120) {
            $('.imgs img').eq(i).css('left', -($('.imgs img').eq(i).width() - 120) / 2);
        }else{
            $('.imgs img').eq(i).width(120);
        }
        if ($('.imgs img').eq(i).height() > 120) {
            $('.imgs img').eq(i).css('top', -($('.imgs img').eq(i).height() - 120) / 2);
        }else{
            $('.imgs img').eq(i).height(120);
        }
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
            success : function(data,response,status){
                if(data) {
                    $('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/success.gif)no-repeat 20px center').html('微博发布成功');
                    $('.weibo_pic_content,input[name="image"]').remove();
                    $('#pic_box').hide();
                    $('.pic_arrow_top').hide();
                    $('.weibo_pic_total').text(0);
                    $('.weibo_pic_limit').text(8);
                    window.uploadCount.clear();

                    var html = '';

                    switch (img.length){
                        case 0:
                            html = $('#ajax_html1').html();
                            break;
                        case 1:
                            html = $('#ajax_html2').html();
                            img = $.parseJSON(img);
                            break;
                        default :
                            for(var i = img.length-1; i >=0 ; i--){
                                img_arr = $.parseJSON(img[i]);
                                $('#ajax_html3').find('p').after('<div class="imgs"><img src="' + ThinkPHP['ROOT'] + '/' + img_arr['thumb'] + '" unfold-src="' + ThinkPHP['ROOT'] + '/' + img_arr['unfold'] + '" source-src="' + ThinkPHP['ROOT'] + '/' + img_arr['source'] + '" /></div>');
                            }
                            html = $('#ajax_html3').html();


                    }if(html.indexOf('#内容#')){
                        html = html.replace(/#内容#/g,$('.weibo_text').val());
                    }if(html.indexOf('#缩略图#')) {
                        html = html.replace(/#缩略图#/g, ThinkPHP['ROOT'] + '/' + img['thumb']);
                    }if(html.indexOf('#放大图#')) {
                        html = html.replace(/#放大图#/g, ThinkPHP['ROOT'] + '/' + img['unfold']);
                    }if(html.indexOf('#原图#')) {
                        html = html.replace(/#原图#/g, ThinkPHP['ROOT'] + '/' + img['source']);
                    }

                    //表情解析
                    html = html.replace(/\[(a|b|c|d)_([0-9])+\]/g,'<img src="'+ ThinkPHP['FACE'] + '/$1/$2.gif" border="0">');

                    setTimeout(function () {
                        $('.weibo_text').val('');
                        $('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/loading.gif)no-repeat 20px center').html('...').dialog('close');
                        $('.weibo_content ul').after(html);
                        for(var i = 0; i < $('.imgs img').length; i++) {
                            if ($('.imgs img').eq(i).width() > 120) {
                                $('.imgs img').eq(i).css('left', -($('.imgs img').eq(i).width() - 120) / 2);
                            }else{
                                $('.imgs img').eq(i).width(120);
                            }
                            if ($('.imgs img').eq(i).height() > 120) {
                                $('.imgs img').eq(i).css('top', -($('.imgs img').eq(i).height() - 120) / 2);
                            }else{
                                $('.imgs img').eq(i).height(120);
                            }
                        }
                    }, 500);
                }
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
    $('.weibo_content').on('click','.img img',function(){
        $(this).parent().hide();
        var img_zoom = $(this).parent().next('.img_zoom');
        var img = img_zoom.find('img');
        img_zoom.show();
        img.attr('src',img.attr('data'));
        });

    //点击单独缩小
    $('.weibo_content').on('click','.img_zoom img',function(){
        $(this).parent().hide();
        $(this).parent().prev('.img').show();
    });
    $('.weibo_content').on('click',' .img_zoom .in a',function(){
        $(this).parent().parent().parent().hide();
        $(this).parent().parent().parent().prev('.img').show();
    });

    //多图点击放大
    $('.weibo_content').on('click','.imgs img',function(){
        var _this = this;
        imgLoadEvent(function(obj){
            $('#imgs').dialog('open').dialog('option','height',obj['h'] + 90);
            $('#imgs img').attr('src',$(_this).attr('unfold-src'));
            $('#imgs .source a').click(function(){
                $(this).attr('href',$(_this).attr('source-src'));
            });
            var top = $('#imgs').dialog('widget').position().top;
            var left = $('#imgs').dialog('widget').position().left;
            $('.imgs_close').css({
                top : top - 18,
                left : left + 588,
                zIndex : 1001,
                display : 'block',
            }).click(function(){
                $('#imgs').dialog('close');
                $(this).hide();
            });
            $('#imgs img').click(function(){
                $('#imgs').dialog('close');
                $('.imgs_close').hide();
            });
        },$(_this).attr('unfold-src'));
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
        zIndex : 1000,
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
    //通过URL得到图片的长和高
    function imgLoadEvent(callback,url){
        var img = new Image();
        img.onreadystatechange = function(){
            if(this.readyState == "complete"){
                callback({"w":img.width,"h":img.height});
            }
        }
        img.onload = function(){
            if(this.complete == true)
            callback({"w":img.width,"h":img.height});
        }
        img.onerror = function () {
            callback({"w":0,"h":0});
        }
        img.src = url;
    }
})