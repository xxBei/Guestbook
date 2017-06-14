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
        <?php
            if(isset($_COOKIE['username'])){
                echo '<li><a href="member.php">'.$_COOKIE['username'].' ● 个人中心</a></li>';
                echo "\n";
            }else{
                echo '<li><a href="register.php">注册</a></li>';
                echo "\n\t\t";
		        echo '<li><a href="login.php">登录</a></li>';
		        echo "\n";
            }
        ?>
        <li><a href="blog.php">博友</a></li>
		<li>网络</li>
		<li>管理</li>
        <?php
            if(isset($_COOKIE['username'])){
                echo '<li><a href="logout.php"> 退出</a></li>';
            }
        ?>

	</ul>
</div>
