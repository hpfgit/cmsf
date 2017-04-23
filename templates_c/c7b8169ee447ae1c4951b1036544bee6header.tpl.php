<div id="top"></div>
<div id="header">
<h1><a href="javascript:void(0)">瓢城web俱乐部</a></h1>
</div>
<script type="text/javascript" src="./static.php?type=header"></script>
<div id="nav">
	<ul>
		<script type="text/javascript">getHeader();</script>
		<?php /* <strong><a href="./register.php?action=register">注册</a></strong> */ ?>
		<?php /* <strong><a href="./register.php?action=login">登录</a></strong> */ ?>
		<?php foreach($this->_vars['allnav'] as $key => $value) { ?>
		<li><a href="list.php?id=<?php echo $value->id;?>"><?php echo $value->nav_name;?></a></li>
		<?php } ?>
	</ul>
</div>
<?php if ($this->_vars['islogin']) {?>
<div id="header">
	<strong><?php echo $this->_vars['user'];?><img src="<?php echo $this->_vars['face'];?>" alt="<?php echo $this->_vars['user'];?>" width="50" /></strong>
</div>
<?php } ?>
<?php if ($this->_vars['alllateruser']) {?>
<?php foreach($this->_vars['Alllateruser'] as $key => $value) { ?>
最近登录的会员：<strong><?php echo $value->user;?><img src="<?php echo $value->face;?>" alt="<?php echo $value->user;?>" /></strong>
<?php } ?>
<?php } ?>