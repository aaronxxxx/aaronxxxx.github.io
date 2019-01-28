
window.onscroll = function () {

    var scroll = document.documentElement.scrollTop;

    console.log(scroll);

}


var swiper = new Swiper('#slides1',{
    direction : 'vertical',
    followFinger : false,
    speed:800,
    mousewheel: true,
    pagination : {
        el:'.swiper-pagination',
    },
    on:{
        init:function(swiper){
            slide=this.slides.eq(0);
            slide.addClass('ani-slide');
        },
        transitionStart: function(){
            for(i=0;i<this.slides.length;i++){
                slide=this.slides.eq(i);
                slide.removeClass('ani-slide');
            }
        },
        transitionEnd: function(){
            slide=this.slides.eq(this.activeIndex);
            slide.addClass('ani-slide');
            
        },
    }
});


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
    spaceBetween: 60,
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
window.onresize = function () {
    swiper.update();
}

var his1Btn = document.getElementById('his1btn');

var his2Btn = document.getElementById('his2btn');

var his3Btn = document.getElementById('his3btn');

var his4Btn = document.getElementById('his4btn');

var his5Btn = document.getElementById('his5btn');

var his6Btn = document.getElementById('his6btn');

var his7Btn = document.getElementById('his7btn');

var history1 = document.getElementById('history1');

var history2 = document.getElementById('history2');

var history3 = document.getElementById('history3');

var history4 = document.getElementById('history4');

var history5 = document.getElementById('history5');

var history6 = document.getElementById('history6');

var history7 = document.getElementById('history7');

var hisintro1 = document.getElementById('his-intro1');

var hisintro2 = document.getElementById('his-intro2');

var hisintro3 = document.getElementById('his-intro3');

var hisintro4 = document.getElementById('his-intro4');

var hisintro5 = document.getElementById('his-intro5');

var hisintro6 = document.getElementById('his-intro6');

var hisintro7 = document.getElementById('his-intro7');

his1Btn.onmouseover = function(){
    
    history1.classList.add('show');
    hisintro1.classList.add('show');
}

his1Btn.onmouseleave = function(){
    
    history1.classList.remove('show');
    hisintro1.classList.remove('show');
}

his2Btn.onmouseover = function(){
    
    history2.classList.add('show');
    hisintro2.classList.add('show');
}

his2Btn.onmouseleave = function(){
    
    history2.classList.remove('show');
    hisintro2.classList.remove('show');
}

his3Btn.onmouseover = function(){
    
    history3.classList.add('show');
    hisintro3.classList.add('show');
}

his3Btn.onmouseleave = function(){
    
    history3.classList.remove('show');
    hisintro3.classList.remove('show');
}

his4Btn.onmouseover = function(){
    
    history4.classList.add('show');
    hisintro4.classList.add('show');
}

his4Btn.onmouseleave = function(){
    
    history4.classList.remove('show');
    hisintro4.classList.remove('show');
}

his5Btn.onmouseover = function(){
    
    history5.classList.add('show');
    hisintro5.classList.add('show');
}

his5Btn.onmouseleave = function(){
    
    history5.classList.remove('show');
    hisintro5.classList.remove('show');
}

his6Btn.onmouseover = function(){
    
    history6.classList.add('show');
    hisintro6.classList.add('show');
}

his6Btn.onmouseleave = function(){
    
    history6.classList.remove('show');
    hisintro6.classList.remove('show');
}

his7Btn.onmouseover = function(){
    
    history7.classList.add('show');
    hisintro7.classList.add('show');
}

his7Btn.onmouseleave = function(){
    
    history7.classList.remove('show');
    hisintro7.classList.remove('show');
}