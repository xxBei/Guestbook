/**
 * 文件用途：短信批量删除
 * ==============================================
 * Created by lenovo on 2017/6/27 16:56.
 */
window.onload = function () {
  var all = document.getElementById('all');
  var fm = document.getElementsByTagName('form')[0];
  //全选
  all.onclick = function () {
    for(var i=0;i<fm.elements.length;i++){
        fm.elements[i].checked = fm.chkall.checked;
    }
  };
  fm.onsubmit = function () {
      if(confirm('是否删除选中的短信')){
          return true
      }
      return false;
  }
};
