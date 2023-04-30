<?php
/**
 * Cyber Security Services: Customizer
 *
 * @subpackage Cyber Security Services
 * @since 1.0
 */

function cyber_security_services_customize_register( $wp_customize ) {

	wp_enqueue_style('customizercustom_css', esc_url( get_template_directory_uri() ). '/assets/css/customizer.css');

	// Add custom control.
  	require get_parent_theme_file_path( 'inc/customize/customize_toggle.php' );

		// Register the custom control type.
	$wp_customize->register_control_type( 'Cyber_Security_Services_Toggle_Control' );

 	$wp_customize->add_section('cyber_security_services_pro', array(
        'title'    => __('UPGRADE CYBER SECURITY PREMIUM', 'cyber-security-services'),
        'priority' => 1,
    ));
    $wp_customize->add_setting('cyber_security_services_pro', array(
        'default'           => null,
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(new Cyber_Security_Services_Pro_Control($wp_customize, 'cyber_security_services_pro', array(
        'label'    => __('Cyber Security Services PREMIUM', 'cyber-security-services'),
        'section'  => 'cyber_security_services_pro',
        'settings' => 'cyber_security_services_pro',
        'priority' => 1,
    )));

				//Logo
		$wp_customize->add_setting('cyber_security_services_logo_max_height',array(
			'default'	=> '',
			'sanitize_callback'	=> 'sanitize_text_field'
		));
		$wp_customize->add_control('cyber_security_services_logo_max_height',array(
			'label'	=> esc_html__('Logo Width','cyber-security-services'),
			'section'	=> 'title_tagline',
			'type'		=> 'number'
		));
			$wp_customize->add_setting( 'cyber_security_services_logo_title', array(
			'default'           => true,
			'transport'         => 'refresh',
			'sanitize_callback' => 'cyber_security_services_sanitize_checkbox',
		) );
		$wp_customize->add_control( new Cyber_Security_Services_Toggle_Control( $wp_customize, 'cyber_security_services_logo_title', array(
			'label'       => esc_html__( 'Show Site Title', 'cyber-security-services' ),
			'section'     => 'title_tagline',
			'type'        => 'toggle',
			'settings'    => 'cyber_security_services_logo_title',
		) ) );

			$wp_customize->add_setting( 'cyber_security_services_logo_text', array(
			'default'           => false,
			'transport'         => 'refresh',
			'sanitize_callback' => 'cyber_security_services_sanitize_checkbox',
		) );
		$wp_customize->add_control( new Cyber_Security_Services_Toggle_Control( $wp_customize, 'cyber_security_services_logo_text', array(
			'label'       => esc_html__( 'Show Site Tagline', 'cyber-security-services' ),
			'section'     => 'title_tagline',
			'type'        => 'toggle',
			'settings'    => 'cyber_security_services_logo_text',
		) ) );

		// Theme General Settings
    $wp_customize->add_section('cyber_security_services_theme_settings',array(
        'title' => __('Theme General Settings', 'cyber-security-services'),
        'priority' => 1,
    ) );

    $wp_customize->add_setting( 'cyber_security_services_theme_loader', array(
			'default'           => false,
			'transport'         => 'refresh',
			'sanitize_callback' => 'cyber_security_services_sanitize_checkbox',
		) );
		$wp_customize->add_control( new Cyber_Security_Services_Toggle_Control( $wp_customize, 'cyber_security_services_theme_loader', array(
			'label'       => esc_html__( 'Show Site Loader', 'cyber-security-services' ),
			'section'     => 'cyber_security_services_theme_settings',
			'type'        => 'toggle',
			'settings'    => 'cyber_security_services_theme_loader',
		) ) );

		$wp_customize->add_setting( 'cyber_security_services_sticky_header', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'cyber_security_services_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Toggle_Control( $wp_customize, 'cyber_security_services_sticky_header', array(
		'label'       => esc_html__( 'Show Sticky Header', 'cyber-security-services' ),
		'section'     => 'cyber_security_services_theme_settings',
		'type'        => 'toggle',
		'settings'    => 'cyber_security_services_sticky_header',
	) ) );

		$wp_customize->add_setting( 'cyber_security_services_scroll_enable', array(
			'default'           => true,
			'transport'         => 'refresh',
			'sanitize_callback' => 'cyber_security_services_sanitize_checkbox',
		) );
		$wp_customize->add_control( new Cyber_Security_Services_Toggle_Control( $wp_customize, 'cyber_security_services_scroll_enable', array(
			'label'       => esc_html__( 'Show Scroll Top', 'cyber-security-services' ),
			'section'     => 'cyber_security_services_theme_settings',
			'type'        => 'toggle',
			'settings'    => 'cyber_security_services_scroll_enable',
		) ) );

	$wp_customize->add_setting('cyber_security_services_scroll_options',array(
      'default' => 'right_align',
      'sanitize_callback' => 'cyber_security_services_sanitize_choices'
	));
	$wp_customize->add_control('cyber_security_services_scroll_options',array(
      'type' => 'select',
      'label' => __('Scroll Top Alignment','cyber-security-services'),
      'section' => 'cyber_security_services_theme_settings',
      'choices' => array(
          'right_align' => __('Right Align','cyber-security-services'),
          'center_align' => __('Center Align','cyber-security-services'),
          'left_align' => __('Left Align','cyber-security-services'),
      ),
) );

$wp_customize->add_setting( 'cyber_security_services_shop_page_sidebar', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'cyber_security_services_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Toggle_Control( $wp_customize, 'cyber_security_services_shop_page_sidebar', array(
		'label'       => esc_html__( 'Show Shop Page Sidebar', 'cyber-security-services' ),
		'section'     => 'cyber_security_services_theme_settings',
		'type'        => 'toggle',
		'settings'    => 'cyber_security_services_shop_page_sidebar',
	) ) );

	$wp_customize->add_setting( 'cyber_security_services_wocommerce_single_page_sidebar', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'cyber_security_services_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Toggle_Control( $wp_customize, 'cyber_security_services_wocommerce_single_page_sidebar', array(
		'label'       => esc_html__( 'Show Single Product Page Sidebar', 'cyber-security-services' ),
		'section'     => 'cyber_security_services_theme_settings',
		'type'        => 'toggle',
		'settings'    => 'cyber_security_services_wocommerce_single_page_sidebar',
	) ) );

    //theme width
	$wp_customize->add_section('cyber_security_services_theme_width_settings',array(
        'title' => __('Theme Width Option', 'cyber-security-services'),
    ) );

	$wp_customize->add_setting('cyber_security_services_width_options',array(
        'default' => 'full_width',
        'sanitize_callback' => 'cyber_security_services_sanitize_choices'
	));
	$wp_customize->add_control('cyber_security_services_width_options',array(
        'type' => 'select',
        'label' => __('Theme Width Option','cyber-security-services'),
        'section' => 'cyber_security_services_theme_width_settings',
        'choices' => array(
            'full_width' => __('Fullwidth','cyber-security-services'),
            'Container' => __('Container','cyber-security-services'),
            'container_fluid' => __('Container Fluid','cyber-security-services'),
        ),
	) );

	// Post Layouts
    $wp_customize->add_section('cyber_security_services_layout',array(
        'title' => __('Post Layout', 'cyber-security-services'),
        'description' => __( 'Change the post layout from below options', 'cyber-security-services' ),
        'priority' => 1
    ) );

	$wp_customize->add_setting( 'cyber_security_services_post_sidebar', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'cyber_security_services_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Toggle_Control( $wp_customize, 'cyber_security_services_post_sidebar', array(
		'label'       => esc_html__( 'Show Fullwidth', 'cyber-security-services' ),
		'section'     => 'cyber_security_services_layout',
		'type'        => 'toggle',
		'settings'    => 'cyber_security_services_post_sidebar',
	) ) );

	$wp_customize->add_setting( 'cyber_security_services_single_post_sidebar', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'cyber_security_services_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Toggle_Control( $wp_customize, 'cyber_security_services_single_post_sidebar', array(
		'label'       => esc_html__( 'Show Single Post Fullwidth', 'cyber-security-services' ),
		'section'     => 'cyber_security_services_layout',
		'type'        => 'toggle',
		'settings'    => 'cyber_security_services_single_post_sidebar',
	) ) );

    $wp_customize->add_setting('cyber_security_services_post_option',array(
		'default' => 'simple_post',
		'sanitize_callback' => 'cyber_security_services_sanitize_select'
	));
	$wp_customize->add_control('cyber_security_services_post_option',array(
		'label' => esc_html__('Select Layout','cyber-security-services'),
		'section' => 'cyber_security_services_layout',
		'setting' => 'cyber_security_services_post_option',
		'type' => 'radio',
        'choices' => array(
            'simple_post' => __('Simple Post','cyber-security-services'),
            'grid_post' => __('Grid Post','cyber-security-services'),
        ),
	));

    $wp_customize->add_setting('cyber_security_services_grid_column',array(
		'default' => '3_column',
		'sanitize_callback' => 'cyber_security_services_sanitize_select'
	));
	$wp_customize->add_control('cyber_security_services_grid_column',array(
		'label' => esc_html__('Grid Post Per Row','cyber-security-services'),
		'section' => 'cyber_security_services_layout',
		'setting' => 'cyber_security_services_grid_column',
		'type' => 'radio',
        'choices' => array(
            '1_column' => __('1','cyber-security-services'),
            '2_column' => __('2','cyber-security-services'),
            '3_column' => __('3','cyber-security-services'),
            '4_column' => __('4','cyber-security-services'),
            '5_column' => __('6','cyber-security-services'),
        ),
	));

	$wp_customize->add_setting( 'cyber_security_services_date', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'cyber_security_services_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Toggle_Control( $wp_customize, 'cyber_security_services_date', array(
		'label'       => esc_html__( 'Hide Date', 'cyber-security-services' ),
		'section'     => 'cyber_security_services_layout',
		'type'        => 'toggle',
		'settings'    => 'cyber_security_services_date',
	) ) );

	$wp_customize->add_setting( 'cyber_security_services_admin', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'cyber_security_services_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Toggle_Control( $wp_customize, 'cyber_security_services_admin', array(
		'label'       => esc_html__( 'Hide Author/Admin', 'cyber-security-services' ),
		'section'     => 'cyber_security_services_layout',
		'type'        => 'toggle',
		'settings'    => 'cyber_security_services_admin',
	) ) );

	$wp_customize->add_setting( 'cyber_security_services_comment', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'cyber_security_services_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Toggle_Control( $wp_customize, 'cyber_security_services_comment', array(
		'label'       => esc_html__( 'Hide Comment', 'cyber-security-services' ),
		'section'     => 'cyber_security_services_layout',
		'type'        => 'toggle',
		'settings'    => 'cyber_security_services_comment',
	) ) );

	// Social Media
    $wp_customize->add_section('cyber_security_services_urls',array(
        'title' => __('Social Media', 'cyber-security-services'),
        'description' => __( 'Add social media links in the below feilds', 'cyber-security-services' ),
        'priority' => 3
    ) );

	$wp_customize->add_setting('cyber_security_services_facebook',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('cyber_security_services_facebook',array(
		'label' => esc_html__('Facebook URL','cyber-security-services'),
		'section' => 'cyber_security_services_urls',
		'setting' => 'cyber_security_services_facebook',
		'type'    => 'url'
	));

	$wp_customize->add_setting('cyber_security_services_twitter',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('cyber_security_services_twitter',array(
		'label' => esc_html__('Twitter URL','cyber-security-services'),
		'section' => 'cyber_security_services_urls',
		'setting' => 'cyber_security_services_twitter',
		'type'    => 'url'
	));

	$wp_customize->add_setting('cyber_security_services_linkdin',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('cyber_security_services_linkdin',array(
		'label' => esc_html__('Linkedin URL','cyber-security-services'),
		'section' => 'cyber_security_services_urls',
		'setting' => 'cyber_security_services_linkdin',
		'type'    => 'url'
	));

	$wp_customize->add_setting('cyber_security_services_youtube',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('cyber_security_services_youtube',array(
		'label' => esc_html__('Youtube URL','cyber-security-services'),
		'section' => 'cyber_security_services_urls',
		'setting' => 'cyber_security_services_youtube',
		'type'    => 'url'
	));

	$wp_customize->add_setting('cyber_security_services_instagram',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('cyber_security_services_instagram',array(
		'label' => esc_html__('Instagram URL','cyber-security-services'),
		'section' => 'cyber_security_services_urls',
		'setting' => 'cyber_security_services_instagram',
		'type'    => 'url'
	));

    //Slider
	$wp_customize->add_section( 'cyber_security_services_slider_section' , array(
    	'title'      => __( 'Slider Settings', 'cyber-security-services' ),
    	'description' => __('Slider Image Dimension ( 1600px x 650px )','cyber-security-services'),
		'priority'   => 3,
	) );

	$wp_customize->add_setting('cyber_security_services_slide_heading',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('cyber_security_services_slide_heading',array(
		'label' => esc_html__('Slider Text','cyber-security-services'),
		'section' => 'cyber_security_services_slider_section',
		'setting' => 'cyber_security_services_slide_heading',
		'type'    => 'text'
	));

	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_post[]= 'select';
	foreach($categories as $category){
	if($i==0){
	  $default = $category->slug;
	  $i++;
	}
	$cat_post[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('cyber_security_services_post_setting',array(
		'default' => 'select',
		'sanitize_callback' => 'cyber_security_services_sanitize_select',
	));
	$wp_customize->add_control('cyber_security_services_post_setting',array(
		'type'    => 'select',
		'choices' => $cat_post,
		'label' => esc_html__('Select Category to display slider images','cyber-security-services'),
		'section' => 'cyber_security_services_slider_section',
	));

	// About Section
	$wp_customize->add_section( 'cyber_security_services_services_section' , array(
    	'title'      => __( 'About Us Section Settings', 'cyber-security-services' ),
		'priority'   => 4,
	) );

    $wp_customize->add_setting( 'cyber_security_services_about_images', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cyber_security_services_about_images', array(
        'label' => 'Upload Image',
        'section' => 'cyber_security_services_services_section',
        'settings' => 'cyber_security_services_about_images',
        'button_labels' => array(
            'select' => 'Select Image',
            'remove' => 'Remove Image',
            'change' => 'Change Image',
        )
    )));

    $wp_customize->add_setting( 'cyber_security_services_about_images1', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cyber_security_services_about_images1', array(
        'label' => 'Upload Image',
        'section' => 'cyber_security_services_services_section',
        'settings' => 'cyber_security_services_about_images1',
        'button_labels' => array(
            'select' => 'Select Image',
            'remove' => 'Remove Image',
            'change' => 'Change Image',
        )
    )));

    $wp_customize->add_setting( 'cyber_security_services_about_images2', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cyber_security_services_about_images2', array(
        'label' => 'Upload Image',
        'section' => 'cyber_security_services_services_section',
        'settings' => 'cyber_security_services_about_images2',
        'button_labels' => array(
            'select' => 'Select Image',
            'remove' => 'Remove Image',
            'change' => 'Change Image',
        )
    )));

    $wp_customize->add_setting('cyber_security_services_services_heading',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('cyber_security_services_services_heading',array(
		'label'	=> esc_html__('Add Heading','cyber-security-services'),
		'section'	=> 'cyber_security_services_services_section',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('cyber_security_services_about_us_settigs',array(
		'sanitize_callback' => 'cyber_security_services_sanitize_dropdown_pages',
	));
	$wp_customize->add_control('cyber_security_services_about_us_settigs',array(
		'type'    => 'dropdown-pages',
		'label' => __('Select Page','cyber-security-services'),
		'section' => 'cyber_security_services_services_section',
	));

	//Footer
    $wp_customize->add_section( 'cyber_security_services_footer_copyright', array(
    	'title' => esc_html__( 'Footer Text', 'cyber-security-services' ),
    	'priority' => 6
	) );

    $wp_customize->add_setting('cyber_security_services_footer_text',array(
			'default'	=> '',
			'sanitize_callback'	=> 'sanitize_text_field'
	));
		$wp_customize->add_control('cyber_security_services_footer_text',array(
			'label'	=> esc_html__('Copyright Text','cyber-security-services'),
			'section'	=> 'cyber_security_services_footer_copyright',
			'type'		=> 'text'
	));

	$wp_customize->add_setting('cyber_security_services_footer_widget',array(
		'default' => '4',
		'sanitize_callback' => 'cyber_security_services_sanitize_select'
	));
	$wp_customize->add_control('cyber_security_services_footer_widget',array(
		'label' => esc_html__('Footer Per Column','cyber-security-services'),
		'section' => 'cyber_security_services_footer_copyright',
		'setting' => 'cyber_security_services_footer_widget',
		'type' => 'radio',
				'choices' => array(
						'1'   => __('1 Column', 'cyber-security-services'),
						'2'  => __('2 Column', 'cyber-security-services'),
						'3' => __('3 Column', 'cyber-security-services'),
						'4' => __('4 Column', 'cyber-security-services')
				),
	));

	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'cyber_security_services_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'cyber_security_services_customize_partial_blogdescription',
	) );

	//front page
	$num_sections = apply_filters( 'cyber_security_services_front_page_sections', 4 );

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
		$wp_customize->add_setting( 'panel_' . $i, array(
			'default'           => false,
			'sanitize_callback' => 'cyber_security_services_sanitize_dropdown_pages',
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( 'panel_' . $i, array(
			/* translators: %d is the front page section number */
			'label'          => sprintf( __( 'Front Page Section %d Content', 'cyber-security-services' ), $i ),
			'description'    => ( 1 !== $i ? '' : __( 'Select pages to feature in each area from the dropdowns. Add an image to a section by setting a featured image in the page editor. Empty sections will not be displayed.', 'cyber-security-services' ) ),
			'section'        => 'theme_options',
			'type'           => 'dropdown-pages',
			'allow_addition' => true,
			'active_callback' => 'cyber_security_services_is_static_front_page',
		) );

		$wp_customize->selective_refresh->add_partial( 'panel_' . $i, array(
			'selector'            => '#panel' . $i,
			'render_callback'     => 'cyber_security_services_front_page_section',
			'container_inclusive' => true,
		) );
	}
}
add_action( 'customize_register', 'cyber_security_services_customize_register' );

function cyber_security_services_customize_partial_blogname() {
	bloginfo( 'name' );
}
function cyber_security_services_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
function cyber_security_services_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}
function cyber_security_services_is_view_with_layout_option() {
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'sidebar-1' ) ) );
}

