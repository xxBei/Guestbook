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
if(isset($_COOKIE['username'])){
    $_result = _mysql_fetch_array("SELECT gb_username,gb_sex,gb_face,gb_email,gb_url,gb_qq,gb_reg_time,gb_level FROM gb_manager WHERE gb_username='{$_COOKIE['username']}'");
    $_html = array();
    $_html['username'] = $_result['gb_username'];
    $_html['sex'] = $_result['gb_sex'];
    $_html['face'] = $_result['gb_face'];
    $_html['email'] = $_result['gb_email'];
    $_html['url'] = $_result['gb_url'];
    $_html['qq'] = $_result['gb_qq'];
    $_html['reg_time'] = $_result['gb_reg_time'];
    $_html['level'] = $_result['gb_level'];
    $_html = _htmlspecialchars($_html);
}else{
    _alert_back('非法操作');
}
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
                <dd>用 户 名:&nbsp;&nbsp;<?php echo $_html['username']?></dd>
                <dd>性　　别:&nbsp;&nbsp;<?php echo $_html['sex']?></dd>
                <dd>头　　像:&nbsp;&nbsp;<?php echo $_html['face']?></dd>
                <dd>电子邮件:&nbsp;&nbsp;<?php echo $_html['email']?></dd>
                <dd>主　　页:&nbsp;&nbsp;<?php echo $_html['url']?></dd>
                <dd>Q　　Q :&nbsp;&nbsp;<?php echo $_html['qq']?></dd>
                <dd>注册时间:&nbsp;&nbsp;<?php echo $_html['reg_time']?></dd>
                <dd>身　　份:&nbsp;&nbsp;
                    <?php
                        switch ($_html['level']) {
                            case 0:
                                echo '普通会员';
                                break;
                            case 1:
                                echo '管理员';
                                break;
                            default:
                                echo '出错';
                        }
                    ?>
                </dd>
            </dl>
        </div>
    </div>
<?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>