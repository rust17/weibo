<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>微博系统--登录</title>
    <script type="text/javascript" src="/weibo/Public/Home/js/jquery.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/js/jequery.ui.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/js/login.js"></script>
    <link rel="stylesheet" href="/weibo/Public/Home/Css/jequery.ui.css">
    <link rel="stylesheet" href="/weibo/Public/Home/Css/login.css">
    <script type="text/javascript">
        var ThinkPHP={
            'IMG' : '/weibo/Public/<?php echo MODULE_NAME;?>/img',
        };
    </script>
</head>
<body>

<div id="header"></div>

<div id="main">
    <form id="login">
        <div class="top">
            <input type="text" name="user" placeholder="用户名">
            <input type="password" name="password" placeholder="密码">
            <input type="submit" name="submit" value="登录">
        </div>
        <div class="bottom">
            <a href="javascript:void(0)" id="reg_link">注册新用户</a>
            <a href="javascript:void(0)">忘记密码?</a>
        </div>
    </form>
</div>

<div id="footer"></div>
<p class="footer_text">&copy;2009-2014 瓢城Web 俱乐部. Power by ThinkPHP.</p>
<div id="register">
    <form>
        <p>
            <label for="user">账号：</label>
            <input type="text" name="user" class="text" id="user" palcehoder="昵称，不小于两位!"/>
            <span class="star">*</span>
        </p>
        <p>
            <label for="pass">密码：</label>
            <input type="password" name="pass" class="text" id="pass" palchoder="密码，不小于6位!" />
            <span class="star">*</span>
        </p>
        <p>
            <label for="email">邮箱：</label>
            <input type="text" name="email" class="text" id="email" palcehoder="电子邮件，用于找回密码!"/>
            <span class="star">*</span>
        </p>
    </form>
</div>
</body>
</html>