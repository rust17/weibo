<?php
namespace Home\Controller;

class SettingController extends HomeController {
    //显示资料
    public function index(){
        if($this->login()){
            $User = D('User');
            $this->assign('user',$User->getUser());
            $this->display();
        }
    }

    //显示头像
    public function avatar(){
        if($this->login()){
            $User = D('User');
            $this->assign('bigFace',$User->getFace());
            $this->display();
        }
    }

    //显示个性域名
    public function domain(){
        if($this->login()){
            $User = D('User');
            $this->assign('domain',$User->getUser()['domain']);
            $this->display();
        }
    }

    //修改资料
    public function updateUser(){
        if(IS_AJAX){
            $User = D('User');
            $uid = $User -> updateUser(I('post.email'),I('post.intro'));
            echo $uid;
        }else{
            $this->error('非法访问！');
        }
    }

    //注册个性域名
    public function registerDomain(){
        if(IS_AJAX){
            $User = D('User');
            $uid = $User -> registerDomain(I('post.domain'));
            echo $uid;
        }else{
            $this->error('非法访问！');
        }
    }

    //显示@提及到我
    public function refer(){
        if($this->login()){
            $Refer = D('refer');
            $getRefer = $Refer->getRefer(session('user_auth'['id']));
            $this->assign('getRefer',$getRefer);
            $this->display();
        }
    }
}