<?php
    //定义一个常量，防止恶意调用
    define('ROOT', true);
    define('SCRIPT', 'index');
    require dirname(__FILE__).'/includes/common.inc.php';
    //读取XML
    $_html = _get_xml('new.xml');
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
            <dd class="user"><?php echo $_html['username']?></dd>
            <dt><img src="<?php echo $_html['face']?>" alt="<?php echo $_html['username']?>"></dt>
            <dd class="message"><a href="javascript:;" name="message" title="<?php echo $_html['id']?>">发消息</a></dd>
            <dd class="friend"><a href="javascript:;" name="friend" title="<?php echo $_html['id']?>">加为好友</a></dd>
            <dd class="guest">写留言</dd>
            <dd class="flower"><a href="javascript:;" name="flower" title="<?php echo $_html['id']?>">送鲜花</a></dd>
            <dd class="email">邮箱：<a href="mailto:<?php echo $_html['email']?>"><?php echo $_html['email']?></a></dd>
            <dd class="url">网址：<a href="<?php echo $_html['url']?>" target="_blank"><?php echo $_html['url']?></a></dd>
        </dl>
	</div>
	<div id="pics">
		<h2>最新图片</h2>
	</div>
	<?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>