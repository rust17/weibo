<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/8/21
 * Time: 11:44
 */
namespace Home\Model;
use Think\Model;
use Think\Image;
use Think\Upload;

class FileModel extends Model{
    //微博图片上传
    public function image(){
        $Upload = new Upload();
        $Upload->rootPath = C('UPLOAD_PATH');
        $Upload->maxSize = 1048579;
        $info = $Upload->upload();
        if($info){
            $savePath = $info['Filedata']['savepath'];
            $saveName = $info['Filedata']['savename'];
            $imgPath = C('UPLOAD_PATH').$savePath.$saveName;
            $image = new Image();
            $image ->open($imgPath);
            $thumbPath = C('UPLOAD_PATH').$savePath.'180_'.$saveName;
            $image ->thumb(180,180)->save($thumbPath);
            $image ->open($imgPath);
            $unfoldPath = C('UPLOAD_PATH').$savePath.'550_'.$saveName;
            $image ->thumb(550,550)->save($unfoldPath);
            $imgArr = array(
                'thumb'=>$thumbPath,
                'unfold'=>$unfoldPath,
                'source'=>$imgPath,
            );
            return $imgArr;
        }else{
            return $Upload->getError();
        }
    }
    //个人头像上传
    public function face(){
        $Upload = new Upload();
        $Upload->rootPath = C('UPLOAD_PATH');
        $Upload->maxSize = 1048579;
        $info = $Upload->upload();
        if($info){
            $savePath = $info['Filedata']['savepath'];
            $saveName = $info['Filedata']['savename'];
            $imgPath = C('UPLOAD_PATH').$savePath.$saveName;
            $image = new Image();
            $image ->open($imgPath);
            $image ->thumb(500,500)->save($imgPath);
            return $imgPath;
        }else{
            return $Upload->getError();
        }
    }
}