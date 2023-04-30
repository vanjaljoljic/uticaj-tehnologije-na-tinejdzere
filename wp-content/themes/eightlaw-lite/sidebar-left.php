<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package 8Law Lite
 */


	if( !is_active_sidebar( 'left-sidebar' ) ) {
		return;
	} ?>
    <div id="secondary-left" class="widget-area left-sidebar sidebar">
        <?php if ( is_active_sidebar( 'left-sidebar' ) ) : ?>
			<?php dynamic_sidebar( 'left-sidebar' ); ?>
		<?php endif; ?>
    </div>
    <?php    

?>
