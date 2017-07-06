<?php
/**
 * 文件用途：发表帖子
 * ==============================================
 * @date: 2017/7/6 9:54
 * @author: zbei
 * @version:
 */
session_start();
//定义一个常量，防止恶意调用
define('ROOT', true);
require dirname(__FILE__) . '/includes/common.inc.php';
//登录状态
_login_state();
//定义一个常量，用来区分不同页面的css样式的引用
define('SCRIPT', 'post');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <?php require ROOT_PATH . 'includes/title.inc.php'; ?>
    <title>留言簿--发表帖子</title>
    <script type="text/javascript" src="js/code.js"></script>
    <script type="text/javascript" src="js/register.js"></script>
</head>
<body>
<?php require ROOT_PATH . 'includes/header.inc.php' ?>
<div id="post">
    <h2>用户注册</h2>
    <form action="" name="post" method="post">
        <dl>
            <dt>发表帖子</dt>
            <dd>
                类　　型：
                <?php
                    foreach (range(1,16) as $_num){
                        if($_num == 1){
                            echo '<label for="type'.$_num.'"><input type="radio" id="type'.$_num.'" name="type" checked="checked" class="radio" value="'.$_num.'"/>';
                        }else{
                            echo '<label for="type'.$_num.'"><input type="radio" id="type'.$_num.'" name="type" class="radio"/>';
                        }
                        echo '<img src="images/icon'.$_num.'.gif" alt="icon'.$_num.'"/></label>';
                        if($_num == 8){
                            echo "</br>　　　　　 ";
                        }
                    }
                ?>
            </dd>
            <dd>标　　题：<input type="text" name="username" class="text"/>　(*必填，最少为4～10位)</dd>
            <dd><textarea></textarea></dd>
        </dl>
    </form>
</div>
<?php require ROOT_PATH . 'includes/footer.inc.php'; ?>
</body>
</html>
