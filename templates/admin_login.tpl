<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>登录CMS内容后台管理系统</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css">
</head>
<body>
	<form action="?action=login" method="post" id="adminLogin">
		<fieldset>
			<legend>登录CMS内容后台管理系统</legend>
			<label>用户名：<input type="text" name="admin_user" placeholder="请输入用户名" /></label>
			<label>密　码：<input type="password" name="admin_pass" placeholder="请输入密码" /></label>
			<label>验证码：<input type="text" name="checkcode" placeholder="请输入验证码" /><img src="../config/code.php" onclick="javascript:this.src='../config/code.php?tm='+Math.random();"></label>
			<label><input type="submit" value="登录" name="send" class="btn"></label>
		</fieldset>
	</form>
</body>
</html>