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
        <input type="text" name="user">
        <input type="password" name="password">
        <input type="submit" name="submit" value="登录">
    </form>
</div>

<div id="footer"></div>

</body>
</html>