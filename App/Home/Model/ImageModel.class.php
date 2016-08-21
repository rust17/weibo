<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/8/21
 * Time: 11:44
 */
namespace Home\Model;
use Think\Model;

class ImageModel extends Model{
    //配图入库
    public function storage($img){
        $iid = '';
        foreach($img as $key=>$value){
            $data = array(
                'data'=>$value,
            );
            if(!!$iid .=$this->add($data)){
                $iid .= ',';
            }else{
                return 0;
            }
        }
        return substr($iid,0,strlen($iid)-1);
    }
}