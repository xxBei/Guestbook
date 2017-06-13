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
    //为防止恶意注册，跨站攻击
    _check_code($_POST['code'], $_SESSION['code']);
    //引入校验文件
    include ROOT_PATH.'includes/register.func.php';
    //定义一个数组来存放表单数据
    $clean = array();
    //通过唯一标示符来防止恶意注册，伪装表单跨站攻击
    //除啦存入数据库唯一标识符还有第二个用途，就是登陆cookie验证
    $clean['uniqid'] = _check_uniqid($_POST['uniqid'], $_SESSION['uniqid']);
    //active也是唯一标识符，用来给刚注册的用户进行激活的
    $clean['active'] = _sha1_uniqid();
    $clean['username'] = _check_username($_POST['username'],2,20);
    $clean['password'] = _check_password($_POST['password'], $_POST['notpassword'], 6);
    $clean['question'] = _check_question($_POST['question'], 2, 20);
    $clean['answer'] = _check_answer($_POST['question'], $_POST['answer'], 2, 20);
    $clean['sex'] = _check_sex($_POST['sex']);
    $clean['faces'] = _check_face($_POST['faces']);
    $clean['email'] = _check_email($_POST['email']);
    $clean['qq'] = _check_qq($_POST['qq']);
    $clean['url'] = _check_url($_POST['url']);
    //校验用户名是否重复
    _is_repeat(
        "SELECT gb_username FROM gb_manager WHERE gb_username = '{$_POST['username']}' LIMIT 1",
        '该用户已被注册！'
    );
    //向数据库插入数据
    _mysql_query(
        "INSERT INTO gb_manager(
                                        gb_uniqid,
                                        gb_active,
                                        gb_username,
                                        gb_password,
                                        gb_question,
                                        gb_answer,
                                        gb_email,
                                        gb_qq,
                                        gb_url,
                                        gb_sex,
                                        gb_face,
                                        gb_reg_time,
                                        gb_last_time,
                                        gb_last_id
                                    )
                            VALUES(
                                        '{$clean['uniqid']}',
                                        '{$clean['active']}',
                                        '{$clean['username']}',
                                        '{$clean['password']}',
                                        '{$clean['question']}',
                                        '{$clean['answer']}',
                                        '{$clean['email']}',
                                        '{$clean['qq']}',
                                        '{$clean['url']}',
                                        '{$clean['sex']}',
                                        '{$clean['faces']}',
                                        NOW(),
                                        NOW(),
                                        '{$_SERVER["REMOTE_ADDR"]}'
                                    )");
        if(_mysql_affected_rows()==1){
            _mysql_close();
            _session_destroy();
            _location('恭喜你，注册成功', 'active.php?active='.$clean['active']);
        }else{
            _mysql_close();
            _session_destroy();
            _location('很遗憾，注册失败', 'register.php');
        }

}else{
    $_SESSION['uniqid'] = $_uniqid = _sha1_uniqid();
}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<?php require ROOT_PATH.'includes/title.inc.php';?>
	<title>留言簿--注册</title>
    <script type="text/javascript" src="js/code.js"></script>
	<script type="text/javascript" src="js/register.js"></script>
</head>
<body>
	<?php require ROOT_PATH.'includes/header.inc.php'?>
	<div id="reg">
		<h2>用户注册</h2>
		<form action="register.php?action=register" name="register" method="post">
			<dl>
				<dt>请仔细填写一下信息</dt>
				<dd><input type="hidden" name="uniqid" value="<?php echo @$_uniqid;?>"/></dd>
				<dd>用户名称：<input type="text" name="username" class="text"/>　(*必填，最少为2位)</dd>
				<dd>密　　码：<input type="password" name="password" class="text"/>　(*必填，最少为6位)</dd>
				<dd>确认密码：<input type="password" name="notpassword" class="text"/>　(*必填，最少为6位)</dd>
				<dd>密码提示：<input type="text" name="question" class="text"/>　(*必填，最少为2位)</dd>
				<dd>密码回答：<input type="text" name="answer" class="text"/>　(*必填，最少为2位)</dd>
				<dd>性　　别：<input type="radio" name='sex' value='男' checked="checked"/>男　<input type="radio" name='sex' value='女'/>女</dd>
				<dd><input type="hidden" name ="faces" value="face/1.png"><img src="face/1.png" class='face' id="userimg"/></dd>
				<dd>电子邮件：<input type="text" name='email' class='text'/>　(*必填，最少为2位)</dd>
				<dd>　Q Q　：<input type="text" name='qq' class="text"/></dd>
				<dd>主页地址：<input type="text" name='url' value='http://' class="text"/></dd>
				<dd>验  证  码 ：<input type="text" name='code' class="text yzm"/><img id="code" src="code.php"></dd>
				<dd><input type="submit" name='submit' value='注册' class="submit"/></dd>
			</dl>
		</form>
	</div>
	<?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>