<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/9/3
 * Time: 9:54
 */
namespace Admin\Model;

use Think\Model;

class UserModel extends Model{

    //注册自动验证
    protected $_validate = array(
        //-1，'账号长度不合法'
        array('username','/^[^@]{2,20}$/i',-1,self::EXISTS_VALIDATE),
        //-2，'密码长度不合法'
        array('password','6,30',-2,self::EXISTS_VALIDATE,'length'),
        //-3，'邮箱格式不正确'
        array('email','email',-3,self::EXISTS_VALIDATE),
        //-4，'账号被占用'
        array('username','',-4,self::EXISTS_VALIDATE,'unique',self::MODEL_INSERT),
        //-5，'邮箱被占用'
        array('email','',-5,self::EXISTS_VALIDATE,'unique',self::MODEL_INSERT),
        //-6,'个性域名不合法'
        array('domain','/^\w{4,10}$/i',-6,self::VALUE_VALIDATE),
        //-7,'个性域名被占用'
        array('domain','',-7,self::VALUE_VALIDATE,'unique',self::MODEL_INSERT),

    );

    //注册自动完成
    protected $_auto = array(
        array('password','sha1',self::MODEL_BOTH,'function'),
        array('create','time',self::MODEL_INSERT,'function'),
    );

    //获取数据列表
    public function getList($page,$rows,$sort,$order,$username,$date_from,$date_to){
        $map = array();
        if($username){
            $map['username'] = array('like','%'.$username.'%');
        }
        if($date_from && $date_to){
            $map['create'] = array(array('egt',strtotime($date_from)),array('elt',strtotime($date_to)));
        }else if($date_from){
            $map['create'] = array('egt',strtotime($date_from));
        }else if($date_to){
            $map['create'] = array('elt',strtotime($date_to));
        }

        $obj = $this->field('id,username,email,domain,create,last_login,last_ip')
                    ->where($map)
                    ->order(array($sort=>$order))
                    ->limit(($rows * ($page - 1)),$rows)
                    ->select();

        foreach ($obj as $key => $value) {
            $obj[$key]['create'] = date('Y-m-d H:i:s',$value['create']);
            $obj[$key]['last_login'] = date('Y-m-d H:i:s',$value['last_ip']);
            $obj[$key]['last_ip'] = long2ip($value['last_ip']);
        }

        return array(
            'total'=>$this->where($map)->count(),
            'rows'=>$obj ? $obj : '',
        );
    }

    //新增会员
    public function register($username,$password,$email,$domain,$intro){
        $data = array(
            'username'=>$username,
            'password'=>$password,
            'email'=>$email,
        );
        if($domain){
            $data['domain'] = $domain;
        }
        if($this->create($data)){
            $uid = $this->add();
            if($uid && $intro){
                $extendData = array(
                    'uid'=>$uid,
                    'intro'=>$intro,
                );
                $UserExtend = M('UserExtend');
                $UserExtend->add($extendData);
            }
            return $uid ? $uid : 0;
        }else{
            return $this->getError();
        }
    }

    //删除会员
    public function remove($ids){
        return $this->delete($ids);
    }
}