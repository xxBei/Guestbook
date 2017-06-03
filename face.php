<?php
/**
* 文件用途：选择用户头像
* ==============================================
* @date: 2017年5月25日　上午11:52:17
* @author: zbei
* @version:
*/
require dirname(__FILE__).'/includes/common.inc.php';
//定义一个常量，防止恶意调用
define('ROOT', true);
define('SCRIPT', 'face');
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>留言簿--选择头像</title>
	<?php require ROOT_PATH.'includes/title.inc.php';?>
	<script type="text/javascript" src="js/opener.js"></script>
</head>
<body>
	<div id="reg">
		<h3>选择头像</h3>
		<dl>
			<?php foreach (range(1,15) as $num){?>
			
			<dd><img src="face/<?php echo $num;?>.png" alt="face/<?php echo $num;?>.png" id="faceimg" title='头像<?php echo $num;?>'/></dd>
			<?php }?>
			
		</dl>
	</div>
</body>
</html>