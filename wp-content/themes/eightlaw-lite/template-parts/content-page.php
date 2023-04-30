<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package 8Law Lite
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
	
		<?php
            if( has_post_thumbnail() ) { ?>
				<div class="single-image">
					<?php the_post_thumbnail(); ?>
				</div>
				<?php
        	}
        ?> 
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'eightlaw-lite' ),
			'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php edit_post_link( __( 'Edit', 'eightlaw-lite' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-footer -->
</article><!-- #post-## -->