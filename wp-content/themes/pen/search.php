<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Pen
 */

$content_id = pen_post_id();

get_header(); ?>
<div id="primary" class="content-area">
	<main id="main" class="<?php echo esc_attr( pen_content_classes( $content_id ) ); ?>" role="main">
		<div class="pen_article_wrapper">
<?php
if ( have_posts() ) {
	$classes_header = array(
		'page-header',
		'pen_content_header',
		pen_class_animation( 'list_page_header', false, $content_id ),
		pen_class_lists( 'list_page_header', $content_id ),
	);
	$classes_header = implode( ' ', array_filter( $classes_header ) );
	?>
			<header class="<?php echo esc_attr( $classes_header ); ?>">
				<h1 class="page-title pen_content_title">
					<span class="pen_heading_main">
	<?php
	esc_html_e( 'Search results for:', 'pen' );
	?>
					</span>
					<span>
	<?php
	echo get_search_query();
	?>
					</span>
				</h1>
			</header><!-- .pen_content_header -->
			<div id="<?php echo esc_attr( pen_html_id_layout( $content_id ) ); ?>" class="pen_articles">
	<?php
	/* Start the Loop */
	while ( have_posts() ) {
		the_post();
		/**
		 * Run the loop for the search to output the results.
		 * If you want to overload this in a child theme then include a file
		 * called content-search.php and that will be used instead.
		 */
		get_template_part( 'partials/content', 'search' );
	}
	?>
			</div>
	<?php
	get_template_part( 'partials/content', 'pagination' );
} else {
	get_template_part( 'partials/content', 'none' );
}
?>
		</div>
	</main>
<?php
pen_html_jump_menu( 'list', $content_id );
?>
</div><!-- #primary -->
<?php
get_footer();
