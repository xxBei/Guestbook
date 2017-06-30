<?php
/**
 * 文件用途：好友列表
 * ==============================================
 * @date: 2017/6/27 9:43
 * @author: zbei
 * @version:
 */
//定义一个常量，防止恶意调用
define('ROOT', true);
define('SCRIPT', 'member_friend');
require dirname(__FILE__).'/includes/common.inc.php';
//判断用户是否登录
if(!isset($_COOKIE['username'])){
    _alert_back('请先登录');
}
if(@$_GET['action'] == 'add' && isset($_POST['ids'])){
    $_clean = array();
    $_clean['id'] = _mysql_string(implode(',',$_POST['ids']));
    //危险操作，防止cookie伪造，验证唯一标识符
    $_rows = _mysql_fetch_array("SELECT 
                                              gb_uniqid 
                                       FROM 
                                              gb_friend 
                                       WHERE 
                                              gb_username = '{$_COOKIE['username']}' 
                                       LIMIT 
                                              1
                                ");
}
//调用分页函数
global $_pagesize,$_pagenum;
_page_main("SELECT gb_id FROM gb_friend WHERE gb_touser='{$_COOKIE['username']}'",15);
//显示好友列表
if($_pagenum < 0){
    $_pagenum = 1;
}else{
    $_result = _mysql_query("SELECT gb_id,
                                      gb_touser,
                                      gb_fromuser,
                                      gb_content,
                                      gb_state,
                                      gb_date
                                FROM
                                      gb_friend
                                WHERE 
                                      gb_touser = '{$_COOKIE['username']}'
                             ORDER BY
                                      gb_date DESC
                                 LIMIT
                                      $_pagenum,$_pagesize");
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <?php require ROOT_PATH.'includes/title.inc.php';?>
    <title>留言簿--好友列表</title>
    <script type="text/javascript" src="js/member_message.js"></script>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'?>
<div id="member">
    <!--引入导航栏-->
    <?php include ROOT_PATH."includes/member.inc.php";?>
    <div id="member_main">
        <h2>好友管理中心</h2>
        <form action="?action=add" method="post">
            <table cellspacing="1">
                <tr><th>请求用户</th><th>请求内容</th><th>时间</th><th>状态</th><th>操作</th></tr>
                <?php
                    if(empty($_result)){
                        exit();
                    }
                    while (!!$_rows = _mysql_fetch_array_list($_result)){
                        $_html = array();
                        $_html['id'] = $_rows['gb_id'];
                        $_html['fromuser'] = $_rows['gb_fromuser'];
                        $_html['content'] = $_rows['gb_content'];
                        $_html['date'] = $_rows['gb_date'];
                        $_html = _htmlspecialchars($_html);
                        $_html['state'] = $_rows['gb_state'];
                        if($_html['state'] == 0){
                            $_html['state'] = '未添加';
                        }else{
                            $_html['state'] = '已添加';
                        }
                ?>
                <tr><td><?php echo $_html['fromuser']?></td><td title="<?php echo $_html['content']?>"><?php echo _title($_html['content'])?></td><td><?php echo $_html['date']?></td><td>
                        <a href="member_message_details.php?id=<?php echo $_html['id']?>"><?php echo $_html['state']?></a></td><td><input name="ids[]" value="<?php echo $_html['id']?>" type="checkbox"/></td></tr>
                <?php
                    }
                    _mysql_free_result($_result);
                ?>
                <tr><td colspan="5"><label for="all">全选<input type="checkbox" name="chkall" id="all"></label><input type="submit" id="delete" value="批量删除" name="delete"><input type="submit" id="add" value="添加" name="add"></td></tr>
            </table>
        </form>
        <?php
            //调用分页函数
            _page_type(2);
        ?>
    </div>
</div>
<?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>