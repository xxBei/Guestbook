/**
 * 
 */
 window.onload = function(){
	var userimg = document.getElementById('userimg');
	var code = document.getElementById('code');
	//点击打开新窗口
	userimg.onclick = function(){
		window.open('face.php','face','width=400,height=400,top=0,left=0');
	};
	//局部刷新验证码
	code.onclick = function(){
		this.src='code.php?rnd='+Math.random();
	}
	
};
