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
                <li><a href="#">消息</a></li>
                <li><a href="#">账号</a></li>
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
    main
</div>

<div id="footer">
    <div class="footer_left">&copy; 2016 Ycku.com All Rights Reserved.</div>
    <div class="footer_right">Powered by ThinkPHP</div>
</div>

</body>
</html>