<?php
/**
* 文件用途：公共核心函数
* ==============================================
* @date: 2017年5月24日
* @author: zbei
* @version:
*/

/**
* _runtime()是用来获取执行耗时
* @access public 表示访问类型为公共访问
* @return float 表示返回类型为浮点型
*/
function _runtime(){
    $_mtime = explode(' ', microtime());
    return $_mtime[1]+$_mtime[0];
}

/**
 * _sha1_uniqid() 唯一标识符函数
 * @return string
 */
function _sha1_uniqid(){
    return sha1(uniqid(rand(),true));
}

/**
 * _uniqid() 判断唯一标识符是否一致
 */
function _uniqid($_cookie_uniqid,$_mysql_uniqid){
    if($_cookie_uniqid != $_mysql_uniqid){
        _alert_back('唯一标识符异常');
    }
}

/**
 * _check_code() 验证码验证
 * @param String $_first_code
 * @param String $_end_code
 */
function _check_code($_first_code,$_end_code){
    //验证码不区分大小写
    $_first_code = strtolower($_first_code);
    //为防止恶意注册，跨站攻击
    if(!($_first_code==$_end_code)){
        exit(_alert_back('验证码错误！'));
    }
}

/**
 * _code()是验证码函数
 * @param int $width 表示宽
 * @param int $heigh 表示高
 * @param int $rnd_code 表示验证码位数
 * @param bool $_flag 表示是否显示边框
 * @access public 表示访问类型为公共访问
 * @return void 表示无返回值
 */
