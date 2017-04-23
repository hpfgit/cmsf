<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $this->_config['webname'];?></title>
<link rel="stylesheet" type="text/css" href="style/index.css">
<script type="text/javascript" src="static.php?id=<?php echo $this->_vars['id'];?>&type=details"></script>
</head>
<body>
	<?php $tpl->create('header.tpl');?>
	<?php if ($this->_vars['details']) {?>
    <div id="list">
    	<h2>当前位置&gt;<?php echo $this->_vars['nav'];?></h2>
    	<ul>
		    详细内容：<?php echo $this->_vars['info'];?>
			点击量：<?php echo $this->_vars['count'];?>
    	</ul>
    	<?php echo $this->_vars['tag'];?>
    </div>
    <a href="./feedback.php?cid=<?php echo $this->_vars['id'];?>" target="_blank">全部评论</a>
    <form method="post" action="./feedback.php?cid=<?php echo $this->_vars['id'];?>" target="_blank">
    	<textarea rows="20" cols="100" placeholder="请输入你的评论......" name="content"></textarea>
    	<label>验证码：<input type="text" name="checkcode" placeholder="请输入验证码" /><img src="./config/code.php" onclick="javascript:this.src='./config/code.php?tm='+Math.random();"></label>
    	<input type="submit" value="提交" name="send">
    </form>
    <?php if ($this->_vars['hothreecomment']) {?>
    <?php foreach($this->_vars['hothreecomment'] as $key => $value) { ?>
	<p><?php echo $value->face;?></p>
	<p><?php echo $value->user;?></p>
	<p><?php echo $value->content;?></p>
	<a href="./feedback.php?cid=<?php echo $value->cid;?>&id=<?php echo $value->id;?>&type=sustain">支持<?php echo $value->sustain;?></a>
	<a href="./feedback.php?cid=<?php echo $value->cid;?>&id=<?php echo $value->id;?>&type=oppose">反对<?php echo $value->oppose;?></a>
	<?php } ?>
	<?php } ?>
	<div style="border: 1px solid red";>
    <?php if ($this->_vars['hottwentycomment']) {?>
    <?php foreach($this->_vars['hottwentycomment'] as $key => $value) { ?>
	<p><?php echo $value->title;?></p>
	<?php } ?>
	<?php } else { ?>
	此文章下没有任何评论
	<?php } ?>
	</div>
    <?php } ?>
    <?php $tpl->create('footer.tpl');?>
</body>
</html>