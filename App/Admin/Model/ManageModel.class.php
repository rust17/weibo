<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/9/3
 * Time: 9:54
 */
namespace Admin\Model;

use Think\Model;

class ManageModel extends Model{

    //管理员账号自动验证
    protected $_validate = array(
        //-1,账号长度不合法
        array('manager','/^[^@]{2,20}$/i',-1,self::EXISTS_VALIDATE),
        //-2,密码长度不合法
        array('password','6,30',-2,self::EXISTS_VALIDATE,'length'),
    );

    //验证管理员登陆
    public function checkManager($manager,$password){
        $data = array(
            'manager'=>$manager,
            'password'=>$password,
        );
        if($this->create($data)){
            $map['manager'] = $manager;
            $map['password'] = sha1($password);
            $obj = $this->field('id,manager')->where($map)->find();
            if($obj){
                session('admin',array(
                    'id'=>$obj['id'],
                    'manager'=>$obj['manager'],
                ));
                //登录验证后写入信息
                $update = array(
                    'id'=>$obj['id'],
                    'last_login'=>NOW_TIME,
                    'last_ip'=>get_client_ip(1),
                );
                $this->save($update);
                return $obj['id'];
            }else{
                return 0;
            }
        }else{
            return $this->getError();
        }
    }
}