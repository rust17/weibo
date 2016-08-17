<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>微博系统--我的首页</title>
<script type="text/javascript" src="/weibo/Public/Home/js/jquery.js"></script>
<script type="text/javascript" src="/weibo/Public/Home/js/jquery.ui.js"></script>
<script type="text/javascript" src="/weibo/Public/Home/js/index.js"></script>
<link rel="stylesheet" href="/weibo/Public/Home/Css/jquery.ui.css" />
<link rel="stylesheet" href="/weibo/Public/Home/Css/index.css" />
</head>
<body>

<div id="header">
    <div class="header_main">
        <div class="logo">微博系统</div>
        <div class="nav">
            <ul>
                <li><a href="#" class="selected">首页</a></li>
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
                        <dd><a href="#">个人设置</a></dd>
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
        <div class="weibo_form">
            <span class="left">和大家分享一点新鲜事吧？</span>
            <span class="right weibo_num">可以输入<strong>140</strong>个字</span>
            <textarea class="weibo_text"></textarea>
            <input class="weibo_button" type="button" value="发布"/>
        </div>
    </div>
    <div class="main_right">
        right
    </div>

</div>

<div id="error">...</div>
<div id="foot">
    <div class="footer_left">&copy; 2016 Ycku.com All Rights Reserved.</div>
    <div class="footer_right">Powered by ThinkPHP</div>
</div>




</body>
</html>