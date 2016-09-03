<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
    //显示会员列表
    public function index(){
        if (session('admin')) {
            $this->display();
        } else {
            $this->redirect('Login/index');
        }
    }

    //获取会员数据
    public function getList(){
        if(IS_AJAX){
            $User = D('User');
            $this->ajaxReturn($User->getList());
        }else{
            $this->error('非法操作');
        }
    }
}