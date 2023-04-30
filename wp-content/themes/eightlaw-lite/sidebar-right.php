<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package 8Law Lite
 */

	if( !is_active_sidebar( 'right-sidebar' ) ) {
		return;
	}
?>
    <div id="secondary-right" class="widget-area right-sidebar sidebar">
        <?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
			<?php dynamic_sidebar( 'right-sidebar' ); ?>
		<?php endif; ?>
    </div>
    <?php    
   
?>