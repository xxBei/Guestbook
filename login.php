<?php
/**
 * 文件用途：登录验证
 * ==============================================
 * @date: 2017/6/12 9:48
 * @author: zbei
 * @version:
 */
session_start();
//定义一个常量，防止恶意调用
define('ROOT', true);
require dirname(__FILE__).'/includes/common.inc.php';
//定义一个常量，用来区分不同页面的css样式的引用
define('SCRIPT', 'login');
if($_GET['action'] == 'login'){
    exit('111');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <?php require ROOT_PATH.'includes/title.inc.php';?>
    <title>留言簿--登录</title>
    <script type="text/javascript" src="js/code.js"></script>
    <script type="text/javascript" src="js/login.js"></script>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'?>
    <div id="login">
        <h2>用户登录</h2>
        <form action="login.php?action=login" name="login" method="post">
            <dl>
                <dt>　　</dt>
                <dd>用户名称：<input type="text" name="username" class="text"/></dd>
                <dd>密　　码：<input type="password" name="password" class="text"/></dd>
                <dd>保　　留：<input type="radio" name="time" value="0" checked="checked">不保留　<input type="radio" name="time" value="1">一天　<input type="radio" name="time" value="2">一周　<input type="radio" name="time" value="30">一月</dd>
                <dd>验  证  码 ：<input type="text" name='code' class="text code"/><img id="code" src="code.php"></dd>
                <dd><input type="submit" value='登录' class="button"/><input type="button" value='注册' id="location" class="button location"/></dd>
            </dl>
        </form>
    </div>
<?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>