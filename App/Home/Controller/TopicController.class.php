<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/8/18
 * Time: 19:15
 */
namespace Home\Controller;
class TopicController extends HomeController{
    //发布微博
    public function publish(){
        if(IS_AJAX){
            $Topic = D('Topic');
            $tip = $Topic->publish(I('post.content'),session('user_auth')['id']);
            echo $tip;
        }else{
            $this->error('非法访问');
        }
    }
}