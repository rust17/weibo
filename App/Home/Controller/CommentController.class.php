<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/8/18
 * Time: 19:15
 */
namespace Home\Controller;
class CommentController extends HomeController{
    //发布微博
    public function publish(){
        if(IS_AJAX){
            $Comment = D('Comment');
            $cid = $Comment->publish(I('post.content'),session('user_auth')['id'],I('post.tid'));
            echo $cid;
        }else{
            $this->error('非法访问');
        }
    }


}