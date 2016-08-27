/**
 * Created by lenovo on 2016/8/25.
 */
$(function(){
    //点击修改资料
    $('.submit').button().click(function(){
        $.ajax({
            url: ThinkPHP['MODULE'] + '/Setting/updateUser',
            type: 'POST',
            data: {
                email : $('input[name=email]').val(),
                intro : $('textarea[name=intro]').val(),
            },
            beforeSend : function(){
                $('#loading').html('资料修改中...').dialog('open');
            },
            success: function (data, response, status) {
                if(response == 'success'){
                    $('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/success.gif)no-repeat 20px 65%').html('资料修改成功。。。');
                    setTimeout(function(){
                        $('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/success.gif)no-repeat 20px 65%').dialog('close');
                    },500);
                };
            }
        });
    });

    //头像上传
    if($('#file').length > 0) {
        $('#file').uploadify({
            swf: ThinkPHP['UPLOADIFY'] + '/uploadify.swf',
            uploader: ThinkPHP['FACEURL'],
            width: 120,
            height: 35,
            fileTypeDesc: '图片类型',
            buttonCursor: 'pointer',
            buttonText: '上传头像',
            fileTypeExts: '*.jpeg; *.jpg; *.png; *.gif',
            fileSizeLimit: '1MB',
            overrideEvents: ['onSelectError', 'onSelect', 'onDialogClose'],
            onSelectError: function (file, errorCode, errorMsg) {
                switch (errorCode) {
                    case -110 :
                        $('#error').dialog('open').html('超过了1MB');
                        setTimeout(function () {
                            $('#error').dialog('close').html('...');
                        }, 1000);
                        break;
                }
            },
            onUploadStart: function () {
                $('#loading').html('头像上传中...').dialog('open');
            },
            onUploadSuccess: function (file, data, response) {
                if (data) {
                    $('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/success.gif)no-repeat 20px 65%').html('头像上传成功。。。');
                    $('#face, #crop_preview').attr('src', ThinkPHP['ROOT'] + '/' + $.parseJSON(data));
                    $('#url').val($.parseJSON(data));
                    $('#preview_box').show();
                    $('.save,.cancel').button().show();
                    $('#face').one('load', function () {
                        //裁剪头像
                        jcrop = $.Jcrop('#face', {
                            onChange: showPreview,
                            onSelect: showPreview,
                            //锁定纵横比
                            aspectRatio: 1,
                        });
                        //设置自动选区
                        jcrop.setSelect([0,0,200,200]);
                        $('#file').hide();
                        $('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/loading.gif)no-repeat 20px 65%').html('...').dialog('close');
                    });
                }
                ;
            }
        });
    }

    //取消当前图片裁剪
    $('.cancel').click(function(e){
        jcrop.destroy();
        $('#face,#crop_preview').attr('src', ThinkPHP['IMG'] + '/big.jpg');
        $('#preview_box').hide();
        $('.save,.cancel').hide();
        $('#file').show();
        return nothing(e);
    });

    //简单的事件处理程序，响应自onChange,onSelect事件按照上面的Jcrop调用
    function showPreview(coords){
        $('#x').val(coords.x);
        $('#y').val(coords.y);
        $('#w').val(coords.w);
        $('#h').val(coords.h);
        if(parseInt(coords.w) > 0){
            var rx = $("#preview_box").width() / coords.w;
            var ry = $("#preview_box").height() / coords.h;
            $("#crop_preview").css({
                width:Math.round(rx*$("#face").width()) + "px",
                height:Math.round(rx * $("#face").height()) + "px",
                marginLeft:"-"+Math.round(rx * coords.x)+"px",
                marginTop:"-"+Math.round(ry * coords.y)+"px"
            });
        }
    }

    function nothing(e){
        e.stopPropagation();
        e.preventDefault();
        return false;
    };

    //保存头像
    $('.save').click(function(){
        $.ajax({
            url: ThinkPHP['MODULE'] + '/File/crop',
            type: 'POST',
            data: {
                x : $('#x').val(),
                y : $('#y').val(),
                w : $('#w').val(),
                h : $('#h').val(),
                url : $('#url').val(),
            },
            beforeSend : function(){
                jcrop.destroy();
                $('.save, .cancel').hide();
                $('#loading').html('头像保存中...').dialog('open');
            },
            success: function(data,response,status){
                if(data){
                    $('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/success.gif)no-repeat 20px 65%').html('头像保存成功');
                    $('#face,#crop_preview').attr('src',ThinkPHP['ROOT'] + $.parseJSON(data)['big'] + '?random='+ Math.random());
                    $('#preview_box').hide();
                    $('#file').show();
                    setTimeout(function () {
                        $('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/loading.gif)no-repeat 20px center').html('...').dialog('close');
                    }, 500);
                }
            }
        })
    });
});