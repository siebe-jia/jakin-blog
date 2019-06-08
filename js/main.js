$(document).ready(function () {
    //header
    var windowTop = 0;//初始话可视区域距离页面顶端的距离
    var header = document.getElementById("header");
    $(window).scroll(function () {
        var scrolly = $(this).scrollTop();//获取当前可视区域距离页面顶端的距离
        if(scrolly > 60){
            if (scrolly >= windowTop) {//当scrolly>windowTop时，表示页面在向下滑动
                //需要执行隐藏导航的操作
                header.classList.remove("slideDown");
                header.classList.add("slideUp");
                windowTop = scrolly;
            } else {
                //需要执行显示导航动画操作
                header.classList.remove("slideUp");
                header.classList.add("slideDown");
                windowTop = scrolly;
            }
        }
    });
    //banner
    $('#banner').easyFader();
    //scroll
    if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))) {
        window.scrollReveal = new scrollReveal({ reset: true });
    };
    //aside
    var Sticky = new hcSticky('aside', {
        stickTo: 'article',
        innerTop: 410,
        followScroll: false,
        queries: {
            480: {
                disable: true,
                stickTo: 'body'
            }
        }
    });
    //tab	
    var oLi = document.getElementById("tab").getElementsByTagName("a");
    var oUls = document.getElementById("content").getElementsByTagName("ul");

    for (var i = 0; i < oLi.length; i++) {
        oLi[i].index = i;
        oLi[i].onmouseover = function () {
            for (var n = 0; n < oLi.length; n++) {
                oLi[n].className = "";
                this.className = "current";
            }
            for (var n = 0; n < oUls.length; n++) {
                oUls[n].style.display = "none";
                oUls[this.index].style.display = "block"
            }
        }
    };
});