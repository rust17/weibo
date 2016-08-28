<?php
namespace Home\Controller;

class SpaceController extends HomeController {
    //显示主页
    public function index($id = 0 , $domain = ''){
        if($id == 0 && $domain == '') {$this->error('非法操作');}
        if($this->login()){
            $User = D('User');
            if($id) {
                $getUser = $User->getUser($id);
                if ($getUser) {
                    $this->assign('user', $getUser);
                    $this->assign('bigFace', json_decode($getUser['face'])->big);
                    $this->display();
                } else {
                    $this->error('不存在此用户');
                }
            }
            if($domain){
                $getUser = $User->getUser2($domain);
                if ($getUser) {
                    $this->assign('user', $getUser);
                    $this->assign('bigFace', json_decode($getUser['face'])->big);
                    $this->display();
                } else {
                    $this->error('不存在此用户');
                }
            }
        }
    }

}