<?php
/**
 * 文件用途：个人中心--修改资料
 * ==============================================
 * @date: 2017/6/16 14:29
 * @author: zbei
 * @version:
 */
session_start();
//定义一个常量，防止恶意调用
define('ROOT', true);
require dirname(__FILE__) . '/includes/common.inc.php';
define('SCRIPT', 'member_modify');
if (@$_GET['action'] == 'mobify') {
    //为防止恶意注册，跨站攻击
    _check_code($_POST['code'], $_SESSION['code']);
    //判断用户名是否存在
    if (!!$_rows = _mysql_fetch_array("SELECT 
                                                    gb_uniqid 
                                             FROM 
                                                    gb_manager 
                                             WHERE 
                                                    gb_username='{$_COOKIE['username']}' 
                                             LIMIT 
                                                    1")){
        //防止伪造唯一标识符，判断cookie的标识符和数据库中的唯一标识符是否一致
        _uniqid($_COOKIE['uniqid'],$_rows['gb_uniqid']);
        require ROOT_PATH . 'includes/check.func.php';
        $_clean = array();
        $_clean['password'] = _check_mobify_password($_POST['password'], 6);
        $_clean['sex'] = $_POST['sex'];
        $_clean['face'] = $_POST['face'];
        $_clean['email'] = _check_email($_POST['email']);
        $_clean['url'] = _check_url($_POST['url']);
        $_clean['qq'] = _check_qq($_POST['qq']);
        //执行修改数据操作
        if (!empty($_clean['password'])) {//密码等于空不修改密码
            _mysql_query("UPDATE gb_manager SET
                                                        gb_password='{$_clean['password']}',
                                                        gb_sex='{$_clean['sex']}',
                                                        gb_face='{$_clean['face']}',
                                                        gb_email='{$_clean['email']}',
                                                        gb_url='{$_clean['url']}',
                                                        gb_qq='{$_clean['qq']}'
                                                  WHERE
                                                        gb_username='{$_COOKIE['username']}'
                                                        ");
        } else {//密码不等于空，修改密码
            _mysql_query("UPDATE gb_manager SET
                                                        gb_sex='{$_clean['sex']}',
                                                        gb_face='{$_clean['face']}',
                                                        gb_email='{$_clean['email']}',
                                                        gb_url='{$_clean['url']}',
                                                        gb_qq='{$_clean['qq']}'
                                                  WHERE
                                                        gb_username='{$_COOKIE['username']}'
                                                        ");
        }
        //判断是否修改成功
        if (_mysql_affected_rows() == 1) {
            _mysql_close();
            _session_destroy();
            _location('恭喜你，修改成功', 'member.php');
        } else {
            _mysql_close();
            _session_destroy();
            _location('很抱歉，没有任何修改', 'member_modify.php');
        }
    }
}
//验证cookie是否存在
if (isset($_COOKIE['username'])) {
    $_result = _mysql_fetch_array("SELECT gb_username,gb_sex,gb_face,gb_email,gb_url,gb_qq FROM gb_manager WHERE gb_username='{$_COOKIE['username']}' LIMIT 1");
    $_html = array();
    $_html['username'] = $_result['gb_username'];
    $_html['sex'] = $_result['gb_sex'];
    $_html['face'] = $_result['gb_face'];
    $_html['email'] = $_result['gb_email'];
    $_html['url'] = $_result['gb_url'];
    $_html['qq'] = $_result['gb_qq'];
    $_html = _htmlspecialchars($_html);
    $_html['sex_html'] = $_html['sex'];
    //判断性别是男是女
    if ($_html['sex'] == '男') {
        $_html['sex_html'] = '<input type="radio" name="sex" value="男" checked="checked"/>男 <input type="radio" name="sex" value="女"/>女';
    } else if ($_html['sex'] == '女') {
        $_html['sex_html'] = '<input type="radio" name="sex" value="男"/>男 <input type="radio" name="sex" value="女" checked="checked"/>女';
    }
    //头像更改
    $_html['face_html'] = '<select name="face">';
    foreach (range(1, 15) as $_num) {
        $_html['face_html'] .= '<option name="face" value="face/' . $_num . '.png">face/' . $_num . '.png</option>' . "\n\t\t\t\t\t\t";
    }
    $_html['face_html'] .= '</select>';

} else {
    _alert_back('非法操作');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <?php require ROOT_PATH . 'includes/title.inc.php'; ?>
    <title>留言簿--个人中心</title>
    <script src="js/code.js" type="text/javascript"></script>
    <script src="js/member_modify.js" type="text/javascript"></script>
</head>
<body>
<?php require ROOT_PATH . 'includes/header.inc.php' ?>
<div id="member">
    <!--引入导航栏-->
    <?php include ROOT_PATH . "includes/member.inc.php"; ?>
    <div id="member_main">
        <h2>会员管理中心</h2>
        <form method="post" action="?action=mobify">
            <dl>
                <dd>用 户 名:&nbsp;&nbsp;<?php echo $_html['username'] ?></dd>
                <dd>密　　码:&nbsp;&nbsp;<input type="password" name="password" class="text"></dd>
                <dd>性　　别:&nbsp;&nbsp;<?php echo $_html['sex_html'] ?></dd>
                <dd>头　　像:&nbsp;&nbsp;<?php echo $_html['face_html'] ?></dd>
                <dd>电子邮件:&nbsp;&nbsp;<input type="text" name="email" class="text" value="<?php echo $_html['email'] ?>">
                </dd>
                <dd>主　　页:&nbsp;&nbsp;<input type="text" name="url" class="text" value="<?php echo $_html['url'] ?>">
                </dd>
                <dd>Q　　Q :&nbsp;&nbsp;<input type="text" name="qq" class="text" value="<?php echo $_html['qq'] ?>"></dd>
                <dd>验 证 码 ：<input type="text" name='code' class="text yzm"/><img id="code" src="code.php"></dd>
                <dd style="border-bottom: 0;"><input type="submit" name='submit' value='修改' class="submit"/></dd>
            </dl>
        </form>
    </div>
</div>
<?php require ROOT_PATH . 'includes/footer.inc.php'; ?>
</body>
</html>