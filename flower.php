<?php
/**
 * 文件用途：发短信
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
define('SCRIPT', 'flower');
//用户登录的情况才可以发送短信
if(!isset($_COOKIE['username'])){
    _alert_close('请先登录');
}
if(@$_GET['action'] == 'send'){
    //为防止恶意注册，跨站攻击
    _check_code($_POST['code'], $_SESSION['code']);
    include ROOT_PATH.'includes/check.func.php';
    //验证唯一标识符
    if(!!$_rows = _mysql_fetch_array("SELECT gb_uniqid FROM gb_manager WHERE gb_username = '{$_COOKIE['username']}'")){
        _uniqid($_COOKIE['uniqid'],$_rows['gb_uniqid']);
    }else{
        _alert_close('非法登录');
    }
    $_clean = array();
    $_clean['touser'] = $_POST['touser'];
    $_clean['fromuser'] = $_COOKIE['username'];
    $_clean['flower'] = $_POST['flower'];
    $_clean['content'] = _check_content($_POST['content'],6,200);
    $_clean = _mysql_string($_clean);
    //不能给自己送鲜花
    if($_clean['touser'] == $_COOKIE['username']){
        _alert_close('不能给自己送鲜花');
        exit();
    }
    //送花
    _mysql_query("INSERT INTO gb_flower(
                                                      gb_touser,
                                                      gb_fromuser,
                                                      gb_flower,
                                                      gb_content,
                                                      gb_date)
                                            VALUES (
                                                      '{$_clean['touser']}',
                                                      '{$_clean['fromuser']}',
                                                      '{$_clean['flower']}',
                                                      '{$_clean['content']}',
                                                      NOW()
                                                    )");
    if(_mysql_affected_rows() == 1){
        _mysql_close();
        _session_destroy();
        _alert_close('送花成功');
    }else{
        _mysql_close();
        _session_destroy();
        _alert_back('送花失败');
    }
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
    <title>留言簿--送鲜花</title>
    <script type="text/javascript" src="js/code.js"></script>
    <script type="text/javascript" src="js/message.js"></script>
</head>
<body>
    <div id="message">
        <h3>送鲜花</h3>
        <form method="post" action="?action=send">
            <input type="hidden" name="touser" value="<?php echo $_html['touser']?>">
            <dl>
                <dd>
                    <input type="text" readonly="readonly" value="TO:<?php echo $_html['touser']?>" class="text">
                    <select  name="flower" id="select">
                        <?php
                            foreach (range(1,100) as $_num){
                                echo '<option class="option" value="'.$_num.'">'.$_num.' 朵</option>';
                            }
                        ?>
                    </select>
                </dd>
                <dd><textarea name="content">非常喜欢你，送你一朵小花花</textarea></dd>
                <dd><input type="text" name='code' class="text yzm"/><img id="code" src="code.php"><input type="submit" name='submit' value='赠送鲜花' class="submit"/></dd>
            </dl>
        </form>
    </div>
</body>
</html>


