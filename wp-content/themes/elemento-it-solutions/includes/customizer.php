<?php

if ( class_exists("Kirki")){

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'elemento_it_solutions_enable_logo_text',
		'section'     => 'title_tagline',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Site Title and Tagline', 'elemento-it-solutions' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'elemento_it_solutions_display_header_title',
		'label'       => esc_html__( 'Site Title Enable / Disable Button', 'elemento-it-solutions' ),
		'section'     => 'title_tagline',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'elemento-it-solutions' ),
			'off' => esc_html__( 'Disable', 'elemento-it-solutions' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'elemento_it_solutions_display_header_text',
		'label'       => esc_html__( 'Tagline Enable / Disable Button', 'elemento-it-solutions' ),
		'section'     => 'title_tagline',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'elemento-it-solutions' ),
			'off' => esc_html__( 'Disable', 'elemento-it-solutions' ),
		],
	] );

	// Additional Settings

	Kirki::add_section( 'elemento_it_solutions_additional_setting', array(
	    'title'          => esc_html__( 'Additional Settings', 'elemento-it-solutions' ),
	    'description'    => esc_html__( 'Additional Settings of themes', 'elemento-it-solutions' ),
	    'priority'       => 10,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'elemento_it_solutions_preloader_hide',
		'label'       => esc_html__( 'Here you can enable or disable your preloader.', 'elemento-it-solutions' ),
		'section'     => 'elemento_it_solutions_additional_setting',
		'default'     => '0',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'elemento_it_solutions_scroll_enable_setting',
		'label'       => esc_html__( 'Here you can enable or disable your scroller.', 'elemento-it-solutions' ),
		'section'     => 'elemento_it_solutions_additional_setting',
		'default'     => '0',
		'priority'    => 10,
	] );

	// HEADER SECTION

	Kirki::add_section( 'elemento_it_solutions_section_header', array(
	    'title'          => esc_html__( 'Header Settings', 'elemento-it-solutions' ),
	    'description'    => esc_html__( 'Here you can add header information.', 'elemento-it-solutions' ),
	    'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'elemento_it_solutions_sticky_header',
		'label'       => esc_html__( 'Enable/Disable Sticky Header', 'elemento-it-solutions' ),
		'section'     => 'elemento_it_solutions_section_header',
		'default'     => 0,
		'priority'    => 2,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'elemento-it-solutions'),
			'off' => esc_html__( 'Disable', 'elemento-it-solutions'),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'elemento_it_solutions_menu_size_heading',
		'section'     => 'elemento_it_solutions_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Menu Font Size(px)', 'elemento-it-solutions' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'elemento_it_solutions_menu_size',
		'label'       => __( 'Enter a value in pixels. Example:20px', 'elemento-it-solutions' ),
		'type'        => 'text',
		'section'     => 'elemento_it_solutions_section_header',
		'transport' => 'auto',
		'output' => array(
			array(
				'element'  => array( '#main-menu a', '#main-menu ul li a', '#main-menu li a'),
				'property' => 'font-size',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'elemento_it_solutions_menu_text_transform_heading',
		'section'     => 'elemento_it_solutions_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Menu Text Transform', 'elemento-it-solutions' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'settings'    => 'elemento_it_solutions_menu_text_transform',
		'section'     => 'elemento_it_solutions_section_header',
		'default'     => 'capitalize',
		'choices'     => [
			'none' => esc_html__( 'Normal', 'elemento-it-solutions' ),
			'uppercase' => esc_html__( 'Uppercase', 'elemento-it-solutions' ),
			'lowercase' => esc_html__( 'Lowercase', 'elemento-it-solutions' ),
			'capitalize' => esc_html__( 'Capitalize', 'elemento-it-solutions' ),
		],
		'output' => array(
			array(
				'element'  => array( '#main-menu a', '#main-menu ul li a', '#main-menu li a'),
				'property' => ' text-transform',
			),
		),
	 ) );


	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'elemento_it_solutions_menu_color',
		'label'       => __( 'Menu Color', 'elemento-it-solutions' ),
		'type'        => 'color',
		'section'     => 'elemento_it_solutions_section_header',
		'transport' => 'auto',
		'default'     => '#222222',
		'choices'     => [
			'alpha' => true,
		],
		'output' => array(
			array(
				'element'  => array( '#main-menu a', '#main-menu ul li a', '#main-menu li a'),
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'elemento_it_solutions_menu_hover_color',
		'label'       => __( 'Menu Hover Color', 'elemento-it-solutions' ),
		'type'        => 'color',
		'default'     => '#007fff',
		'section'     => 'elemento_it_solutions_section_header',
		'transport' => 'auto',
		'choices'     => [
			'alpha' => true,
		],
		'output' => array(
			array(
				'element'  => array( '#main-menu a:hover', '#main-menu ul li a:hover', '#main-menu li:hover > a','#main-menu a:focus','#main-menu li.focus > a','#main-menu ul li.current-menu-item > a','#main-menu ul li.current_page_item > a','#main-menu ul li.current-menu-parent > a','#main-menu ul li.current_page_ancestor > a','#main-menu ul li.current-menu-ancestor > a'),
				'property' => 'color',
			),

		),
	) );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'elemento_it_solutions_submenu_color',
		'label'       => __( 'Submenu Color', 'elemento-it-solutions' ),
		'type'        => 'color',
		'section'     => 'elemento_it_solutions_section_header',
		'transport' => 'auto',
		'default'     => '#222222',
		'choices'     => [
			'alpha' => true,
		],
		'output' => array(
			array(
				'element'  => array( '#main-menu ul.children li a', '#main-menu ul.sub-menu li a'),
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'elemento_it_solutions_submenu_hover_color',
		'label'       => __( 'Submenu Hover Color', 'elemento-it-solutions' ),
		'type'        => 'color',
		'section'     => 'elemento_it_solutions_section_header',
		'transport' => 'auto',
		'default'     => '#fff',
		'choices'     => [
			'alpha' => true,
		],
		'output' => array(
			array(
				'element'  => array( '#main-menu ul.children li a:hover', '#main-menu ul.sub-menu li a:hover'),
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'elemento_it_solutions_submenu_hover_background_color',
		'label'       => __( 'Submenu Hover Background Color', 'elemento-it-solutions' ),
		'type'        => 'color',
		'section'     => 'elemento_it_solutions_section_header',
		'transport' => 'auto',
		'default'     => '#007fff',
		'choices'     => [
			'alpha' => true,
		],
		'output' => array(
			array(
				'element'  => array( '#main-menu ul.children li a:hover', '#main-menu ul.sub-menu li a:hover'),
				'property' => 'background',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'elemento_it_solutions_enable_hiring_heading',
		'section'     => 'elemento_it_solutions_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Add Timing', 'elemento-it-solutions' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'label'	   =>  esc_html__( 'Title', 'elemento-it-solutions' ),
		'settings' => 'elemento_it_solutions_header_hiring_head',
		'section'  => 'elemento_it_solutions_section_header',
		'default'  => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'label'    =>  esc_html__( 'Text', 'elemento-it-solutions' ),
		'settings' => 'elemento_it_solutions_header_hiring',
		'section'  => 'elemento_it_solutions_section_header',
		'default'  => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'label'    =>  esc_html__( 'Button Text', 'elemento-it-solutions' ),
		'settings' => 'elemento_it_solutions_header_hiring_text',
		'section'  => 'elemento_it_solutions_section_header',
		'default'  => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'label'    =>  esc_html__( 'Button Url', 'elemento-it-solutions' ),
		'settings' => 'elemento_it_solutions_header_hiring_url',
		'section'  => 'elemento_it_solutions_section_header',
		'default'  => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'elemento_it_solutions_enable_location_heading',
		'section'     => 'elemento_it_solutions_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Add Location', 'elemento-it-solutions' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'elemento_it_solutions_header_location',
		'section'  => 'elemento_it_solutions_section_header',
		'default'  => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'elemento_it_solutions_enable_email_heading',
		'section'     => 'elemento_it_solutions_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Add Email Address', 'elemento-it-solutions' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'elemento_it_solutions_header_email',
		'section'  => 'elemento_it_solutions_section_header',
		'default'  => '',
		'sanitize_callback' => 'sanitize_email',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'elemento_it_solutions_header_phone_number_heading',
		'section'     => 'elemento_it_solutions_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Add Phone Number', 'elemento-it-solutions' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'label'    =>  esc_html__( 'Text', 'elemento-it-solutions' ),
		'settings' => 'elemento_it_solutions_header_phone_number_text',
		'section'  => 'elemento_it_solutions_section_header',
		'default'  => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'label'    =>  esc_html__( 'Phone Number', 'elemento-it-solutions' ),
		'settings' => 'elemento_it_solutions_header_phone_number',
		'section'  => 'elemento_it_solutions_section_header',
		'default'  => '',
		'sanitize_callback' => 'elemento_it_solutions_sanitize_phone_number',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'elemento_it_solutions_enable_socail_link',
		'section'     => 'elemento_it_solutions_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Social Media Link', 'elemento-it-solutions' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'repeater',
		'section'     => 'elemento_it_solutions_section_header',
		'row_label' => [
			'type'  => 'field',
			'value' => esc_html__( 'Social Icon', 'elemento-it-solutions' ),
			'field' => 'link_text',
		],
		'button_label' => esc_html__('Add New Social Icon', 'elemento-it-solutions' ),
		'settings'     => 'elemento_it_solutions_social_links_settings',
		'default'      => '',
		'fields' 	   => [
			'link_text' => [
				'type'        => 'text',
				'label'       => esc_html__( 'Icon', 'elemento-it-solutions' ),
				'description' => esc_html__( 'Add the fontawesome class ex: "fab fa-facebook-f".', 'elemento-it-solutions' ),
				'default'     => '',
			],
			'link_url' => [
				'type'        => 'url',
				'label'       => esc_html__( 'Social Link', 'elemento-it-solutions' ),
				'description' => esc_html__( 'Add the social icon url here.', 'elemento-it-solutions' ),
				'default'     => '',
			],
		],
		'choices' => [
			'limit' => 20
		],
	] );

	// POST SECTION

	Kirki::add_section( 'elemento_it_solutions_blog_post', array(
		'title'          => esc_html__( 'Post Settings', 'elemento-it-solutions' ),
		'description'    => esc_html__( 'Here you can add post information.', 'elemento-it-solutions' ),
		'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'elemento_it_solutions_date_hide',
		'label'       => esc_html__( 'Enable / Disable Post Date', 'elemento-it-solutions' ),
		'section'     => 'elemento_it_solutions_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'elemento_it_solutions_author_hide',
		'label'       => esc_html__( 'Enable / Disable Post Author', 'elemento-it-solutions' ),
		'section'     => 'elemento_it_solutions_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'elemento_it_solutions_comment_hide',
		'label'       => esc_html__( 'Enable / Disable Post Comment', 'elemento-it-solutions' ),
		'section'     => 'elemento_it_solutions_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'elemento_it_solutions_blog_post_featured_image',
		'label'       => esc_html__( 'Enable / Disable Post Image', 'elemento-it-solutions' ),
		'section'     => 'elemento_it_solutions_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'elemento_it_solutions_length_setting_heading',
		'section'     => 'elemento_it_solutions_blog_post',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Blog Post Content Limit', 'elemento-it-solutions' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'number',
		'settings'    => 'elemento_it_solutions_length_setting',
		'section'     => 'elemento_it_solutions_blog_post',
		'default'     => '15',
		'priority'    => 10,
		'choices'  => [
					'min'  => -10,
					'max'  => 40,
					'step' => 1,
				],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'label'       => esc_html__( 'Enable / Disable Single Post Tag', 'elemento-it-solutions' ),
		'settings'    => 'elemento_it_solutions_single_post_tag',
		'section'     => 'elemento_it_solutions_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'label'       => esc_html__( 'Enable / Disable Single Post Category', 'elemento-it-solutions' ),
		'settings'    => 'elemento_it_solutions_single_post_category',
		'section'     => 'elemento_it_solutions_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'elemento_it_solutions_single_post_featured_image',
		'label'       => esc_html__( 'Enable / Disable Single Post Image', 'elemento-it-solutions' ),
		'section'     => 'elemento_it_solutions_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'elemento_it_solutions_single_post_radius',
		'section'     => 'elemento_it_solutions_blog_post',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Single Post Image Border Radius(px)', 'elemento-it-solutions' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'elemento_it_solutions_single_post_border_radius',
		'label'       => __( 'Enter a value in pixels. Example:15px', 'elemento-it-solutions' ),
		'type'        => 'text',
		'section'     => 'elemento_it_solutions_blog_post',
		'transport' => 'auto',
		'output' => array(
			array(
				'element'  => array('.post-img img'),
				'property' => 'border-radius',
			),
		),
	) );

	// FOOTER SECTION

	Kirki::add_section( 'elemento_it_solutions_footer_section', array(
        'title'          => esc_html__( 'Footer Settings', 'elemento-it-solutions' ),
        'description'    => esc_html__( 'Here you can change copyright text', 'elemento-it-solutions' ),
        'priority'       => 160,
    ) );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'elemento_it_solutions_footer_text_heading',
		'section'     => 'elemento_it_solutions_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Copyright Text', 'elemento-it-solutions' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'elemento_it_solutions_footer_text',
		'section'  => 'elemento_it_solutions_footer_section',
		'default'  => '',
		'priority' => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'elemento_it_solutions_footer_enable_heading',
		'section'     => 'elemento_it_solutions_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Footer Link', 'elemento-it-solutions' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'elemento_it_solutions_copyright_enable',
		'label'       => esc_html__( 'Section Enable / Disable', 'elemento-it-solutions' ),
		'section'     => 'elemento_it_solutions_footer_section',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'elemento-it-solutions' ),
			'off' => esc_html__( 'Disable', 'elemento-it-solutions' ),
		],
	] );
}
