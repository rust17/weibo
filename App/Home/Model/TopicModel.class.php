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
    public function publish($allContent,$uid){
        //微博内容分离
        $len = mb_strlen($allContent,'utf8');
        $content = $content_over = '';
        if($len > 255){
            $content = mb_substr($allContent,0,255,'utf8');
            $content_over = mb_substr($allContent,255,25,'utf8');
        }else{
            $content = $allContent;
        }

        $data = array(
            'allContent'=>$allContent,
            'content'=>$content,
            'uid'=>$uid,
            'ip'=>get_client_ip(1),
        );
        if(!empty($contentover)){
            $data['content_over'] = $contentover;
        }
        if($this->create($data)){
            $uid = $this->add();
        }else{
            return $this->getError();
        }
    }
}