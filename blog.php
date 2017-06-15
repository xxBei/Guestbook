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
define('SCRIPT', 'blog');
require dirname(__FILE__).'/includes/common.inc.php';
//分页模块
@$_page = $_GET['page'];
$_pagesize = 10;
if(isset($_page)){
    $_page = $_GET['page'];
    if(empty($_page) || $_page < 0 || !is_numeric($_page)){
        $_page = 1;
    }else{
        $_page = intval($_page);
    }
}else{
    $_page = 1;
}
$_num = _mysql_num_rows("SELECT gb_id FROM gb_manager");
if($_num == 0){
    $_pageabsolute == 1;
}else{
    $_pageabsolute = ceil($_num/$_pagesize);
}
if($_page > $_pageabsolute){
    $_page = $_pageabsolute;
}
$_pagenum = ($_page-1)*$_pagesize;
//显示会员信息
$_result = _mysql_query("SELECT gb_username,gb_sex,gb_face FROM gb_manager WHERE gb_active IS NULL ORDER BY gb_reg_time DESC LIMIT $_pagenum,$_pagesize");
//定义一个常量，用来区分不同页面的css样式的引用
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

        <!--数组分页-->
        <div id="page">
            <ul>
                <?php for($i=1;$i<=$_pageabsolute;$i++){
                    if($_page == $i){
                        echo '<li><a href="blog.php?page='.$i.'" class="selected">'.$i.'</a></li>';
                    }else{
                        echo '<li><a href="blog.php?page='.$i.'">'.$i.'</a></li>';
                    }
                }?>
            </ul>
        </div>

            <!--文章分页-->
        <div id="textpage">
            <ul>
                <li><?php echo $_page?>/<?php echo $_pageabsolute?>|</li>
                <li>共有<?php echo $_num?>个会员|</li>
                <?php
                    if($_page == 1){
                        echo '<li>首页|</li>';
                        echo '<li>上一页|</li>';
                    }else{
                        echo '<li><a href="'.SCRIPT.'.php">首页</a>| </li>';
                        echo '<li><a href="'.SCRIPT.'.php?page='.($_page-1).'">上一页</a>| </li>';
                    }
                    if($_page == $_pageabsolute){
                        echo '<li>下一页| </li>';
                        echo '<li>尾页| </li>';
                    }else{
                        echo '<li><a href="'.SCRIPT.'.php?page='.($_page+1).'">下一页</a>| </li>';
                        echo '<li><a href="'.SCRIPT.'.php?page='.$_pageabsolute.'">尾页</a></li>';
                    }
                ?>

            </ul>
        </div>
    </div>



<?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>