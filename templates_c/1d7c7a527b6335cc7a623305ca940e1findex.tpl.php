<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $this->_config['webname'];?></title>
<link rel="stylesheet" type="text/css" href="style/index.css">
</head>
<body>
	<?php $tpl->create('header.tpl');?>
    <div id="search"></div>
    <div id="user"></div>
    <div id="news"></div>
    <div id="pic"></div>
    <div id="rec"></div>
    <div id="sidebar-right"></div>
    <div id="picnews"></div>
    <div id="newslist"></div>
    <?php $tpl->create('footer.tpl');?>
</body>
</html>