<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><!--{webname}--></title>
<link rel="stylesheet" type="text/css" href="../style/admin.css">
</head>
<body id="main">
后台管理&gt;&gt;管理员管理&gt;&gt;{$title}
<ol>
	<li><a href="manage.php?action=list">管理员列表</a></li>
	<li><a href="manage.php?action=add">新增管理员</a></li>
	{if $update}
	<li><a href="manage.php?action=update">修改管理员</a></li>
	{/if}
</ol>
{if $list}
<table border="0">
	<tr>
		<th>编号</th>
		<th>用户名</th>
		<th>等级</th>
		<th>登陆次数</th>
		<th>登陆ip</th>
		<th>最近登陆时间</th>
		<th>创建时间</th>
		<th>操作</th>
	</tr>
	{foreach $manage(key, value)}
	<tr>
		<td>{@value->id}</td>
		<td>{@value->admin_user}</td>
		<td>{@value->level_name}</td>
		<td>{@value->login_number}</td>
		<td>{@value->login_ip}</td>
		<td>{@value->login_time}</td>
		<td>{@value->reg_time}</td>
		<td><a href="manage.php?action=update&id={@value->id}">修改</a> | <a href="manage.php?action=delete&id={@value->id}" onclick = "return confirm('你真的删除这个管理员吗？') ? true : false">删除</a></td>
	</tr>
	{/foreach}
</table>
<div>{$total}</div>
<p><a href="manage.php?action=add">【新增管理员】</a></p>
{/if}
{if $add}
<form method="post" action="" name="add">
	<table cellspacing="0">
		<tr><td>用&nbsp;户&nbsp;名：<input type="text" name="admin_user" class="text"></td></tr>
		<tr><td>密&nbsp;&nbsp;&nbsp;码：<input type="password" name="admin_pass" class="text"></td></tr>
		<tr><td>密码确认：<input type="password" name="admin_notpass" class="text"></td></tr>
		<tr><td>等&nbsp;&nbsp;&nbsp;级：<select name="level">
								{foreach $alllevel(key, value)}
								<option value="{@value->level}">{@value->level_name}</option>
								{/foreach}
							</select></td></tr>
		<tr><td><input type="submit" name="send" value="新增管理员" onclick="return checkAddForm()" class="submit">【<a href="manage.php?action=list">返回列表</a>】</td></tr>
	</table>
</form>
{/if}
{if $update}
<form method="post" action="" name="update">
	<input type="hidden" value="{$id}" name="id" />
	<input type="text" value="{$level}" name="level" id="level" hidden="hidden" />
	<input type="hidden" value="{$admin_pass}" name="pass" />
	<table cellspacing="0">
		<tr><td>用户名：<input type="text" name="admin_user" value="{$admin_user}" class="text" readonly="readonly"></td></tr>
		<tr><td>密&nbsp;码：<input type="password" name="admin_pass" class="text"></td></tr>
		<tr><td>等&nbsp;级：<select name="level" id="level_name">
								{foreach $alllevel(key, value)}
								<option value="{@value->level}">{@value->level_name}</option>
								{/foreach}
							</select></td></tr>
		<tr><td><input type="submit" name="send" value="修改管理员" class="submit">【<a href="manage.php?action=list">返回列表</a>】</td></tr>
	</table>
</form>
{/if}
{if $delete}
删除页面
{/if}
<script type="text/javascript" src="../js/manage.js"></script>
</body>
</html>