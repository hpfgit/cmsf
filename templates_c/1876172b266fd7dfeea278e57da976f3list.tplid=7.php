<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $this->_config['webname'];?></title>
<link rel="stylesheet" type="text/css" href="style/index.css">
</head>
<body>
	<?php $tpl->create('header.tpl');?>
	<?php if ($this->_vars['list']) {?>
    <div id="list">
    	<h2>当前位置&gt;<?php echo $this->_vars['nav'];?></h2>
    	<ul>
		    <?php foreach($this->_vars['listcontent'] as $key => $value) { ?>
				<script type="text/javascript" src="./static.php?type=list&id=<?php echo $value->id;?>"></script>
    		<li>【<?php echo $value->nav_name;?>】<a href="details.php?id=<?php echo $value->id;?>" target="_blank"><?php echo $value->title;?><?php echo $value->info;?></a>点击量:<?php echo $value->count;?></li>
		    <?php } ?>
    	</ul>
    </div>
    <div style="margin:0 auto;"><?php echo $this->_vars['page'];?></div>
    <?php } else { ?>
            <p style="padding:20px;">没有任何数据</p>
    <?php } ?>
    <div id="childnav">
    	<strong>子导航列表</strong>
    	<ul>
    	<?php foreach($this->_vars['childnav'] as $key => $value) { ?>
    		<li><a href="list.php?id=<?php echo $value->id;?>"><?php echo $value->nav_name;?></a></li>
    	<?php } ?>
    	</ul>
    </div>
    <?php $tpl->create('footer.tpl');?>
</body>
</html>