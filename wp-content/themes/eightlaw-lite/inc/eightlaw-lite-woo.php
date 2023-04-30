<?php
add_theme_support('woocommerce');
/** Eightlaw Woo Tweaks **/
/////////////////////// for all woo commerce pages///////////////////////////
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20);
remove_action('woocommerce_sidebar','woocommerce_get_sidebar');
add_action('eightlaw_lite_sidebar','woocommerce_get_sidebar',10);	
add_action('eightlaw_lite_breadcrumb','woocommerce_breadcrumb',10);
add_action('woocommerce_before_main_content', 'eightlaw_lite_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'eightlaw_lite_wrapper_end', 10);

//////////////// for all woocomerce pages ends////////////////

// page header of  archive woocommerce page
add_action('woocommerce_before_shop_loop', 'eightlaw_lite_primary', 0);
// page header for single product
add_action('woocommerce_before_single_product', 'eightlaw_lite_primary', 0);

add_filter( 'loop_shop_per_page', 'eightlaw_lite_loop_shop_per_page', 20 );

function eightlaw_lite_loop_shop_per_page($cols){
	$cols = 12;
	return $cols;
}


function eightlaw_lite_wrapper_start(){
	$sidebar = get_theme_mod('eightlaw_lite_innerpage_setting_archive_layout','right-sidebar');
	if( ( $sidebar == 'no-sidebar' ) && ( $sidebar == 'both-sidebar' ) ){
		$sidebar = '';
	}

	echo '<header class="page-header">';
	echo '<div class="header-banner"><img src="'.esc_url(get_theme_mod('eightlaw_lite_single_setting_page_banner_image_option','')).'"  /></div>';
	echo '<div class="ed-container"><div class="archive-page-title">';
}

	// to add primary div after breadcrumb
function eightlaw_lite_primary(){		
	echo '</div>';
	do_action('eightlaw_lite_breadcrumb');
	echo "</div></header>";
	echo '<div class="ed-container"><div id="primary" class="content-area">';
}

function eightlaw_lite_wrapper_end(){
	echo '</div>';
	do_action('eightlaw_lite_sidebar');

}

if ( class_exists('YITH_WCWL') ) {
	if (function_exists('YITH_WCWL')) {

		add_action('woocommerce_before_shop_loop_item_title', 'eightlaw_lite_show_add_to_wishlist', 10 );
		function eightlaw_lite_show_add_to_wishlist(){
			if(class_exists( 'YITH_WCQV_Frontend' )){
				echo "<div class='whislist-quickview'>";
			}
			echo do_shortcode('[yith_wcwl_add_to_wishlist]');
		}

		add_action('woocommerce_single_product_summary', 'eightlaw_lite_add_to_wishlist_single_product', 35 );
		function eightlaw_lite_add_to_wishlist_single_product(){
			echo do_shortcode('[yith_wcwl_add_to_wishlist]');	
		}

	}
}

if( class_exists( 'YITH_WCQV_Frontend' ) ){

	$quick_view = YITH_WCQV_Frontend();
	remove_action('woocommerce_after_shop_loop_item', array( $quick_view, 'yith_add_quick_view_button' ), 15 );
	add_action( 'woocommerce_before_shop_loop_item_title', array( $quick_view, 'yith_add_quick_view_button' ), 10 );

	add_action( 'woocommerce_before_shop_loop_item_title',  'eightlaw_lite_div_after_yith_add_quick_view_button' , 10 );
	function eightlaw_lite_div_after_yith_add_quick_view_button(){
		if(function_exists('YITH_WCWL') ){
			echo "</div>";
		}
	}

}

add_filter('loop_shop_columns', 'eightlaw_lite_loop_columns');
if (!function_exists('eightlaw_lite_loop_columns')) {
	function eightlaw_lite_loop_columns() {
		$xr = 4;
		return intval($xr); 
	}
}