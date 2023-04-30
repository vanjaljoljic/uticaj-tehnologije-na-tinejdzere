jQuery(document).ready(function($) {
  $('.testimonial-slider').bxSlider({
    pager:true,
    controls: false,
    auto : true 
  });
  
  
    $(window).load(function () {
        // Animate loader off screen
        $("#eightlaw-lite-preloader").fadeOut("slow");
    });


  $('.ed_footer_social .social-icons > a').each(function(){
    $(this).wrap('<span></span>');
  });

//Search Box Toogle
$('.site-header .search-icon .fa-search').click(function(){
  $('.site-header .ed-search').slideToggle('slow');
});

/* Fancy box */
    /* For gallery image pop up */
    $('.thumbnail-gallery .gallery-view-link > a').attr('data-fancybox','images');
    $('[data-fancybox]').fancybox({
      loop     : true
    });
    $('#primary .gallery figure a').attr('data-fancybox','images');
    $('[data-fancybox]').fancybox({
      loop     : true
    });
    /* Fancy box ends */


var winwidth = $(window).width();
  if(winwidth >= 1921){var mslide = 7; slidew = 350;}
  else if(winwidth <= 1920 && winwidth >= 1097){var mslide = 5; slidew = 400;}
  else if(winwidth <= 1096 && winwidth >= 801){var mslide = 5; slidew = 250;}
  else if(winwidth <= 800 && winwidth >= 641){var mslide = 3; slidew = 350;}
  else if(winwidth <= 640 && winwidth >=320){var mslide = 2; slidew = 300;}
 else {var mslide = 2; slidew = 300;}

$('.thumbnail-gallery .gallery').bxSlider({
  pager:false,
  controls:true, 
  auto: false,
  minSlides:mslide,
  maxSlides: mslide,
  moveSlides:1,
  slideWidth:slidew,
  autoHeight: true
});
$('.post-slider').bxSlider({
  pager:false,
  controls:true, 
  auto: false,
});

$('.edfooter_social .social-icons a').hover(function() {
  $(this).addClass('animated subtleBounce');
}, function() {
  $(this).removeClass('animated subtleBounce');
});


$('.error404 .number404').addClass('animated bounce');


$('.scroll').bxSlider({
  pager:false,
  controls: true,
  auto : 'true',
  minSlides: 2,
  maxSlides: 6,
  slideWidth: 170,
  slideMargin: 10   
});

$('.menu-toggle, .menu-close-btn').click(function() {
  $('.site-navigation .menu ul').toggle();
  $('body').toggleClass('toggled-nav');
});

$('.menu-wrap .main-navigation .nav-menu').scroll(function(){
  if($(this).scrollTop() > 20){
    $('.menu-close-btn').hide();
  }else{
    $('.menu-close-btn').show();
  }
});

$('#ed-top').css('right',-65);
$(window).scroll(function(){
  if($(this).scrollTop() > 300){
    $('#ed-top').css('right',20);
  }else{
    $('#ed-top').css('right',-65);
  }
});

$("#ed-top").click(function(){
  $('html,body').animate({scrollTop:0},600);
});

$('.site-header .ed-search .search-close').on('click', function(){
  $('.site-header .ed-search').slideToggle('slow');
});

// $('.practice-title').click(function(){
//   var id = $(this).attr('id').split('-');
// //console.log(id[1]);
// $('.practice-content').hide();
// $('#pcontent-'+id[1]).fadeIn();
// }); 

// BENEFIT TABS
$('ul.title li:first-child').addClass('active');
$('.benefit > #tabs > .content > div:first-child').addClass('active');
$('.tabs-title').click(function(){ 
  var clas = $(this).attr('class');
  var arr=clas.split(' ');
  var tabsClas = arr[0];
//alert(tabsClas);
$('.tabs-title').removeClass('active');
$(this).addClass('active');
$('.tabs-content').hide();
$('.tabs-content').removeClass('active');
$('.'+tabsClas+'-content').show().addClass('active');
});


// homepage gallery slider
$('.bxslider').bxSlider();
}); //doc redy close