define('CYBER_SECURITY_SERVICES_PRO_LINK',__('https://www.ovationthemes.com/wordpress/wordpress-cyber-security-theme/
','cyber-security-services'));

/* Pro control */
if (class_exists('WP_Customize_Control') && !class_exists('Cyber_Security_Services_Pro_Control')):
    class Cyber_Security_Services_Pro_Control extends WP_Customize_Control{

    public function render_content(){?>
        <label style="overflow: hidden; zoom: 1;">
	        <div class="col-md upsell-btn">
                <a href="<?php echo esc_url( CYBER_SECURITY_SERVICES_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE CYBER SECURITY PREMIUM','cyber-security-services');?> </a>
	        </div>
            <div class="col-md">
                <img class="cyber_security_services_img_responsive " src="<?php echo esc_url(get_template_directory_uri()); ?>/screenshot.png">
            </div>
	        <div class="col-md">
	            <h3 style="margin-top:10px; margin-left: 20px; text-decoration:underline; color:#333;"><?php esc_html_e('Cyber Security Services PREMIUM - Features', 'cyber-security-services'); ?></h3>
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
		    <div class="col-md upsell-btn upsell-btn-bottom">
	            <a href="<?php echo esc_url( CYBER_SECURITY_SERVICES_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE CYBER SECURITY PREMIUM','cyber-security-services');?> </a>
		    </div>
        </label>
    <?php } }
endif;
