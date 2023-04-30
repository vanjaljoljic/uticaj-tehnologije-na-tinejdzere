<?php

add_action( 'admin_menu', 'cyber_security_services_gettingstarted' );
function cyber_security_services_gettingstarted() {
	add_theme_page( esc_html__('Theme Documentation', 'cyber-security-services'), esc_html__('Theme Documentation', 'cyber-security-services'), 'edit_theme_options', 'cyber-security-services-guide-page', 'cyber_security_services_guide');
}

function cyber_security_services_admin_theme_style() {
   wp_enqueue_style('cyber-security-services-custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/dashboard/dashboard.css');
}
add_action('admin_enqueue_scripts', 'cyber_security_services_admin_theme_style');

if ( ! defined( 'CYBER_SECURITY_SERVICES_SUPPORT' ) ) {
define('CYBER_SECURITY_SERVICES_SUPPORT',__('https://wordpress.org/support/theme/cyber-security-services/','cyber-security-services'));
}
if ( ! defined( 'CYBER_SECURITY_SERVICES_REVIEW' ) ) {
define('CYBER_SECURITY_SERVICES_REVIEW',__('https://wordpress.org/support/theme/cyber-security-services/reviews/','cyber-security-services'));
}
if ( ! defined( 'CYBER_SECURITY_SERVICES_LIVE_DEMO' ) ) {
define('CYBER_SECURITY_SERVICES_LIVE_DEMO',__('https://www.ovationthemes.com/demos/cyber-security-services/','cyber-security-services'));
}
if ( ! defined( 'CYBER_SECURITY_SERVICES_BUY_PRO' ) ) {
define('CYBER_SECURITY_SERVICES_BUY_PRO',__('https://www.ovationthemes.com/wordpress/wordpress-cyber-security-theme/','cyber-security-services'));
}
if ( ! defined( 'CYBER_SECURITY_SERVICES_PRO_DOC' ) ) {
define('CYBER_SECURITY_SERVICES_PRO_DOC',__('https://www.ovationthemes.com/docs/ot-cyber-security-services-pro-doc','cyber-security-services'));
}
if ( ! defined( 'CYBER_SECURITY_SERVICES_THEME_NAME' ) ) {
define('CYBER_SECURITY_SERVICES_THEME_NAME',__('Premium Cyber Security Theme','cyber-security-services'));
}

/**
 * Theme Info Page
 */
