(function ($) {
    $.fn.animateNumbers = function (stop, commas, duration, ease) {
        return this.each(function () {
            var $this = $(this);
            var start = parseInt($this.text().replace(/,/g, ""));
            commas = (commas === undefined) ? true : commas;
            $({
                value: start
            }).animate({
                value: stop
            }, {
                duration: duration == undefined ? 1000 : duration,
                easing: ease == undefined ? "swing" : ease,
                step: function () {
                    $this.text(Math.floor(this.value));
                    if (commas) {
                        $this.text($this.text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                    }
                },
                complete: function () {
                    if (parseInt($this.text()) !== stop) {
                        $this.text(stop);
                        if (commas) {
                            $this.text($this.text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                        }
                    }
                }
            });
        });
    };
})(jQuery);

$(document).ready(function () {
    AOS.init();
    $('.index').addClass('anim');
    var galleryThumbs = new Swiper('.gallery-thumbs', {
        spaceBetween: 10,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 40
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 30
            },
            1280: {
                slidesPerView: 4,
                spaceBetween: 10
            }
        }
    });
    var galleryTop = new Swiper('.gallery-top', {
        spaceBetween: 10,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        thumbs: {
            swiper: galleryThumbs
        }
    });
    $(window).scroll(function () {
        var windowHeight = $(this).height(),
            windowWidth = $(this).width(),
            scrollTop = $(window).scrollTop(),
            introTop = $('.intro').offset().top,
            cardTop = $('.advisory__cardGroup').offset().top,
            setpLeftTop = $('.step__left').offset().top,
            setpRightTop = $('.step__right').offset().top;
        if (scrollTop > 1000) {
            $('.js-bodyButton').addClass('anim');
        } else {
            $('.js-bodyButton').removeClass('anim');
        }
        if (introTop - scrollTop < windowHeight) {
            $(".js-number1").animateNumbers(3296, true, 1000);
            $(".js-number2").animateNumbers(1720, true, 1000);
            $(".js-number3").animateNumbers(1301947, true, 1000);
        } else {
            $(".js-number1").animateNumbers(1570, true, 1000);
            $(".js-number2").animateNumbers(829, true, 1000);
            $(".js-number3").animateNumbers(700040, true, 1000);
        }
        if (windowWidth < 768) {
            if (cardTop - scrollTop < windowHeight / 8) {
                $('.js-card').addClass('shiney');
            } else {
                $('.js-card').removeClass('shiney');
            }
        } else {
            if (cardTop - scrollTop < windowHeight / 3) {
                $('.js-card').addClass('shiney');
            } else {
                $('.js-card').removeClass('shiney');
            }
        }
        if (setpLeftTop - scrollTop < windowHeight / 2) {
            var stepTop = $('.step').offset().top;
            $('.step__leftLine').css('height', -((stepTop - scrollTop) - 185) + 'px');
        }
        if (setpRightTop - scrollTop < windowHeight / 2) {
            var stepTop = $('.step').offset().top;
            $('.step__rightLine').css('height', -(stepTop - scrollTop) + 'px');
        }
        $('.step__item').each(function () {
            var stepItemTop = $(this).offset().top;
            if (stepItemTop - scrollTop < windowHeight / 2) {
                $(this).addClass('active');
            } else {
                $(this).removeClass('active');
            }
        });
    });
    $('.input').on('focus', function () {
        $(this).parent().addClass('active');
    });
    $('.input').on('blur', function () {
        if ($(this).val() !== "") {
            $(this).parent().removeClass('wrong');
        } else {
            $(this).parent().removeClass('active');
            $(this).parent().addClass('wrong');
        }
    });
});

$(window).on('load', function () {
    SmoothParallax.init();
})