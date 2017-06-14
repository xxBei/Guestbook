<?php
/**
 * 文件用途：退出登录
 * ==============================================
 * @date: 2017/6/13 18:15
 * @author: zbei
 * @version:
 */
session_start();
//定义一个常量，防止恶意调用
define('ROOT', true);
require dirname(__FILE__).'/includes/common.inc.php';
_unsetcookies();
?>