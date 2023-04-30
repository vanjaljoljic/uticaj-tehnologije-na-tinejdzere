<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package 8Law Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php eightlaw_lite_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
        <a href="<?php the_permalink(); ?>" class="bttn"><?php echo __('Read More', 'eightlaw-lite'); ?></a>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php eightlaw_lite_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->