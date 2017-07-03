<?php
    //定义一个常量，防止恶意调用
    define('ROOT', true);
    define('SCRIPT', 'index');
    require dirname(__FILE__).'/includes/common.inc.php';
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<?php require ROOT_PATH.'includes/title.inc.php';?>
    <script type="text/javascript" src="js/blog.js"></script>
	<title>留言簿--首页</title>
</head>
<body>
	<?php require ROOT_PATH.'includes/header.inc.php';?>
	<div id="list">
		<h2>帖子列表</h2>
	</div>
	<div id="user">
		<h2>新进用户</h2>
        <dl>
            <dd class="user">zBei</dd>
            <dt><img src="face/1.png" alt="张三"></dt>
            <dd class="message"><a href="javascript:;" name="message" title="69">发消息</a></dd>
            <dd class="friend"><a href="javascript:;" name="friend" title="69">加为好友</a></dd>
            <dd class="guest">写留言</dd>
            <dd class="flower"><a href="javascript:;" name="flower" title="69">送鲜花</a></dd>
            <dd class="email">邮箱：zzw_bei@163.com</dd>
            <dd class="url">网址：http://www.baidu.com</dd>
        </dl>
	</div>
	<div id="pics">
		<h2>最新图片</h2>
	</div>
	<?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>