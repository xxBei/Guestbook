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

?>
