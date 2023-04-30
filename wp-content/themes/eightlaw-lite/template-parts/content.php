<?php
/**
 * Template part for displaying posts.
 *
 * @package 8Law Lite
 */
?>
<?php 
$cat_team = get_theme_mod('eightlaw_lite_teammember_setting_category','');
$cat_testimonial = get_theme_mod('eightlaw_lite_testimonial_setting_category','');
$cat_blog = get_theme_mod('eightlaw_lite_blog_setting_category');
$layout_blog = get_theme_mod('eightlaw_lite_archive_setting_blog_layout','large');
$layout_team_member = get_theme_mod('eightlaw_lite_archive_setting_teammember_layout','grid');
$layout_testimonial = get_theme_mod('eightlaw_lite_archive_setting_testimonial_layout','grid');
$layout_archive = get_theme_mod('eightlaw_lite_archive_setting_archive_layout','large');
$read_more_archive      =   get_theme_mod('eightlaw_lite_archive_setting_archive_readmore',__('Read More','eightlaw-lite'));
$read_more_testimonial	= 	get_theme_mod('eightlaw_lite_archive_setting_testimonial_readmore',__('Read More','eightlaw-lite'));

?>


<?php if(!empty($cat_team) && is_category() && is_category($cat_team)): ?>
<article id="post-<?php the_ID(); ?>" class="cat-team">

	<div class="entry-content">
        		<div class="cat-team-image">
        		<?php        
				if( has_post_thumbnail() ){
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'eightlaw-lite-feature-image', false ); 
				?>
				<img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title_attribute(); ?>">
				<?php } else{ ?>
                            <img src="<?php echo esc_url(get_template_directory_uri().'/images/team-fallback-367-413.jpg'); ?>" alt="<?php the_title_attribute(); ?>" />                            
                        <?php } ?>
				</div>				
				<div class="cat-team-excerpt <?php if(! has_post_thumbnail() ) { echo "full-width"; }?>">
					<header class="entry-header">
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					</header><!-- .entry-header -->  
				    <p><?php echo esc_attr(eightlaw_lite_excerpt( get_the_excerpt() , 350 )) ?></p>
				</div>
				                  
            
	</div><!-- .entry-content -->
    
            
</article>

<?php 
elseif(!empty($cat_testimonial) && is_category() && is_category($cat_testimonial)): ?>
<article id="post-<?php the_ID(); ?>" class="cat-testimonial">  

	<div class="entry-content">
		
		        <div class="cat-testimonial-image">   
		         <?php
		            if( has_post_thumbnail() ){
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'eightlaw-lite-feature-image', false ); 
				?>
				
				<img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title_attribute(); ?>">				
				<?php } else{?>				
                            <img src="<?php echo esc_url(get_template_directory_uri().'/images/testimonial-fallback.jpg'); ?>" alt="<?php the_title_attribute(); ?>" />

				<?php }?>
				</div>
				<div class="cat-testimonial-excerpt <?php if(! has_post_thumbnail() ) { echo "full-width"; }?>">
					<header class="entry-header">
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					</header><!-- .entry-header -->
				    <?php the_content(); ?>
				</div>			                
        
          
	</div><!-- .entry-content -->
</article>
<?php
elseif( ( !empty($cat_blog) && is_category() && is_category($cat_blog)) || is_home() ): 

	?>
