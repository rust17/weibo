<?php if (!defined('THINK_PATH')) exit();?><table id="topic">123</table>

<div id="topic_tool" style="padding: 5px;">
    <div style="margin-bottom: 5px;">
        <a href="javascript:void (0)" class="easyui-linkbutton" plain="true" iconCls="icon-add-new" onclick="alert('没做');">新增</a>
        <a href="javascript:void (0)" class="easyui-linkbutton" plain="true" iconCls="icon-edit-new" onclick="alert('没做');">修改</a>
        <a href="javascript:void (0)" class="easyui-linkbutton" plain="true" iconCls="icon-delete-new" onclick="alert('没做');">删除</a>
        <a href="javascript:void (0)" class="easyui-linkbutton" plain="true" iconCls="icon-reload" onclick="alert('没做');">刷新</a>
        <a href="javascript:void (0)" class="easyui-linkbutton" plain="true" iconCls="icon-redo" onclick="alert('没做');">取消选定</a>
    </div>
    <div style="padding: 0 0 0 7px;color: #333;">
        查询账号：<input type="text" class="textbox" name="search_topic_name" style="width: 110px;" />
        创建时间从：<input type="text" name="date_from" editable="false" class="easyui-datebox" style="width: 110px;" />
        到：<input type="text" name="date_to" editable="false" class="easyui-datebox" style="width: 110px;" />
        <a href="javascript:void (0)" class="easyui-linkbutton" iconCls="icon-search" onclick="alert('没做');">查询</a>
    </div>
</div>

<script type="text/javascript" src="/weibo/Public/Admin/js/topic.js"></script>