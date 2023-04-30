<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Software Company Elementor
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta http-equiv="Content-Type" content="<?php echo esc_attr(get_bloginfo('html_type')); ?>; charset=<?php echo esc_attr(get_bloginfo('charset')); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.2, user-scalable=yes" />

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php
	if ( function_exists( 'wp_body_open' ) )
	{
		wp_body_open();
	}else{
		do_action('wp_body_open');
	}
?>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'software-company-elementor' ); ?></a>

<header id="site-navigation" class="header text-center text-md-left">
	<div class="upperheader py-2">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-md-5 col-sm-5 align-self-center">
					<?php if ( get_theme_mod('software_company_elementor_header_announcement') ) : ?>
						<p class="mb-0"><?php echo esc_html( get_theme_mod('software_company_elementor_header_announcement' ) ); ?></p>
					<?php endif; ?>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 align-self-center">
					<?php if ( get_theme_mod('software_company_elementor_enable_opening_hours') ) : ?>
						<p class="mb-0"><i class="fas fa-clock mr-2"></i><?php echo esc_html( get_theme_mod('software_company_elementor_enable_opening_hours' ) ); ?></p>
					<?php endif; ?>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 align-self-center">
					<?php $software_company_elementor_settings = get_theme_mod( 'software_company_elementor_social_links_settings' ); ?>
					<div class="social-links text-center text-md-right">
						<?php if ( is_array($software_company_elementor_settings) || is_object($software_company_elementor_settings) ){ ?>
							<span class="mr-3"><?php esc_html_e( 'FOLLOW US ', 'software-company-elementor' ); ?></span>
					    	<?php foreach( $software_company_elementor_settings as $software_company_elementor_setting ) { ?>					    		
						        <a href="<?php echo esc_url( $software_company_elementor_setting['link_url'] ); ?>">
						            <i class="<?php echo esc_attr( $software_company_elementor_setting['link_text'] ); ?> mr-2"></i>
						        </a>
					    	<?php } ?>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="topheader py-3  <?php if( get_theme_mod( 'software_company_elementor_sticky_header',false) != '') { ?>sticky-header<?php } else { ?>close-sticky <?php } ?> ">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-3 align-self-center">
					<div class="logo text-center text-md-left mb-3 mb-md-0">
			    		<div class="logo-image">
			    			<?php the_custom_logo(); ?>
				    	</div>
				    	<div class="logo-content">
					    	<?php
					    		echo '<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name')) . '">';
						      		echo esc_attr(get_bloginfo('name'));
						      	echo '</a>';
						      	echo '<span class="mb-0">'. esc_attr(get_bloginfo('description')) . '</span>';
				    		?>
						</div>
					</div>
			   	</div>
				<div class="col-lg-9 col-md-9 col-sm-9 align-self-center">
					<?php if(has_nav_menu('main-menu')){ ?>
						<button class="menu-toggle my-2 py-2 px-3" aria-controls="top-menu" aria-expanded="false" type="button">
							<span aria-hidden="true"><?php esc_html_e( 'Menu', 'software-company-elementor' ); ?></span>
						</button>
						<nav id="main-menu" class="close-panal">
							<?php
								wp_nav_menu( array(
									'theme_location' => 'main-menu',
									'container' => 'false'
								));
							?>
							<button class="close-menu my-2 p-2" type="button">
								<span aria-hidden="true"><i class="fa fa-times"></i></span>
							</button>
						</nav>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
</header>