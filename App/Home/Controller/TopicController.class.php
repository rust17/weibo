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
            $tid = $Topic->publish(I('post.content'),session('user_auth')['id']);
                if($tid){
                    $iid = '';
                    $img = I('post.img','',false);
                    if(is_array($img)){
                        $Image = D('Image');
                        $iid = $Image->storage($img,$tid);
                        echo $iid ? $tid : 0;
                    }else{
                        echo $tid;
                    }
                }
        }else{
            $this->error('非法访问');
        }
    }
}