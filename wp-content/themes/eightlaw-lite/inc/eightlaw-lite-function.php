<?php
/**
 * Custome Function for theme template
 * 
 * @package 8Law Lite
 */

//adding custom scripts and styles in header for favicon and other
function eightlaw_lite_header_scripts(){
	$header_bg_v = get_header_image();
	echo "<style type='text/css' media='all'>";
	if(($header_bg_v)){
		$header_bg_v =   '.site-header { background: url("'.esc_url($header_bg_v).'") no-repeat scroll left top rgba(0, 0, 0, 0); position: relative; z-index: 1;background-size: cover; }';
		echo $header_bg_v;
		echo "\n";
		echo '.site-header:before {
			content: "";
			position: absolute;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			background: rgba(255,255,255,0.7);
			z-index: -1;
		}';
	}
	echo "</style>\n";
}
add_action('wp_head','eightlaw_lite_header_scripts');

    function eightlaw_lite_web_layout($classes){
	    if(get_theme_mod('eightlaw_lite_webpage_layout','fullwidth') == 'boxed'){
	        $classes[]= 'boxed-layout';
	    }
        elseif(get_theme_mod('eightlaw_lite_webpage_layout','fullwidth') == 'fullwidth'){
            $classes[]='fullwidth';
        }
	    return $classes;
   }
   add_filter( 'body_class', 'eightlaw_lite_web_layout' );
   
   function eightlaw_lite_sidebar_layout($classes){
    global $post;
        $post_class = '';
        if( is_singular() ){
		    $post_class = get_post_meta( $post -> ID, 'eightlaw_lite_sidebar_layout', true );
		    if(empty($post_class)){
			        $post_class = 'right-sidebar';
		    }
		}
		elseif(is_archive() ){
		    $post_class = get_theme_mod('eightlaw_lite_archive_setting_sidebar_option','right-sidebar');
		    if(empty($post_class)){
		        $post_class = 'right-sidebar';
		    }	    
		}
		else{
			$post_class = 'right-sidebar';
		}
		if( ($post_class == 'right-sidebar') && is_active_sidebar( 'right-sidebar' ) ){
			$post_class = 'right-sidebar';
		}
		elseif( ($post_class == 'left-sidebar') && is_active_sidebar( 'left-sidebar' ) ){
			$post_class = 'left-sidebar';
		}
		elseif( ( $post_class == 'both-sidebar' ) ){
			if( is_active_sidebar( 'right-sidebar' ) && !is_active_sidebar( 'left-sidebar' ) ){
				$post_class = 'right-sidebar';
			}
			elseif( !is_active_sidebar( 'right-sidebar' ) && is_active_sidebar( 'left-sidebar' ) ){
				$post_class = 'left-sidebar';
			}
			else {
				$post_class = 'both-sidebar';
			}
		}
		else{
			$post_class = 'no-sidebar';
		}
		if( !is_404() ){
			$classes[] = esc_attr( $post_class );		
		}
        return $classes;
   }
   add_filter('body_class', 'eightlaw_lite_sidebar_layout');

   
    function eightlaw_lite_bxslidercb(){
        $eightlaw_lite_slider_category = get_theme_mod('eightlaw_lite_slider_setting_category','');
		$eightlaw_lite_show_pager = (get_theme_mod('eightlaw_lite_slider_show_pager','no') == "yes") ? "true" : "false";
		$eightlaw_lite_show_controls = (get_theme_mod('eightlaw_lite_slider_show_controls','no') == "yes") ? "true" : "false";
		$eightlaw_lite_auto_transition = (get_theme_mod('eightlaw_lite_slider_show_transitions','no') == "yes") ? "true" : "false";
		$eightlaw_lite_slider_transition = get_theme_mod('eightlaw_lite_slider_transitions_type','horizontal');
		$eightlaw_lite_slider_speed = get_theme_mod('eightlaw_lite_slider_speed','1000');
		$eightlaw_lite_slider_pause = get_theme_mod('eightlaw_lite_slider_pause','4000');
		$eightlaw_lite_show_caption = get_theme_mod('eightlaw_lite_slider_show_caption','no');       
		
        ?>
        <section id="main-slider" class="slider">
	       	<script type="text/javascript">
	            jQuery(function($){
					$('#main-slider .bx-slider').bxSlider({
						pager: <?php echo esc_attr($eightlaw_lite_show_pager); ?>,
						controls: <?php echo esc_attr($eightlaw_lite_show_controls); ?>,
						mode: '<?php echo esc_attr($eightlaw_lite_slider_transition); ?>',
						pause: <?php echo esc_attr($eightlaw_lite_slider_pause); ?>,
						speed: <?php echo esc_attr($eightlaw_lite_slider_speed); ?>,
						auto : <?php echo esc_attr($eightlaw_lite_auto_transition); ?>
					});
				});
	        </script>
	        <?php
			if( !empty($eightlaw_lite_slider_category)) :

				$loop = new WP_Query(array(
						'category_name' => $eightlaw_lite_slider_category,
						'posts_per_page' => -1    
					));
	                ?>
	            <div class="bx-slider">
	                <?php
					if($loop->have_posts()) : 
						while($loop->have_posts()) : $loop-> the_post();
		                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full', false );
		                    
		                     ?>
		                    <div class="slides">
								<img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_url(get_the_title()); ?>" />
			                    <?php 
			                    if($eightlaw_lite_show_caption == 'yes'){ ?>
			        				<div class="caption-wrapper">  
				        				<div class="ed-container">
				        					<div class="slider-caption">
				        						<div class="mid-content">
				        							<div class="small-caption"> <?php the_title(); ?> </div>
				                                    <div class="slider-content">
				        	                            <?php echo eightlaw_lite_excerpt(get_the_content(),200); 
				        	                            ?>
				                                	</div>
				        							<a href="<?php the_permalink(); ?>" class="slider-btn"> <?php echo esc_html(get_theme_mod('eightlaw_lite_slider_button_text',__('Details','eightlaw-lite'))); ?> </a>
				        						</div>
				        					</div>
				        				</div>
			        				</div>
			                    <?php  
			                    } ?>
							</div>
						<?php 
						endwhile;
						wp_reset_postdata();
					endif; ?>	
	            </div>
			<?php  endif; ?>
		</section>
<?php

}
add_action('eightlaw_lite_bxslider','eightlaw_lite_bxslidercb', 10);

