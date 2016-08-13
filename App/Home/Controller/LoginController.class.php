<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/8/7
 * Time: 9:02
 */
namespace Home\Controller;
use Think\Controller;

class LoginController extends Controller{
    public function index(){
        $this->display();
    }
    public function test(){
        $m = M('User');
        dump($m->select());
    }
}