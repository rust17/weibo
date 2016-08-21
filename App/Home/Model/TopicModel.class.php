<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/8/18
 * Time: 19:30
 */
namespace Home\Model;
use Think\Model;

class TopicModel extends Model{
    //微博表自动验证
    protected $_validate = array(
        //-1，微博长度不合法
        array('allContent','1,280',-1,self::EXISTS_VALIDATE,'length'),
    );
    //微博表自动完成
    protected $_auto = array(
        array('create','time',self::MODEL_INSERT,'function'),
    );

    //发布微博
    public function publish($allContent,$uid,$iid){
        //微博内容分离
        $len = mb_strlen($allContent,'utf8');
        $content = $contentOver = '';
        if($len > 255){
            $content = mb_substr($allContent,0,255,'utf8');
            $contentOver = mb_substr($allContent,255,25,'utf8');
        }else{
            $content = $allContent;
        }

        $data = array(
            'allContent'=>$allContent,
            'content'=>$content,
            'uid'=>$uid,
            'ip'=>get_client_ip(1),
            'iid'=>$iid,
        );
        if(!empty($contentOver)){
            $data['content_over'] = $contentOver;
        }
        if($this->create($data)){
            $uid = $this->add();
            return $uid ? $uid : 0;
        }else{
            return $this->getError();
        }
    }
}