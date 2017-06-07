<?php
/**
* 文件用途：公共文件
* ==============================================
* @date: 2017年5月24日 上午9:18:09
* @author: zbei
* @version:
*/
header('Content-Type:text/html;charset=utf-8');
//获取当前目录路径,这样的好处访问速度更快
define('ROOT_PATH', substr(dirname(__FILE__), 0,-8));
//定义一个转义常量
define('GPC', get_magic_quotes_gpc());
//防止恶意调用
if(!defined('ROOT')){
    echo 'Access Defined!';
}
//php版本过低，禁止访问
if(PHP_VERSION<4.0){
    exit("<strong>Version is too low!</strong>");
}

//引入核心函数
require 'includes/global.func.php';
//定义一个常量，常量为开始时间
define('START_TIME', _runtime());


//数据库连接
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PSW', 'root');
define('DB_NAME', 'guestbooks');

$_conn = mysqli_connect(DB_SERVER,DB_USER,DB_PSW) or die('数据库连接失败！');
mysqli_select_db($_conn, DB_NAME) or die('数据库不正确');
mysqli_set_charset($_conn, 'UTF8');



?>
