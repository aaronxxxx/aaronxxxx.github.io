$(function () {

    $('#hamburger').on('click', function () {

        $('.navInner').toggleClass('show');

        $(this).toggleClass('active');

    });
    $('.swiperBtn').hover(function () {
        var tableName = $(this).data('table');
        var a = $(this).find('a');
        $(this).addClass('show');
        a.addClass('show');
        $('#bag').addClass('show');
        $('.bigBox').addClass('show');
        $('.box').addClass('show');
        $(".swiper-container").removeClass('show');
        $('body').find("#" + tableName).addClass('show');
    }, function () {
        $(this).removeClass('show');
        $('a').removeClass('show');
        $('#bag').removeClass('show');
        $('.bigBox').removeClass('show');
        $('.box').removeClass('show');
        $('.main').removeClass('show');
        $(".swiper-container").removeClass('show');
    })
})

var mySwiper = new Swiper('.swiper-container', {
    slidesPerView: 3,
    spaceBetween: 30,
    autoplay: true,
    loop: true,
    loopAdditionalSlides: 11,
    speed: 2000,
    autoplay: {
        delay: 0,
    }

})
