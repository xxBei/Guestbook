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
//登录状态
_login_state();
//定义一个常量，用来区分不同页面的css样式的引用
define('SCRIPT', 'login');
if(@$_GET['action'] == 'login'){
    //为防止恶意注册，跨站攻击
    _check_code($_POST['code'], $_SESSION['code']);
    //引入校验文件
    include ROOT_PATH.'includes/login.func.php';
    $clean = array();
    $clean['username'] = _check_username($_POST['username'],2,20);
    $clean['password'] = _check_password($_POST['password'],6);
    $clean['time'] = _check_time($_POST['time']);
    if(!!$_rows = _mysql_fetch_array("SELECT gb_username,gb_uniqid FROM gb_manager WHERE gb_username = '{$clean['username']}' AND gb_password = '{$clean['password']}' AND gb_active IS NULL LIMIT 1")){
        //登录成功后，记录登录信息，最后的登录的时间、ip、次数
        _mysql_query("UPDATE gb_manager SET 
                                                  gb_last_time = NOW(),
                                                  gb_last_ip = '{$_SERVER["REMOTE_ADDR"]}',
                                                  gb_login_count = gb_login_count+1 
                                              WHERE 
                                                  gb_username = '{$_rows['gb_username']}'
                                              ");
        _mysql_close();
        _session_destroy();
        _setcookies($_rows['gb_username'],$_rows['gb_uniqid'],$clean['time']);
       _location(null,'member.php');
    }else{
        _mysql_close();
        _session_destroy();
        _location('用户名密码不正确或账户未激活！','login.php');
    }
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
                <dd>保　　留：<input type="radio" name="time" value="0" checked="checked">不保留　<input type="radio" name="time" value="1">一天　<input type="radio" name="time" value="2">一周　<input type="radio" name="time" value="3">一月</dd>
                <dd>验  证  码 ：<input type="text" name='code' class="text code"/><img id="code" src="code.php"></dd>
                <dd><input type="submit" value='登录' class="button"/><input type="button" value='注册' id="location" class="button location"/></dd>
            </dl>
        </form>
    </div>
<?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>