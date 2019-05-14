//  頁面載入準備事件
$(function () {
    $('.swiperBtn').click(function () {
        var tableName = $(this).data('table');
        $(".smallIssue").find("#" + tableName).siblings(".swiperTable").css("opacity", "0");
        $(".smallIssue").find("#" + tableName).css("opacity", "1");
    })
})

//  Swiper
var mySwiper = new Swiper('.swiper-container', {
    observer: true,
    observeParents: true,
    autoplay: true,   //自動輪播
    autoplay: {       //自動選項
        delay: 1000
    },
    speed: 300,       //輪播速度
    pagination: {     //分頁器選項
        el: '.swiper-pagination',
    },
})

var mySwiper = new Swiper('#issueBtn', {
    autoplay: true,   //自動輪播
    autoplay: {       //自動選項
        delay: 2000
    },
    speed: 300,       //輪播速度
    pagination: {     //分頁器選項
        el: '.swiper-pagination',
    },
})