<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><!--{webname}--></title>
<link rel="stylesheet" type="text/css" href="../style/admin.css">
</head>
<body id="main">
内容管理 &gt;&gt;设置网站导航&gt;&gt;{$title}
<ol>
	<li><a href="nav.php?action=list">导航列表</a></li>
	<li><a href="nav.php?action=add">新增子导航</a></li>
	{if $update}
	<li><a href="nav.php?action=update&id={$id}">修改导航</a></li>
	{/if}
	{if $addchild}
	<li><a href="nav.php?action=update&id={$id}">修改子导航</a></li>
	{/if}
</ol>
{if $list}
<form method="post" action="nav.php?action=sort">
<table border="0">
	<tr>
		<th>编号</th>
		<th>导航名称</th>
		<th>描述</th>
		<th>子类</th>
		<th>操作</th>
		<th>排序</th>
	</tr>
	{foreach $manage(key, value)}
	<tr>
		<td>{@value->id}</td>
		<td>{@value->nav_name}</td>
		<td>{@value->nav_info}</td>
		<td><a href="nav.php?action=showchild&pid={@value->id}">查看</a> | <a href="nav.php?action=addchild&id={@value->id}&prevname={@value->nav_name}">增加子类</a></td>
		<td><a href="nav.php?action=update&id={@value->id}">修改</a> | <a href="nav.php?action=delete&id={@value->id}" onclick = "return confirm('你真的删除这个导航吗？') ? true : false">删除</a></td>
		<td><input type="number" name="sort[{@value->id}]" value="{@value->sort}" /></td>
	</tr>
	{/foreach}
	<tr><td></td><td></td><td></td><td></td><td></td><td><input type="submit" name="send" value="排序" /></td></tr>
</table>
</form>
<div>{$total}</div>
<p><a href="nav.php?action=add">【新增导航】</a></p>
{/if}
{if $showchild}
<form method="post" action="nav.php?action=sort">
<table border="0">
	<tr>
		<th>编号</th>
		<th>导航名称</th>
		<th>描述</th>
		<th>操作</th>
		<th>排序</th>
	</tr>
	{foreach $manage(key, value)}
	<tr>
		<td>{@value->id}</td>
		<td>{@value->nav_name}</td>
		<td>{@value->nav_info}</td>
		<td><a href="nav.php?action=update&id={@value->id}">修改</a> | <a href="nav.php?action=delete&id={@value->id}" onclick = "return confirm('你真的删除这个导航吗？') ? true : false">删除</a></td>
		<td><input type="number" name="sort[{@value->id}]" value="{@value->sort}" /></td>
	</tr>
	{/foreach}
	<tr><td></td><td></td><td></td><td></td><td><input type="submit" name="send" value="排序" /></td></tr>
</table>
</form>
<div>{$total}</div>
<p><a href="nav.php?action=addchild&id={$pid}">【新增子导航】</a></p>
{/if}
{if $add}
<form method="post" action="" name="add">
	<table cellspacing="0">
		<input type="hidden" value="0" name="pid">
		<tr><td>导航名称：<input type="text" name="nav_name" class="text"></td></tr>
		<tr><td>导航描述：<input type="text" name="nav_info" class="text"></td></tr>
		<tr><td><input type="submit" name="send" value="新增导航" onclick="return checkAddForm()" class="submit">【<a href="nav.php?action=list">返回列表</a>】</td></tr>
	</table>
</form>
{/if}
{if $addchild}
<form method="post" action="" name="addchild">
	<table cellspacing="0">
		<input type="hidden" value="{$pid}" name="pid">
		<tr><td>上级导航： <strong>{$prev_name}</strong>
		<tr><td>导航名称：<input type="text" name="nav_name" class="text"></td></tr>
		<tr><td>导航描述：<input type="text" name="nav_info" class="text"></td></tr>
		<tr><td><input type="submit" name="send" value="新增子导航" onclick="return checkAddForm()" class="submit">【<a href="nav.php?action=list">返回列表</a>】</td></tr>
	</table>
</form>
{/if}
{if $update}
<form method="post" action="" name="update">
	<table cellspacing="0">
		<input type="hidden" name="id" value="{$id}" />
		<tr><td>导航名：<input type="text" name="nav_name" value="{$nav_name}" class="text"></td></tr>
		<tr><td>导航描述：<input type="text" name="nav_info" value="{$nav_info}" class="text"></td></tr>
		<tr><td><input type="submit" name="send" value="修改导航" class="submit">【<a href="nav.php?action=list">返回列表</a>】</td></tr>
	</table>
</form>
{/if}
</body>
</html>