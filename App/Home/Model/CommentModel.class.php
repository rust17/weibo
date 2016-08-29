<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/8/18
 * Time: 19:30
 */
namespace Home\Model;
use Think\Model;

class CommentModel extends Model{
    //微博表自动完成
    protected $_auto = array(
        array('create','time',self::MODEL_INSERT,'function'),
    );

    //发布微博
    public function publish($content,$uid,$tid){

        $data = array(
            'content'=>$content,
            'ip'=>get_client_ip(1),
            'uid'=>$uid,
            'tid'=>$tid,
        );

        if($this->create($data)){
            $cid = $this->add();
            if($cid){
                $Topic = D('Topic');
                $Topic ->comCount($tid);
                return $cid;
            }else{
                return 0;
            }
            //return $uid ? $uid : 0;
        }else{
            return $this->getError();
        }
    }

}