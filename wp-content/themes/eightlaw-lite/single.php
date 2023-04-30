<?php
/**
 * The template for displaying all single posts.
 *
 * @package 8Law Lite
 */

get_header();
 ?>		
<?php the_post(); ?>

<header class="page-header">	
		<div class="header-banner">			
		<img src="<?php echo esc_url(get_theme_mod('eightlaw_lite_single_setting_post_banner_image_option'))?>"  /></div>
		<div class="ed-container">
			<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>		
			<div class="page-meta">
				<?php eightlaw_lite_posted_on(); ?>
			</div><!-- .page-meta -->	
		</div>
</header><!-- .page-header -->
<div class="ed-container">
    <?php global $post;
    $sidebar = get_post_meta($post->ID, 'eightlaw_lite_sidebar_layout', true);
    if(empty($sidebar)){
    	$sidebar='right-sidebar';
    }
    if($sidebar=='both-sidebar'){
        ?>
    <div class="left-sidbar-right">
        <?php
    }
     ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">


			<?php get_template_part( 'template-parts/content', 'single' ); ?>

			<?php eightlaw_lite_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		
		</main><!-- #main -->
	</div><!-- #primary -->
<?php 
if($sidebar=='left-sidebar' || $sidebar=='both-sidebar'){
	get_sidebar('left');
}
if($sidebar=='both-sidebar'){
    ?>
        </div>
    <?php
}
if($sidebar=='right-sidebar' || $sidebar=='both-sidebar'){
 get_sidebar('right');
}
?>
</div>
<?php get_footer(); ?>
