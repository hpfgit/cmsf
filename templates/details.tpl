<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><!--{webname}--></title>
<link rel="stylesheet" type="text/css" href="style/index.css">
<script type="text/javascript" src="static.php?id={$id}&type=details"></script>
</head>
<body>
	{include file="header.tpl"}
	{if $details}
    <div id="list">
    	<h2>当前位置&gt;{$nav}</h2>
    	<ul>
		    详细内容：{$info}
			点击量：{$count}
    	</ul>
    	{$tag}
    </div>
    <a href="./feedback.php?cid={$id}" target="_blank">全部评论</a>
    <form method="post" action="./feedback.php?cid={$id}" target="_blank">
    	<textarea rows="20" cols="100" placeholder="请输入你的评论......" name="content"></textarea>
    	<label>验证码：<input type="text" name="checkcode" placeholder="请输入验证码" /><img src="./config/code.php" onclick="javascript:this.src='./config/code.php?tm='+Math.random();"></label>
    	<input type="submit" value="提交" name="send">
    </form>
    {if $hothreecomment}
    {foreach $hothreecomment(key, value)}
	<p>{@value->face}</p>
	<p>{@value->user}</p>
	<p>{@value->content}</p>
	<a href="./feedback.php?cid={@value->cid}&id={@value->id}&type=sustain">支持{@value->sustain}</a>
	<a href="./feedback.php?cid={@value->cid}&id={@value->id}&type=oppose">反对{@value->oppose}</a>
	{/foreach}
	{/if}
	<div style="border: 1px solid red";>
    {if $hottwentycomment}
    {foreach $hottwentycomment(key, value)}
	<p>{@value->title}</p>
	{/foreach}
	{else}
	此文章下没有任何评论
	{/if}
	</div>
    {/if}
    {include file="footer.tpl"}
</body>
</html>