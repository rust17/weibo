<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/8/14
 * Time: 20:58
 */
namespace Home\Controller;
use Think\Controller;

class HomeController extends Controller{
    //检测用户登录状态
    protected function login(){
        //处理自动登陆，当cookie存在，且session不存在的情况下
        if(!is_null(cookie('auto')) && !session('?user_auth')){

            $value = explode('|',encryption(cookie('auto'),1));
            list($username,$ip) = $value;
            if($ip == get_client_ip()) {
                $map['username'] = $username;
                $User = D('User');
                $userObj = $User->field('id,username')->where($map)->find();

                //自动登陆验证后写入登录信息
                $update = array(
                    'id' => $userObj['id'],
                    'last_login' => NOW_TIME,
                    //'last_ip'=>get_client_ip(1),
                );
                $User->save($update);

                //将记录写入到cookie和session中
                $auth = array(
                    'id' => $userObj['id'],
                    'username' => $userObj['username'],
                    'last_login' => NOW_TIME,
                );
                //写入session
                session('user_auth', $auth);
            }
        }

        //检测session是否存在
        if(session('?user_auth')){
            return 1;
        }else{
            $this->redirect('Login/index');
        }
    }
}