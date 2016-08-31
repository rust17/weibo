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

    //构造方法
    protected function _initialize(){

    }

    //通过Ajax轮询执行方法
    public function getRefer(){
        if(IS_AJAX){
            $Refer = D('Refer');
            $referCount = $Refer->getReferCount(session('user_auth')['id']);
            echo $referCount;
        }else{
            $this->error('非法操作！');
        }
    }

    //检测用户登录状态
    protected function login(){
        //处理自动登陆，当cookie存在，且session不存在的情况下
        if(!is_null(cookie('auto')) && !session('?user_auth')){

            $value = explode('|',encryption(cookie('auto'),1));
            list($username,$ip) = $value;
            if($ip == get_client_ip()) {
                $map['username'] = $username;
                $User = D('User');
                $userObj = $User->field('id,username,face')->where($map)->find();

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
                    'face'=>json_decode($userObj['face']),
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