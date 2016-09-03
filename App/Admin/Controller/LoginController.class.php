<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
        if(session('admin')){
            $this->redirect('Index/index');
        }else {
            $this->display();
        }
    }

    //验证管理员
    public function checkManager(){
        sleep(3);
        if(IS_AJAX){
            $Manage = D('Manage');
            $mid = $Manage->checkManager(I('post.manager'),I('post.password'));
            echo $mid;
        }else{
            $this->error('非法操作！');
        }
    }

    //退出登录
    public function out(){
        session('admin',null);
        $this->redirect('Login/index');
    }
}