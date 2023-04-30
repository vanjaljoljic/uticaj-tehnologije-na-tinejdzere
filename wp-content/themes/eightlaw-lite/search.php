<?php
/**
 * The template for displaying search results pages.
 *
 * @package 8Law Lite
 */

get_header(); 
?>

<?php if(!have_posts()):?>
	<header class="page-header">
		<div class="header-banner"><img src="<?php echo esc_url(get_theme_mod('eightlaw_lite_single_setting_page_banner_image_option'))?>"  /></div>
		
				<div class="ed-container">
					<h1 class="page-title"><?php _e( 'Nothing Found', 'eightlaw-lite' ); ?></h1>
				</div>
	</header><!-- .page-header -->
<?php else: ?>
<header class="page-header">
				<div class="header-banner"><img src="<?php echo esc_url(get_theme_mod('eightlaw_lite_single_setting_page_banner_image_option'))?>"  /></div>
		
				<div class="ed-container">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'eightlaw-lite' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</div>
			</header><!-- .page-header -->
<?php endif; ?>
<div class="ed-container">
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
	
		<?php if ( have_posts() ) : ?>

			

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );
				?>

			<?php endwhile; ?>

			<?php eightlaw_lite_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->
	
<?php get_sidebar('right'); ?>

</div>
<?php get_footer(); ?>