<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><!--{webname}--></title>
<link rel="stylesheet" type="text/css" href="../style/admin.css">
<script type="text/javascript" src="../js/register.js"></script>
</head>
<body id="main">
后台管理&gt;&gt;会员管理&gt;&gt;{$title}
<ol>
	<li><a href="user.php?action=list">会员列表</a></li>
	<li><a href="user.php?action=add">新增会员</a></li>
	{if $update}
	<li><a href="user.php?action=update">修改会员</a></li>
	{/if}
</ol>
{if $list}
<table border="0">
	<tr>
		<th>编号</th>
		<th>会员名称</th>
		<th>等级描述</th>
		<th>操作</th>
	</tr>
	{foreach $AllUser(key, value)}
	<tr>
		<td>{@value->id}</td>
		<td>{@value->user}</td>
		<td>{@value->email}</td>
		<td><a href="user.php?action=update&id={@value->id}">修改</a> | <a href="user.php?action=delete&id={@value->id}" onclick = "return confirm('你真的删除这个会员吗？') ? true : false">删除</a></td>
	</tr>
	{/foreach}
</table>
{$page}
<p><a href="../register.php?action=add" target="_blank">【新增管理员等级】</a></p>
{/if}
{if $add}
<form method="post" action="" name="register">
	<table cellspacing="0">
		<tr><td>用 户 名：<input type="text" name="username" placeholder="请输入用户名"></td></tr>
			<tr><td>密　　码：<input type="password" name="userpass" placeholder="请输入密码"></td></tr>
			<tr><td>电子邮件：<input type="text" name="email" placeholder="请输入邮箱"></td></tr>
			<tr><td>选择头像：<select name="face" onchange="rface()">
							{foreach $optionOne(key, value)}
							<option value="0{@value}.jpg">0{@value}.jpg</option>
							{/foreach}
							{foreach $optionTwo(key, value)}
							<option value="{@value}.jpg">{@value}.jpg</option>
							{/foreach}
						<select></td></tr>
			<tr><td><img src="../image/01.jpg" alt="" name="faceimg" /></td></tr>
			<tr><td><input type="submit" name="send" value="注册"></td></tr>
	</table>
</form>
{/if}
{if $update}
<form method="post" action="" name="register">
	<input type="hidden" value="{$id}" name="id" />
	<table cellspacing="0">
		<tr><td>会员名称：<strong>{$username}</strong>
		<tr><td><input type="password" hidden="hidden" value="{$userpass}" name="userpass"></td></tr>
		<tr><td>会员密码：<input type="password" name="userppass"></td></tr>
		<tr><td>会员邮箱：<input type="email" value="{$email}" name="email"></td></tr>
		<tr><td>选择头像：<select name="face" onchange="rface()">
							{$face}
						<select></td></tr>
		<tr><td><img src="../image/01.jpg" alt="" name="faceimg" /></td></tr>
		<tr><td><select name="state">
					{$state}
				</select>
					</td></tr>
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