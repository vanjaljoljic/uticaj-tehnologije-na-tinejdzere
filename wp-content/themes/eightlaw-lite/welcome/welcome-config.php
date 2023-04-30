<?php
/**
 * Welcome Page Initiation
*/

include get_template_directory() . '/welcome/welcome.php';

/** Plugins **/
$plugins = array(
	// *** Companion Plugins
	'companion_plugins' => array(
		'8degreethemes-demo-importer' => array(
			'slug' 				=> '8degreethemes-demo-importer',
			'name' 				=> esc_html__('Instant Demo Importer', 'eightlaw-lite'),
			'filename' 			=>'8degreethemes-demo-importer.php',
 			// Use either bundled, remote, wordpress
			'host_type' 		=> 'remote',
			'location' 		=> egtdi_get_plugin_remote_url('https://demo.8degreethemes.com/wp-content/theme-demos/','8degreethemes-demo-importer.zip'),
			'class' 			=> 'EGTDI_Demo_Importer',
			'info' => __('8Degree Demo Importer Plugin adds the feature to Import the Demo Conent with a single click.', 'eightlaw-lite'),
		)
	),
	// *** Required Plugins
	'required_plugins' 			=> array(),

	// *** Recommended Plugins
	'recommended_plugins' => array(
			// Free Plugins
		'free_plugins' => array(
			'contact-form-7' => array(
				'slug' => 'contact-form-7',
				'filename' => 'wp-contact-form-7.php',
				'class' => 'WPCF7'
			),
		),
		// Pro Plugins
		'pro_plugins' => array()
	),
);

$strings = array(
		// Welcome Page General Texts
	'welcome_menu_text' => esc_html__( 'Eightlaw Lite Setup', 'eightlaw-lite' ),
	'theme_short_description' => esc_html__( 'EightLaw Lite is free responsive lawyer WordPress theme. It is a clean, minimalist, modern theme ideal for lawyers, law firms and agencies, private attorneys, business consultation, blogging or personal websites. Built on WordPress Live Customizer using cutting-edge technology, it offers you a professional design and powerful support. It is free, yet feature-rich law firm WordPress template. It features full-screen beautiful sliders, multiple sidebar options, team section layouts: grid or list, multiple blog layouts, testimonial section layouts: grid or list, media gallery in carousel slider, contact forms, CTA, social media icons etc. On top of everything, EightLaw Lite is simple and super user-friendly. Demo: https://8degreethemes.com/demo/eightlaw-lite Support forum: support@8degreethemes.com', 'eightlaw-lite' ),

	// Plugin Action Texts
	'install_n_activate' => esc_html__('Install and Activate', 'eightlaw-lite'),
	'deactivate' => esc_html__('Deactivate', 'eightlaw-lite'),
	'activate' => esc_html__('Activate', 'eightlaw-lite'),

	// Recommended Plugins Section
	'pro_plugin_title' => esc_html__( 'Pro Plugins', 'eightlaw-lite' ),
	'pro_plugin_description' => esc_html__( 'Take Advantage of some of our Premium Plugins.', 'eightlaw-lite' ),
	'free_plugin_title' => esc_html__( 'Free Plugins', 'eightlaw-lite' ),
	'free_plugin_description' => esc_html__( 'These Free Plugins might be handy for you.', 'eightlaw-lite' ),

	// Demo Actions
	'installed_btn' => esc_html__('Activated', 'eightlaw-lite'),
	'deactivated_btn' => esc_html__('Activated', 'eightlaw-lite'),
	'demo_installing' => esc_html__('Installing Demo', 'eightlaw-lite'),
	'demo_installed' => esc_html__('Demo Installed', 'eightlaw-lite'),
	'demo_confirm' => esc_html__('Are you sure to import demo content ?', 'eightlaw-lite'),

	// Actions Required
	'req_plugins_installed' => esc_html__( 'All Recommended action has been successfully completed.', 'eightlaw-lite' ),
	'customize_theme_btn' => esc_html__( 'Customize Theme', 'eightlaw-lite' ),
);

function egtdi_get_plugin_remote_url( $base,$filename ) {

	return trailingslashit($base) . $filename;
}
/**
 * Initiating Welcome Page
*/
$my_theme_wc_page = new Eightlaw_Lite_Welcome( $plugins, $strings );