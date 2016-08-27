<?php
return array(
	//设置模板替换变量
    'TMPL_PARSE_STRING'=>array(
        '__CSS__'=>__ROOT__.'/Public/'.MODULE_NAME.'/css',
        '__JS__'=>__ROOT__.'/Public/'.MODULE_NAME.'/js',
        '__IMG__'=>__ROOT__.'/Public/'.MODULE_NAME.'/img',
        '__UPLOADIFY__'=>__ROOT__.'/Public/'.MODULE_NAME.'/uploadify',
    ),
    //页面Trace
    //'SHOW_PAGE_TRACE'=>true,
    //COOKIE密钥
    'COOKIE_KEY'=>'www.google.com',
    //默认错误跳转对应的模板文件
    'TMPL_ACTION_ERROR' => 'Public/jump',
    //默认成功跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'=>'Public/jump',
    //图片上传路径
    'UPLOAD_PATH'=>'./Uploads/',
    //头像上传路径
    'FACE_PATH'=>'./Uploads/face/',
);