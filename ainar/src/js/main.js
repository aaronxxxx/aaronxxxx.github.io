(function ($) {
	"use strict";


/*=============================================
	=    		Mobile Menu			      =
=============================================*/
//SubMenu Dropdown Toggle
if ($('.menu-area li.menu-item-has-children ul').length) {
	$('.menu-area .navigation li.menu-item-has-children').append('<div class="dropdown-btn"><span class="fas fa-angle-down"></span></div>');

}

//Mobile Nav Hide Show
if ($('.mobile-menu').length) {

	var mobileMenuContent = $('.menu-area .main-menu .push-menu').html();
	$('.mobile-menu .menu-box .menu-outer').append(mobileMenuContent);

	//Dropdown Button
	$('.mobile-menu li.menu-item-has-children .dropdown-btn').on('click', function () {
		$(this).toggleClass('open');
		$(this).prev('ul').slideToggle(500);
	});
	//Menu Toggle Btn
	$('.mobile-nav-toggler').on('click', function () {
		$('body').addClass('mobile-menu-visible');
	});

	//Menu Toggle Btn
	$('.menu-backdrop, .mobile-menu .close-btn').on('click', function () {
		$('body').removeClass('mobile-menu-visible');
	});
}


/*=============================================
=     Offcanvas Menu      =
=============================================*/
$(".menu-tigger").on("click", function () {
	$(".extra-info,.offcanvas-overly").addClass("active");
	return false;
});
$(".menu-close,.offcanvas-overly").on("click", function () {
	$(".extra-info,.offcanvas-overly").removeClass("active");
});


/*=============================================
	=     Menu sticky & Scroll to top      =
=============================================*/
$(window).on('scroll', function () {
	var scroll = $(window).scrollTop();
	if (scroll < 245) {
		$("#sticky-header").removeClass("sticky-menu");
		$('.scroll-to-target').removeClass('open');
		$("#header-top-fixed").removeClass("header-fixed-position");

	} else {
		$("#sticky-header").addClass("sticky-menu");
		$('.scroll-to-target').addClass('open');
		$("#header-top-fixed").addClass("header-fixed-position");
	}
});


/*=============================================
	=    		 Scroll Up  	         =
=============================================*/
if ($('.scroll-to-target').length) {
  $(".scroll-to-target").on('click', function () {
    var target = $(this).attr('data-target');
    // animate
    $('html, body').animate({
      scrollTop: $(target).offset().top
    }, 1000);

  });
}


/*=============================================
	=       Home Active           =
=============================================*/
$('.home-active').slick({
	autoplay: true,
	arrows: false,
	dots: false,
	infinite: false,
	pauseOnFocus: false,
	pauseOnHover: false,
	speed: 1000,
});


if(window.innerWidth < 767) {
	let menuWidth = $('.category-menu').outerWidth();

	$('.category-menu-target').on('click', function () {
		if($('.category-menu').hasClass('show')) {
			$('.category-menu').removeClass('show');
			$(this).removeClass('active');
			$(this).css('right', '0');
		} else {
			$('.category-menu').addClass('show');
			$(this).addClass('active');
			$(this).css('right', menuWidth);
		}
	});
	$('.category-menu a').on('click', function () {
		$('.category-menu').removeClass('show');
		$('.category-menu-target').removeClass('active');
		$('.category-menu-target').css('right', '0');
	});
}


})(jQuery);