<?php
/**
 * 文件用途：博友页面
 * ==============================================
 * @date: 2017/6/14 9:06
 * @author: zbei
 * @version:
 */
//定义一个常量，防止恶意调用
define('ROOT', true);
require dirname(__FILE__).'/includes/common.inc.php';
$_result = _mysql_query("SELECT gb_username,gb_sex,gb_face FROM gb_manager WHERE gb_active IS NULL ORDER BY gb_reg_time DESC ");
//定义一个常量，用来区分不同页面的css样式的引用
define('SCRIPT', 'blog');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <?php require ROOT_PATH.'includes/title.inc.php';?>
    <title>留言簿--博友</title>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'?>

    <div id="blog">
        <h2>博友页面</h2>

        <?php while($_rows = _mysql_fetch_array_list($_result)){?>
        <dl>
            <dd class="user"><?php echo $_rows['gb_username']?></dd>
            <dt><img src="<?php echo $_rows['gb_face']?>" alt="张三"></dt>
            <dd class="message">发消息</dd>
            <dd class="friend">加为好友</dd>
            <dd class="guest">写留言</dd>
            <dd class="flower">送<?php
                    if($_rows['gb_sex'] == '男'){
                        echo '他';
                    }else{
                        echo '她';
                    } ?>鲜花</dd>
        </dl>
        <?php }?>
    </div>

<?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>