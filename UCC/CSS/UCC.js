
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
    spaceBetween: 50,
    slidesOffsetBefore: 40,
    loop: true,
    slidesPerView: 'auto',
    on: {
        slideChangeTransitionEnd: function () {
            this.slides.transition(this.params.autoplay.delay + this.params.speed).transform('translate3d(-60px, 0, 0)');
        },
        slideChangeTransitionStart: function () {
            this.slides.transition(this.params.speed).transform('translate3d(0, 0, 0)');
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

