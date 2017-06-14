/**
 * 文件用途：登录页面
 * ==============================================
 * Created by lenovo on 2017/6/12 10:32.
 */
window.onload = function () {
    code();//调用函数局部刷新验证码
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
