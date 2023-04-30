<?php
/**
 * Elemento IT Solutions functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Elemento IT Solutions
 */

/* Enqueue script and styles */

function elemento_it_solutions_enqueue_google_fonts() {

	require_once get_theme_file_path( 'includes/wptt-webfont-loader.php' );

	wp_enqueue_style(
		'opensans',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap' ),
		array(),
		'1.0'
	);
}
add_action( 'wp_enqueue_scripts', 'elemento_it_solutions_enqueue_google_fonts' );

if (!function_exists('elemento_it_solutions_enqueue_scripts')) {

	function elemento_it_solutions_enqueue_scripts() {

		wp_enqueue_style(
			'bootstrap-css',
			get_template_directory_uri() . '/assets/css/bootstrap.css',
			array(),'4.5.0'
		);

		wp_enqueue_style(
			'fontawesome-css',
			get_template_directory_uri() . '/assets/css/fontawesome-all.css',
			array(),'4.5.0'
		);

		wp_enqueue_style('elemento-it-solutions-style', get_stylesheet_uri(), array() );

		wp_enqueue_style(
			'elemento-it-solutions-responsive-css',
			get_template_directory_uri() . '/assets/css/responsive.css',
			array(),'2.3.4'
		);

		wp_enqueue_script(
			'elemento-it-solutions-navigation',
			get_template_directory_uri() . '/assets/js/navigation.js',
			FALSE,
			'1.0',
			TRUE
		);

		wp_enqueue_script(
			'elemento-it-solutions-script',
			get_template_directory_uri() . '/assets/js/script.js',
			array('jquery'),
			'1.0',
			TRUE
		);

		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

		$css = '';

		if ( get_header_image() ) :

			$css .=  '
				.header-image-box{
					background-image: url('.esc_url(get_header_image()).') !important;
					-webkit-background-size: cover !important;
					-moz-background-size: cover !important;
					-o-background-size: cover !important;
					background-size: cover !important;
					height: 550px;
				    display: flex;
				    align-items: center;
				}';

		endif;

		wp_add_inline_style( 'elemento-it-solutions-style', $css );

	}

	add_action( 'wp_enqueue_scripts', 'elemento_it_solutions_enqueue_scripts' );

}

/* Setup theme */

if (!function_exists('elemento_it_solutions_after_setup_theme')) {

	function elemento_it_solutions_after_setup_theme() {

		if ( ! isset( $elemento_it_solutions_content_width ) ) $elemento_it_solutions_content_width = 900;

		register_nav_menus( array(
			'main-menu' => esc_html__( 'Main menu', 'elemento-it-solutions' ),
		));

		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'align-wide' );
		add_theme_support('title-tag');
		add_theme_support('automatic-feed-links');
		add_theme_support( 'wp-block-styles' );
		add_theme_support('post-thumbnails');
		add_theme_support( 'custom-background', array(
		  'default-color' => 'f3f3f3'
		));

		add_theme_support( 'custom-logo', array(
			'height'      => 70,
			'width'       => 70,
		) );

		add_theme_support( 'custom-header', array(
			'default-image'      => get_parent_theme_file_uri( '/assets/images/default-image.png' ),
			'width' => 1920,
			'flex-width' => true,
			'height' => 550,
			'flex-height' => true,
			'header-text' => false,
		));

		register_default_headers( array(
			'default-image' => array(
				'url'           => '%s/assets/images/default-image.png',
				'thumbnail_url' => '%s/assets/images/default-image.png',
				'description'   => __( 'Default Header Image', 'elemento-it-solutions' ),
			),
		) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_editor_style( array( '/assets/css/editor-style.css' ) );

		global $pagenow;

		if (is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] )) {
			add_action('admin_notices', 'elemento_it_solutions_activation_notice');
		}
	}

	add_action( 'after_setup_theme', 'elemento_it_solutions_after_setup_theme', 999 );

}

