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
//删除单条短信
//判断是否点击了删除按钮并且id存在
if(@$_GET['action']=='delete' && isset($_GET['id'])){
    $_rows = _mysql_fetch_array("SELECT 
                                              gb_id 
                                        FROM 
                                              gb_message 
                                       WHERE 
                                              gb_id = '{$_GET['id']}'
                                       LIMIT 
                                              1
                                ");
    //危险操作，先验证唯一标识符是否一致
    if(!!$_rows){
        $_rows2 = _mysql_fetch_array("SELECT 
                                                  gb_uniqid 
                                            FROM 
                                                  gb_manager 
                                            WHERE 
                                                  gb_username='{$_COOKIE['username']}'
                                            LIMIT
                                                  1
                                      ");
        if(!!$_rows2){
            _uniqid($_COOKIE['uniqid'],$_rows2['gb_uniqid']);
            _mysql_query("DELETE FROM
                                              gb_message
                                       WHERE 
                                              gb_id = '{$_GET['id']}'
                                       LIMIT 
                                              1
                         ");
            if(_mysql_affected_rows() == 1){
                _mysql_close();
                _session_destroy();
                _location('短信删除成功','member_message.php');
            }else{
                _mysql_close();
                _session_destroy();
                _alert_back('短信删除失败');
            }
        }

    }else{
        _alert_back('此短信不存在');
    }
}
if(isset($_GET['id'])){
    $_rows = _mysql_fetch_array("SELECT 
                                    gb_id,
                                    gb_fromuser,
                                    gb_content,
                                    gb_date
                              FROM
                                    gb_message
                              WHERE 
                                    gb_id = '{$_GET['id']}'
                                ");
    $_html = array();
    $_html['id'] = $_rows['gb_id'];
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
    <script type="text/javascript" src="js/member_message_details.js"></script>
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
            <dd class="button"><input type="button" value="返回列表"id="back"><input type="button" id="delete" name="<?php echo $_html['id']?>" value="删除短信"></dd>
        </dl>
    </div>
    <?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>

