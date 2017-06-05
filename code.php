<?php
/**
* 文件用途：验证码
* ==============================================
* @date: 2017年5月26日　下午10:32:17
* @author: zbei
* @version:
*/
session_start();
//定义一个常量，防止恶意调用
define('ROOT', true);
require dirname(__FILE__).'/includes/common.inc.php';

//运行验证码，默认宽高75*25，默认验证码位数4，显示边框true,不显示为false，例如：_code(75,25,4,true);
_code();


?>