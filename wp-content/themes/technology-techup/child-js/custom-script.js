jQuery(function () {
    jQuery(".testimonials-content").owlCarousel({
        dots:false,
        nav:false,
        loop: true,
        slideSpeed: 500,
        autoPlay: true,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:1,
            },
            800:{
                items:1,
            },
            1500:{
                items:1,
            }
        }
    });
});