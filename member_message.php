<?php
/**
 * 文件用途：短信列表
 * ==============================================
 * @date: 2017/6/27 9:43
 * @author: zbei
 * @version:
 */
/**
 * 文件用途：个人中心
 * ==============================================
 * @date: 2017/6/16 14:29
 * @author: zbei
 * @version:
 */
//定义一个常量，防止恶意调用
define('ROOT', true);
define('SCRIPT', 'member_message');
require dirname(__FILE__).'/includes/common.inc.php';
//判断用户是否登录
if(!isset($_COOKIE['username'])){
    _alert_back('请先登录');
}
//调用分页函数
global $_pagesize,$_pagenum;
_page_main("SELECT gb_id FROM gb_message",15);
//显示短信列表
$_result = _mysql_query("SELECT gb_id,
                                      gb_fromuser,
                                      gb_content,
                                      gb_date
                                FROM
                                      gb_message
                                WHERE 
                                      gb_touser = '{$_COOKIE['username']}'
                             ORDER BY
                                      gb_date DESC
                                 LIMIT
                                      $_pagenum,$_pagesize");

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <?php require ROOT_PATH.'includes/title.inc.php';?>
    <title>留言簿--短信列表</title>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'?>
<div id="member">
    <!--引入导航栏-->
    <?php include ROOT_PATH."includes/member.inc.php";?>
    <div id="member_main">
        <h2>短信管理中心</h2>
        <table cellspacing="1">
            <tr><th>发信人</th><th>短信内容</th><th>时间</th><th>操作</th></tr>
            <?php while (!!$_rows = _mysql_fetch_array_list($_result)){
                $_html = array();
                $_html['id'] = $_rows['gb_id'];
                $_html['fromuser'] = $_rows['gb_fromuser'];
                $_html['content'] = $_rows['gb_content'];
                $_html['date'] = $_rows['gb_date'];
                $_html = _htmlspecialchars($_html);
            ?>
            <tr><td><?php echo $_html['fromuser']?></td><td><a href="member_message_details.php?id=<?php echo $_html['id']?>"><?php echo _title($_html['content'])?></a></td><td><?php echo $_html['date']?></td><td><input type="checkbox"/></td></tr>
            <?php
                }
                _mysql_free_result($_result);
            ?>
        </table>
        <?php
            //调用分页函数
            _page_type(1);
        ?>
    </div>
</div>
<?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>