<?php
/**
 * @package 8Law Lite
 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php
		$show_img = get_theme_mod('eightlaw_lite_feat_img_option','enable');
		if($show_img == 'enable'){

			if( has_post_thumbnail() ){
				the_post_thumbnail();
			}
		}

		the_content(); 

		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'eightlaw-lite' ),
			'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php eightlaw_lite_entry_footer(); ?>
		</footer><!-- .entry-footer -->
</article><!-- #post-## -->