function eightlaw_lite_social_cb(){	
	$facebooklink = esc_url( get_theme_mod('eightlaw_lite_social_facebook','#') );
	$twitterlink = esc_url( get_theme_mod('eightlaw_lite_social_twitter','#'));
	$google_pluslink = esc_url( get_theme_mod('eightlaw_lite_social_googleplus','#') );
	$youtubelink = esc_url( get_theme_mod('eightlaw_lite_social_youtube','#') );
	$pinterestlink = esc_url( get_theme_mod('eightlaw_lite_social_pinterest') );
	$linkedinlink = esc_url( get_theme_mod('eightlaw_lite_social_linkedin') );
	$vimeolink = esc_url( get_theme_mod('eightlaw_lite_social_vimeo') );
	$instagramlink = esc_url( get_theme_mod('eightlaw_lite_social_instagram') );
	$flickrlink = esc_url(get_theme_mod('eightlaw_lite_social_flicker'));
	$stumbleuponlink = esc_url(get_theme_mod('eightlaw_lite_social_stumbleupon'));
    $soundcloudlink = esc_url(get_theme_mod('eightlaw_lite_social_soundcloud'));
    $githublink = esc_url(get_theme_mod('eightlaw_lite_social_github'));
    $tumblrlink = esc_url(get_theme_mod('eightlaw_lite_social_tumbler'));
    $rsslink = esc_url(get_theme_mod('eightlaw_lite_social_rss')); 
	$skypelink = get_theme_mod('eightlaw_lite_social_skype');

	?>
	<div class="social-icons ">
		<?php if(!empty($facebooklink)){ ?>
			<a href="<?php echo $facebooklink; ?>" class="facebook" data-title="Facebook" target="_blank"><i class="fa fa-facebook"></i><span></span></a>
			<?php } ?>

		<?php if(!empty($twitterlink)){ ?>
		<a href="<?php echo $twitterlink; ?>" class="twitter" data-title="Twitter" target="_blank"><i class="fa fa-twitter"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($google_pluslink)){ ?>
		<a href="<?php echo $google_pluslink; ?>" class="gplus" data-title="Google Plus" target="_blank"><i class="fa fa-google-plus"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($youtubelink)){ ?>
		<a href="<?php echo $youtubelink; ?>" class="youtube" data-title="Youtube" target="_blank"><i class="fa fa-youtube"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($pinterestlink)){ ?>
		<a href="<?php echo $pinterestlink; ?>" class="pinterest" data-title="Pinterest" target="_blank"><i class="fa fa-pinterest"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($linkedinlink)){ ?>
		<a href="<?php echo $linkedinlink; ?>" class="linkedin" data-title="Linkedin" target="_blank"><i class="fa fa-linkedin"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($vimeolink)){ ?>
		<a href="<?php echo $vimeolink; ?>" class="vimeo" data-title="Vimeo" target="_blank"><i class="fa fa-vimeo-square"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($instagramlink)){ ?>
		<a href="<?php echo $instagramlink; ?>" class="instagram" data-title="instagram" target="_blank"><i class="fa fa-instagram"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($flickrlink)){ ?>
		<a href="<?php echo $flickrlink; ?>" class="flickr" data-title="Flickr" target="_blank"><i class="fa fa-flickr"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($stumbleuponlink)){ ?>
		<a href="<?php echo $stumbleuponlink; ?>" class="stumbleupon" data-title="Stumbleupon" target="_blank"><i class="fa fa-stumbleupon"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($soundcloudlink)){ ?>
		<a href="<?php echo $soundcloudlink; ?>" class="delicious" data-title="Delicious" target="_blank"><i class="fa fa-delicious"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($githublink)){ ?>
		<a href="<?php echo $githublink; ?>" class="github" data-title="Github" target="_blank"><i class="fa fa-github"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($tumblrlink)){ ?>
		<a href="<?php echo $tumblrlink; ?>" class="tumblr" data-title="Tumblr" target="_blank"><i class="fa fa-tumblr"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($rsslink)){ ?>
		<a href="<?php echo $rsslink; ?>" class="rss" data-title="Rss" target="_blank"><i class="fa fa-rss"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($skypelink)){ ?>
		<a href="<?php echo esc_attr('skype:'.$skypelink); ?>" class="skype" data-title="Skype"><i class="fa fa-skype"></i><span></span></a>
		<?php } ?>
	</div>
<?php
}
add_action('eightlaw_lite_social','eightlaw_lite_social_cb', 10);

