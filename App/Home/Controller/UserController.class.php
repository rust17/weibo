<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/8/7
 * Time: 9:02
 */
namespace Home\Controller;

class UserController extends HomeController{
    //注册行为返回给Ajax
    public function register(){
        if(IS_POST) {
            $User = D('User');
            $uid = $User->register(I('post.username'), I('post.password'),I('post.repassword'), I('post.email'),I('post.verify'));
            print_r($uid);
        }else{
            $this->error('非法访问');
        }
    }
    //登录行为返回给Ajax
    public function login(){
        if(IS_AJAX) {
            $User = D('User');
            $uid = $User->login(I('post.username'), I('post.password'),I('post.auto'));
            echo $uid;
        }else{
            $this->error('非法访问');
        }
    }
    //Ajax验证数据，账号返回给Ajax
    public function checkUserName(){
        if(IS_AJAX){
            $User = D('User');
            $uid = $User->checkField(I('post.username'),'username');
            echo $uid >0 ? 'true' : 'false';
        }else{
            $this->error('非法访问');
        }
    }
    //Ajax验证数据，邮箱返回给Ajax
    public function checkEmail(){
        if(IS_AJAX){
            $User = D('User');
            $uid = $User->checkField(I('post.email'),'email');
            echo $uid >0 ? 'true' : 'false';
        }else{
            $this->error('非法访问');
        }
    }

    //Ajax验证数据，验证码返回给Ajax
    public function checkVerify(){
        if(IS_AJAX){
            $User = D('User');
            $uid = $User->checkField(I('post.verify'),'verify');
            echo $uid >0 ? 'true' : 'false';
        }else{
            $this->error('非法访问');
        }
    }
}