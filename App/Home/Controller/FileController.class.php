<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/8/19
 * Time: 7:12
 */
namespace Home\Controller;



class FileController extends HomeController{
    //图片上传
    public function image(){
        $File = D('File');
        $this->ajaxReturn($File->image());

    }
    //头像上传
    public function face(){
        $File = D('File');
        $this->ajaxReturn($File->face());

    }
}