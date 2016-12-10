<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/9/3
 * Time: 9:54
 */
namespace Admin\Model;

use Think\Model;

class AuthGroupModel extends Model{

    //获取微博列表
    public function getList($page,$rows){

        $obj = $this->field('id,title,rules')
                    ->limit(($rows * ($page - 1)),$rows)
                    ->select();

        foreach ($obj as $key => $value) {
            $map['id'] = array('in',$value['rules']);
            $AuthRule = M('AuthRule');
            $objAR = $AuthRule->field('title')->where($map)->select();
            foreach ($objAR as $key2 => $value2) {
                $obj[$key]['auth'] .= $value2['title'].',';
            }
            $obj[$key]['auth'] = substr($obj[$key]['auth'],0,-1);
        }

        return array(
            'total'=>$this->count(),
            'rows'=>$obj ? $obj : '',
        );
    }

    //获取所有角色
    public function getListAll(){
        return $this->field('id,title,rules')->select();
    }

    //新增角色名称
    public function addRole($title,$rules){
        $map['title'] = array('in',$rules);
        $AuthRule = D('AuthRule');
        $objAr = $AuthRule->field('id')->where($map)->select();

        $ids = '';
        foreach($objAr as $key=>$value){
            $ids .=$value['id'].',';
        }
        $ids = substr($ids,0,-1);

        $data = array(
            'title'=>$title,
            'rules'=>$ids,
        );
        if($this->create($data)){
            $aid = $this->add($data);
            return $aid ? $aid : 0;
        }else{
            return $this->getError();
        }
    }
}