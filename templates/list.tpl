<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><!--{webname}--></title>
<link rel="stylesheet" type="text/css" href="style/index.css">
</head>
<body>
	{include file="header.tpl"}
	{if $list}
    <div id="list">
    	<h2>当前位置&gt;{$nav}</h2>
    	<ul>
		    {foreach $listcontent(key, value)}
				<script type="text/javascript" src="./static.php?type=list&id={@value->id}"></script>
    		<li>【{@value->nav_name}】<a href="details.php?id={@value->id}" target="_blank">{@value->title}{@value->info}</a>点击量:{@value->count}</li>
		    {/foreach}
    	</ul>
    </div>
    <div style="margin:0 auto;">{$page}</div>
    {else}
            <p style="padding:20px;">没有任何数据</p>
    {/if}
    <div id="childnav">
    	<strong>子导航列表</strong>
    	<ul>
    	{foreach $childnav(key, value)}
    		<li><a href="list.php?id={@value->id}">{@value->nav_name}</a></li>
    	{/foreach}
    	</ul>
    </div>
    {include file="footer.tpl"}
</body>
</html>