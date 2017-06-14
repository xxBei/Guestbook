/**
 *
 */
 window.onload = function(){
	var userimg = document.getElementById('userimg');
	code();//验证码局部刷新
	//点击打开新窗口
	userimg.onclick = function(){
		window.open('face.php','face','width=400,height=400,top=0,left=0');
	};
	//JS表单验证，可以节省服务器压力
	var fm = document.getElementsByTagName('form')[0];
	fm.onsubmit = function () {
		//用户名验证
		if(fm.username.value.length < 2 || fm.username.value.length > 20){
			alert('用户名不能小于2位或大于20位');
			fm.username.value = '';
			fm.username.focus();
			return false;
		}
		if(/[<>\'\"\ ]/	.test(fm.username.value)){
            alert('用户名不能包含特殊字符！');
            fm.username.value = '';
            fm.username.focus();
			return false;
		}
		//密码验证
		if(fm.password.value.length < 6){
			alert('密码不能小于6位');
			fm.password.value = '';
			fm.password.focus();
			return false;
		}
		if(fm.password.value != fm.notpassword.value){
			alert('两次密码不一致！');
			fm.notpassword.value = '';
			fm.notpassword.focus();
			return false;
		}
		//密码问题验证
		if(fm.question.value.length < 2 || fm.question.value.length > 20){
            alert('密码问题不能小于2位或大于20位！');
            fm.question.value = '';
            fm.question.focus();
            return false;
		}
		//密码答案验证
		if(fm.answer.value.length < 2 || fm.answer.value.length > 20){
			alert('密码答案不能小于2位或大于20位！');
			fm.answer.value = '';
			fm.answer.focus();
			return false;
		}
		if(fm.answer.value == fm.question.value){
            alert('密码答案不能和问题一致！');
            fm.answer.value = '';
            fm.answer.focus();
            return false;
		}
		//电子邮箱验证
		if(!/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(fm.email.value)){
            alert('邮箱格式不正确！');
            fm.email.value = '';
            fm.email.focus();
            return false;
		}
		//QQ验证
		if(fm.qq.value != ''){
            if(!/^[1-9]{1}[\d]{4,9}$/.test(fm.qq.value)){
                alert('QQ格式不正确！');
                fm.qq.value = '';
                fm.qq.focus();
                return false;
            }
		}
		//网址验证

		if(fm.url.value != ''){
			if(fm.url.value == 'http://'){
                return true;
			}else {
                if (!/^https?:\/\/[\w\.]?[\w\-\.]+(\.\w+)+?$/.test(fm.url.value)) {
                    alert('网址格式不正确！');
                    fm.url.value = '';
                    fm.url.focus();
                    return false;
                }
            }
		}
		//验证码验证
		if(fm.code.value.length != 4){
            alert('验证码必须是4位！');
            fm.code.value = '';
            fm.code.focus();
            return false;
		}

		return true;
    };
};
