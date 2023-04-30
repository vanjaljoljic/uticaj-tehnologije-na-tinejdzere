<?php

if ( class_exists("Kirki")){

	// HEADER SECTION

	Kirki::add_section( 'software_company_elementor_section_header', array(
	    'title'          => esc_html__( 'Header Settings', 'software-company-elementor' ),
	    'description'    => esc_html__( 'Here you can add header information.', 'software-company-elementor' ),
	    'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'software_company_elementor_sticky_header',
		'label'       => esc_html__( 'Enable/Disable Sticky Header', 'software-company-elementor' ),
		'section'     => 'software_company_elementor_section_header',
		'default'     => 0,
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'software-company-elementor' ),
			'off' => esc_html__( 'Disable', 'software-company-elementor' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'software_company_elementor_menu_size_heading',
		'section'     => 'software_company_elementor_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Menu Font Size(px)', 'software-company-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'software_company_elementor_menu_size',
		'label'       => __( 'Enter a value in pixels. Example:20px', 'software-company-elementor' ),
		'type'        => 'text',
		'section'     => 'software_company_elementor_section_header',
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
		'settings'    => 'software_company_elementor_menu_text_transform_heading',
		'section'     => 'software_company_elementor_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Menu Text Transform', 'software-company-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'settings'    => 'software_company_elementor_menu_text_transform',
		'section'     => 'software_company_elementor_section_header',
		'default'     => 'capitalize',
		'choices'     => [
			'none' => esc_html__( 'Normal', 'software-company-elementor' ),
			'uppercase' => esc_html__( 'Uppercase', 'software-company-elementor' ),
			'lowercase' => esc_html__( 'Lowercase', 'software-company-elementor' ),
			'capitalize' => esc_html__( 'Capitalize', 'software-company-elementor' ),
		],
		'output' => array(
			array(
				'element'  => array( '#main-menu a', '#main-menu ul li a', '#main-menu li a'),
				'property' => ' text-transform',
			),
		),
	 ) );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'software_company_elementor_menu_color',
		'label'       => __( 'Menu Color', 'software-company-elementor' ),
		'type'        => 'color',
		'section'     => 'software_company_elementor_section_header',
		'transport' => 'auto',
		'default'     => '#fff',
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
		'settings'    => 'software_company_elementor_menu_hover_color',
		'label'       => __( 'Menu Hover Color', 'software-company-elementor' ),
		'type'        => 'color',
		'default'     => '#fff',
		'section'     => 'software_company_elementor_section_header',
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
		'settings'    => 'software_company_elementor_submenu_color',
		'label'       => __( 'Submenu Color', 'software-company-elementor' ),
		'type'        => 'color',
		'section'     => 'software_company_elementor_section_header',
		'transport' => 'auto',
		'default'     => '#012122',
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
		'settings'    => 'software_company_elementor_submenu_hover_color',
		'label'       => __( 'Submenu Hover Color', 'software-company-elementor' ),
		'type'        => 'color',
		'section'     => 'software_company_elementor_section_header',
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
		'settings'    => 'software_company_elementor_submenu_hover_background_color',
		'label'       => __( 'Submenu Hover Background Color', 'software-company-elementor' ),
		'type'        => 'color',
		'section'     => 'software_company_elementor_section_header',
		'transport' => 'auto',
		'default'     => '#ed2122',
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
		'settings'    => 'software_company_elementor_header_announcement_heading',
		'section'     => 'software_company_elementor_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Add Announcement', 'software-company-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'label'    =>  esc_html__( 'Text', 'software-company-elementor' ),
		'settings' => 'software_company_elementor_header_announcement',
		'section'  => 'software_company_elementor_section_header',
		'default'  => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'software_company_elementor_enable_opening_hours_heading',
		'section'     => 'software_company_elementor_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Opening Hours', 'software-company-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'software_company_elementor_enable_opening_hours',
		'section'  => 'software_company_elementor_section_header',
		'default'  => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'software_company_elementor_enable_socail_link',
		'section'     => 'software_company_elementor_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Social Media Link', 'software-company-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'repeater',
		'section'     => 'software_company_elementor_section_header',
		'row_label' => [
			'type'  => 'field',
			'value' => esc_html__( 'Social Icon', 'software-company-elementor' ),
			'field' => 'link_text',
		],
		'button_label' => esc_html__('Add New Social Icon', 'software-company-elementor' ),
		'settings'     => 'software_company_elementor_social_links_settings',
		'default'      => '',
		'fields' 	   => [
			'link_text' => [
				'type'        => 'text',
				'label'       => esc_html__( 'Icon', 'software-company-elementor' ),
				'description' => esc_html__( 'Add the fontawesome class ex: "fab fa-facebook-f".', 'software-company-elementor' ),
				'default'     => '',
			],
			'link_url' => [
				'type'        => 'url',
				'label'       => esc_html__( 'Social Link', 'software-company-elementor' ),
				'description' => esc_html__( 'Add the social icon url here.', 'software-company-elementor' ),
				'default'     => '',
			],
		],
		'choices' => [
			'limit' => 20
		],
	] );
	
	// POST SECTION

	Kirki::add_section( 'software_company_elementor_blog_post', array(
		'title'          => esc_html__( 'Post Settings', 'software-company-elementor' ),
		'description'    => esc_html__( 'Here you can add post information.', 'software-company-elementor' ),
		'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'software_company_elementor_date_hide',
		'label'       => esc_html__( 'Enable / Disable Post Date', 'software-company-elementor' ),
		'section'     => 'software_company_elementor_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'software_company_elementor_author_hide',
		'label'       => esc_html__( 'Enable / Disable Post Author', 'software-company-elementor' ),
		'section'     => 'software_company_elementor_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'software_company_elementor_comment_hide',
		'label'       => esc_html__( 'Enable / Disable Post Comment', 'software-company-elementor' ),
		'section'     => 'software_company_elementor_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'software_company_elementor_blog_post_featured_image',
		'label'       => esc_html__( 'Enable / Disable Post Image', 'software-company-elementor' ),
		'section'     => 'software_company_elementor_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );


	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'software_company_elementor_length_setting_heading',
		'section'     => 'software_company_elementor_blog_post',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Blog Post Content Limit', 'software-company-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'number',
		'settings'    => 'software_company_elementor_length_setting',
		'section'     => 'software_company_elementor_blog_post',
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
		'label'       => esc_html__( 'Enable / Disable Single Post Tag', 'software-company-elementor' ),
		'settings'    => 'software_company_elementor_single_post_tag',
		'section'     => 'software_company_elementor_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'label'       => esc_html__( 'Enable / Disable Single Post Category', 'software-company-elementor' ),
		'settings'    => 'software_company_elementor_single_post_category',
		'section'     => 'software_company_elementor_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );
	
	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'software_company_elementor_single_post_featured_image',
		'label'       => esc_html__( 'Enable / Disable Single Post Image', 'software-company-elementor' ),
		'section'     => 'software_company_elementor_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'software_company_elementor_single_post_radius',
		'section'     => 'software_company_elementor_blog_post',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Single Post Image Border Radius(px)', 'software-company-elementor' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'software_company_elementor_single_post_border_radius',
		'label'       => __( 'Enter a value in pixels. Example:15px', 'software-company-elementor' ),
		'type'        => 'text',
		'section'     => 'software_company_elementor_blog_post',
		'transport' => 'auto',
		'output' => array(
			array(
				'element'  => array('.post-img img'),
				'property' => 'border-radius',
			),
		),
	) );

	// FOOTER SECTION

	Kirki::add_section( 'software_company_elementor_footer_section', array(
        'title'          => esc_html__( 'Footer Settings', 'software-company-elementor' ),
        'description'    => esc_html__( 'Here you can change copyright text', 'software-company-elementor' ),
        'priority'       => 160,
    ) );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'software_company_elementor_footer_text_heading',
		'section'     => 'software_company_elementor_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Copyright Text', 'software-company-elementor' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'software_company_elementor_footer_text',
		'section'  => 'software_company_elementor_footer_section',
		'default'  => '',
		'priority' => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'software_company_elementor_footer_enable_heading',
		'section'     => 'software_company_elementor_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Footer Link', 'software-company-elementor' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'software_company_elementor_copyright_enable',
		'label'       => esc_html__( 'Section Enable / Disable', 'software-company-elementor' ),
		'section'     => 'software_company_elementor_footer_section',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'software-company-elementor' ),
			'off' => esc_html__( 'Disable', 'software-company-elementor' ),
		],
	] );
}