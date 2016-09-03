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
    public function getList(){
        $obj = $this->field('id,username,email,domain,create,last_login,last_ip')->select();

        foreach ($obj as $key => $value) {
            $obj[$key]['create'] = date('Y-m-d H:i:s',$value['create']);
            $obj[$key]['last_login'] = date('Y-m-d H:i:s',$value['last_ip']);
            $obj[$key]['last_ip'] = long2ip($value['last_ip']);
        }


        return $obj;
    }
}