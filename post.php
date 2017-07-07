<?php
/**
 * 文件用途：发表帖子
 * ==============================================
 * @date: 2017/7/6 9:54
 * @author: zbei
 * @version:
 */
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
    <script type="text/javascript" src="js/post.js"></script>
</head>
<body>
<?php require ROOT_PATH . 'includes/header.inc.php' ?>
<div id="post">
    <h2>发表帖子</h2>
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
            <dd>
                <div id="ubb">
                    <img src="images/fontsize.gif" title="字体大小" alt="字体大小" />
                    <img src="images/space.gif" title="线条" alt="线条" />
                    <img src="images/bold.gif" title="粗体" />
                    <img src="images/italic.gif" title="斜体" />
                    <img src="images/underline.gif" title="下划线" />
                    <img src="images/strikethrough.gif" title="删除线" />
                    <img src="images/space.gif" />
                    <img src="images/color.gif" title="颜色" />
                    <img src="images/url.gif" title="超链接" />
                    <img src="images/email.gif" title="邮件" />
                    <img src="images/image.gif" title="图片" />
                    <img src="images/swf.gif" title="flash" />
                    <img src="images/movie.gif" title="影片" />
                    <img src="images/space.gif" />
                    <img src="images/left.gif" title="左区域" />
                    <img src="images/center.gif" title="中区域" />
                    <img src="images/right.gif" title="右区域" />
                    <img src="images/space.gif" />
                    <img src="images/increase.gif" title="扩大输入区" />
                    <img src="images/decrease.gif" title="缩小输入区" />
                    <img src="images/help.gif" />
                </div>
            </dd>

            <dd><textarea id="content" rows="12"></textarea></dd>
            <dd>
                验 证 码 ：<input type="text" name='code' class="text yzm"/><img id="code" src="code.php">
                <input type="submit" name='submit' value='发表帖子' class="submit"/>
            </dd>
        </dl>
    </form>
</div>
<?php require ROOT_PATH . 'includes/footer.inc.php'; ?>
</body>
</html>
