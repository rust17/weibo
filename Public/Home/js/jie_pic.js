/**
 * Created by lenovo on 2016/8/19.
 */
//微博配图上传JS插件
$(function(){
    var jie_pic = {
        uploadTotal:0,
        uploadLimit:8,
        uploadify : function(){
            //文件上传测试
            $('#file').uploadify({
                swf : ThinkPHP['UPLOADIFY'] + '/uploadify.swf',
                uploader : ThinkPHP['UPLOADER'],
                width : 120,
                height : 35,
                fileTypeDesc : '图片类型',
                buttonCursor : 'pointer',
                buttonText : '上传图片',
                fileTypeExts : '*.jpeg; *.jpg; *.png; *.gif',
                fileSizeLimit : '1MB',
                overrideEvents : ['onSelectError','onSelect','onDialogClose'],
                onSelectError : function(file,errorCode,errorMsg){
                    switch (errorCode){
                        case -110 :
                            $('#error').dialog('open').html('超过了1MB');
                            setTimeout(function(){
                                $('#error').dialog('close').html('...');
                            },1000);
                            break;
                    }
                },
                onUploadStart : function(){
                    if(jie_pic.uploadTotal == 8){
                        $('#file').uploadify('stop');
                        $('#file').uploadify('cancel');
                        $('#error').dialog('open').html('限制为8张');
                        setTimeout(function(){
                            $('#error').dialog('close').html('...');
                        },1000);
                    }else{
                        $('.weibo_pic_list').append('<div class="weibo_pic_content"><span class="remove"></span><span class="text">删除</span><img src="'+ ThinkPHP['IMG'] +'/loading_100.png' +'" class="weibo_pic_img"/></div>');
                    }
                },
                onUploadSuccess : function(file, data, response){
                    $('.weibo_pic_list').append('<input type="hidden" name="image" value='+ data +' />');
                    var imageUrl = $.parseJSON(data);
                    jie_pic.thumb(imageUrl['thumb']);
                    jie_pic.hover();
                    jie_pic.remove();
                    jie_pic.uploadTotal++;
                    jie_pic.uploadLimit--;
                    $('.weibo_pic_total').text(jie_pic.uploadTotal);
                    $('.weibo_pic_limit').text(jie_pic.uploadLimit);
                }
            });
        },
        thumb : function(src){
            var img = $('.weibo_pic_img');
            var len = img.length;
            $(img[len - 1]).attr('src',ThinkPHP['ROOT']+src).hide();
            setTimeout(function(){
                if($(img[len - 1]).width() > 100){
                    $(img[len - 1]).css('left',-($(img[len - 1]).width()-100)/2);
                }
                if($(img[len - 1]).height() > 100){
                    $(img[len - 1]).css('top',-($(img[len - 1]).height()-100)/2);
                }
                $(img[len - 1]).attr('src',ThinkPHP['ROOT']+src).fadeIn();
            },50);
        },
        hover : function(){
            var content = $('.weibo_pic_content');
            var len = content.length;
            $(content[len - 1]).hover(function(){
                $(this).find('.remove').show();
                $(this).find('.text').show();
            },function(){
                $(this).find('.remove').hide();
                $(this).find('.text').hide();
            });
        },
        remove : function(){
            var remove = $('.weibo_pic_content .text');
            var len = remove.length;
            $(remove[len - 1]).on('click',function(){
                $(this).parent().next('input[name = "image"]').remove();
                $(this).parent().remove();
                jie_pic.uploadTotal--;
                jie_pic.uploadLimit++;
                $('.weibo_pic_total').text(jie_pic.uploadTotal);
                $('.weibo_pic_limit').text(jie_pic.uploadLimit);
            });
        },
        init : function(){
            $('#pic_btn').on('click',function(){
                var w = $(this).position();
                $('#pic_box').css({left: w.left-42,top: w.top+30}).show();
                $('.pic_arrow_top').show();
                jie_pic.uploadify();
            });
            //点击close图标关闭
            $('#pic_box a.close').on('click',function(){
                $('#pic_box').hide();
                $('.pic_arrow_top').hide();
            });
            //点击空白区域关闭
            /*
            $(document).on('click',function(e){
                var target = $(e.target);
                if(target.closest("#pic_btn").length == 1 || target.closest(".weibo_pic_content .text").length == 1)
                    return;
                if(target.closest("#pic_box").length == 0){
                    $('#pic_box').hide();
                    $('.pic_arrow_top').hide();
                }
            });
            */
        },

    };
    jie_pic.init();
    window.uploadCount = {
        clear : function(){
            jie_pic.uploadTotal = 0;
            jie_pic.uploadLimit = 8;
        }
    }
});