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

	<title>留言簿--首页</title>
</head>
<body>
	<?php require ROOT_PATH.'includes/header.inc.php';?>
	<div id="list">
		<h2>帖子列表</h2>
	</div>
	<div id="user">
		<h2>新进用户</h2>
	</div>
	<div id="pics">
		<h2>最新图片</h2>
	</div>
	<?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>