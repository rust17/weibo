<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/8/13
 * Time: 7:51
 */
namespace Home\Model;
use Think\Model;

class UserModel extends Model\RelationModel{
    //批量验证
    //protected $patchValidate = true;

    //自动验证
    protected $_validate = array(
        //-1,'账号不合法'
        array('username','/^[^@]{2,20}$/i',-1,self::EXISTS_VALIDATE),
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
        //-8,'登录用户名不合法'
        array('login_username','2,50',-8,self::EXISTS_VALIDATE,'length'),
        //noemail,判断登录用户名是否是邮箱
        array('login_username','email','noemail',self::EXISTS_VALIDATE),

    );
    //自动填充
    protected $_auto = array(
        array('password','sha1',self::MODEL_BOTH,'function'),
        array('create','time',self::MODEL_INSERT,'function'),
    );

    //一对一关联用户
    protected $_link = array(
        'extend'=>array(
            'mapping_type'=>self::HAS_ONE,
            'class_name'=>'UserExtend',
            'foreign_key'=>'uid',
            'mapping_fields'=>'intro',
        ),
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

    //登录用户
    public function login($username,$password,$auto){
        $data = array(
            'login_username'=>$username,
            'password'=>$password,
        );
        //where条件
        $map = array();
        if($this->create($data)){
            //这里采用邮箱登陆方式
            $map['email'] = $username;
        }else{
            if($this->getError()=='noemail'){
                //这里采用账号登陆方式
                $map['username'] = $username;
            }else{
                return $this->getError();
            }
        }
        //验证密码
        $user = $this->field('id,username,password')->where($map)->find();
        if($user['password'] == sha1($password)){
            //登录验证后写入登录消息
            $update = array(
                'id' => $user['id'],
                'last_login'=>NOW_TIME,
                'last_ip'=>get_client_ip(1),
            );
            $this->save($update);

            //将记录写入到cookies和session中
            $auth = array(
                'id'=>$user['id'],
                'username'=>$user['username'],
                'last_login'=>NOW_TIME,
            );
            //写入到session
            session('user_auth',$auth);

            //将用户名加密写入cookie
            if($auto == 'on'){
                cookie('auto',encryption($user['username'].'|'.get_client_ip()),3600 * 24 * 30);
            }

            return $user['id'];
        }else{
            return -9;
        }
    }

    //通过一对一关联获取用户信息
    public function getUser(){
        $map['id'] = session('user_auth')['id'];
        $user = $this->relation(true)->field('id,username,email')->where($map)->find();
        if(!is_array($user['extend'])){
            $UserExtend = M('UserExtend');
            $data = array(
                'uid'=>$map['id'],
            );
            $UserExtend->add($data);
        }
        return $user;
    }

    //通过一对一修改关联用户资料
    public function updateUser($email,$intro){
        $map['id'] = session('user_auth')['id'];
        $data = array(
            'email'=>$email,
            'extend'=>array(
                'intro'=>$intro,
            ),
        );
        return $this->relation(true)->where($map)->save($data);
    }

    //更新个人头像
    public function updateFace($face){
        $data = array(
            'face'=>$face,
        );
        $map['id'] = session('user_auth')['id'];
        return $this->where($map)->save($data);
    }

    //获取个人头像
    public function getFace(){
        $map['id'] = session('user_auth')['id'];
        return json_decode($this->field('face')->where($map)->find()['face'])->big;
    }
}