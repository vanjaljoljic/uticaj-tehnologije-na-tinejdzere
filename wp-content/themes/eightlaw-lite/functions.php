<?php
/**
 * 8Law Lite functions and definitions
 *
 * @package 8Law Lite
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'eightlaw_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function eightlaw_lite_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on 8Law Lite, use a find and replace
	 * to change 'eightlaw-lite' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'eightlaw-lite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
    
    add_image_size('eightlaw-lite-blog-wide', 1200, 600, true); 
    add_image_size('eightlaw-lite-blog-medium', 400, 300, true); 
	add_image_size('eightlaw-lite-feature-image', 600, 600, true);
	add_image_size('eightlaw-lite-rectangle',700,300,true);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'eightlaw-lite' ),
	) );
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside'
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'eightlaw_lite_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );	
	add_theme_support( 'custom-logo' , array(
	 	'header-text' => array( 'site-title', 'site-description' ),
	 	));
	
	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );

}
endif; // eightlaw_lite_setup
add_action( 'after_setup_theme', 'eightlaw_lite_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function eightlaw_lite_widgets_init() {
	register_sidebar( 
		array(
			'name'          => esc_html__( 'Sidebar', 'eightlaw-lite' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'eightlaw-lite' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widget-title"><span>',
			'after_title'   => '</span></h1>',
			) 
		);
	register_sidebar( array(
		'name'          => __( 'Right Sidebar', 'eightlaw-lite' ),
		'id'            => 'right-sidebar',
		'description'   => esc_html__( 'Add widgets here to show in Right Sidebar.', 'eightlaw-lite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title"><span>',
		'after_title'   => '</span></h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Left Sidebar', 'eightlaw-lite' ),
		'id'            => 'left-sidebar',
		'description'   => esc_html__( 'Add widgets here to show in Right Sidebar.', 'eightlaw-lite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title"><span>',
		'after_title'   => '</span></h1>',
	) );    
    register_sidebar( array(
		'name'          => __( 'Footer 1', 'eightlaw-lite' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here to show in Footer 1.', 'eightlaw-lite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title"><span>',
		'after_title'   => '</span></h1>',
	) );
    register_sidebar( array(
		'name'          => __( 'Footer 2', 'eightlaw-lite' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here to show in Footer 2.', 'eightlaw-lite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title"><span>',
		'after_title'   => '</span></h1>',
	) );
    register_sidebar( array(
		'name'          => __( 'Footer 3', 'eightlaw-lite' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here to show in Footer 3.', 'eightlaw-lite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title"><span>',
		'after_title'   => '</span></h1>',
	) );
    register_sidebar( array(
		'name'          => __( 'Footer 4', 'eightlaw-lite' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widgets here to show in Footer 4.', 'eightlaw-lite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title"><span>',
		'after_title'   => '</span></h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Widget Icon', 'eightlaw-lite' ),
		'id'            => 'widget_icon',
		'description'   => esc_html__( 'Add widgets here to show in Widget Icon Area.', 'eightlaw-lite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title"><span>',
		'after_title'   => '</span></h1>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Language Switchter', 'eightlaw-lite' ),
		'id'            => 'eightlaw-lite-language-switcher',
		'description'   => esc_html__( 'Add Polylang or WPML Language Switchter Widget.', 'eightlaw-lite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title"><span>',
		'after_title'   => '</span></h1>',
	) );
	    
}
add_action( 'widgets_init', 'eightlaw_lite_widgets_init' );
if(is_admin()):
add_action( 'admin_enqueue_scripts', 'eightlaw_lite_custom_load' );
function eightlaw_lite_custom_load($hook) {    
	if ( 'customize.php' == $hook || 'widgets.php' == $hook ) {
		wp_enqueue_style( 'wp-color-picker' );        
		wp_enqueue_script( 'wp-color-picker' );    
	    wp_enqueue_style( 'font-awesome-admin', get_template_directory_uri() . '/css/font-awesome.min.css');
	}
}
endif;
/**
 * Enqueue scripts and styles.
 */
function eightlaw_lite_scripts() {
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css'); 
	wp_enqueue_style( 'jquery-fancybox', get_template_directory_uri() . '/css/jquery.fancybox.css');
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
    wp_enqueue_style( 'eightlaw-lite-fonts', '//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Playfair+Display:400i|Lora:400,400i,700,700i');
	wp_enqueue_style( 'eightlaw-lite-style', get_stylesheet_uri() );
	wp_enqueue_style( 'eightlaw-lite-responsive', get_template_directory_uri() . '/css/responsive.css');
	wp_enqueue_style( 'eightlaw-lite-keybaord-style', get_template_directory_uri().'/css/keyboard.css', array(), '1.0.0' );	 
	if( is_rtl() ){
		wp_enqueue_style( 'eightlaw-lite-rtl', get_template_directory_uri() . '/rtl.css'); 
	}
    wp_enqueue_script( 'bx-slider', get_template_directory_uri() . '/js/jquery.bxslider.js', array('jquery'), '4.1.2', true );
	wp_enqueue_script( 'eightlaw-lite-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );   
    wp_enqueue_script( 'jquery-fancybox', get_template_directory_uri() . '/js/jquery.fancybox.js', array(), '3.2.10', true);
    wp_enqueue_style( 'wp-color-picker' );        
	wp_enqueue_script( 'wp-color-picker' );    
	wp_enqueue_script( 'eightlaw-lite-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '1.0', true );
    wp_enqueue_script( 'eightlaw-lite-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'eightlaw_lite_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Options Custom function.
 */
require get_template_directory() . '/inc/eightlaw-lite-function.php';

/**
 * Load Options Custom metabox.
 */
require get_template_directory() . '/inc/eightlaw-lite-metabox.php';
/**
 * Load Options Required Plugins.
 */
require get_template_directory() . '/inc/contact-form-dropdown.php';
require get_template_directory() . '/inc/eightlaw-lite-woo.php';


require get_template_directory() . '/inc/eightlaw-lite-controls.php';

require get_template_directory() . '/welcome/welcome-config.php';