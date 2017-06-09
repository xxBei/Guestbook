<?php
/**
 * 文件用途：新注册用户激活
 * ==============================================
 * @date: 2017/6/9 10:16
 * @author: zbei
 * @version:
 */
//定义一个常量，防止恶意调用
define('ROOT', true);
require dirname(__FILE__).'/includes/common.inc.php';
//定义一个常量，用来区分不同页面的css样式的引用
define('SCRIPT', 'active');
if(!isset($_GET['active'])){
    _alert_back('非法操作');
}
if(isset($_GET['active'])&& isset($_GET['action']) && $_GET['action']=='ok'){
    $_active = _mysql_string($_GET['active']);
    if(_mysql_fetch_array("SELECT gb_active FROM gb_manager WHERE gb_active = '$_active' LIMIT 1")){
        _mysql_query("UPDATE gb_manager SET gb_active = NULL WHERE gb_active = '$_active' LIMIT 1");
        if(_mysql_affected_rows() == 1){
            _mysql_close();
            _location('恭喜你，激活成功','login.php');
        }else{
            _mysql_close();
            _location('很遗憾，激活失败','register.php');
        }
    }else{
        _alert_back('非法操作');
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <?php require ROOT_PATH.'includes/title.inc.php';?>
    <title>留言簿--注册</title>
    <script type="text/javascript" src="js/register.js"></script>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'?>
<div id="active">
    <h2>用户激活</h2>
    <p>此页面用于模拟邮件激活，不能实现真正的邮件激活</p>
    <p><a href="active.php?action=ok&amp;active=<?php echo $_GET['active']?>"><?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']?>active.php?action=ok&amp;active=<?php echo $_GET['active']?></a></p>
</div>
<?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>
