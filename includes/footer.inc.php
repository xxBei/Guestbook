<?php
/**
* 文件用途：底部分离，防止恶意调用
* ==============================================
* @date: 2017年5月24日
* @author: zbei
* @version:
*/
//定义一个常量，防止恶意调用
if(!defined('ROOT')){
    exit('Access Defined!');
}
?>

<div id="footer">
	<p>版权所有，违者必究</p>
	<p>本程序所属于<span>zBei</span>,仅用于学习</p>
	<p>本程序所用时间：<?php echo round((_runtime()-START_TIME),4)?>秒</p>
</div>
