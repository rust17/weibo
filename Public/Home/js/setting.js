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
});