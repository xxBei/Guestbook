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
define('SCRIPT', 'member_flower');
require dirname(__FILE__).'/includes/common.inc.php';
//判断用户是否登录
if(!isset($_COOKIE['username'])){
    _alert_back('请先登录');
}
if(@$_GET['action'] == 'delete' && empty($_POST['ids'])){
    _alert_back('请选择一项删除');
}
if(@$_GET['action'] == 'delete' && isset($_POST['ids'])){
    $_clean = array();
    $_clean['id'] = _mysql_string(implode(',',$_POST['ids']));
    //危险操作，防止cookie伪造，验证唯一标识符
    $_rows = _mysql_fetch_array("SELECT 
                                              gb_uniqid 
                                       FROM 
                                              gb_manager 
                                       WHERE 
                                              gb_username = '{$_COOKIE['username']}' 
                                       LIMIT 
                                              1
                                ");
    if(!!$_rows){
        _uniqid($_COOKIE['uniqid'],$_rows['gb_uniqid']);
         //批量删除短信
         _mysql_query("DELETE FROM 
                                          gb_flower 
                                    WHERE 
                                          gb_id 
                                    IN ({$_clean['id']})");
         if(_mysql_affected_rows()){
             _mysql_close();
             _location('花朵删除成功','member_message.php');
         }else{
             _mysql_close();
             _alert_back('花朵删除失败');
         }
    }else{
        _alert_back('非法登录');
    }
}
//调用分页函数
global $_pagesize,$_pagenum;
_page_main("SELECT gb_id FROM gb_flower WHERE gb_touser='{$_COOKIE['username']}'",15);
//显示短信列表
if($_pagenum < 0){
    $_pagenum = 1;
}else{
    $_result = _mysql_query("SELECT gb_id,
                                          gb_touser,
                                          gb_fromuser,
                                          gb_content,
                                          gb_flower,
                                          gb_date
                                    FROM
                                          gb_flower
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
    <title>留言簿--花朵列表</title>
    <script type="text/javascript" src="js/member_message.js"></script>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'?>
<div id="member">
    <!--引入导航栏-->
    <?php include ROOT_PATH."includes/member.inc.php";?>
    <div id="member_main">
        <h2>花朵管理中心</h2>
        <form action="?action=delete" method="post">
            <table cellspacing="1">
                <tr><th>送花人</th><th>送花留言</th><th>送花数量</th><th>时间</th><th>操作</th></tr>
                <?php
                    if(empty($_result)){
                        exit();
                    }
                    $_html = array();
                    while (!!$_rows = _mysql_fetch_array_list($_result)){
                        $_html['id'] = $_rows['gb_id'];
                        $_html['touser'] = $_COOKIE['username'];
                        $_html['fromuser'] = $_rows['gb_fromuser'];
                        $_html['content'] = $_rows['gb_content'];
                        $_html['flower'] = $_rows['gb_flower'];
                        $_html['date'] = $_rows['gb_date'];
                        $_html = _htmlspecialchars($_html);
                        @$_html['counts'] += $_html['flower'];
                ?>
                <tr>
                    <td><?php echo $_html['fromuser']?></td>
                    <td><?php echo _title($_html['content'])?></td>
                    <td><?php echo $_html['flower']?></td>
                    <td><?php echo $_html['date']?></td>
                    <td><input name="ids[]" value="<?php echo $_html['id']?>" type="checkbox"/></td></tr>
                <?php
                    }
                    _mysql_free_result($_result);
                ?>
                <tr><td colspan="5">共<?php echo $_html['counts']?></td></tr>
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