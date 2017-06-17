/**
 * 文件用途：修改资料js界面
 * ==============================================
 * Created by lenovo on 2017/6/17 10:57.
 */
window.onload = function () {
  code();
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