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
//验证好友
if(@$_GET['action']=='add' && isset($_GET['id'])){
    $_uniqid_row1 = _mysql_fetch_array("SELECT gb_uniqid FROM gb_manager WHERE gb_username = '{$_COOKIE['username']}' LIMIT 1");
    if(!!$_uniqid_row1){
        _uniqid($_COOKIE['uniqid'],$_uniqid_row1['gb_uniqid']);
        //验证好友
        $_result1 = _mysql_fetch_array("SELECT gb_state FROM gb_friend WHERE gb_id = '{$_GET['id']}' LIMIT 1");
        if($_result1['gb_state'] == '1'){
            _alert_back('你们已经是好友了');
        }
        _mysql_query("UPDATE gb_friend SET gb_state = '1' WHERE gb_id = '{$_GET['id']}' AND gb_touser = '{$_COOKIE['username']}'");
        if(_mysql_affected_rows() == 1){
            _mysql_close();
            _location('验证成功','member_friend.php');
        }else{
            _mysql_close();
            _alert_back('验证失败');
        }
        $_result2 = _mysql_fetch_array("SELECT gb_touser FROM gb_friend WHERE gb_id = '{$_GET['id']}' LIMIT 1");
        if($_result2['gb_touser'] != $_COOKIE['username']){
            _location('你没有权限','member_friend.php');
        }
    }else{
        _alert_back('非法登录');
    }
}
//批量删除好友
if(@$_GET['action'] == 'delete' && empty($_POST['ids'])){
    _alert_back('至少选择一个');
}
if(@$_GET['action'] == 'delete' && isset($_POST['ids'])){
    $_clean = array();
    $_clean['id'] = _mysql_string(implode(',',$_POST['ids']));
    $_uniqid_row2 = _mysql_fetch_array("SELECT gb_uniqid FROM gb_manager WHERE gb_username = '{$_COOKIE['username']}' LIMIT 1");
    if(!!$_uniqid_row2){
        //验证唯一标识符
        _uniqid($_COOKIE['uniqid'],$_uniqid_row2['gb_uniqid']);
        //删除好友
        _mysql_query("DELETE FROM 
                                          gb_friend 
                                    WHERE 
                                          gb_id
                                    IN ({$_clean['id']})");
        if(_mysql_affected_rows()){
            _mysql_close();
            _location('删除好友成功','member_friend.php');
        }else{
            _mysql_close();
            _alert_back('删除好友失败');
        }
    }else{
        _alert_back('非法登录');
    }
}
//调用分页函数
global $_pagesize,$_pagenum;
_page_main("SELECT 
                          gb_id 
                   FROM 
                          gb_friend 
                   WHERE 
                          gb_touser='{$_COOKIE['username']}' 
                   OR 
                          gb_fromuser='{$_COOKIE['username']}'
                   LIMIT
                          1",
            15);
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
                                OR
                                      gb_fromuser = '{$_COOKIE['username']}'
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
        <form action="?action=delete" method="post">
            <table cellspacing="1">
                <tr><th>好友</th><th>请求内容</th><th>时间</th><th>状态</th><th>操作</th></tr>
                <?php
                    if(empty($_result)){
                        exit();
                    }
                    while (!!$_rows = _mysql_fetch_array_list($_result)){
                        $_html = array();
                        $_html['id'] = $_rows['gb_id'];
                        $_html['touser'] = $_rows['gb_touser']; //被添加的
                        $_html['fromuser'] = $_rows['gb_fromuser'];//添加的
                        $_html['content'] = $_rows['gb_content'];
                        $_html['date'] = $_rows['gb_date'];
                        $_html = _htmlspecialchars($_html);
                        $_html['state'] = $_rows['gb_state'];
                        if($_html['touser'] == $_COOKIE['username']){
                            $_html['friend'] = $_html['fromuser'];
                            if(empty($_html['state'])){
                                $_html['state'] = '<span style="color: #1195ff;">你未验证</span>';
                            }else{
                                $_html['state'] = '<span style="color: #0f0;">通过</span>';
                            }
                        }else if($_html['fromuser'] == $_COOKIE['username']){
                            $_html['friend'] = $_html['touser'];
                            if(empty($_html['state'])){
                                $_html['state'] = '<span style="color:#f00">对方未验证</span>';
                            }else{
                                $_html['state'] = '<span style="color: #0f0;">通过</span>';
                            }
                        }
                ?>
                <tr><td><?php echo $_html['friend']?></td><td title="<?php echo $_html['content']?>"><?php echo _title($_html['content'])?></td><td><?php echo $_html['date']?></td><td>
                        <a href="?action=add&id=<?php echo $_html['id'];?>"><?php echo $_html['state']?></a></td><td><input name="ids[]" value="<?php echo $_html['id']?>" type="checkbox"/></td></tr>
                <?php
                    }
                    _mysql_free_result($_result);
                ?>
                <tr><td colspan="5"><label for="all">全选<input type="checkbox" name="chkall" id="all"></label><input type="submit" id="delete" value="批量删除" name="delete"></td></tr>
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