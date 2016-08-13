<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/8/7
 * Time: 9:02
 */
namespace Home\Controller;
use Home\Model\UserModel;
use Think\Controller;

class UserController extends Controller{
    //注册行为返回给Ajax
    public function register(){
        if(IS_POST) {
            $User = new UserModel();
            $uid = $User->register(I('post.username'), I('post.password'),I('post.repassword'), I('post.email'));
            print_r($uid);
        }else{
            $this->error('非法访问');
        }
    }
}