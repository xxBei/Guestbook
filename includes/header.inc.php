<?php
/**
* 文件用途：头部分离，防止恶意调用
* ==============================================
* @date: 2017年5月24日
* @author: zbei
* @version:
*/

//定义一个常量，防止恶意调用
if(!defined('ROOT')){
    exit('Access Defined!');
}
?>

<div id="header">
	<h1><a href="index.php">zbei留言薄</a></h1>
	<ul>
		<li><a href="index.php">首页</a></li>
		<li><a href="register.php">注册</a></li>
		<li><a href="login.php">登录</a></li>
		<li>个人中心</li>
		<li>网络</li>
		<li>管理</li>
		<li>退出</li>
	</ul>
</div>
