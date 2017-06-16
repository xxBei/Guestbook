<?php
/**
 * 文件用途：个人中心
 * ==============================================
 * @date: 2017/6/16 14:29
 * @author: zbei
 * @version:
 */
//定义一个常量，防止恶意调用
define('ROOT', true);
define('SCRIPT', 'member');
require dirname(__FILE__).'/includes/common.inc.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <?php require ROOT_PATH.'includes/title.inc.php';?>
    <title>留言簿--个人中心</title>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'?>
    <div id="member">
        <!--引入导航栏-->
        <?php include ROOT_PATH."includes/member.inc.php";?>
        <div id="member_main">
            <h2>会员管理中心</h2>
            <dl>
                <dd>用 户 名:&nbsp;&nbsp;zBei</dd>
                <dd>性　　别:&nbsp;&nbsp;男</dd>
                <dd>头　　像:&nbsp;&nbsp;face/1.png</dd>
                <dd>电子邮件:&nbsp;&nbsp;zbei@16.com</dd>
                <dd>主　　页:&nbsp;&nbsp;http://www.zbei.com</dd>
                <dd>Q　　Q :&nbsp;&nbsp;123456789</dd>
                <dd>注册时间:&nbsp;&nbsp;2017-06-16 12:00:00</dd>
                <dd>身　　份:&nbsp;&nbsp;管理员</dd>
            </dl>
        </div>
    </div>
<?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>