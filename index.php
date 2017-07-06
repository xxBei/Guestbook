<?php
//定义一个常量，防止恶意调用
define('ROOT', true);
define('SCRIPT', 'index');
require dirname(__FILE__).'/includes/common.inc.php';
//读取XML
$_html = _get_xml('new.xml');

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<?php require ROOT_PATH.'includes/title.inc.php';?>
    <script type="text/javascript" src="js/blog.js"></script>
	<title>留言簿--首页</title>
</head>
<body>
	<?php require ROOT_PATH.'includes/header.inc.php';?>
	<div id="list">
		<h2>帖子列表</h2>
        <a href="post.php" class="post"> </a>
        <ul class="article">
            <li class="icon1"><em><a href="">阅读数(<strong>72</strong>)</a> <a href="">评论数(<strong>2</strong>)</a></em> <a href="#">创意时代：解密QQ仙侠传美术创意设计</a></li>
            <li class="icon2"><em><a href="">阅读数(<strong>194</strong>)</a> <a href="">评论数(<strong>7</strong>)</a></em> <a href="#">天掉下馅饼《游戏人生》变装拿大奖</a></li>
            <li class="icon3"><em><a href="">阅读数(<strong>39</strong>)</a> <a href="">评论数(<strong>0</strong>)</a></em> <a href="#">格斗大作《街头霸王4》PC版即将公布</a></li>
            <li class="icon4"><em><a href="">阅读数(<strong>46</strong>)</a> <a href="">评论数(<strong>0</strong>)</a></em> <a href="#">暗黑魔幻《炼狱》4月19正式开放封测</a></li>
            <li class="icon5"><em><a href="">阅读数(<strong>23</strong>)</a> <a href="">评论数(<strong>0</strong>)</a></em> <a href="#">永恒之塔的日子有一种自豪叫做牺牲</a></li>
            <li class="icon6"><em><a href="">阅读数(<strong>33</strong>)</a> <a href="">评论数(<strong>0</strong>)</a></em> <a href="#">盘点多年以后你还刻骨铭心的十款游戏</a></li>
            <li class="icon7"><em><a href="">阅读数(<strong>23</strong>)</a> <a href="">评论数(<strong>0</strong>)</a></em> <a href="#">炫舞吧 内测火爆 引领休闲舞蹈网游</a></li>
            <li class="icon8"><em><a href="">阅读数(<strong>22</strong></a> <a href="">评论数(<strong>0</strong>)</a></em> <a href="#">姚仙亲自主刀 《仙剑5》剧透曝光?</a></li>
            <li class="icon9"><em><a href="">阅读数(<strong>12</strong>)</a> <a href="">评论数(<strong>1</strong>)</a></em> <a href="#">新概念战车网游《钢铁围攻》24日封测</a></li>
            <li class="icon10"><em><a href="">阅读数(<strong>251</strong>)</a> <a href="">评论数(<strong>3</strong>)</a></em> <a href="#">完美国际新副本即将推出 背景揭秘</a></li>
        </ul>
	</div>
	<div id="user">
		<h2>新进用户</h2>
        <dl>
            <dd class="user"><?php echo $_html['username']?></dd>
            <dt><img src="<?php echo $_html['face']?>" alt="<?php echo $_html['username']?>"></dt>
            <dd class="message"><a href="javascript:;" name="message" title="<?php echo $_html['id']?>">发消息</a></dd>
            <dd class="friend"><a href="javascript:;" name="friend" title="<?php echo $_html['id']?>">加为好友</a></dd>
            <dd class="guest">写留言</dd>
            <dd class="flower"><a href="javascript:;" name="flower" title="<?php echo $_html['id']?>">送鲜花</a></dd>
            <dd class="email">邮箱：<a href="mailto:<?php echo $_html['email']?>"><?php echo $_html['email']?></a></dd>
            <dd class="url">网址：<a href="<?php echo $_html['url']?>" target="_blank"><?php echo $_html['url']?></a></dd>
        </dl>
	</div>
	<div id="pics">
		<h2>最新图片</h2>
	</div>
	<?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>