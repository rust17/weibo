<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/8/14
 * Time: 10:09
 */
//检测验证码
function check_verify($code,$id=1){
    $Verify = new \Think\Verify();
    $Verify->reset = false;
    return $Verify->check($code,$id);
}