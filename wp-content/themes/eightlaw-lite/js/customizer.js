/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title ' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title , .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title , .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title , .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );
    
    //footer text
    wp.customize( 'eightlaw_lite_footer_copyright_text', function( value ) {
		value.bind( function( to ) {
			$('.site-info .copyright span:first-child').text(to);
		} );
	} );
    
    //search placeholder
    wp.customize( 'eightlaw_lite_search_placeholder', function( value ) {
		value.bind( function( to ) {
			$('.search-field').attr('placeholder',to);
		} );
	} );
    
    //search button text
    wp.customize( 'eightlaw_lite_search_button_text', function( value ) {
		value.bind( function( to ) {
			$('.search-submit').val(to);
		} );
	} );
    
    //homepage about us section viewmore button text
    wp.customize( 'eightlaw_lite_aboutus_viewmore_text', function( value ) {
		value.bind( function( to ) {
			$('.about .ed-container .btn-wrapper a.btn').text(to);
		} );
	} );
    
    
    
    //clientlogo Section Title
    wp.customize( 'eightlaw_lite_clientlogo_title', function( value ) {
		value.bind( function( to ) {
			$('.clients-logo .clients-logo-title').text(to);
		} );
	} );   

    
    //call to Action title
    wp.customize( 'eightlaw_lite_callto_title', function( value ) {
		value.bind( function( to ) {
			$('.call-to-action .cta-title').text(to);
		} );
	} );
    
    //call to Action desc
    wp.customize( 'eightlaw_lite_callto_desc', function( value ) {
		value.bind( function( to ) {
			$('.call-to-action div.home-description').text(to);
		} );
	} );
    
    //call to Action readmore button text
    wp.customize( 'eightlaw_lite_callto_readmore', function( value ) {
		value.bind( function( to ) {
			$('.call-to-action .author a').text(to);
		} );
	} );
    
    //call to Action link
    wp.customize( 'eightlaw_lite_callto_link', function( value ) {
		value.bind( function( to ) {
			$('.call-to-action .author a').attr('href',to);
		} );
	} );
    
     //Teammember title
    wp.customize( 'eightlaw_lite_teammember_title', function( value ) {
		value.bind( function( to ) {
			$('.our-team-member .home-title').text(to);
		} );
	} );

    wp.customize( 'eightlaw_lite_teammember_desc', function( value ) {
		value.bind( function( to ) {
			$('.our-team-member .team-content').text(to);
		} );
	} );

	wp.customize( 'eightlaw_lite_teammember_single_readmore', function( value ) {
		value.bind( function( to ) {
			$('.our-team-member .team-hover-btn a').text(to);
		} );
	} );

	

	//benefit title
    wp.customize( 'eightlaw_lite_benefit_title', function( value ) {
		value.bind( function( to ) {
			$('h2.benefit-title').text(to);
		} );
	} );

	wp.customize( 'eightlaw_lite_benefit_single_readmore', function( value ) {
		value.bind( function( to ) {
			$('div.tab-btn a').text(to);
		} );
	} );

	//Law post
    wp.customize( 'eightlaw_lite_law_title', function( value ) {
		value.bind( function( to ) {
			$('.wrap-law-post-right h2').text(to);
		} );
	} );

	wp.customize( 'eightlaw_lite_law_desc', function( value ) {
		value.bind( function( to ) {
			$('.wrap-law-post-right p').text(to);
		} );
	} );

	wp.customize( 'eightlaw_lite_law_button_text', function( value ) {
		value.bind( function( to ) {
			$('.wrap-law-post-right a.view-more').text(to);
		} );
	} );   

	//practice title
    wp.customize( 'eightlaw_lite_practice_title', function( value ) {
		value.bind( function( to ) {
			$('h2.practice-title').text(to);
		} );
	} );

	wp.customize( 'eightlaw_lite_practice_desc', function( value ) {
		value.bind( function( to ) {
			$('.practice-desc p, .practice-desc-full p').text(to);
		} );
	} );

	wp.customize( 'eightlaw_lite_practice_button_text', function( value ) {
		value.bind( function( to ) {
			$('a.practice-btn').text(to);
		} );
	} );

	//case
    wp.customize( 'eightlaw_lite_case_title', function( value ) {
		value.bind( function( to ) {
			$('h2.case-title').text(to);
		} );
	} );

	wp.customize( 'eightlaw_lite_case_desc', function( value ) {
		value.bind( function( to ) {
			$('.case p').text(to);
		} );
	} );
    wp.customize( 'eightlaw_lite_case_single_readmore', function( value ) {
		value.bind( function( to ) {
			$('.case-btn a').text(to);
		} );
	} );


//gallery
    wp.customize( 'eightlaw_lite_gallery_title', function( value ) {
		value.bind( function( to ) {
			$('h2.gallery-title').text(to);
		} );
	} );
            
    //Contact form title
    wp.customize( 'eightlaw_lite_contact_form_title', function( value ) {
		value.bind( function( to ) {
			$('.contact-form-section h2').text(to);
		} );
	} );
    
    
    //Blog Section Title
    wp.customize( 'eightlaw_lite_blog_title', function( value ) {
		value.bind( function( to ) {
			$('.blog-section .blog-title').text(to);
		} );
	} );
    
    //Testimonial Section Category View more button
    wp.customize( 'eightlaw_lite_testimonial_title', function( value ) {
		value.bind( function( to ) {
			$('.testimonial .testimonial-title').text(to);
		} );
	} );
    
    //Latest Post Section View more button
    wp.customize( 'eightlaw_lite_latestpost_title', function( value ) {
		value.bind( function( to ) {
			$('.latest-post .latest-post-title').text(to);
		} );
	} );
    wp.customize( 'eightlaw_lite_latestpost_readmore', function( value ) {
		value.bind( function( to ) {
			$('.latest-post .bttn').text(to);
		} );
	} );

	wp.customize( 'eightlaw_lite_latestnews_title', function( value ) {
		value.bind( function( to ) {
			$('.latestnews .latestnews-title').text(to);
		} );
	} );
    wp.customize( 'eightlaw_lite_latestnews_readmore', function( value ) {
		value.bind( function( to ) {
			$('.latestnews-slider .btn a').text(to);
		} );
	} );

    
    //Slider button
    wp.customize( 'eightlaw_lite_slider_button_text', function( value ) {
		value.bind( function( to ) {
			$('.slider-btn').text(to);
		} );
	} );
    
   
    
} )( jQuery );