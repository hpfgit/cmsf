<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><!--{webname}--></title>
<link rel="stylesheet" type="text/css" href="../style/admin.css">
</head>
<body id="main">
后台管理&gt;&gt;文章管理&gt;&gt;{$title}
<ol>
	<li><a href="content.php?action=list">文章列表</a></li>
	<li><a href="content.php?action=add">新增文章</a></li>
	{if $update}
	<li><a href="content.php?action=update&id={$id}">修改文章</a></li>
	{/if}
</ol>
{if $list}
<table border="0">
	<tr>
		<th>编号</th>
		<th>标题</th>
		<th>属性</th>
		<th>文档类别</th>
		<th>浏览次数</th>
		<th>发布时间</th>
		<th>操作</th>
	</tr>
	{foreach $allcontent(key, value)}
	<tr>
		<td><script type="text/javascript">document.write({@key+1}+{$num});</script></td>
		<td><a href="details.php?id={@value->id}" title="{@value->t}">{@value->title}</a></td>
		<td>{@value->attr}</td>
		<td><a href="?action=list&nav={@value->nav}">{@value->nav_name}</a></td>
		<td>{@value->count}</td>
		<td>{@value->date}</td>
		<td><a href="content.php?action=update&id={@value->id}">修改</a> | <a href="content.php?action=delete&id={@value->id}" onclick = "return confirm('你真的删除这个管理员吗？') ? true : false">删除</a></td>
	</tr>
	{/foreach}
</table>
<div>{$page}</div>
<form method="get" action="?">
<input type="hidden" name="action" value="list" />
<select name="nav" id="select">
	<option value="">默认全部</option>
	{$nav}
</select>
<input type="submit" value="查询">
</form>
<p><a href="content.php?action=add">【新增文章】</a></p>
{/if}
{if $content}
<form method="post" action="?action=add" name="content" id="content">
	<table cellspacing="0">
		<tr><th><strong>发布一条新文档</strong></th></tr>
		<tr><td>文章标题：<input type="text" name="title" class="text"></td></tr>
		<tr><td>所属栏目：<select name="column">
							<option value="">请选择一个栏目<option>{$nav}
							</select></td></tr>
		<tr><td>定义属性：
										<label><input type="checkbox" name="attr[]" value="头条" />头条</label>
										<label><input type="checkbox" name="attr[]" value="推荐" />推荐</label>
										<label><input type="checkbox" name="attr[]" value="加粗" />加粗</label>
										<label><input type="checkbox" name="attr[]" value="跳转" />跳转</label>
										</td></tr>
		<tr><td>TAG标签：<input type="text" name="tag" class="text"></td></tr>
		<tr><td>关键字：<input type="text" name="keyword" class="text"></td></tr>
		<tr><td>缩略图：<input type="text" name="thumbnail" class="text" readonly="readonly"><input type="button" id="images" value="上传图片"></td>
				<td><img name="pic" src="" alt="" style="display:none;" /></td>
		</tr>
		<tr><td>文章来源：<input type="text" name="source" class="text"></td></tr>
		<tr><td>文章作者：<input type="text" name="author" class="text"></td></tr>
		<tr><td>内容摘要：<input type="text" name="info" class="text"></td></tr>
		<tr><td>评论选项：<input type="radio" name="commend" value="1">允许评论
											<input type="radio" name="commend" value="0">禁止评论
											　　　　浏览次数：<input type="text" name="count" value="">
											</td></tr>
		<tr><td>文章排序：<select name="sort" id="lanmu">
											<option value="0">默认排序</option>
											<option value="1">置顶一天</option>
							</select></td></tr>
		<tr><td>阅读权限：<select name="limit" id="lanmu">
											<option value="1">普通游客</option>
											<option value="2">普通会员</option>
											<option value="3">高级会员</option>
							</select></td></tr>
		<tr><td>标题颜色：<select name="color" id="lanmu">
											<option value="">默认颜色</option>
											<option value="red">红色</option>
											<option value="green">绿色</option>
											<option value="gray">灰色</option>
							</select></td></tr>
		<tr><td><input type="submit" name="send" value="新增文章" onclick="return checkcontent();" class="submit">【<a href="content.php?action=list">返回列表</a>】</td></tr>
	</table>
</form>
{/if}
{if $update}
	<form method="post" action="?action=update&id={$id}" name="content" id="content">
		<table cellspacing="0">
			<tr><th><strong>修改文档</strong></th></tr>
			<tr><td>文章标题：<input type="text" name="title" class="text" value="{$title}"></td></tr>
			<tr><td>所属栏目：<select name="column">
						<option value="">请选择一个栏目<option>{$nav}
					</select></td></tr>
			<tr><td>定义属性：
					{$attr}
				</td></tr>
			<tr><td>TAG标签：<input type="text" name="tag" class="text" value="tag"></td></tr>
			<tr><td>关键字：<input type="text" name="keyword" class="text" value="{$keywords}"></td></tr>
			<tr><td>缩略图：<input type="text" name="thumbnail" value="{$thumbnail}" class="text" readonly="readonly"><input type="button" id="images" value="上传图片"></td>
				<td><img name="pic" src="{$thumbnail}" alt="" /></td>
			</tr>
			<tr><td>文章来源：<input type="text" name="source" class="text" value="{$source}"></td></tr>
			<tr><td>文章作者：<input type="text" name="author" class="text" value="{$author}"></td></tr>
			<tr><td>内容摘要：<input type="text" name="info" class="text" value="{$info}"></td></tr>
			<tr><td>评论选项：<input type="radio" name="commend" value="1">允许评论
					<input type="radio" name="commend" value="0">禁止评论
					　　　　浏览次数：<input type="text" name="count" value="{$count}">
				</td></tr>
			<tr><td>文章排序：<select name="sort" id="lanmu">
						{$sort}
					</select></td></tr>
			<tr><td>阅读权限：<select name="readlimit" id="lanmu">
						{$readlimit}
					</select></td></tr>
			<tr><td>标题颜色：<select name="color" id="lanmu">
						{$color}
					</select></td></tr>
			<tr><td><input type="submit" name="send" value="确认修改" onclick="return checkcontent();" class="submit">【<a href="content.php?action=list">返回列表</a>】</td></tr>
		</table>
	</form>
{/if}
{if $delete}
删除页面
{/if}
<script type="text/javascript" src="../js/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="../js/manage.js"></script>
<script type="text/javascript" src="../js/upload.js"></script>
<script type="text/javascript" charset="utf-8" src="../utf8-php/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="../utf8-php/ueditor.all.min.js"></script>
<script type="text/javascript" charset="utf-8" src="../utf8-php/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" charset="utf-8" src="../js/editor.js"></script>
<script type="text/javascript">
    if (isFocus()) {
        document.getElementById('content').value = getContent();        
    }
</script>
</body>
</html>