jQuery(function($){
 	"use strict";
   	jQuery('.gb_navigation > ul').superfish({
		delay:       500,
		animation:   {opacity:'show',height:'show'},
		speed:       'fast'
  	});
});

function cyber_security_services_gb_Menu_open() {
	jQuery(".side_gb_nav").addClass('show');
}
function cyber_security_services_gb_Menu_close() {
	jQuery(".side_gb_nav").removeClass('show');
}

jQuery(function($){
	$('.gb_toggle').click(function () {
        cyber_security_services_Keyboard_loop($('.side_gb_nav'));
    });
});

jQuery('document').ready(function(){
    var owl = jQuery('#slider .owl-carousel');
        owl.owlCarousel({
        loop:true,
        margin:10,
        autoplay : true,
        lazyLoad: true,
        autoplayTimeout: 5000,
        loop: true,
        dots:false,
        navText : ['<i class="fas fa-arrow-left"></i>','<i class="fas fa-arrow-right"></i>'],
        nav:true,
        items:1,
        lazyLoad: true,
        nav:true,
        rtl:true,
      	responsive:{
            0:{
                items:1,
            },
            600:{
                items:1,
            },
            1000:{
                items:1,
            },
            1200:{
                items:1,
            },
        }
    });
});

jQuery(window).load(function() {
	jQuery(".preloader").delay(2000).fadeOut("slow");
});

jQuery(window).scroll(function(){
	if (jQuery(this).scrollTop() > 100) {
		jQuery('.scrollup').addClass('is-active');
	} else {
  		jQuery('.scrollup').removeClass('is-active');
	}
});

jQuery( document ).ready(function() {
	jQuery('#cyber-security-services-scroll-to-top').click(function (argument) {
		jQuery("html, body").animate({
		       scrollTop: 0
		   }, 600);
	})
})

jQuery(window).scroll(function(){
	if (jQuery(this).scrollTop() > 120) {
		jQuery('.menubarr').addClass('fixed');
	} else {
  		jQuery('.menubarr').removeClass('fixed');
	}
});
