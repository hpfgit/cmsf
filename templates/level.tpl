<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><!--{webname}--></title>
<link rel="stylesheet" type="text/css" href="../style/admin.css">
</head>
<body id="main">
后台管理&gt;&gt;等级管理&gt;&gt;{$title}
<ol>
	<li><a href="manage.php?action=list">等级列表</a></li>
	<li><a href="manage.php?action=add">新增等级</a></li>
	{if $update}
	<li><a href="manage.php?action=update">修改等级</a></li>
	{/if}
</ol>
{if $list}
<table border="0">
	<tr>
		<th>编号</th>
		<th>等级名称</th>
		<th>等级描述</th>
		<th>操作</th>
	</tr>
	{foreach $manage(key, value)}
	<tr>
		<td>{@value->id}</td>
		<td>{@value->level_name}</td>
		<td>{@value->level_info}</td>
		<td><a href="level.php?action=update&id={@value->id}">修改</a> | <a href="level.php?action=delete&id={@value->id}" onclick = "return confirm('你真的删除这个管理员等级吗？') ? true : false">删除</a></td>
	</tr>
	{/foreach}
</table>
<p><a href="level.php?action=add">【新增管理员等级】</a></p>
{/if}
{if $add}
<form method="post" action="">
	<table cellspacing="0">
		<tr><td>等级名称：<input type="text" name="level_name" class="text"></td></tr>
		<tr><td>等级描述：<textarea rows="10" cols="10" name="level_info"></textarea></td></tr>
		<tr><td><input type="submit" name="send" value="新增管理员等级" class="submit">【<a href="level.php?action=list">返回列表</a>】</td></tr>
	</table>
</form>
{/if}
{if $update}
<form method="post" action="">
	<input type="hidden" value="{$id}" name="id" />
	<table cellspacing="0">
		<tr><td>等级名称：<input type="text" value="{$level_name}" name="level_name" class="text"></td></tr>
		<tr><td>等级描述：<textarea rows="10" cols="10" name="level_info"></textarea></td></tr>
		<tr><td><input type="submit" name="send" value="修改管理员等级" class="submit">【<a href="level.php?action=list">返回列表</a>】</td></tr>
	</table>
</form>
{/if}
{if $delete}
删除页面
{/if}
<script type="text/javascript" src="../js/manage.js"></script>
</body>
</html>