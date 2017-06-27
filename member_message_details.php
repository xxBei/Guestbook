<?php
/**
 * 文件用途：短信详情
 * ==============================================
 * @date: 2017/6/27 10:48
 * @author: zbei
 * @version:
 */
//定义一个常量，防止恶意调用
define('ROOT', true);
define('SCRIPT', 'member_message_details');
require dirname(__FILE__).'/includes/common.inc.php';
//判断用户是否登录
if(!isset($_COOKIE['username'])){
    _alert_close('请先登录');
}
if(isset($_GET['id'])){
    $_rows = _mysql_fetch_array("SELECT 
                                    gb_fromuser,
                                    gb_content,
                                    gb_date
                              FROM
                                    gb_message
                              WHERE 
                                    gb_id = '{$_GET['id']}'
                                ");
    $_html = array();
    $_html['fromuser'] = $_rows['gb_fromuser'];
    $_html['content'] = $_rows['gb_content'];
    $_html['date'] = $_rows['gb_date'];
    $_html = _htmlspecialchars($_html);
}else{
    _alert_back('非法登录');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <?php require ROOT_PATH.'includes/title.inc.php';?>
    <title>留言簿--短信详情</title>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'?>
<div id="member">
    <!--引入导航栏-->
    <?php include ROOT_PATH."includes/member.inc.php";?>
    <div id="member_main">
        <h3>短信详情</h3>
        <dl>
            <dd>发 信 人：<?php echo $_html['fromuser']?></dd>
            <dd>发信时间：<?php echo $_html['date']?></dd>
            <dd>内　　容：<strong><?php echo $_html['content']?></strong></dd>
            <dd class="button"><input type="button" value="返回列表" onclick="javascript:history.back();"><input type="button" value="删除"></dd>
        </dl>
    </div>
    <?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>

