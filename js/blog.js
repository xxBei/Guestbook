/**
 * 文件用途：博友js
 * ==============================================
 * Created by lenovo on 2017/6/26 12:12.
 */

window.onload = function () {
    var message = document.getElementsByName('message');
    var friend = document.getElementsByName('friend');
    for(var i=0;i<message.length;i++){
        message[i].onclick = function () {
            centerWindow('message.php?id='+this.title,'message',500,300);
        };
    }
    for(var i=0;i<friend.length;i++){
        friend[i].onclick = function () {
            centerWindow('friend.php?id='+this.title,'friend',500,300);
        };
    }
};
/**
 * centerWindow() 让对话框居中显示
 * @param url
 * @param name
 * @param width
 * @param height
 */
function centerWindow(url,name,width,height) {
    var top = (screen.height - height) / 2;
    var left = (screen.width - width) / 2;
    window.open(url,name,'width='+width+',height='+height+',top='+top+',left='+left);
}