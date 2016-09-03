/**
 * Created by lenovo on 2016/8/7.
 */
$(function(){
    $('#nav').tree({
        url : ThinkPHP['MODULE'] + '/Index/getNav',
        lines : true,
        onLoadSuccess : function(node,data){
            var _this = this;
            if(data){
                $(data).each(function(){
                    if(this.state == 'closed'){
                        $(_this).tree('expendAll');
                    }
                })
            }
        }
    });
});