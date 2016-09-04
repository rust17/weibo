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
}