<?php
/**
 * 文件用途：登录验证
 * ==============================================
 * @date: 2017/6/12 14:19
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
if(!function_exists('_mysql_string')){
    exit('_mysql_string()函数不存在');
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
    $_char_pattern = '/[<>\'\"\ ]/';
    if(preg_match($_char_pattern, $_string)){
        _alert_back('用户名不得包含敏感字符！');
    }

    return _mysql_string($_string);
}

/**
 * _check_password 验证密码
 * @access public
 * @param String $_first 密码
 * @param String $_end 确认密码
 * @param int $min_num 最小位数
 * @return String $_first 加密的密码
 */
function _check_password($_string,$min_num){
    //去掉空格
    $_string= trim($_string);
    //密码不能小于6位
    if(strlen($_string) < 6){
        exit(_alert_back('密码不能小于'.$min_num.'位'));
    }
    //返回加密密码
    return _mysql_string(sha1($_string));
}

/**
 *
 * @param $_string
 * @return string
 */
function _check_time($_string){
    $_time = array('0','1','2','3');
    if(!in_array($_string,$_time)) {
        _alert_back('保留字异常');
    }
    return _mysql_string($_string);
}
?>