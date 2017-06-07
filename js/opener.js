/**
 * 头像选取
 */
window.onload = function(){
	var img = document.getElementsByTagName('img');
	for(var i=1;i<img.length;i++){
		img[i].onclick = function(){
			//获取子窗口face中的alt
			_opener(this.alt);
			window.close();
		}
	}
}
function _opener(alt){
	//opener表示父窗口，document表示文档
	opener.document.getElementById('userimg').src = alt;
	//获取父窗口register中input中name为faces，将获取的地址传送到value中
	opener.document.register.faces.value = alt;
}