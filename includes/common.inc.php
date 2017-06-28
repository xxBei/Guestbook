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

//引入函数库
require  ROOT_PATH.'includes/global.func.php';
require  ROOT_PATH.'includes/mysql.func.php';
//定义一个常量，常量为开始时间
define('START_TIME', _runtime());

//数据库连接
_mysql_connect();
_mysql_select_dbname();
_mysql_charset();

@$_message = _mysql_fetch_array("SELECT 
                                              COUNT(*) 
                                          AS 
                                              count
                                        FROM 
                                              gb_message 
                                       WHERE 
                                              gb_touser='{$_COOKIE['username']}' 
                                         AND 
                                              gb_state = 0
                                ");
if(empty($_message['count'])){
    $GLOBALS['message_count'] = '<strong class="read"><a href="member_message.php">(0)</a></strong>';
}else{
    $GLOBALS['message_count'] = '<strong class="noread"><a href="member_message.php"> ('.$_message['count'].')</a></strong>';
}

?>
