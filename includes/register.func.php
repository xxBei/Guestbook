<?php
/**
* 文件用途：过滤信息
* ==============================================
* @date: 2017年6月4日
* @author: zbei
* @version:
*/
//防止恶意调用
if(!defined('ROOT')){
    echo 'Access Defined!';
}
if(!function_exists('_alert_back')){
    exit('_alert_back()函数不存在');
}

/**
 * @_check_username() 检测用户名函数
 * @access public 公共函数
 * @param string $_string 没有过滤的用户名
 * @param int $min_num
 * @param int $max_num
 * @return string $_string 过滤后的用户名
 */
function _check_username($_string,$min_num,$max_num){
    //去掉空格
    $_string = trim($_string);
    //长度小于两位或大于二十位
    if(mb_strlen($_string,'utf-8')<$min_num || mb_strlen($_string,'utf-8')>$max_num){
        _alert_back('长度不能小于'.$min_num.'位或大于'.$max_num.'位!');
    }

    //限制敏感字符
    $_char_pattern = '/[<>\'\"\ \　]/';
    if(preg_match($_char_pattern, $_string)){
        _alert_back('用户名不得包含敏感字符！');
    }

    //敏感用户名
    $_mg[0] = 'xbei';
    $_mg[1] = 'zbei';
    foreach ($_mg as $value){
        @$_mg_string .= $value.'\n';
    }
    if(in_array($_string, $_mg)){
        _alert_back($_mg_string.'敏感用户名不得注册！');
    }
    //将用户名转义输出
//     return mysqli_real_escape_string($_string);
    return $_string;
}
?>