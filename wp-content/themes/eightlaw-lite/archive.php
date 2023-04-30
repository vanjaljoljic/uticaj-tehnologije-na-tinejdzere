<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package 8Law Lite
 */

get_header(); 
$sidebar = get_theme_mod('eightlaw_lite_archive_setting_sidebar_option','right-sidebar');
if(empty($sidebar)){
    	$sidebar='right-sidebar';
    }
?>
<header class="page-header">
				<div class="header-banner"><img src="<?php echo esc_url(get_theme_mod('eightlaw_lite_single_setting_category_banner_image_option',''))?>"  /></div>
				<div class="ed-container">
					<h1 class="page-title">						
					<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( 'Author: %s', 'eightlaw-lite' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) : 
							printf( __( 'Day: %s', 'eightlaw-lite' ), '<span>' . esc_html( get_the_date() ) . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'eightlaw-lite' ), '<span>' . esc_html( get_the_date( _x( 'F Y', 'monthly archives date format', 'eightlaw-lite' ) ) ). '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'eightlaw-lite' ), '<span>' . esc_html( get_the_date( _x( 'Y', 'yearly archives date format', 'eightlaw-lite' ) ) ). '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'eightlaw-lite' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', 'eightlaw-lite' );

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'eightlaw-lite' );

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'eightlaw-lite' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'eightlaw-lite' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'eightlaw-lite' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', 'eightlaw-lite' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', 'eightlaw-lite' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', 'eightlaw-lite' );

						else :
							_e( 'Archives', 'eightlaw-lite' );

						endif;
					?>
					</h1>
				</div>			
			</header><!-- .page-header -->
<div class="ed-container">
	<?php
	if($sidebar=='both-sidebar'){
		?>
		<div class="left-sidbar-right">
		<?php
	}
	?>
	<section id="primary" class="content-area">
		<main id="main" clas="site-main" role="main">

		<?php if ( have_posts() ) : ?>			
            <?php 
                        $layout_testimonial = get_theme_mod('eightlaw_lite_archive_setting_testimonial_layout','grid');
                        $layout_team_member = get_theme_mod('eightlaw_lite_archive_setting_teammember_layout','grid');
                        $cat_team = get_theme_mod('eightlaw_lite_teammember_setting_category','');
                        $cat_testimonial = get_theme_mod('eightlaw_lite_testimonial_setting_category','');
                        $layout_blog = get_theme_mod('eightlaw_lite_archive_setting_blog_layout','large');
                        $cat_blog = get_theme_mod('eightlaw_lite_blog_setting_category','');
                        $layout_archive = get_theme_mod('eightlaw_lite_archive_setting_archive_layout','list');
                        if(is_category($cat_team)){
                            $cat =  esc_attr('team-member-'.$layout_team_member); 
                        }
                        elseif(is_category($cat_testimonial)){
                            $cat =  esc_attr('testimonial-'.$layout_testimonial);
                        }
                        elseif(is_category($cat_blog)){
                            $cat =  esc_attr('archive-blog blog-'.$layout_blog);
                        }                       
                        else{
                        	$cat = esc_attr('archive-'.$layout_archive);
                        }

                    ?>
        <div class="archive-wrap <?php echo $cat; ?>">            

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
                     
                    
				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */			
					 		
					get_template_part( 'template-parts/content', get_post_format() );



				?>	

			<?php endwhile; ?>

			<?php eightlaw_lite_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>
    </div>
		</main><!-- #main -->
	</section><!-- #primary -->
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