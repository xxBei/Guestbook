/**
 * 文件用途：发短信js
 * ==============================================
 * Created by lenovo on 2017/6/26 14:29.
 */

window.onload = function () {
  code();
  var fm = document.getElementsByTagName('form')[0];
  fm.onsubmit = function () {
      //验证验证码
      if(fm.code.value.length < 4){
          alert('验证码必须是4位！');
          fm.code.value = '';
          fm.code.focus();
          return false;
      }
      //验证短信内容
      if(fm.content.value.length < 6 || fm.content.value.length > 200){
          alert('短信内容不能小于6位或大于200位！');
          fm.content.focus();
          return false;
      }
      return true;
  };
};