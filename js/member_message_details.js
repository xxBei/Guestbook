/**
 * 文件用途：
 * ==============================================
 * Created by lenovo on 2017/6/27 14:45.
 */
window.onload = function () {
  var back = document.getElementById('back');
  var del = document.getElementById('delete');
  back.onclick = function () {
      history.back();
  };
    del.onclick = function () {
      if(confirm('是否删除该条短信？')){
          location.href = '?action=delete&id='+this.name;
      }

  }
};