function _code($width = 75,$height = 25,$rnd_code = 4,$_flag = false){
    $_nmsg = "";
    //生成四位随机码
    for($i=0;$i<$rnd_code;$i++){
        $_nmsg .= dechex(mt_rand(1,15));
    }
    $_SESSION['code'] = $_nmsg;

    header("Content-Type:image/png");
    //创建一个真彩图片
    $_img = imagecreatetruecolor($width, $height);
    //画笔颜色
    $_white = imagecolorallocate($_img, 255, 255, 255);
    $_color = imagecolorallocate($_img, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
    //填充颜色,
    imagefill($_img, 0, 0, $_white);

    if($_flag){
        //画一个多彩边框
        imagerectangle($_img, 0, 0, $width-1, $height-1, $_color);
    }
    //随机画出六条线条
    for($i=0;$i<6;$i++){
        $lineColor = imagecolorallocate($_img, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
        imageline($_img, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $lineColor);
    }
    //随机画出100个雪花
    for($j=1;$j<100;$j++){
        $rnd_color = imagecolorallocate($_img, mt_rand(200,255), mt_rand(200,255), mt_rand(200,255));
        imagestring($_img, 1, mt_rand(1,$width), mt_rand(1,$height), '*', $rnd_color);
    }
    //输出验证码
    for($i=0;$i<strlen($_SESSION['code']);$i++){
        $codeColor = imagecolorallocate($_img, mt_rand(0,100), mt_rand(0,150), mt_rand(0,200));
        imagestring($_img, 5, $i*$width/$rnd_code+mt_rand(1,10), mt_rand(1,$height/2), $_SESSION['code'][$i], $codeColor);
    }

    //生成图片
    imagepng($_img);
    //销毁图片
    imagedestroy($_img);
}

/**
 *_alert_back() 表示JS弹出框
 *@param varchar int $_info 表示提示消息
 *@access public
 *@return void
 */
function _alert_back($_info){
    echo "<script type='text/javascript'>alert('$_info');history.back();</script>";
    exit();
}

/**
 * _alert_close() 弹出信息后关闭当前页面
 * @access public
 * @param $_info 表示提示消息
 */
function _alert_close($_info){
    echo "<script type='text/javascript'>alert('$_info');window.close();</script>";
    exit();
}

/**
 * _location() 跳转
 * @access public
 * @param $_info 信息
 * @param $_url 网址
 * @return void
 */
function _location($_info,$_url){
    if(empty($_info)){
        Header('Location:'.$_url);
    }else{
        echo "<script type='text/javascript'>alert('$_info');location.href='$_url';</script>";
}   }

/**
 * session_destroy() 销毁session
 * @access public
 * @return void
 */
function _session_destroy(){
        session_destroy();

}

/**
 * _unsetcookies() 销毁cookie
 * @access public
 * @return void
 */
function _unsetcookies(){
    _session_destroy();
    setcookie('username','',time()-1);
    setcookie('uniqid','',time()-1);
    _location(null,'index.php');
}

/**
 * _setcookies() 设置cookie
 * @param $_username 用户名
 * @param $_uniqid 唯一标识符
 * @param $_time 保留时间
 */
function _setcookies($_username,$_uniqid,$_time){
    switch ($_time){
        case '0':
            setcookie('username',$_username);
            setcookie('uniqid',$_uniqid);
            break;
        case '1':
            setcookie('username',$_username,time()+86400);
            setcookie('uniqid',$_uniqid,time()+86400);
            break;
        case '2':
            setcookie('username',$_username,time()+604800);
            setcookie('uniqid',$_uniqid,time()+604800);
            break;
        case '3':
            setcookie('username',$_username,time()+2592000);
            setcookie('uniqid',$_uniqid,time()+2592000);
            break;
    }

}

/**
 * _login_state() 登录状态下判断，登录情况下不能进行注册和登录
 */
function _login_state(){
    if(isset($_COOKIE['username'])){
        _alert_back('登录状态下不可进行本操作');
    }
}

/**
 * _page_main() 分页主函数
 * @param $_sql SQL语句
 * @param $_size 显示多少条数据
 */
function _page_main($_sql,$_size){
    global $_page,$_pagesize,$_pagenum,$_num,$_pageabsolute;
    @$_page = $_GET['page'];
    $_pagesize = $_size;
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
    $_num = _mysql_num_rows($_sql);
    if($_num == 0){
        $_pageabsolute == 1;
    }else{
        $_pageabsolute = ceil($_num/$_pagesize);
    }
    if($_page > $_pageabsolute){
        $_page = $_pageabsolute;
    }
    $_pagenum = ($_page-1)*$_pagesize;
}

/**
 * _page_type() 分页状态，1为数字分页，2为文章分页
 * @param $_type
 */
function _page_type($_type){
    global $_pageabsolute,$_page,$_num;
    if($_type == 1){
    /*数组分页*/
    echo '<div id="page">';
    echo '<ul>';
            for($i=1;$i<=$_pageabsolute;$i++){
                if($_page == $i){
                    echo '<li><a href="'.SCRIPT.'.php?page='.$i.'" class="selected">'.$i.'</a></li>';
                }else{
                    echo '<li><a href="'.SCRIPT.'.php?page='.$i.'">'.$i.'</a></li>';
                }
            }
    echo '</ul>';
    echo '</div>';
    }else if ($_type == 2){
        /*文章分页*/
        echo '<div id="textpage">';
        echo '<ul>';
        echo '<li>'.$_page.'/'.$_pageabsolute.'|</li>';
        echo '<li>共有'.$_num.'个数据|</li>';
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

        echo '</ul>';
        echo '</div>';
    }
}

/**
 * _htmlspecialchars() 将特殊字符转换为 HTML 实体，
 * 先判断传入的是否是数组，如果是数组则采用递归的方式来循环转换，
 * 如果传入的是字符串，那么直接通过内置函数转化
 * @param $_string
 * @return array|string
 */
function _htmlspecialchars($_string){
    if(is_array($_string)){
        foreach ($_string as $_key => $_value){
            //此方法采用的是递归，让每次遍历出来的下标和其对应的值都执行自身方法，然后在返回出去
            $_string[$_key] = _htmlspecialchars($_value);
            //这个上面方法一样，只是这个采用的是内置函数，而上面采用的是递归
            $_string[$_key] = htmlspecialchars($_value);
        }
    }else{
        $_string = htmlspecialchars($_string);
    }
    return $_string;
}

/**
 * _mysql_string() 字符转义函数
 * @access public
 * @param string $_string
 * @return $_string|$_string 一个转义后的字符，一个是没有转义的字符
 */
function _mysql_string($_string){
    if(!GPC) {
        if (is_array($_string)) {
            foreach ($_string as $_key => $_value) {
                //此方法采用的是递归，让每次遍历出来的下标和其对应的值都执行自身方法，然后在返回出去
                $_string[$_key] = addslashes($_value);
                //这个上面方法一样，只是这个采用的是内置函数，而上面采用的是递归
                $_string[$_key] = addslashes($_value);
            }
        } else {
            $_string = addslashes($_string);
        }
    }
    return $_string;
}

/**
 * _title() 截取标题
 * @param $_string
 * @return string
 */
function _title($_string){
    if(mb_strlen($_string,'utf-8') > 14){
        $_string = mb_substr($_string,0,14,'utf-8').'...';
    }
    return $_string;
}
?>