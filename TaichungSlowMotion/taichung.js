//  頁面載入
$(function () {
    $('#hamburger').on('click', function () {

        $('.navInner').toggleClass('show');

        $(this).toggleClass('active');

    });
    $('#mb_hamburger').on('click', function () {

        $('.navInner').toggleClass('show');

        $(this).toggleClass('active');

    });
    $('#his').on('click', function () {

        $('.navInner').toggleClass('show');

        $('mb_hamburger').toggleClass('show');

        $('#hamburger').toggleClass('active');
    });
    $('#int').on('click', function () {

        $('.navInner').toggleClass('show');

        $('mb_hamburger').toggleClass('show');

        $('#hamburger').toggleClass('active');
    });
    $('#tou').on('click', function () {

        $('.navInner').toggleClass('show');

        $('mb_hamburger').toggleClass('show');

        $('#hamburger').toggleClass('active');
    });
    $('#tou2').on('click', function () {

        $('.navInner').toggleClass('show');

        $('mb_hamburger').toggleClass('show');

        $('#hamburger').toggleClass('active');
    });

    $('#historyBtn').click(function () {
        $('.historyInner').toggleClass('show');
        $('.line').toggleClass('show');
        $('.circle').toggleClass('show');
        $('.circle2').toggleClass('show');
        $('.space').toggleClass('show');
        $('.historyani').toggleClass('show');
    })
});

var scroll = new Swiper("#scroll", {
    mousewheel: true,
    freeMode: true,
    observer: true,
    observeParents: true,
    pagination: {
        el: '.swiper-pagination',
    },

});

var swiper1 = new Swiper("#ture", {
    speed: 15000,
    autoplay: {
        delay: 0,
    },
    loop: true,
    loopAdditionalSlides: 7,
    slidesPerView: 6,
});
var swiper2 = new Swiper("#reverse", {
    speed: 15000,
    roundLengths: false,
    autoplay: {
        delay: 0,
        reverseDirection: true,

    },
    loop: true,
    loopAdditionalSlides: 7,
    slidesPerView: 6,
});
var swiper3 = new Swiper("#ture2", {
    speed: 15000,
    autoplay: {
        delay: 0,
    },
    loop: true,
    loopAdditionalSlides: 7,
    slidesPerView: 6,
});
var swiper4 = new Swiper("#ture3", {
    speed: 2000,
    autoplay: {
        delay: 0,
    },
    loop: true,
    loopAdditionalSlides: 7,
    width: 430,
    height: 600,
    spaceBetween: 70,

});

swiper1.el.onmouseenter = function () {

    var swiper1_translate = swiper1.getTranslate();

    swiper1.setTranslate(swiper1_translate);

}

swiper1.el.onmouseleave = function () {

    var Now_translate1 = swiper1.getTranslate();

    Now_translate1 = Now_translate1 - 300;

    swiper1.setTransition(15000);

    swiper1.setTranslate(Now_translate1);

}

swiper2.el.onmouseenter = function () {

    var swiper2_translate = swiper2.getTranslate();

    swiper2.setTranslate(swiper2_translate);

}

swiper2.el.onmouseleave = function () {

    var Now_translate2 = swiper2.getTranslate();

    Now_translate2 = Now_translate2 + 300;

    swiper2.setTransition(15000);

    swiper2.setTranslate(Now_translate2);
}

swiper3.el.onmouseenter = function () {

    var swiper3_translate = swiper3.getTranslate();

    swiper3.setTranslate(swiper3_translate);

}

swiper3.el.onmouseleave = function () {

    var Now_translate3 = swiper3.getTranslate();

    Now_translate3 = Now_translate3 - 300;

    swiper3.setTransition(15000);

    swiper3.setTranslate(Now_translate3)

}

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});


var mySwiper = new Swiper('#mapSwiper', {

    initialSlide: 2,
    slideToClickedSlide: true,
    centeredSlides: true,
    slidesPerView: 2,
    breakpoints: {
        1024: {
            slidesPerView: 2,
        }
    }
})

var mapBtn1 = document.querySelector('.mapslide1');

var mapBtn2 = document.querySelector('.mapslide2');

var mapBtn3 = document.querySelector('.mapslide3');

var mapBtn4 = document.querySelector('.mapslide4');

var mapBtn5 = document.querySelector('.mapslide5');

var mapBtn6 = document.querySelector('.mapslide6');

var imgChange1 = document.querySelector('.mapImg1');

var imgChange2 = document.querySelector('.mapImg2');

var imgChange3 = document.querySelector('.mapImg3');

var imgChange4 = document.querySelector('.mapImg4');

var imgChange5 = document.querySelector('.mapImg5');

var imgChange6 = document.querySelector('.mapImg6');

var tourCon = document.getElementById('tourCon');

mapBtn1.onclick = function () {
    imgChange1.classList.add('show');
    imgChange2.classList.remove('show');
    imgChange3.classList.remove('show');
    imgChange4.classList.remove('show');
    imgChange5.classList.remove('show');
    imgChange6.classList.remove('show');
    tourCon.classList.add('move');
}

mapBtn2.onclick = function () {
    imgChange2.classList.add('show');
    imgChange1.classList.remove('show');
    imgChange3.classList.remove('show');
    imgChange4.classList.remove('show');
    imgChange5.classList.remove('show');
    imgChange6.classList.remove('show');
    tourCon.classList.add('move');
}

mapBtn3.onclick = function () {
    imgChange3.classList.add('show');
    imgChange2.classList.remove('show');
    imgChange1.classList.remove('show');
    imgChange4.classList.remove('show');
    imgChange5.classList.remove('show');
    imgChange6.classList.remove('show');
    tourCon.classList.add('move');
}

mapBtn4.onclick = function () {
    imgChange4.classList.add('show');
    imgChange2.classList.remove('show');
    imgChange3.classList.remove('show');
    imgChange1.classList.remove('show');
    imgChange5.classList.remove('show');
    imgChange6.classList.remove('show');
    tourCon.classList.add('move');
}

mapBtn5.onclick = function () {
    imgChange5.classList.add('show');
    imgChange2.classList.remove('show');
    imgChange3.classList.remove('show');
    imgChange4.classList.remove('show');
    imgChange1.classList.remove('show');
    imgChange6.classList.remove('show');
    tourCon.classList.add('move');
}

mapBtn6.onclick = function () {
    imgChange6.classList.add('show');
    imgChange2.classList.remove('show');
    imgChange3.classList.remove('show');
    imgChange4.classList.remove('show');
    imgChange5.classList.remove('show');
    imgChange1.classList.remove('show');
    tourCon.classList.add('move');
}

var swiper1 = new Swiper("#mb-slide", {
    speed: 2000,
    autoplay: {
        delay: 0,
    },
    loop: true,
    loopAdditionalSlides: 6,
    width: 120,
    height: 120,

});


