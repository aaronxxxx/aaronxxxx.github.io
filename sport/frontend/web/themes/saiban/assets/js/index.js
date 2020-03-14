$(document).ready(function () {
    AOS.init();
    toggleColor('.textGlitter', ['#0f0', 'red'], 500);
    //banner
    var mySwiper = new Swiper('#slide-banner', {
        autoplay: true,
        loop: true,
        speed: 300,
        pagination: {
            el: '.swiper-pagination',
        },
    });
    var mySwiper = new Swiper('#slide-bar', {
        direction: 'vertical',
        loop: true,
        loopAdditionalSlides: 6,
        height: 67,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
    $('#login-box').hover(function () {
        $('#agree').toggleClass('show');
    }, function () {
        $('#agree').hover(function () {
            $('#agree').addClass('show');
        }, function () {
            $('#agree').removeClass('show');
        });
        $('#agree').removeClass('show');
    });
    $('.navbarBtn').hover(function () {
        $('.subnav').stop(true, true).slideUp(300);
        $(this).find('.subnav').slideDown(300);
    }, function () {
        $('.subnav').stop(true, true).slideUp(300);
    });
    $('.slideBtn').hover(function () {
        var slideBtn = $(this).attr('data-btn');
        console.log(slideBtn);
        switch (slideBtn) {
            case 'mg':
                $('.wrapper').find('.game-list').hide();
                $('ul.mg').css('display', 'inline-block');
                break;
            case 'pt':
                $('.game-list').hide();
                $('ul.pt').css('display', 'inline-block');
                break;
            case 'bb':
                $('.game-list').hide();
                $('ul.bb').css('display', 'inline-block');
                break;
            case 'ag':
                $('.game-list').hide();
                $('ul.ag').css('display', 'inline-block');
                break;
            case 'prg':
                $('.game-list').hide();
                $('ul.prg').css('display', 'inline-block');
                break;
            case 'gns':
                $('.game-list').hide();
                $('ul.gns').css('display', 'inline-block');
                break;
            case 'gpi':
                $('.game-list').hide();
                $('ul.gpi').css('display', 'inline-block');
                break;
            case 'lg':
                $('.game-list').hide();
                $('ul.lg').css('display', 'inline-block');
                break;
            case 'isb':
                $('.game-list').hide();
                $('ul.isb').css('display', 'inline-block');
                break;
        }
    });
    $('#reg-btn').click(function () {
        window.location.href = "/?r=site/reg";
    })
})