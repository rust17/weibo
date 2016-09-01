<?php
namespace Home\Controller;

class IndexController extends HomeController {
    public function index(){
        if($this->login()){

            $Topic = D('Topic');
            $topicList = $Topic->getList(0,10);
            $this->assign('topicList',$topicList);
            $this->assign('smallFace',session('user_auth')['face']->small);
            $this->assign('bigFace',session('user_auth')['face']->big);
            $this->display();
        }
    }
}