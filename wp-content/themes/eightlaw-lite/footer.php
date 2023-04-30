	<?php
	/**
	 * The template for displaying the footer.
	 *
	 * Contains the closing of the #content div and all content after
	 *
	 * @package 8Law Lite
	 */
	?>

</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">
  <?php
  if ( is_active_sidebar( 'footer-1' ) ||  is_active_sidebar( 'footer-2' )  || is_active_sidebar( 'footer-3' )  || is_active_sidebar( 'footer-4' )) : ?>
  <div class="top-footer footer-column-<?php echo esc_attr(eightlaw_lite_footer_count()); ?>">
    <div class="ed-container">
       <div class="footer-block-1 footer-block">
          <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
             <?php dynamic_sidebar( 'footer-1' ); ?>
         <?php endif; ?>	
     </div>

     <div class="footer-block-2 footer-block">
      <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
         <?php dynamic_sidebar( 'footer-2' ); ?>
     <?php endif; ?>	
 </div>

 <div class="footer-block-3 footer-block">
  <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
     <?php dynamic_sidebar( 'footer-3' ); ?>
 <?php endif; ?>	
</div>

<div class="footer-block-4 footer-block">
  <?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
     <?php dynamic_sidebar( 'footer-4' ); ?>
 <?php endif; ?>
</div>
</div>
</div>
<?php endif; ?>
    <div class="site-info">
      <div id="bottom-footer">
            <div class="ed-container">
              <div class="copyright wow fadeInLeft" data-wow-delay="0.3s">
                            <span>
                            <?php
                            $copyright = get_theme_mod('eightlaw_lite_footer_copyright_text','');
                            if($copyright && $copyright!=""){
                                echo wp_kses_post($copyright)." ";
                            }?>
                            </span>
                            <?php esc_html_e( 'WordPress Theme : ', 'eightlaw-lite' );  ?><a  title="<?php echo __('Free WordPress Theme','eightlaw-lite');?>" href="<?php echo esc_url( __( 'https://demo.8degreethemes.com/eightlaw-lite/', 'eightlaw-lite' ) ); ?>"><?php esc_html_e( 'Eightlaw Lite', 'eightlaw-lite' ); ?> </a>
                            <span><?php echo __(' by 8Degree Themes','eightlaw-lite');?></span>
              </div>
                    <?php if(get_theme_mod('eightlaw_lite_social_setting_option_footer','disable')=='enable'){ ?>
                    <div class="ed_footer_social wow fadeInRight" data-wow-delay="0.3s">
                    <?php do_action('eightlaw_lite_social'); ?>
                    </div>
                    <?php } ?>
            </div>                        
        </div>
    </div><!-- .site-info -->

</footer><!-- #colophon -->
</div> <!-- #inner wrap -->
</div> <!-- #outer-wrap -->
</div><!-- #page -->
<div id="ed-top"><i class="fa fa-arrow-up"></i></div>
<?php wp_footer(); ?>
</body>
</html>