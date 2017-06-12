/**
 * Created by lenovo on 2017/6/12.
 */
    //局部刷新验证码
    function code() {
        var code = document.getElementById('code');
        code.onclick = function(){
            this.src='code.php?rnd='+Math.random();
        };
    }
