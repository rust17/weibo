<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/8/13
 * Time: 7:51
 */
namespace Home\Model;
use Think\Model;

class UserModel extends Model{
    //批量验证
    protected $patchValidate = true;

    //自动验证
    protected $_validate = array(
        //-1,'账号长度不合法'
        array('username','2,20',-1,self::EXISTS_VALIDATE,'length'),
        //-2,'密码长度不合法'
        array('password','6,30',-2,self::EXISTS_VALIDATE,'length'),
        //-3,'密码和密码确认不一致'
        array('repassword','password',-3,self::EXISTS_VALIDATE,'confirm'),
        //-4,'邮箱格式不正确'
        array('email','email',-4,self::EXISTS_VALIDATE),
        //-5,'账号被占用'
        array('username','',-5,self::EXISTS_VALIDATE,'unique',self::MODEL_INSERT),
        //-6,'邮箱被占用'
        array('email','',-6,self::EXISTS_VALIDATE,'unique',self::MODEL_INSERT),
        //-7,'验证码错误'
        array('Verify','check_verify',-7,self::EXISTS_VALIDATE,'function'),

    );
    //自动填充
    protected $_auto = array(
        array('password','sha1',1,'function'),
        array('create','time',1,'function'),
    );

    //验证占用字段
    public function checkField($field,$type){
        $data = array();
        switch ($type){
            case 'username':
                $data['username'] = $field;
                break;
            case 'email':
                $data['email'] = $field;
                break;
            case 'verify':
                $data['verify'] = $field;
                break;
            default:
                return 0;
        }
        return $this->create($data) ? 1 : $this->getError();
    }

    //注册一条用户
    public function register($username,$password,$repassword,$email,$verify){
        $data = array(
            'username'=>$username,
            'password'=>$password,
            'repassword'=>$repassword,
            'email'=>$email,
            'verify'=>$verify,
        );
        if($result = $this->create($data)) {
            $uid = $this->add();
            return $uid ? $uid : 0;
        }else{
            return $this->getError();
        }
    }
}