function eightlaw_lite_footer_count(){
	$count = 0;
	if(is_active_sidebar('footer-1'))
	$count++;

	if(is_active_sidebar('footer-2'))
	$count++;

	if(is_active_sidebar('footer-3'))
	$count++;

	if(is_active_sidebar('footer-4'))
	$count++;

	return $count;
}

function eightlaw_lite_excerpt( $eightlaw_lite_content , $eightlaw_lite_letter_count){
		$eightlaw_lite_letter_count = !empty($eightlaw_lite_letter_count) ? $eightlaw_lite_letter_count : 100 ;
		$eightlaw_lite_striped_content = strip_tags($eightlaw_lite_content);
		$eightlaw_lite_excerpt = mb_substr($eightlaw_lite_striped_content, 0 , $eightlaw_lite_letter_count);
		if(strlen($eightlaw_lite_striped_content) > strlen($eightlaw_lite_excerpt)){
			$eightlaw_lite_excerpt.= "...";
		}
		return $eightlaw_lite_excerpt;
	}

//Dynamic styles on header
function eightlaw_lite_cta_styles_scripts(){
	$cta_bg_v = get_theme_mod('eightlaw_lite_callto_bkgimage');
  
	echo "<style type='text/css' media='all'>";
    if(!empty($cta_bg_v)){
    $cta_bg =   '.call-to-action {background: url("'.esc_url(get_theme_mod('eightlaw_lite_callto_bkgimage')).'") no-repeat scroll center top rgba(0, 0, 0, 0);';
    echo $cta_bg;
    }
   	echo "</style>\n"; 

}

add_action('wp_head','eightlaw_lite_cta_styles_scripts');

if ( is_admin() ) : // Load only if we are viewing an admin page

function eightlaw_lite_admin_scripts() {
	wp_enqueue_style( 'eightlaw-lite-admin-style',get_template_directory_uri().'/inc/css/admin.css');
	wp_enqueue_script('eightlaw-admin-welcome', get_template_directory_uri().'/inc/js/admin.js', array('jquery'),'1.0',true);
    wp_localize_script( 'eightlaw-admin-welcome', 'eightlawWelcomeObject', array(
        'admin_nonce'   => wp_create_nonce('eightlaw_lite_plugin_installer_nonce'),
        'activate_nonce'    => wp_create_nonce('eightlaw_lite_plugin_activate_nonce'),
        'ajaxurl'       => esc_url( admin_url( 'admin-ajax.php' ) ),
        'activate_btn' => __('Activate', 'eightlaw-lite'),
        'installed_btn' => __('Activated', 'eightlaw-lite'),
        'demo_installing' => __('Installing Demo', 'eightlaw-lite'),
        'demo_installed' => __('Demo Installed', 'eightlaw-lite'),
        'demo_confirm' => __('Are you sure to import demo content ?', 'eightlaw-lite'),
        ) );
}
add_action('admin_enqueue_scripts', 'eightlaw_lite_admin_scripts');
endif;