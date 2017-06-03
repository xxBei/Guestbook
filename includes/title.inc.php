<?php
/**
* 文件用途：css样式分离
* ==============================================
* @date: 2017年5月25日　上午9:00:35
* @author: zbei
* @version:
*/
if (!defined('ROOT')){
    exit('Access Defined!');
}
if (!defined('SCRIPT')){
    exit('Script Error!');
}

?>
<link rel="icon" href="images/msg.ico" type="image/x-ico" />
<link rel="stylesheet" type="text/css" href="styles/1/basic.css" /> 
<link rel="stylesheet" type="text/css" href="styles/1/<?php echo SCRIPT?>.css" /> 