function elemento_it_solutions_activation_notice() {
	echo '<div class="notice notice-success is-dismissible dashboard-notice">';
	echo '<h1>'. esc_html__( 'Welcome To Elemento IT Solutions Theme', 'elemento-it-solutions' ) .'</h1>';
	echo '<p>'. esc_html__( 'Much thanks to you for picking Elemento IT Solutions. For the home page setup click on the below button.', 'elemento-it-solutions' ) .'</p>';
	echo '<p><a href="'. esc_url( admin_url( 'themes.php?page=elemento_it_solutions_about' ) ) .'" class="button button-primary">'. esc_html__( 'More Info', 'elemento-it-solutions' ) .'</a></p>';
	echo '</div>';
}

require get_template_directory() .'/includes/tgm/tgm.php';
require get_template_directory() . '/includes/customizer.php';
load_template( trailingslashit( get_template_directory() ) . '/includes/go-pro/class-upgrade-pro.php' );

/* Get post comments */

if (!function_exists('elemento_it_solutions_comment')) :
    /**
     * Template for comments and pingbacks.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     */
    function elemento_it_solutions_comment($comment, $args, $depth){

        if ('pingback' == $comment->comment_type || 'trackback' == $comment->comment_type) : ?>

            <li id="comment-<?php comment_ID(); ?>" <?php comment_class('media'); ?>>
            <div class="comment-body">
                <?php esc_html_e('Pingback:', 'elemento-it-solutions');
                comment_author_link(); ?><?php edit_comment_link(__('Edit', 'elemento-it-solutions'), '<span class="edit-link">', '</span>'); ?>
            </div>

        <?php else : ?>

        <li id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?>>
            <article id="div-comment-<?php comment_ID(); ?>" class="comment-body media mb-4">
                <a class="pull-left" href="#">
                    <?php if (0 != $args['avatar_size']) echo get_avatar($comment, $args['avatar_size']); ?>
                </a>
                <div class="media-body">
                    <div class="media-body-wrap card">
                        <div class="card-header">
                            <h5 class="mt-0"><?php /* translators: %s: author */ printf('<cite class="fn">%s</cite>', get_comment_author_link() ); ?></h5>
                            <div class="comment-meta">
                                <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                                    <time datetime="<?php comment_time('c'); ?>">
                                        <?php /* translators: %s: Date */ printf( esc_html__('%1$s at %2$s', 'elemento-it-solutions'), esc_html( get_comment_date() ), esc_html( get_comment_time() ) ); ?>
                                    </time>
                                </a>
                                <?php edit_comment_link( __( 'Edit', 'elemento-it-solutions' ), '<span class="edit-link">', '</span>' ); ?>
                            </div>
                        </div>

                        <?php if ('0' == $comment->comment_approved) : ?>
                            <p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'elemento-it-solutions'); ?></p>
                        <?php endif; ?>

                        <div class="comment-content card-block">
                            <?php comment_text(); ?>
                        </div>

                        <?php comment_reply_link(
                            array_merge(
                                $args, array(
                                    'add_below' => 'div-comment',
                                    'depth' => $depth,
                                    'max_depth' => $args['max_depth'],
                                    'before' => '<footer class="reply comment-reply card-footer">',
                                    'after' => '</footer><!-- .reply -->'
                                )
                            )
                        ); ?>
                    </div>
                </div>
            </article>

            <?php
        endif;
    }
endif; // ends check for elemento_it_solutions_comment()

if (!function_exists('elemento_it_solutions_widgets_init')) {

	function elemento_it_solutions_widgets_init() {

		register_sidebar(array(

			'name' => esc_html__('Sidebar','elemento-it-solutions'),
			'id'   => 'elemento-it-solutions-sidebar',
			'description'   => esc_html__('This sidebar will be shown next to the content.', 'elemento-it-solutions'),
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'

		));

		register_sidebar(array(

			'name' => esc_html__('Footer sidebar','elemento-it-solutions'),
			'id'   => 'elemento-it-solutions-footer-sidebar',
			'description'   => esc_html__('This sidebar will be shown next at the bottom of your content.', 'elemento-it-solutions'),
			'before_widget' => '<div id="%1$s" class="col-lg-3 col-md-3 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'

		));

	}

	add_action( 'widgets_init', 'elemento_it_solutions_widgets_init' );

}

