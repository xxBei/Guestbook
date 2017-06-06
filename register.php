<?php
/**
* 文件用途：注册
* ==============================================
* @date: 2017年5月24日
* @author: zbei
* @version:
*/
session_start();
//定义一个常量，防止恶意调用
define('ROOT', true);
require dirname(__FILE__).'/includes/common.inc.php';

//定义一个常量，用来区分不同页面的css样式的引用
define('SCRIPT', 'register');
//验证是否提交
if(@$_GET['action']=='register'){
    //验证码不区分大小写
    $yzm = strtolower($_POST['yzm']);
    //为防止恶意注册，跨站攻击
    if(!($yzm==$_SESSION['code'])){
        exit(_alert_back('验证码错误！'));
    }
    //引入校验文件
    include ROOT_PATH.'includes/register.func.php';
    //定义一个数组来存放表单数据
    $clean = array();
    $clean['username'] = _check_username($_POST['username'],2,20);
    $clean['password'] = _check_password($_POST['password'], $_POST['notpassword'], 6);
    $clean['question'] = _check_question($_POST['question'], 2, 20);
    $clean['answer'] = _check_answer($_POST['question'], $_POST['answer'], 2, 20);
    $clean['sex'] = $_POST['sex'];
    $clean['faces'] = $_POST['faces'];
    $clean['email'] = _check_email($_POST['email']);
    $clean['qq'] = _check_qq($_POST['qq']);
    $clean['url'] = _check_url($_POST['url']);
    print_r($clean);

}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<?php require ROOT_PATH.'includes/title.inc.php';?>
	<title>留言簿--注册</title>
	<script type="text/javascript" src="js/face.js"></script>
</head>
<body>
	<?php require ROOT_PATH.'includes/header.inc.php'?>
	<div id="reg">
		<h2>用户注册</h2>
		<form action="register.php?action=register" name="register" method="post">
			<dl>
				<dt>请仔细填写一下信息</dt>
				<dd>用户名称：<input type="text" name="username" class="text"/>　<span>(*必填，最少为2位)</span></dd>
				<dd>密　　码：<input type="password" name="password" class="text"/>　(*必填，最少为6位)</dd>
				<dd>确认密码：<input type="password" name="notpassword" class="text"/>　(*必填，最少为6位)</dd>
				<dd>密码提示：<input type="text" name="question" class="text"/>　(*必填，最少为2位)</dd>
				<dd>密码回答：<input type="text" name="answer" class="text"/>　(*必填，最少为2位)</dd>
				<dd>性　　别：<input type="radio" name='sex' value='男' checked="checked"/>男　<input type="radio" name='sex' value='女'/>女</dd>
				<dd><input type="hidden" name ="faces" value="face/1.png"><img src="face/1.png" class='face' id="userimg"/></dd>
				<dd>电子邮件：<input type="text" name='email' class='text'/></dd>
				<dd>　Q Q　：<input type="text" name='qq' class="text"/></dd>
				<dd>主页地址：<input type="text" name='url' value='http://' class="text"/></dd>
				<dd>验  证  码 ：<input type="text" name='yzm' class="text yzm"/><img id="code" src="code.php"></dd>
				<dd><input type="submit" name='submit' value='注册' class="submit"/></dd>
			</dl>
		</form>
	</div>
	<?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>