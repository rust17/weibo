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
        'IMAGEURL' : '<?php echo U("File/image");?>',
        'FACEURL' : '<?php echo U("File/face");?>',
        'UPLOADIFY' : '/weibo/Public/Home/uploadify',
        'BIGFACE' : '<?php echo session("user_auth")["face"]->big;?>',
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
                <li class="user">
                    <a href="#"><?php echo session('user_auth')['username'];?></a>
                    <?php if(($referCount) > "0"): ?><div class="refer">
                            <span>x</span>
                            您有<?php echo ($referCount); ?>条@提及！
                        </div><?php endif; ?>
                </li>
                <li class="app">消息
                    <dl class="list">
                        <dd><a href="<?php echo U('Setting/refer');?>">@提到我的
                                <?php if(($referCount) > "0"): ?><strong style="color:red;">(<?php echo ($referCount); ?>)</strong>
                                <?php else: ?>
                                    <span>(<?php echo ($referCount); ?>)</span><?php endif; ?>
                            </a>
                        </dd>
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
            <li><a href="<?php echo U('Setting/index');?>">个人设置</a></li>
            <li><a href="<?php echo U('Setting/avatar');?>">头像设置</a></li>
            <li><a href="<?php echo U('Setting/domain');?>">个性域名</a></li>
            <li><a href="<?php echo U('Setting/refer');?>" class="selected">@提及到我</a></li>
        </ul>
    </div>
    <div class="main_right">
        <h2>@提及到我</h2>
        <dl style="font-size: 14px;">
            <?php if(is_array($getRefer)): $i = 0; $__LIST__ = $getRefer;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$obj): $mod = ($i % 2 );++$i; switch($obj["read"]): case "0": ?><dd class="a"><a href="javascript:alert('点击进入此微博详情')">您被微博“<?php echo (mb_substr($obj["topic"]["content"],0,10,utf8)); ?>...”</a>提及到!<b class="read red" rid="<?php echo ($obj["id"]); ?>">[未读]</b></dd><?php break;?>
                    <?php case "1": ?><dd class="b"><a href="javascript:alert('点击进入此微博详情')">您被微博“<?php echo (mb_substr($obj["topic"]["content"],0,10,utf8)); ?>...”</a>提及到!<b class="read green">[已读]</b></dd><?php break; endswitch; endforeach; endif; else: echo "" ;endif; ?>
        </dl>
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