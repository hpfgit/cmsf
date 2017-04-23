<div id="top"></div>
<div id="header">
<h1><a href="javascript:void(0)">瓢城web俱乐部</a></h1>
</div>
<script type="text/javascript" src="./static.php?type=header"></script>
<div id="nav">
	<ul>
		<script type="text/javascript">getHeader();</script>
		{#}<strong><a href="./register.php?action=register">注册</a></strong>{#}
		{#}<strong><a href="./register.php?action=login">登录</a></strong>{#}
		{foreach $allnav(key, value)}
		<li><a href="list.php?id={@value->id}">{@value->nav_name}</a></li>
		{/foreach}
	</ul>
</div>
{if $islogin}
<div id="header">
	<strong>{$user}<img src="{$face}" alt="{$user}" width="50" /></strong>
</div>
{/if}
{if $alllateruser}
{foreach $Alllateruser(key, value)}
最近登录的会员：<strong>{@value->user}<img src="{@value->face}" alt="{@value->user}" /></strong>
{/foreach}
{/if}