<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><!--{webname}--></title>
<link rel="stylesheet" type="text/css" href="style/index.css">
<script type="text/javascript" src="./js/register.js"></script>
</head>
<body>
	{include file="header.tpl"}
	{if $register}
	<div id="register">
		<form method="post" action="?action=add" name="register">
			<dl>
				<dd>用 户 名：<input type="text" name="username" placeholder="请输入用户名"></dd>
				<dd>密　　码：<input type="text" name="userpass" placeholder="请输入密码"></dd>
				<dd>电子邮件：<input type="text" name="email" placeholder="请输入邮箱"></dd>
				<dd>选择头像：<select name="face" onchange="sface()">
								{foreach $optionOne(key, value)}
								<option value="0{@value}.jpg">0{@value}.jpg</option>
								{/foreach}
								{foreach $optionTwo(key, value)}
								<option value="{@value}.jpg">{@value}.jpg</option>
								{/foreach}
							<select></dd>
				<dd><img src="./image/01.jpg" alt="" name="faceimg" /></dd>			
				<dd>验 证 码：<input type="text" name="checkcode" placeholder="请输入验证码" /><img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();"></dd>
				<dd><input type="submit" name="send" value="注册"></dd>
			</dl>
		</form>
	</div>
	{/if}
	{if $login}
	<form action="?action=login" method="post" id="adminLogin">
		<fieldset>
			<legend>会员登录</legend>
			<label>用户名：<input type="text" name="username" placeholder="请输入用户名" /></label>
			<label>密　码：<input type="password" name="userpass" placeholder="请输入密码" /></label>
			<label>验证码：<input type="text" name="checkcode" placeholder="请输入验证码" /><img src="./config/code.php" onclick="javascript:this.src='./config/code.php?tm='+Math.random();"></label>
			<label>记住密码：<input type="checkbox" name="remember" value="1" /></label>
			<label><input type="submit" value="登录" name="send" class="btn"></label>
		</fieldset>
	</form>
	{/if}
    {include file="footer.tpl"}
</body>
</html>