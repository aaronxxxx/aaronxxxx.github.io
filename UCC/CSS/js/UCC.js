var body = document.getElementById("PC");

var hamburger = document.querySelector('.checkbox-toggle');

hamburger.onclick = function () {

    body.classList.toggle('blur');
    
}

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

var mySwiper = new Swiper('#slides-mb', {
    direction: 'vertical',
    mousewheel: true,
    speed: 1500,
    height: window.innerHeight,
    on: {
        slideChangeTransitionEnd: function () {
            var coffeeBean = document.querySelector('.coffeebean');
            var coffee = document.querySelector('.coffee');
            coffeeBean.classList.toggle('show');
            coffee.classList.toggle('show');
        },
    },
})

var productSwiper = new Swiper('#product-video-mb', {
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
})

var swiper = new Swiper('#shop-slides-mb', {
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    speed: 1000,
    allowTouchMove: false,
    lazy: {
        loadPrevNext: true,
        loadPrevNextAmount: 3,
    },
    centeredSlides: true,
    slidesOffsetBefore: 30,
    loop: true,
    slidesPerView: 'auto',
    on: {
        slideChangeTransitionEnd: function () {
            this.slides.transition(this.params.autoplay.delay + this.params.speed).transform('translate3d(-40px, 0, 0)');
        },
        slideChangeTransitionStart: function () {
            this.slides.transition(this.params.speed).transform('translate3d(-25px, 0, 0)');
        },
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
        renderBullet: function (index, className) {
            return '<div class="' + className + '"><span></span><i></i></div>';
        },
    },
});

var galleryThumbs = new Swiper('.gallery-thumbs', {
    spaceBetween: 10,
    slidesPerView: 4,
    loop: true,
    freeMode: true,
    loopedSlides: 5,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
});
var galleryTop = new Swiper('.gallery-top', {
    spaceBetween: 10,
    loop: true,
    loopedSlides: 5,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    thumbs: {
        swiper: galleryThumbs,
    },
});

var colors = new Array(
    [62, 35, 255],
    [60, 255, 60],
    [255, 35, 98],
    [45, 175, 230],
    [255, 0, 255],
    [255, 128, 0]);

var step = 0;
var colorIndices = [0, 1, 2, 3];

var gradientSpeed = 0.005;

function updateGradient() {

    if ($ === undefined) return;

    var c0_0 = colors[colorIndices[0]];
    var c0_1 = colors[colorIndices[1]];
    var c1_0 = colors[colorIndices[2]];
    var c1_1 = colors[colorIndices[3]];

    var istep = 1 - step;
    var r1 = Math.round(istep * c0_0[0] + step * c0_1[0]);
    var g1 = Math.round(istep * c0_0[1] + step * c0_1[1]);
    var b1 = Math.round(istep * c0_0[2] + step * c0_1[2]);
    var color1 = "rgb(" + r1 + "," + g1 + "," + b1 + ")";

    var r2 = Math.round(istep * c1_0[0] + step * c1_1[0]);
    var g2 = Math.round(istep * c1_0[1] + step * c1_1[1]);
    var b2 = Math.round(istep * c1_0[2] + step * c1_1[2]);
    var color2 = "rgb(" + r2 + "," + g2 + "," + b2 + ")";

    $('#gradient').css({
        background: "-webkit-gradient(linear, left top, right top, from(" + color1 + "), to(" + color2 + "))"
    }).css({
        background: "-moz-linear-gradient(left, " + color1 + " 0%, " + color2 + " 100%)"
    });

    step += gradientSpeed;
    if (step >= 1) {
        step %= 1;
        colorIndices[0] = colorIndices[1];
        colorIndices[2] = colorIndices[3];

        colorIndices[1] = (colorIndices[1] + Math.floor(1 + Math.random() * (colors.length - 1))) % colors.length;
        colorIndices[3] = (colorIndices[3] + Math.floor(1 + Math.random() * (colors.length - 1))) % colors.length;

    }
}

setInterval(updateGradient, 10);

