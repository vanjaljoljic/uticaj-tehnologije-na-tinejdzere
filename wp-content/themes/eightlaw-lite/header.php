<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package 8Law Lite
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>    
    <?php
    if ( function_exists( 'wp_body_open' ) ) {
       wp_body_open();
    } ?>
    <div id="eightlaw-lite-preloader">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="object" id="object_one"></div>
                <div class="object" id="object_two"></div>
                <div class="object" id="object_three"></div>
                <div class="object" id="object_four"></div>
            </div>
        </div>     
    </div>
<div id="page" class="hfeed site">
    <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'eightlaw-lite' ); ?></a>
    <div id="outer-wrap">
        <div id="inner-wrap">
            <?php 
            
                $ed_logo_alignment = '';
                $ed_nav_alignment = '';
                $no_slider = '';               
                $ed_social_header = get_theme_mod('eightlaw_lite_social_setting_option_header','disable');                
                $ed_nav = get_theme_mod('eightlaw_lite_logo_alignment','left');
                if( $ed_nav=='left' ){
                    $ed_logo_alignment = 'logo-left';
                    $ed_nav_alignment = 'menu-left';
                }
                elseif( $ed_nav=='right' ){
                    $ed_logo_alignment = 'logo-right';
                    $ed_nav_alignment = 'menu-right';
                }
                else{
                    $ed_logo_alignment = 'logo-center';
                    $ed_nav_alignment = 'menu-center';
                }
               if(get_theme_mod('eightlaw_lite_slider_setting_option','disable')=='disable'){ $no_slider="no_slider"; }
               
            ?>
            
            <header id="masthead" class="site-header <?php echo esc_attr($no_slider)." ".esc_attr($ed_logo_alignment);?>" role="banner">
                
                 <?php if( ( $ed_social_header=='enable' ) || ( is_active_sidebar( 'eightlaw-lite-language-switcher' ) ) ){ 
                ?><div class="header-social">
                    <div class="ed-container">
                        <?php 
                        if( is_active_sidebar( 'eightlaw-lite-language-switcher' ) ):?>
                            <div class="ed-lang-switcher">                             
                                <?php dynamic_sidebar( 'eightlaw-lite-language-switcher' );?>
                            </div>
                            <?php
                        endif;
                        if( $ed_social_header=='enable' ):
                        ?>
                            <div class="ed_header_social">
                                <?php do_action('eightlaw_lite_social'); ?>
                            </div> 
                        <?php endif;?>
                    </div>
                   </div>
                <?php
                }
                ?>
                
                
                <div class="ed-container">
               
                    <div class="site-branding">
                        <?php if ( function_exists( 'the_custom_logo' ) ): ?>
                            <div class="site-logo">
                                <?php if ( has_custom_logo() ) : ?>
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                        <?php the_custom_logo(); ?>
                                    </a>
                                <?php endif; // End logo check. ?>
                            </div>
                        <?php endif; // end custom logo?>
                            <div class="site-text">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                    <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
                                    <p class="site-description"><?php bloginfo( 'description' ); ?></p>
                                </a>
                            </div>
                        </div><!-- .site-branding -->
                    <div class="menu-wrap <?php echo esc_attr($ed_nav_alignment); ?>">
                              
                    <nav id="site-navigation" class="main-navigation" role="navigation">
                        <button class="menu-toggle"><?php _e( 'Primary Menu', 'eightlaw-lite' ); ?></button>
                        <div class="clearfix"> </div>
                            <div class="menu-close-btn">
                                <i class="fa fa-close"></i>
                            </div>
                            <?php 
                                if(has_nav_menu('primary')){
                                    wp_nav_menu( array( 'theme_location' => 'primary' ) );
                                }
                                else{ ?>                                    
                                    <ul id="menu-main-menu" class="menu"><li><a><?php esc_html_e('Select Primary Menu','eightlaw-lite');?></a></li></ul>
                                    <?php
                                }?>  
                    </nav><!-- #site-navigation -->
                    <?php if(get_theme_mod('eightlaw_lite_search_options',0)==1){ ?>                       
                    <?php get_search_form() ?>
                    <?php }?>   
                </div>  
                </div>
 
            </header><!-- #masthead -->

           <div id="content" class="site-content">
            
            <?php 
            if(is_home() || is_front_page()) :
                $ed_slider = get_theme_mod('eightlaw_lite_slider_setting_option','disable');
                if($ed_slider=='enable'):?>
                <section class="slider-wrapper">
                  <?php do_action('eightlaw_lite_bxslider');?>
                </section>
                  <?php
                endif;
            endif;
            ?>