<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/8/7
 * Time: 9:02
 */
namespace Home\Controller;
use Think\Verify;

class LoginController extends HomeController{
    public function index(){
        if(!session('?user_auth')) {
            $this->display();
        }else{
            $this->redirect('Index/index');
        }
    }
    public function verify(){
        $Verify = new Verify();
        $Verify->entry(1);
    }
}