<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/8/7
 * Time: 9:02
 */
namespace Home\Controller;
use Think\Controller;

class UserController extends Controller{
    //注册行为返回给Ajax
    public function register(){
        if(IS_POST) {
            $User = D('User');
            $uid = $User->register(I('post.username'), I('post.password'),I('post.repassword'), I('post.email'));
            print_r($uid);
        }else{
            $this->error('非法访问');
        }
    }
    //Ajax验证数据，账号返回给Ajax
    public function checkUserName(){
        if(IS_AJAX){
            $User = D('User');
            $uid[] = $User->checkField(I('post.username'),'username');
            echo $uid[0]['username'] ? 'false': 'true';
        }
    }
    //Ajax验证数据，邮箱返回给Ajax
    public function checkEmail(){
        if(IS_AJAX){
            $User = D('User');
            $uid = $User->checkField(I('post.email'),'email');
            echo $uid['email'] ? 'false': 'true';
        }
    }
}