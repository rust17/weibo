<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/9/3
 * Time: 9:54
 */
namespace Admin\Model;

use Think\Model;

class NavModel extends Model{

    //获取菜单导航
    public function getNav($id = 0,$texts){
        $map['nid'] = $id;
        if($id != 0)$map['text'] = array('in',$texts);
        $obj = $this->field('id,text,state,url,iconCls')->where($map)->select();
        return $obj ? $obj : '';
    }
}