function cyber_security_services_guide() {

	// Theme info
	$return = add_query_arg( array()) ;
	$theme = wp_get_theme( '' ); ?>

	<div class="getting-started__header">
		<div class="col-md-10">
			<h2><?php echo esc_html( $theme ); ?></h2>
			<p><?php esc_html_e('Version: ', 'cyber-security-services'); ?><?php echo esc_html($theme['Version']);?></p>
		</div>
		<div class="col-md-2">
			<div class="btn_box">
				<a class="button-primary" href="<?php echo esc_url( CYBER_SECURITY_SERVICES_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support', 'cyber-security-services'); ?></a>
				<a class="button-primary" href="<?php echo esc_url( CYBER_SECURITY_SERVICES_REVIEW ); ?>" target="_blank"><?php esc_html_e('Review', 'cyber-security-services'); ?></a>
			</div>
		</div>
	</div>

	<div class="wrap getting-started">
		<div class="container">
			<div class="col-md-9">
				<div class="leftbox">
					<h3><?php esc_html_e('Documentation','cyber-security-services'); ?></h3>
					<p><?php esc_html_e('To step the cyber security service theme follow the below steps.','cyber-security-services'); ?></p>

					<h4><?php esc_html_e('1. Setup Logo','cyber-security-services'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Site Identity >> Upload your logo or Add site title and site description.','cyber-security-services'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','cyber-security-services'); ?></a>

					<h4><?php esc_html_e('2. Setup Contact Info','cyber-security-services'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Social Media >> Add your social icons here.','cyber-security-services'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=cyber_security_services_urls') ); ?>" target="_blank"><?php esc_html_e('Add Social Icons','cyber-security-services'); ?></a>

					<h4><?php esc_html_e('3. Setup Menus','cyber-security-services'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Menus >> Create Menus >> Add pages, post or custom link then save it.','cyber-security-services'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Add Menus','cyber-security-services'); ?></a>

					<h4><?php esc_html_e('4. Setup Social Icons','cyber-security-services'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Social Media >> Add social links.','cyber-security-services'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=cyber_security_services_urls') ); ?>" target="_blank"><?php esc_html_e('Add Social Icons','cyber-security-services'); ?></a>

					<h4><?php esc_html_e('5. Setup Footer','cyber-security-services'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Widgets >> Add widgets in footer 1, footer 2, footer 3, footer 4. >> ','cyber-security-services'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widgets','cyber-security-services'); ?></a>

					<h4><?php esc_html_e('5. Setup Footer Text','cyber-security-services'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Footer Text >> Add copyright text. >> ','cyber-security-services'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=cyber_security_services_footer_copyright') ); ?>" target="_blank"><?php esc_html_e('Footer Text','cyber-security-services'); ?></a>

					<h3><?php esc_html_e('Setup Home Page','cyber-security-services'); ?></h3>
					<p><?php esc_html_e('To step the home page follow the below steps.','cyber-security-services'); ?></p>

					<h4><?php esc_html_e('1. Setup Page','cyber-security-services'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Pages >> Add New Page >> Select "Custom Home Page" from templates. >> Publish it.','cyber-security-services'); ?></p>
					<a class="dashboard_add_new_page button-primary"><?php esc_html_e('Add New Page','cyber-security-services'); ?></a>

					<h4><?php esc_html_e('2. Setup Slider','cyber-security-services'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Post >> Add New Post >> Add title, content and featured image >> Publish it.','cyber-security-services'); ?></p>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Slider Settings >> Select post.','cyber-security-services'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=cyber_security_services_slider_section') ); ?>" target="_blank"><?php esc_html_e('Add Slider','cyber-security-services'); ?></a>

					<h4><?php esc_html_e('3. Setup About Us','cyber-security-services'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Page >> Add New Page >> Add title, content and featured image >> Publish it.','cyber-security-services'); ?></p>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> About Us Section Settings >> Select page','cyber-security-services'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=cyber_security_services_services_section') ); ?>" target="_blank"><?php esc_html_e('Add About Us','cyber-security-services'); ?></a>
				</div>
      </div>
			<div class="col-md-3">
				<h3><?php echo esc_html(CYBER_SECURITY_SERVICES_THEME_NAME); ?></h3>
				<img class="cyber_security_services_img_responsive" style="width: 100%;" src="<?php echo esc_url( $theme->get_screenshot() ); ?>" />
				<div class="pro-links">
					<hr>
			    	<a class="button-primary livedemo" href="<?php echo esc_url( CYBER_SECURITY_SERVICES_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'cyber-security-services'); ?></a>
					<a class="button-primary buynow" href="<?php echo esc_url( CYBER_SECURITY_SERVICES_BUY_PRO ); ?>" target="_blank"><?php esc_html_e('Buy Now', 'cyber-security-services'); ?></a>
					<a class="button-primary docs" href="<?php echo esc_url( CYBER_SECURITY_SERVICES_PRO_DOC ); ?>" target="_blank"><?php esc_html_e('Documentation', 'cyber-security-services'); ?></a>
					<hr>
				</div>
				<ul style="padding-top:10px">
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Responsive Design', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Boxed or fullwidth layout', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Shortcode Support', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Demo Importer', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Section Reordering', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Contact Page Template', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Multiple Blog Layouts', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Unlimited Color Options', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Designed with HTML5 and CSS3', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Customizable Design & Code', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Cross Browser Support', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Detailed Documentation Included', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Stylish Custom Widgets', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Patterns Background', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('WPML Compatible (Translation Ready)', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Woo-commerce Compatible', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Full Support', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('10+ Sections', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Live Customizer', 'cyber-security-services');?> </li>
                   	<li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('AMP Ready', 'cyber-security-services');?> </li>
                   	<li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Clean Code', 'cyber-security-services');?> </li>
                   	<li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('SEO Friendly', 'cyber-security-services');?> </li>
                   	<li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Supper Fast', 'cyber-security-services');?> </li>
                </ul>
        	</div>
		</div>
	</div>

<?php }?>
