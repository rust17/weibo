<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>微博系统--我的首页</title>
<script type="text/javascript" src="/weibo/Public/Home/js/jquery.js"></script>
<script type="text/javascript" src="/weibo/Public/Home/js/jquery.ui.js"></script>
<script type="text/javascript" src="/weibo/Public/Home/js/base.js"></script>
<link rel="stylesheet" href="/weibo/Public/Home/css/jquery.ui.css" />
<link rel="stylesheet" href="/weibo/Public/Home/css/base.css" />



    <script type="text/javascript" src="/weibo/Public/Home/js/setting.js"></script>
    <link rel="stylesheet" href="/weibo/Public/Home/css/setting.css">


<script type="text/javascript">
    var ThinkPHP={
        'ROOT' : '/weibo',
        'MODULE' : '/weibo/Home',
        'IMG' : '/weibo/Public/<?php echo MODULE_NAME;?>/img',
        'FACE' : '/weibo/Public/<?php echo MODULE_NAME;?>/face',
        'UPLOADER' : '<?php echo U("File/upload");?>',
        'UPLOADIFY' : '/weibo/Public/Home/uploadify',
        'INDEX' : '<?php echo U("Index/index");?>',
    };
</script>
</head>
<body>

<div id="header">
    <div class="header_main">
        <div class="logo">微博系统</div>
        <div class="nav">
            <ul>
                <li><a href="<?php echo U('Index/index');?>" class="selected">首页</a></li>
                <li><a href="#">广场</a></li>
                <li><a href="#">图片</a></li>
                <li><a href="#">找人</a></li>
            </ul>
        </div>
        <div class="person">
            <ul>
                <li><a href="#">蜡笔小新</a></li>
                <li class="app">消息
                    <dl class="list">
                        <dd><a href="#">@提到我的</a></dd>
                        <dd><a href="#">收到的评论</a></dd>
                        <dd><a href="#">发出的评论</a></dd>
                        <dd><a href="#">我的私信</a></dd>
                        <dd><a href="#">系统消息</a></dd>
                        <dd><a href="#" class="line">发私信》</a></dd>
                    </dl>
                </li>
                <li class="app">账号
                    <dl class="list">
                        <dd><a href="<?php echo U('Setting/index');?>">个人设置</a></dd>
                        <dd><a href="#">排行榜</a></dd>
                        <dd><a href="#">申请认证</a></dd>
                        <dd><a href="<?php echo U('User/logout');?>" class="line">退出》</a></dd>
                    </dl>
                </li>
            </ul>
        </div>
        <div class="search">
            <form method="post" action="#">
                <input type="text" id="search" placeholder="请输入微博关键字" />
                <a href="javascript:void();"></a>
            </form>
        </div>
    </div>
</div>

<div id="main">
    
    <div class="main_left">
        <ul>
            <li><a href="javascript:void(0)" class="selected">个人设置</a></li>
            <li><a href="javascript:void (0)">头像设置</a></li>
        </ul>
    </div>
    <div class="main_right">
        <h2>个人设置</h2>
        <dl>
            <dd>账号名称：<?php echo ($user["username"]); ?></dd>
            <dd>电子邮箱：<input type="text" name="email" value="<?php echo ($user["email"]); ?>" class="text" /><strong style="color: red;">*</strong></dd>
            <dd><span>个人简介：</span><textarea name="intro"><?php echo ($user["extend"]["intro"]); ?></textarea></dd>
            <dd><input type="submit" class="submit" value="修改" /></dd>
        </dl>
        <p style="margin: 20px 0;font-size: 13px;color: red;text-align: center;">(PS：这里为了不再重复，不做前后端验证)</p>
    </div>

</div>

<div id="error">...</div>
<div id="loading">...</div>
<div id="footer">
    <div class="footer_left">&copy; 2016 Ycku.com All Rights Reserved.</div>
    <div class="footer_right">Powered by ThinkPHP</div>
</div>




</body>
</html>