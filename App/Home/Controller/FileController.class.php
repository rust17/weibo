<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/8/19
 * Time: 7:12
 */
namespace Home\Controller;

use Think\Upload;

class FileController extends HomeController{
    //图片上传测试
    public function upload(){
        $Upload = new Upload();
        $Upload->rootPath = C('UPLOAD_PATH');
        $info = $Upload->upload();
        if($info){
            print_r($info['Filedata']);
        }else{
            echo $Upload->getError();
        }
    }
}