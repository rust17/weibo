<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>微博系统--登录</title>
    <script type="text/javascript" src="/weibo/Public/Home/js/jquery.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/js/jquery.ui.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/js/jquery.validate.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/js/jquery.form.js"></script>
    <script type="text/javascript" src="/weibo/Public/Home/js/login.js"></script>
    <link rel="stylesheet" href="/weibo/Public/Home/Css/jquery.ui.css">
    <link rel="stylesheet" href="/weibo/Public/Home/Css/login.css">
    <script type="text/javascript">
        var ThinkPHP={
            'MODULE' : '/weibo/Home',
            'IMG' : '/weibo/Public/<?php echo MODULE_NAME;?>/img',
            'INDEX' : '<?php echo U("Index/index");?>',
        };
    </script>
</head>
<body>

<div id="header"></div>

<div id="main">
    <form id="login">
        <div class="top">
            <span class="username">
                <input type="text" name="username" placeholder="账号/邮箱">
            </span>
            <span class="password">
                <input type="password" name="password" placeholder="密码">
                <label class="auto" for="auto"><input type="checkbox" name="auto" id="auto"/>自动登陆</label>
            </span>
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

<form id="register">
    <ol class="register_errors"></ol>
    <p>
        <label for="username">账号：</label>
        <input type="text" name="username" class="text" id="username" placeholder="昵称，不小于两位!"/>
        <span class="star">*</span>
    </p>

    <p>
        <label for="password">密码：</label>
        <input type="password" name="password" class="text" id="password" placeholder="密码，不小于6位!"/>
        <span class="star">*</span>
    </p>

    <p>
        <label for="repassword">确认：</label>
        <input type="password" name="repassword" class="text" id="repassword" placeholder="密码确认"/>
        <span class="star">*</span>
    </p>

    <p>
        <label for="email">邮箱：</label>
        <input type="text" name="email" class="text" id="email" placeholder="电子邮件，用于找回密码!"/>
        <span class="star">*</span>
    </p>
</form>

<form id="verify_register" form-click="">
    <ol class="ver_error"></ol>
    <p>
        <label for="verify">验证码：</label>
        <input type="text" name="verify" class="text" id="verify" />
        <span class="star">*</span>
        <a href="javascript:void (0)" class="changeimg">换一换</a>
    </p>
    <p><img src="<?php echo U('verify');?>" class="changeimg verifyimg" /></p>
</form>
<div id="loading">数据交互中。。。</div>
</body>
</html>