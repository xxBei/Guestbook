/**
 * 文件用途：发表帖子验证
 * ==============================================
 * Created by lenovo on 2017/7/7 14:31.
 */
window.onload = function () {
    code();
    var ubb = document.getElementById('ubb');
    var ubbimg = ubb.getElementsByTagName('img');
    var fm  = document.getElementsByTagName('form')[0];
    ubbimg[2].onclick = function () {
        content('<b></b>');
    };
    ubbimg[3].onclick = function () {
        content('<i></i>');
    };
    ubbimg[4].onclick = function () {
        content('<u></u>');
    };
    ubbimg[5].onclick = function () {
        content('<s></s>');
    };
    ubbimg[8].onclick = function () {
        var url = prompt('请输入网址：','http://');
        if(/^https?:\/\/[\w\.]?[\w\-\.]+(\.\w+)+?$/.test(url)){
            content('<url>'+url+'</url>');
        }else {
            alert('网址不合法');
        }
    };
    ubbimg[9].onclick = function () {
        var email = prompt('请输入邮箱：','');
        if(/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(email)){
            content('<email>'+email+'</email>');
        }else {
            alert('邮箱不合法');
        }
    };
    ubbimg[10].onclick = function () {
        var img = prompt('请输入图片地址','');
        content('<img>'+img+'</img>');

    };
    ubbimg[11].onclick = function () {
        var flash = prompt('请输入网址：','http://');
        if(/^https?:\/\/[\w\.]?[\w\-\.]+(\.\w+)+?$/.test(flash)){
            content('<flash>'+flash+'</flash>');
        }else {
            alert('视频不合法');
        }
    };
    ubbimg[18].onclick = function () {
        fm.content.rows += 2;
    };
    ubbimg[19].onclick = function () {
        fm.content.rows -= 2;
    };
    function content(string) {
        fm.content.value += string;
    }
};