<article id="post-<?php the_ID(); ?>" class="cat-blog">
	<div class="entry-content">
		<?php if($layout_blog=='large'): 			
				if( has_post_thumbnail() ){ ?>
	        		<div class="cat-blog-image">
	        			<?php
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'eightlaw-lite-blog-wide', true ); 
					?>
						<img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title_attribute(); ?>">	
					</div>
				<?php } ?>
				<div class="cat-blog-content-wrap clearfix">
	                <span class="blog-date"><a href="<?php echo esc_url( home_url( '/'.get_the_date('Y/m/d') ) );?>">
	                    <span><?php echo get_the_date('d'); ?></span>
	                    <?php echo get_the_date('M'); ?>
	                </a></span>
	                <div class="cat-blog-desc">
						<header class="entry-header">
							<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>						
	                        <div class="date-author-wrap">
	                            <div class="blog-author">
	                                <a href="<?php echo  get_author_posts_url( get_the_author_meta( 'ID' ) );  ?>"><i class="fa fa-pencil"></i><?php the_author(); ?></a>
	                            </div>
	                            <div class="blog-comment">
	                                <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
	                                    <span class="comments-link"><?php comments_popup_link( __( 'No comment', 'eightlaw-lite' ), __( '1 Comment', 'eightlaw-lite' ), __( '% Comments', 'eightlaw-lite' ) ); ?></span>
	                                <?php endif; ?>
	                            </div>
	                        </div>
						</header><!-- .entry-header -->  
	                    <div class="cat-blog-excerpt <?php if(! has_post_thumbnail() ) { echo "full-width"; }?>">
	                        <p><?php echo esc_attr(eightlaw_lite_excerpt( get_the_excerpt() , 250)) ?></p>
	                    </div>
	                </div>
	            </div>  
        <?php elseif($layout_blog=='medium'):
        		if( has_post_thumbnail() ) { ?>
	        		<div class="cat-blog-image">
		        		<?php
							$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'eightlaw-lite-blog-medium', false ); 
						?>
						<img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title_attribute(); ?>">
					</div>
				<?php } ?>
				<div class="cat-blog-content-wrap clearfix <?php if( !has_post_thumbnail() ) { echo "full-width"; }?>">
	                <span class="blog-date"><a href="<?php echo esc_url( home_url( '/'.get_the_date('Y/m/d') ) );?>">
	                    <span><?php echo get_the_date('d'); ?></span>
	                    <?php echo get_the_date('M'); ?>
	                </a></span>
	                <div class="cat-blog-desc">
						<header class="entry-header">
							<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>						
	                        <div class="date-author-wrap">
	                            <div class="blog-author">
	                                <a href="<?php echo  get_author_posts_url( get_the_author_meta( 'ID' ) );  ?>"><i class="fa fa-pencil"></i><?php the_author(); ?></a>
	                            </div>
	                            <div class="blog-comment">
	                                <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
	                                    <span class="comments-link"><?php comments_popup_link( __( 'No comment', 'eightlaw-lite' ), __( '1 Comment', 'eightlaw-lite' ), __( '% Comments', 'eightlaw-lite' ) ); ?></span>
	                                <?php endif; ?>
	                            </div>
	                        </div>
						</header><!-- .entry-header -->  
	                    <div class="cat-blog-excerpt <?php if(! has_post_thumbnail() ) { echo "full-width"; }?>">
	                        <p><?php echo esc_attr(eightlaw_lite_excerpt( get_the_excerpt() , 250)) ?></p>
	                    </div>
	                </div>
	            </div>  
				
                 
        
        <?php 
        else:        
				if( has_post_thumbnail() ):
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'eightlaw-lite-blog-medium', false ); ?>		
					<div class="cat-blog-image">
						<img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title_attribute(); ?>">
					</div>
				<?php endif; ?>		
				
				<div class="cat-blog-content-wrap clearfix <?php if(! has_post_thumbnail() ) { echo "full-width"; }?>">
	                <span class="blog-date"><a href="<?php echo esc_url( home_url( '/'.get_the_date('Y/m/d') ) );?>">
	                    <span><?php echo get_the_date('d'); ?></span>
	                    <?php echo get_the_date('M'); ?>
	                </a></span>
	                <div class="cat-blog-desc">
						<header class="entry-header">
							<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>						
	                        <div class="date-author-wrap">
	                            <div class="blog-author">
	                                <a href="<?php echo  get_author_posts_url( get_the_author_meta( 'ID' ) );  ?>"><i class="fa fa-pencil"></i><?php the_author(); ?></a>
	                            </div>
	                            <div class="blog-comment">
	                                <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
	                                    <span class="comments-link"><?php comments_popup_link( __( 'No comment', 'eightlaw-lite' ), __( '1 Comment', 'eightlaw-lite' ), __( '% Comments', 'eightlaw-lite' ) ); ?></span>
	                                <?php endif; ?>
	                            </div>
	                        </div>
						</header><!-- .entry-header -->  
	                    <div class="cat-blog-excerpt <?php if(! has_post_thumbnail() ) { echo "full-width"; }?>">
	                        <p><?php echo esc_attr(eightlaw_lite_excerpt( get_the_excerpt() , 250)) ?></p>
	                    </div>
	                </div>
	            </div>  
				
		
        <?php endif;?>        
	</div><!-- .entry-content -->
    
            
</article>

<?php else: ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<p><?php the_excerpt(); ?></p>
        <a href="<?php the_permalink(); ?>" class="bttn"><?php echo esc_html($read_more_archive); ?></a>
	</div><!-- .entry-summary -->

	<?php else : ?>
	<div class="entry-content">
		<?php 
		if( has_post_thumbnail() ){
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'eightlaw-lite-blog-medium', false ); 
			?>
			<div class="cat-archive-image">
			<img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title_attribute(); ?>">
			</div>
			<?php } ?>
			<div class="cat-archive-excerpt <?php if(! has_post_thumbnail() ) { echo "full-width"; }?>">
				<header class="entry-header">
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<?php
					if ( 'post' === get_post_type() ) : ?>
						<div class="entry-meta">
							<?php eightlaw_lite_posted_on(); ?>
						</div><!-- .entry-meta -->
					<?php
					endif;?>
				</header><!-- .entry-header -->
			 	<p><?php echo eightlaw_lite_excerpt( get_the_excerpt() , 250 ) ?></p>
			 	<a href="<?php the_permalink(); ?>" class="cat-archive-more bttn"><?php echo esc_html($read_more_archive);?></a>
			 </div>			
			
	</div><!-- .entry-content -->
	<?php endif; ?>
</article><!-- #post-## -->
<?php endif; ?>