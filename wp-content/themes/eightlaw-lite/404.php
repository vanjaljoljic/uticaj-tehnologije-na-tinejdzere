<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package 8Law Lite
 */

get_header(); ?>
<header class="page-header">
    <div class="header-banner"><img src="<?php echo esc_url(get_theme_mod('eightlaw_lite_single_setting_page_banner_image_option'))?>"  /></div>        
    <div class="ed-container">
          <h1 class="page-title ed-container"><?php _e( 'Oops! That page can&rsquo;t be found.', 'eightlaw-lite' ); ?></h1>
    </div>
</header><!-- .page-header -->
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<section class="error-404 not-found">
        	<div class="ed-container">
    			<div class="page-content">
    				<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'eightlaw-lite' ); ?></p>
    			</div><!-- .page-content -->
                    
                <div class="number404">
                    <?php esc_html_e('404', 'eightlaw-lite');?> 
                <span><?php esc_html_e('error', 'eightlaw-lite');?></span>   
                </div>
            </div>
        </section><!-- .error-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>