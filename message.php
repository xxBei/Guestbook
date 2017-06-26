<?php
/**
 * 文件用途：发短信
 * ==============================================
 * @date: 2017/6/26 14:19
 * @author: zbei
 * @version:
 */

//定义一个常量，防止恶意调用
define('ROOT', true);
require dirname(__FILE__) . '/includes/common.inc.php';
//定义一个常量，用来区分不同页面的css样式的引用
define('SCRIPT', 'message');
//用户登录的情况才可以发送短信
if(!isset($_COOKIE['username'])){
    _alert_close('请先登录');
}
//获取数据
if(isset($_GET['id'])){
    if(!!$_rows = _mysql_fetch_array("SELECT gb_username FROM gb_manager WHERE gb_id = '{$_GET['id']}' LIMIT 1")){
        $_html = array();
        $_html['touser'] = $_rows['gb_username'];
        $_html = _htmlspecialchars($_html);
    }else{
        _alert_close('用户不存在');
    }

}else{
    _alert_close('非法操作');
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <?php require ROOT_PATH . 'includes/title.inc.php'; ?>
    <title>留言簿--发短信</title>
    <script type="text/javascript" src="js/code.js"></script>
    <script type="text/javascript" src="js/message.js"></script>
</head>
<body>
    <div id="message">
        <h3>发短信</h3>
        <form action="">
            <dl>
                <dd><input type="text" value="TO:<?php echo $_html['touser']?>" class="text"></dd>
                <dd><textarea name="content"></textarea></dd>
                <dd><input type="text" name='code' class="text yzm"/><img id="code" src="code.php"><input type="submit" name='submit' value='发送短信' class="submit"/></dd>
            </dl>
        </form>
    </div>
</body>
</html>


