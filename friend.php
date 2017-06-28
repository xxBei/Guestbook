<?php
/**
 * 文件用途：添加好友
 * ==============================================
 * @date: 2017/6/26 14:19
 * @author: zbei
 * @version:
 */
session_start();
//定义一个常量，防止恶意调用
define('ROOT', true);
require dirname(__FILE__) . '/includes/common.inc.php';
//定义一个常量，用来区分不同页面的css样式的引用
define('SCRIPT', 'friend');
//用户登录的情况才可以添加好友
if(!isset($_COOKIE['username'])){
    _alert_close('请先登录');
}
if(@$_GET['action'] == 'add'){
    _check_code($_POST['code'],$_SESSION['code']);
    include ROOT_PATH.'includes/check.func.php';
    $_rows = _mysql_fetch_array("SELECT
                                              gb_uniqid
                                        FROM
                                              gb_manager
                                        WHERE
                                              gb_username='{$_COOKIE['username']}'
                                        LIMIT
                                              1
                                ");
    if(!!$_rows){
        _uniqid($_COOKIE['uniqid'],$_rows['gb_uniqid']);
        $_clean = array();
        $_clean['touser'] = $_POST['touser'];
        $_clean['fromuser'] = $_COOKIE['username'];
        $_clean['content'] = $_POST['content'];
        $_clean = _mysql_string($_clean);
        //不能添加将自己添加为好友
        if($_clean['touser'] == $_clean['fromuser']){
            _alert_close('不能添加将自己添加为好友');
        }
        //验证数据库中是否存在添加信息
        $_rows2 = _mysql_fetch_array("SELECT 
                                                    gb_id 
                                             FROM 
                                                    gb_friend
                                            WHERE
                                                    (gb_touser='{$_clean['touser']}' AND gb_fromuser='{$_clean['fromuser']}')
                                               OR   
                                                    (gb_fromuser='{$_clean['fromuser']}' AND gb_touser='{$_clean['touser']}')
                                       ");
        if(!!$_rows2){
            _alert_close('你们已经是好友了或对方正在验证！');
        }else{
            //向数据库插入添加好友信息
            _mysql_query("INSERT INTO gb_friend 
                                                  (
                                                    gb_touser,
                                                    gb_fromuser,
                                                    gb_content,
                                                    gb_date
                                                   ) 
                                          VALUES 
                                                  (
                                                    '{$_clean['touser']}',
                                                    '{$_clean['fromuser']}',
                                                    '{$_clean['content']}',
                                                    NOW()
                                                  )
                     ");
            if(_mysql_affected_rows()==1){
                _mysql_close();
                _session_destroy();
                _alert_close('添加成功，请等待回复！');
            }else{
                _mysql_close();
                _session_destroy();
                _alert_close('添加失败');
            }
        }
    }else{
        _alert_close('非法登录');
    }
    exit();
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
        <h3>添加好友</h3>
        <form method="post" action="?action=add">
            <input type="hidden" name="touser" value="<?php echo $_html['touser']?>">
            <dl>
                <dd><input type="text" readonly="readonly" value="TO:<?php echo $_html['touser']?>" class="text"></dd>
                <dd><textarea name="content">交个朋友吧。</textarea></dd>
                <dd><input type="text" name='code' class="text yzm"/><img id="code" src="code.php"><input type="submit" name='submit' value='添加好友' class="submit"/></dd>
            </dl>
        </form>
    </div>
</body>
</html>


