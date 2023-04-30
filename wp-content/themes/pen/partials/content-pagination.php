<?php
/**
 * Template part for displaying the pagination links.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pen
 */

$content_id = pen_post_id();

ob_start();
if ( function_exists( 'wp_pagenavi' ) ) {
	wp_pagenavi();
} else {
	the_posts_navigation();
}
$pager = ob_get_clean();
if ( $pager ) {
	$pager = trim( $pager );
}
if ( $pager ) {
	$classes = array(
		'clearfix',
		pen_class_animation( 'list_pager', false, $content_id ),
	);
	$classes = implode( ' ', array_filter( $classes ) );
	?>
	<div id="pen_pager" class="<?php echo esc_attr( $classes ); ?>">
	<?php
	echo $pager; /* phpcs:ignore */
	?>
	</div>
	<?php
}
