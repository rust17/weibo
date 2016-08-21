<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/8/18
 * Time: 19:30
 */
namespace Home\Model;
use Think\Model;

class TopicModel extends Model\RelationModel{
    //微博表自动验证
    protected $_validate = array(
        //-1，微博长度不合法
        array('allContent','1,280',-1,self::EXISTS_VALIDATE,'length'),
    );
    //微博表自动完成
    protected $_auto = array(
        array('create','time',self::MODEL_INSERT,'function'),
    );

    //一对多微博关联
    protected $_link = array(
        'images'=>array(
            'mapping_type'=>self::HAS_MANY,
            'class_name'=>'Image',
            'foreign_key'=>'tid',
            'mapping_fields'=>'data',
        ),
    );

    //发布微博
    public function publish($allContent,$uid){
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
    //格式化配图JSON
    public function format($list){
        foreach ($list as $key => $value) {
            if(!is_null($value['images'])) {
                foreach ($value['images'] as $key2 => $value2) {
                    $value['images'][$key2] = json_decode($value2['data'], true);
                }
            }
            $list[$key] = $value;
            $list[$key]['count'] = count($value['images']);
            $time = NOW_TIME - $list[$key]['create'];
            if($time<60){
                $list[$key]['time'] = '刚刚发布';
            }else if($time < 60 * 60){
                $list[$key]['time'] = floor($time/60).'分钟之前';
            }else if($time < 60 * 60 * 24){
                $list[$key]['time'] = '今天'.date('H:i',$list[$key]['create']);
            }else if($time < 60 * 60 * 48){
                $list[$key]['time'] = '昨天'.date('H:i',$list[$key]['create']);
            }else if($time < 60 * 60 * 365){
                $list[$key]['time'] = date('m月d日H:i',$list[$key]['create']);
            }else{
                $list[$key]['time'] = date('Y年m月d日H:i',$list[$key]['create']);
            }
        }

        return $list;
    }
}