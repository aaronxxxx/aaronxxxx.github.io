
var swiper = new Swiper('#slides2', {
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    speed: 700,
    allowTouchMove: false,
    lazy: {
        loadPrevNext: true,
        loadPrevNextAmount: 3,
    },
    centeredSlides: true,
    slidesOffsetBefore: 40,
    loop: true,
    slidesPerView: 'auto',
    on: {
        slideChangeTransitionEnd: function () {
            this.slides.transition(this.params.autoplay.delay + this.params.speed).transform('translate3d(-80px, 0, 0)');
        },
        slideChangeTransitionStart: function () {
            this.slides.transition(this.params.speed).transform('translate3d(-30px, 0, 0)');
        },
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
        renderBullet: function (index, className) {
            return '<div class="' + className + '"><span></span><i></i></div>';
        },
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});

var timelineSwiper = new Swiper('#slides3', {
    direction: 'vertical',
    loop: false,
    speed: 1600,
    mousewheel: true,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
        renderBullet: function (index, className) {
            switch (index) {
                case 0: text = '1951'; break;
                case 1: text = '1969'; break;
                case 2: text = '1981'; break;
                case 3: text = '1987'; break;
                case 4: text = '1989'; break;
            }
            return '<span class="' + className + '">' + text + '</span>';
        },
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

});
