<?php if (!defined('THINK_PATH')) exit();?><ol class="comment_list">
    <?php if(is_array($getList)): $i = 0; $__LIST__ = $getList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$obj): $mod = ($i % 2 );++$i;?><li>
            <?php if(empty($obj["domain"])): ?><a href="<?php echo U('Space/index',array('id'=>$obj['uid']));?>" target="_blank"><?php echo ($obj["username"]); ?></a>
                <?php else: ?>
                <a href="/weibo/i/<?php echo ($obj["domain"]); ?>"><?php echo ($obj["username"]); ?></a><?php endif; ?>
            :<?php echo ($obj["content"]); ?>
        </li>
        <li class="line"><?php echo ($obj["time"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ol>