function elemento_it_solutions_the_breadcrumb() {
	if (!is_home()) {
		echo '<a href="';
		echo esc_url( home_url() );
		echo '">';
		bloginfo('name');
		echo "</a> >> ";
		if (is_category() || is_single()) {
			the_category(' , ');
			if (is_single()) {
				echo " >> ";
				the_title();
			}
		} elseif (is_page()) {
			echo the_title();
		}
	}
}

function elemento_it_solutions_customize_css() {
	?>
	<style>
		#main-menu a,#main-menu ul li a,#main-menu li a{
			text-transform: <?php echo esc_attr( get_theme_mod('elemento_it_solutions_menu_text_transform') ); ?>;
		}
		#main-menu a,#main-menu ul li a,#main-menu li a{
				font-size: <?php echo esc_attr( get_theme_mod('elemento_it_solutions_menu_size') ); ?>;
		}
		#main-menu a,#main-menu ul li a,#main-menu li a{
				color: <?php echo esc_attr( get_theme_mod('elemento_it_solutions_menu_color') ); ?>;
		}
		#main-menu a:hover, #main-menu ul li a:hover, #main-menu li:hover > a,#main-menu a:focus,#main-menu li.focus > a,#main-menu ul li.current-menu-item > a,#main-menu ul li.current_page_item > a,#main-menu ul li.current-menu-parent > a,#main-menu ul li.current_page_ancestor > a,#main-menu ul li.current-menu-ancestor > a{
				color: <?php echo esc_attr( get_theme_mod('elemento_it_solutions_menu_hover_color','#007fff') ); ?>;
		}
        #main-menu ul.children li a:hover, #main-menu ul.sub-menu li a:hover{
			background: <?php echo esc_attr( get_theme_mod('elemento_it_solutions_submenu_hover_background_color','#007fff') ); ?>;
		}
		#main-menu ul.children li a,#main-menu ul.sub-menu li a{
				color: <?php echo esc_attr( get_theme_mod('elemento_it_solutions_submenu_color','#222222') ); ?>;
		}
		#main-menu ul.children li a:hover,#main-menu ul.sub-menu li a:hover{
				color: <?php echo esc_attr( get_theme_mod('elemento_it_solutions_submenu_hover_color','#fff') ); ?>;
		}
		.post-img img {
			border-radius: <?php echo esc_attr( get_theme_mod('elemento_it_solutions_single_post_border_radius') ); ?>;
		}
	</style>
	<?php
}

add_action( 'wp_head', 'elemento_it_solutions_customize_css');

/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'elemento_it_solutions_loop_columns', 999);
if (!function_exists('elemento_it_solutions_loop_columns')) {
	function elemento_it_solutions_loop_columns() {
		return 3; // 3 products per row
	}
}

function elemento_it_solutions_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+]/', '', $phone );
}

define('ELEMENTO_IT_SOLUTIONS_FREE_THEME_DOC',__('https://www.wpelemento.com/theme-documentation/elemento-it-solutions/','elemento-it-solutions'));
define('ELEMENTO_IT_SOLUTIONS_SUPPORT',__('https://wordpress.org/support/theme/elemento-it-solutions/','elemento-it-solutions'));
define('ELEMENTO_IT_SOLUTIONS_REVIEW',__('https://wordpress.org/support/theme/elemento-it-solutions/reviews/','elemento-it-solutions'));
define('ELEMENTO_IT_SOLUTIONS_BUY_NOW',__('https://www.wpelemento.com/elementor/it-solutions-wordpress-theme/','elemento-it-solutions'));
define('ELEMENTO_IT_SOLUTIONS_LIVE_DEMO',__('https://www.wpelemento.com/demo/elemento-it-solutions/','elemento-it-solutions'));
define('ELEMENTO_IT_SOLUTIONS_PRO_DOC',__('https://www.wpelemento.com/theme-documentation/elemento-it-solution/','elemento-it-solutions'));

/* Implement the About theme page */
require get_template_directory() . '/includes/getstart/getstart.php';

if ( ! defined( 'ELEMENTO_IT_SOLUTIONS_CHANGELOG_THEME_URL' ) ) {
    define( 'ELEMENTO_IT_SOLUTIONS_CHANGELOG_THEME_URL', get_template_directory() . '/changelog.txt' );
}

?>