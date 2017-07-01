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
//定义一个常量，用来区分不同页面的css样式的引用
define('SCRIPT', 'blog');
require dirname(__FILE__).'/includes/common.inc.php';
//调用分页函数
global $_pagesize,$_pagenum;
_page_main("SELECT gb_id FROM gb_manager WHERE gb_active IS NULL",15);
//显示会员信息
$_result = _mysql_query("SELECT gb_id,gb_username,gb_sex,gb_face FROM gb_manager WHERE gb_active IS NULL ORDER BY gb_reg_time DESC LIMIT $_pagenum,$_pagesize");

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <?php require ROOT_PATH.'includes/title.inc.php';?>
    <title>留言簿--博友</title>
    <script type="text/javascript" src="js/blog.js"></script>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'?>

    <div id="blog">
        <h2>博友页面</h2>

        <?php
            $_html = array();
            while($_rows = _mysql_fetch_array_list($_result)){
            $_html['id'] = $_rows['gb_id'];
            $_html['username'] = $_rows['gb_username'];
            $_html['face'] = $_rows['gb_face'];
            $_html['sex'] = $_rows['gb_sex'];
            $_html = _htmlspecialchars($_html);
        ?>
        <dl>
            <dd class="user"><?php echo $_html['username']?></dd>
            <dt><img src="<?php echo $_html['face']?>" alt="张三"></dt>
            <dd class="message"><a href="javascript:;" name="message" title="<?php echo $_html['id']?>">发消息</a></dd>
            <dd class="friend"><a href="javascript:;" name="friend" title="<?php echo $_html['id']?>">加为好友</a></dd>
            <dd class="guest">写留言</dd>
            <dd class="flower"><a href="javascript:;" name="flower" title="<?php echo $_html['id']?>">送<?php
                    if($_html['sex'] == '男'){
                        echo '他';
                    }else{
                        echo '她';
                    } ?>鲜花</a></dd>
        </dl>
        <?php }
            _mysql_free_result($_result);
            //调用分页函数
            _page_type(1);
        ?>
    </div>
<?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>