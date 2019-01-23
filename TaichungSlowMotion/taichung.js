$(function () {

    $('#hamburger').on('click', function () {

        $('#nav-inner').toggleClass('show');

        $(this).toggleClass('active');

    });

});

var historyBtn = document.getElementById('history-btn');

var historyInner = document.getElementById('history-inner');

var historyLine = document.getElementById('line');

var historyCircle = document.getElementById('circle');

var historyCircle2 = document.getElementById('circle2');

var space = document.querySelector('.space');

var ani = document.querySelector('.historyani');

historyBtn.onclick = function () {

    historyInner.classList.toggle('show');
    historyLine.classList.toggle('show');
    historyCircle.classList.toggle('show');
    historyCircle2.classList.toggle('show');
    space.classList.toggle('show');
    ani.classList.toggle('show');

}

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
    width: 300,
    height: 160,
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
    width: 300,
    height: 160,
});
var swiper3 = new Swiper("#ture2", {
    speed: 15000,
    autoplay: {
        delay: 0,
    },
    loop: true,
    loopAdditionalSlides: 7,
    width: 300,
    height: 160,
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

var introSlide1 = document.getElementById('intro-slide1');

var introSlide2 = document.getElementById('intro-slide2');

var introSlide3 = document.getElementById('intro-slide3');

var introSlide4 = document.getElementById('intro-slide4');

var introSlide5 = document.getElementById('intro-slide5');

var introSlide6 = document.getElementById('intro-slide6');

var introSlide7 = document.getElementById('intro-slide7');

var introSlide8 = document.getElementById('intro-slide8');

var introSlide9 = document.getElementById('intro-slide9');

var introSlide10 = document.getElementById('intro-slide10');

var innerBox1 = document.getElementById('small-box1');

var innerBox2 = document.getElementById('small-box2');

var innerBox3 = document.getElementById('small-box3');

var innerBox4 = document.getElementById('small-box4');

var innerBox5 = document.getElementById('small-box5');

var innerBox6 = document.getElementById('small-box6');

var innerBox7 = document.getElementById('small-box7');

var innerBox8 = document.getElementById('small-box8');

var innerBox9 = document.getElementById('small-box9');

var innerBox10 = document.getElementById('small-box10');

introSlide1.onmouseover = function(){
    
    innerBox1.classList.add('move');

}

introSlide1.onmouseleave = function(){
    
    innerBox1.classList.remove('move');

}

introSlide2.onmouseover = function(){
    
    innerBox2.classList.add('move');

}

introSlide2.onmouseleave = function(){
    
    innerBox2.classList.remove('move');

}


introSlide3.onmouseover = function(){
    console.log('1');
    
    innerBox3.classList.add('move');

}

introSlide3.onmouseleave = function(){
    console.log('1');
    
    innerBox3.classList.remove('move');

}


introSlide4.onmouseover = function(){
    
    innerBox4.classList.add('move');

}

introSlide4.onmouseleave = function(){
    
    innerBox4.classList.remove('move');

}


introSlide5.onmouseover = function(){
    
    innerBox5.classList.add('move');

}

introSlide5.onmouseleave = function(){
    
    innerBox5.classList.remove('move');

}


introSlide6.onmouseover = function(){

    
    innerBox6.classList.add('move');

}

introSlide6.onmouseleave = function(){
    
    innerBox6.classList.remove('move');

}


introSlide7.onmouseover = function(){
    
    innerBox7.classList.add('move');

}

introSlide7.onmouseleave = function(){
    
    innerBox7.classList.remove('move');

}


introSlide8.onmouseover = function(){
    
    innerBox8.classList.add('move');

}

introSlide8.onmouseleave = function(){
    
    innerBox8.classList.remove('move');

}


introSlide9.onmouseover = function(){
    
    innerBox9.classList.add('move');

}

introSlide9.onmouseleave = function(){
    
    innerBox9.classList.remove('move');

}


introSlide10.onmouseover = function(){
    
    innerBox10.classList.add('move');

}

introSlide10.onmouseleave = function(){
    
    innerBox10.classList.remove('move');

}


document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});


var mySwiper = new Swiper('#mapswiper', {

    initialSlide :2,
    slideToClickedSlide: true,
    centeredSlides: true,
    slidesPerView: 3,

})

var mapBtn1 = document.querySelector('.mapslide1');

var mapBtn2 = document.querySelector('.mapslide2');

var mapBtn3 = document.querySelector('.mapslide3');

var mapBtn4 = document.querySelector('.mapslide4');

var mapBtn5 = document.querySelector('.mapslide5');

var mapBtn6 = document.querySelector('.mapslide6');

var imgChange1 = document.querySelector('.map-img1');

var imgChange2 = document.querySelector('.map-img2');

var imgChange3 = document.querySelector('.map-img3');

var imgChange4 = document.querySelector('.map-img4');

var imgChange5 = document.querySelector('.map-img5');

var imgChange6 = document.querySelector('.map-img6');

var tourCon = document.getElementById('tour-con');

mapBtn1.onclick = function(){
    imgChange1.classList.add('show');
    imgChange2.classList.remove('show');
    imgChange3.classList.remove('show');
    imgChange4.classList.remove('show');
    imgChange5.classList.remove('show');
    imgChange6.classList.remove('show');
    tourCon.classList.add('move');
}

mapBtn2.onclick = function(){
    imgChange2.classList.add('show');
    imgChange1.classList.remove('show');
    imgChange3.classList.remove('show');
    imgChange4.classList.remove('show');
    imgChange5.classList.remove('show');
    imgChange6.classList.remove('show');
    tourCon.classList.add('move');
}

mapBtn3.onclick = function(){
    imgChange3.classList.add('show');
    imgChange2.classList.remove('show');
    imgChange1.classList.remove('show');
    imgChange4.classList.remove('show');
    imgChange5.classList.remove('show');
    imgChange6.classList.remove('show');
    tourCon.classList.add('move');
}

mapBtn4.onclick = function(){
    imgChange4.classList.add('show');
    imgChange2.classList.remove('show');
    imgChange3.classList.remove('show');
    imgChange1.classList.remove('show');
    imgChange5.classList.remove('show');
    imgChange6.classList.remove('show');
    tourCon.classList.add('move');
}

mapBtn5.onclick = function(){
    imgChange5.classList.add('show');
    imgChange2.classList.remove('show');
    imgChange3.classList.remove('show');
    imgChange4.classList.remove('show');
    imgChange1.classList.remove('show');
    imgChange6.classList.remove('show');
    tourCon.classList.add('move');
}

mapBtn6.onclick = function(){
    imgChange6.classList.add('show');
    imgChange2.classList.remove('show');
    imgChange3.classList.remove('show');
    imgChange4.classList.remove('show');
    imgChange5.classList.remove('show');
    imgChange1.classList.remove('show');
    tourCon.classList.add('move');
}




