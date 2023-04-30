<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package 8Law Lite
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div id="secondary-right" class="widget-area right-sidebar" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
