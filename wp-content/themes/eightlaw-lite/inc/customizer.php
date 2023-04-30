<?php
/**
 * 8Law Lite Theme Customizer
 *
 * @package 8Law Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */


function eightlaw_lite_customize_register( $wp_customize ) {

  $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
  $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
  $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	 //Deafault setting
  $wp_customize->add_panel('eightlaw_lite_default_setting',array(
      'priority' => 1,
      'title' => __('Default/Basic Setting', 'eightlaw-lite'),
      'panel' => 'eightlaw_lite_default_setting'
      ));
  $wp_customize->get_section('title_tagline')->panel = 'eightlaw_lite_default_setting'; //priority 20
  $wp_customize->get_section('colors')->panel = 'eightlaw_lite_default_setting'; //priority 40
  $wp_customize->get_section('header_image')->panel = 'eightlaw_lite_default_setting'; //priority 60
  $wp_customize->get_section('background_image')->panel = 'eightlaw_lite_default_setting'; //priority 80
  $wp_customize->get_section('static_front_page')->panel = 'eightlaw_lite_default_setting'; //priority 120
  
   //Webpage layout
   $wp_customize->add_section('eightlaw_lite_webpage_layout', array(
      'priority' => 100,
      'title' => __('Webpage Layout', 'eightlaw-lite'),
      'panel' => 'eightlaw_lite_default_setting'
   ));
    $wp_customize->add_setting('eightlaw_lite_webpage_layout', array(
      'default' => 'fullwidth',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_webpagelayout',
   ));

   $wp_customize->add_control('eightlaw_lite_webpage_layout', array(
      'type' => 'radio',
      'label' => __('Choose the layout that you want', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_webpage_layout',
      'setting' => 'eightlaw_lite_webpage_layout',
      'choices' => array(
         'fullwidth' => __('Full Width', 'eightlaw-lite'),
         'boxed' => __('Boxed', 'eightlaw-lite')
      )
   ));
   
   //Footer Copy Right Text
   $wp_customize->add_section('eightlaw_lite_footer_copyright', array(
       	'priority' => 100,
       	'title' => __('Footer Copyright Text', 'eightlaw-lite'),
       	'panel' => 'eightlaw_lite_default_setting'
	));

    $wp_customize->add_setting('eightlaw_lite_footer_copyright_text', array(
		    'default' => '',
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
	));
    
    $wp_customize->add_control('eightlaw_lite_footer_copyright_text',array(
        'type' => 'textarea',
        'section' => 'eightlaw_lite_footer_copyright',
        'setting' => 'eightlaw_lite_footer_copyright_text',
    ));
    
    /* New Panel For Header Settings */
    $wp_customize->add_panel('eightlaw_lite_header_settings', array(
      'capabitity' => 'edit_theme_options',
      'priority' => 20,
      'title' => __('Header Settings', 'eightlaw-lite')
   ));  
   
   //search box
   $wp_customize->add_section('eightlaw_lite_search_options', array(
       	'priority' => 20,
       	'title' => __('Show Search in Header', 'eightlaw-lite'),
       	'panel' => 'eightlaw_lite_header_settings'
	));

    $wp_customize->add_setting('eightlaw_lite_search_options', array(
      'default' => 0,
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_checkbox_sanitize'
   ));

   $wp_customize->add_control('eightlaw_lite_search_options', array(
      'type' => 'checkbox',
      'label' => __('Check to Show Search in Header', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_search_options',
      'setting' => 'eightlaw_lite_search_options'
   ));
   
   //Search Box Placeholder
   $wp_customize->add_section('eightlaw_lite_search_placeholder', array(
       	'priority' => 30,
       	'title' => __('Search Placeholder Text', 'eightlaw-lite'),
       	'panel' => 'eightlaw_lite_header_settings'
	));

    $wp_customize->add_setting('eightlaw_lite_search_placeholder', array(
		'default' => __('Search...','eightlaw-lite'),
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage',
	));
    
    $wp_customize->add_control('eightlaw_lite_search_placeholder',array(
        'type' => 'text',
        'section' => 'eightlaw_lite_search_placeholder',
        'setting' => 'eightlaw_lite_search_placeholder',
    ));
    
    //Search Button Text
   $wp_customize->add_section('eightlaw_lite_search_button_text', array(
       	'priority' => 40,
       	'title' => __('Search Button Text', 'eightlaw-lite'),
       	'panel' => 'eightlaw_lite_header_settings'
	));

    $wp_customize->add_setting('eightlaw_lite_search_button_text', array(
		'default' => __('Search','eightlaw-lite'),
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage',
	));
    
    $wp_customize->add_control('eightlaw_lite_search_button_text',array(
        'type' => 'text',
        'section' => 'eightlaw_lite_search_button_text',
        'setting' => 'eightlaw_lite_search_button_text',
    ));
    
    //logo Alignment
   $wp_customize->add_section('eightlaw_lite_logo_alignment', array(
       	'priority' => 50,
       	'title' => __('Logo Alignment', 'eightlaw-lite'),
       	'panel' => 'eightlaw_lite_header_settings'
	));

    $wp_customize->add_setting('eightlaw_lite_logo_alignment', array(
      'default' => 'left',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_alignment_logo',
   ));

   $wp_customize->add_control('eightlaw_lite_logo_alignment', array(
      'type' => 'radio',
      'label' => __('Choose the layout that you want', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_logo_alignment',
      'setting' => 'eightlaw_lite_logo_alignment',
      'choices' => array(
         'left'=>__('Left', 'eightlaw-lite'),
         'center'=>__('Center', 'eightlaw-lite'),
         'right'=>__('Right', 'eightlaw-lite')
      )
   ));
   
   // Panel Homepage Settings 
   $wp_customize->add_panel('eightlaw_lite_homepage_settings', array(
      'capabitity' => 'edit_theme_options',
      'priority' => 30,
      'title' => __('Homepage Sections', 'eightlaw-lite')
   ));
   
   //Slider Section
   $wp_customize->add_section('eightlaw_lite_slider_setting', array(
        'priority' => 10,
        'title' => __('Slider Section', 'eightlaw-lite'),
        'panel' => 'eightlaw_lite_homepage_settings',
  ));
    
    $wp_customize->add_setting('eightlaw_lite_slider_setting_option', array(
      'default' => 'disable',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_enabledisable',
   ));

   $wp_customize->add_control('eightlaw_lite_slider_setting_option', array(
      'type' => 'radio',
      'label' => __('Enable Disable Slider', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_slider_setting',
      'setting' => 'eightlaw_lite_slider_setting_option',
      'choices' => array(
         'enable' => __('Enable', 'eightlaw-lite'),
         'disable' => __('Disable', 'eightlaw-lite'),
      )
   ));
   
   //select category for slider
   $wp_customize->add_setting('eightlaw_lite_slider_setting_category',array(
        'default' => '0',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
   ));
   
   $wp_customize->add_control( new Eightlaw_lite_Customize_Category_Control( $wp_customize,'eightlaw_lite_slider_setting_category', array(
        'label' => __('Select a category to show in slider','eightlaw-lite'),
        'section' => 'eightlaw_lite_slider_setting',
    )));
    
   //slider button Text
   $wp_customize->add_setting('eightlaw_lite_slider_button_text', array(
    'default' => __('Details','eightlaw-lite'),
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
  ));
    
    $wp_customize->add_control('eightlaw_lite_slider_button_text',array(
        'type' => 'text',
        'label' => __('Slider Button Text','eightlaw-lite'),
        'section' => 'eightlaw_lite_slider_setting',
        'setting' => 'eightlaw_lite_slider_button_text'
    ));
    
    //slider pager
   $wp_customize->add_setting('eightlaw_lite_slider_show_pager', array(
      'default' => 'no',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_yesno',
   ));

   $wp_customize->add_control('eightlaw_lite_slider_show_pager', array(
      'type' => 'radio',
      'label' => __('Show Pager / Navigation Dot', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_slider_setting',
      'setting' => 'eightlaw_lite_slider_show_pager',
      'choices' => array(
         'yes' => __('Yes', 'eightlaw-lite'),
         'no' => __('No', 'eightlaw-lite'),
      )
   ));
   
   //slider controls
   $wp_customize->add_setting('eightlaw_lite_slider_show_controls', array(
      'default' => 'no',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_yesno',
   ));

   $wp_customize->add_control('eightlaw_lite_slider_show_controls', array(
      'type' => 'radio',
      'label' => __('Show Controls', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_slider_setting',
      'setting' => 'eightlaw_lite_slider_show_controls',
      'choices' => array(
         'yes' => __('Yes', 'eightlaw-lite'),
         'no' => __('No', 'eightlaw-lite'),
      )
   ));
   
   //transition type
   $wp_customize->add_setting('eightlaw_lite_slider_transitions_type', array(
      'default' => 'horizontal',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_transitiontype',
   ));

   $wp_customize->add_control('eightlaw_lite_slider_transitions_type', array(
      'type' => 'select',
      'label' => __('Slider Transitions (Slide/Fade)', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_slider_setting',
      'setting' => 'eightlaw_lite_slider_transitions_type',
      'choices' => array(
         'fade' => __('Fade', 'eightlaw-lite'),
         'horizontal' => __('Slide Horizontal', 'eightlaw-lite'),
         'vertical' => __('Slide Vertical', 'eightlaw-lite'),
      )
   ));
   //slider transition
   $wp_customize->add_setting('eightlaw_lite_slider_show_transitions', array(
      'default' => 'no',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_yesno',
   ));

   $wp_customize->add_control('eightlaw_lite_slider_show_transitions', array(
      'type' => 'radio',
      'label' => __('Show Auto Transitions', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_slider_setting',
      'setting' => 'eightlaw_lite_slider_show_transitions',
      'choices' => array(
         'yes' => __('Yes', 'eightlaw-lite'),
         'no' => __('No', 'eightlaw-lite'),
      )
   ));
   
   //slider speed
   $wp_customize->add_setting('eightlaw_lite_slider_speed', array(
    'default' => '1000',
        'sanitize_callback' => 'eightlaw_lite_integer_sanitize',
  ));
    
    $wp_customize->add_control('eightlaw_lite_slider_speed',array(
        'type' => 'number',
        'label' => __('Slider Speed','eightlaw-lite'),
        'section' => 'eightlaw_lite_slider_setting',
        'setting' => 'eightlaw_lite_slider_speed'
    ));
    
    //slider pause
   $wp_customize->add_setting('eightlaw_lite_slider_pause', array(
    'default' => '4000',
        'sanitize_callback' => 'eightlaw_lite_integer_sanitize',
  ));
    
    $wp_customize->add_control('eightlaw_lite_slider_pause',array(
        'type' => 'number',
        'label' => __('Slider Pause','eightlaw-lite'),
        'section' => 'eightlaw_lite_slider_setting',
        'setting' => 'eightlaw_lite_slider_pause'
    ));
    //slider caption
   $wp_customize->add_setting('eightlaw_lite_slider_show_caption', array(
      'default' => 'no',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_yesno',
   ));

   $wp_customize->add_control('eightlaw_lite_slider_show_caption', array(
      'type' => 'radio',
      'label' => __('Show Caption', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_slider_setting',
      'setting' => 'eightlaw_lite_slider_show_caption',
      'choices' => array(
         'yes' => __('Yes', 'eightlaw-lite'),
         'no' => __('No', 'eightlaw-lite'),
      )
   ));
   //homepage about us section
   $wp_customize->add_section('eightlaw_lite_about_section', array(
       	'priority' => 20,
       	'title' => __('About Section', 'eightlaw-lite'),
       	'panel' => 'eightlaw_lite_homepage_settings',
	));
    
    //enable disable about us section
    $wp_customize->add_setting('eightlaw_lite_about_setting_option', array(
      'default' => 'disable',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_enabledisable',
   ));

   $wp_customize->add_control('eightlaw_lite_about_setting_option', array(
      'type' => 'radio',
      'label' => __('Enable Disable About Us Section', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_about_section',
      'setting' => 'eightlaw_lite_about_setting_option',
      'choices' => array(
         'enable' => __('Enable', 'eightlaw-lite'),
         'disable' => __('Disable', 'eightlaw-lite'),
      )
   ));
   
    $options_posts = array();
    $options_posts_obj = get_posts('posts_per_page=-1');
    $options_posts[''] = 'Select a Post:';
    foreach ($options_posts_obj as $post) {
    	$options_posts[$post->ID] = $post->post_title;
    }
   //select post for about us
   $wp_customize->add_setting('eightlaw_lite_about_setting_post',array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'eightlaw_lite_integer_sanitize',
        'transport' => 'postMessage'
   ));
   
   $wp_customize->add_control('eightlaw_lite_about_setting_post', array(
        'type' => 'select',
        'label' => __('Select a Post to show in About Us Section','eightlaw-lite'),
        'section' => 'eightlaw_lite_about_section',
        'setting' => 'eightlaw_lite_about_setting_option',
        'choices' => $options_posts
    ));
   
    /**
    * About us Layout
    * layout added 
    * @since 2.0.0
    */

    //about us layout
    $wp_customize->add_setting('eightlaw_lite_aboutus_layout', array(
        'default' => 'layout1',
        'sanitize_callback' => 'eightlaw_lite_sanitize_layout',
    ));
    
    $wp_customize->add_control('eightlaw_lite_aboutus_layout',array(
        'type' => 'radio',
        'label' => __('About Layout','eightlaw-lite'),
        'section' => 'eightlaw_lite_about_section',
        'setting' => 'eightlaw_lite_aboutus_layout',
        'choices'   => array(
            'layout1' => __('Layout 1', 'eightlaw-lite'),
            'layout2' => __('Layout 2', 'eightlaw-lite'),
            )
        )
    );
   
   //about us view more text
   $wp_customize->add_setting('eightlaw_lite_aboutus_viewmore_text', array(
		'default' => __('Details','eightlaw-lite'),
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
	));
    
    $wp_customize->add_control('eightlaw_lite_aboutus_viewmore_text',array(
        'type' => 'text',
        'label' => __('About View More Text','eightlaw-lite'),
        'section' => 'eightlaw_lite_about_section',
        'setting' => 'eightlaw_lite_aboutus_viewmore_text'
    ));

    //Call to Action Section
    $wp_customize->add_section('eightlaw_lite_callto_section', array(
        'priority' => 30,
        'title' => __('Call To Action Section', 'eightlaw-lite'),
        'panel' => 'eightlaw_lite_homepage_settings',
  ));
    
    //enable disable call to action section
    $wp_customize->add_setting('eightlaw_lite_callto_setting_option', array(
      'default' => 'disable',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_enabledisable',
   ));

   $wp_customize->add_control('eightlaw_lite_callto_setting_option', array(
      'type' => 'radio',
      'label' => __('Enable Disable Call To Action', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_callto_section',
      'setting' => 'eightlaw_lite_callto_setting_option',
      'choices' => array(
         'enable' => __('Enable', 'eightlaw-lite'),
         'disable' => __('Disable', 'eightlaw-lite'),
      )
   ));
      
   //call to action Title
   $wp_customize->add_setting('eightlaw_lite_callto_title', array(
    'default' => __('Our Moto','eightlaw-lite'),
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
  ));
    
    $wp_customize->add_control('eightlaw_lite_callto_title',array(
        'type' => 'text',
        'label' => __('Call To Action Title','eightlaw-lite'),
        'section' => 'eightlaw_lite_callto_section',
        'setting' => 'eightlaw_lite_callto_title'
    ));
    
    
    
    //callto section description
   $wp_customize->add_setting('eightlaw_lite_callto_desc', array(
        'default' => '',
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
  ));
    
    $wp_customize->add_control('eightlaw_lite_callto_desc',array(
        'type' => 'textarea',
        'label' => __('Call To Description','eightlaw-lite'),
        'section' => 'eightlaw_lite_callto_section',
        'setting' => 'eightlaw_lite_callto_desc'
    ));
   
   
      
   
    //call to action read more
   $wp_customize->add_setting('eightlaw_lite_callto_readmore', array(
		'default' => __('Immanuel Kant','eightlaw-lite'),
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
	));
    
    $wp_customize->add_control('eightlaw_lite_callto_readmore',array(
        'type' => 'text',
        'label' => __('Call To Action Read More Text','eightlaw-lite'),
        'section' => 'eightlaw_lite_callto_section',
        'setting' => 'eightlaw_lite_callto_readmore'
    ));
   
   //call to action link
   $wp_customize->add_setting('eightlaw_lite_callto_link', array(
		'default' => '#',
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
	));
    
    $wp_customize->add_control('eightlaw_lite_callto_link',array(
        'type' => 'text',
        'label' => __('Call To Action Link','eightlaw-lite'),
        'section' => 'eightlaw_lite_callto_section',
        'setting' => 'eightlaw_lite_callto_link'
    ));
   //call to action background image
   $wp_customize->add_setting('eightlaw_lite_callto_bkgimage', array(
		'default' => '',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'eightlaw_lite_callto_bkgimage', array(
		'label' => __('Background Image for Call to Action', 'eightlaw-lite'),
		'section' => 'eightlaw_lite_callto_section',
		'setting' => 'eightlaw_lite_callto_bkgimage'
	)));

     //Practice Section
  $wp_customize->add_section(
    'eightlaw_lite_practice_section',
    array(
      'priority'  =>  50,
      'title'     =>  __('Practice Section','eightlaw-lite'),
      'panel'     =>  'eightlaw_lite_homepage_settings'
      )
    );
      $wp_customize->add_setting('eightlaw_lite_practice_setting_option',
        array(
          'default' =>  'disable',
          'capability'  =>'edit_theme_options',
          'sanitize_callback' =>  'eightlaw_lite_radio_sanitize_enabledisable',      
          )
        );
      $wp_customize->add_control(
        'eightlaw_lite_practice_setting_option',
        array(
          'type'    =>  'radio',
          'label'   =>  __('Enable Disable Practice', 'eightlaw-lite'),
          'section' => 'eightlaw_lite_practice_section',
          'setting' => 'eightlaw_lite_practice_setting_option',
          'choices' => array(
             'enable' => __('Enable', 'eightlaw-lite'),
             'disable' => __('Disable', 'eightlaw-lite'),
          )
          )
        );
      //Practice Title
   $wp_customize->add_setting('eightlaw_lite_practice_title', array(
    'default' => __('Practice','eightlaw-lite'),
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
  ));
    
    $wp_customize->add_control('eightlaw_lite_practice_title',array(
        'type' => 'text',
        'label' => __('Practice Title','eightlaw-lite'),
        'section' => 'eightlaw_lite_practice_section',
        'setting' => 'eightlaw_lite_practice_title'
    ));
    //Practice section description
   $wp_customize->add_setting('eightlaw_lite_practice_desc', array(
    'default' => '',
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
  ));
    
    $wp_customize->add_control('eightlaw_lite_practice_desc',array( 
        'type' => 'textarea',
        'label' => __('Practice Section Description','eightlaw-lite'),
        'section' => 'eightlaw_lite_practice_section',
        'setting' => 'eightlaw_lite_practice_desc'
    ));
    $wp_customize->add_setting('eightlaw_lite_practice_image', array(
    'default' => '',
        'capability' => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw'
  ));

  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'eightlaw_lite_practice_image', array(
    'label' => __('Image for Practice Section', 'eightlaw-lite'),
    'section' => 'eightlaw_lite_practice_section',
    'setting' => 'eightlaw_lite_practice_image'
  )));
   
    /**
    * Practice Layout
    * layout added 
    * @since 2.0.0
    */

    //Practice layout
    $wp_customize->add_setting('eightlaw_lite_practice_layout', array(
        'default' => 'layout1',
        'sanitize_callback' => 'eightlaw_lite_sanitize_layout',
    ));
    
    $wp_customize->add_control('eightlaw_lite_practice_layout',array(
        'type' => 'radio',
        'label' => __('Practice Layout','eightlaw-lite'),
        'section' => 'eightlaw_lite_practice_section',
        'setting' => 'eightlaw_lite_practice_layout',
        'choices'   => array(
            'layout1' => __('Layout 1', 'eightlaw-lite'),
            'layout2' => __('Layout 2', 'eightlaw-lite'),
            )
        )
    );

   
   //Practice Know more text
   $wp_customize->add_setting('eightlaw_lite_practice_button_text', array(
    'default' => __('Read More','eightlaw-lite'),
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
  ));
    
    $wp_customize->add_control('eightlaw_lite_practice_button_text',array(
        'type' => 'text',
        'label' => __('Button Text','eightlaw-lite'),
        'section' => 'eightlaw_lite_practice_section',
        'setting' => 'eightlaw_lite_practice_button_text'
    ));
    //practice button link
    $wp_customize->add_setting(
        'eightlaw_lite_practice_button_link',
        array(
            'default' => '#',
            'sanitize_callback' => 'esc_url_raw',
            )
    );
    
    $wp_customize->add_control(
        'eightlaw_lite_practice_button_link',
        array(
            'label' => __( 'Button Link' , 'eightlaw-lite' ),
            'section' => 'eightlaw_lite_practice_section',
            'type' => 'text',
        )
    ); 
       
        
//Gallery Section for slider
    $wp_customize->add_section('eightlaw_lite_gallery_section', array(
        'priority' => 70,
        'title' => __('Gallery Section', 'eightlaw-lite'),
        'panel' => 'eightlaw_lite_homepage_settings',
  ));
    
    //enable disable Gallery section
    $wp_customize->add_setting('eightlaw_lite_gallery_setting_option', array(
      'default' => 'disable',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_enabledisable',
   ));

   $wp_customize->add_control('eightlaw_lite_gallery_setting_option', array(
      'type' => 'radio',
      'label' => __('Enable Disable Gallery Section', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_gallery_section',
      'setting' => 'eightlaw_lite_gallery_setting_option',
      'choices' => array(
         'enable' => __('Enable', 'eightlaw-lite'),
         'disable' => __('Disable', 'eightlaw-lite'),
      )
   ));  
   
  //Gallery Title
   $wp_customize->add_setting('eightlaw_lite_gallery_title', array(
    'default' => __('Gallery','eightlaw-lite'),
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
  ));
    
    $wp_customize->add_control('eightlaw_lite_gallery_title',array(
        'type' => 'text',
        'label' => __('Gallery Section Title','eightlaw-lite'),
        'section' => 'eightlaw_lite_gallery_section',
        'setting' => 'eightlaw_lite_gallery_title'
    ));
    //Gallery content
   $wp_customize->add_setting('eightlaw_lite_gallery_description', array(
    'default' => __('Gallery','eightlaw-lite'),
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
  ));
    
    $wp_customize->add_control('eightlaw_lite_gallery_description',array(
        'type' => 'textarea',
        'label' => __('Gallery Section Description','eightlaw-lite'),
        'section' => 'eightlaw_lite_gallery_section',
        'setting' => 'eightlaw_lite_gallery_description'
    ));
     //select category for Gallery
   $wp_customize->add_setting('eightlaw_lite_gallery_setting_category',array(
        'default' => '0',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
   ));
   
   $wp_customize->add_control( new Eightlaw_lite_Customize_Category_Control( $wp_customize,'eightlaw_lite_gallery_setting_category', array(
        'label' => __('Select a Category to show in Gallery Section in Slider','eightlaw-lite'),
        'section' => 'eightlaw_lite_gallery_section',
        'setting' => 'eightlaw_lite_gallery_setting_category'
    )));
    //Team Member Section
    $wp_customize->add_section('eightlaw_lite_teammember_section', array(
       	'priority' => 90,
       	'title' => __('Team Member Section', 'eightlaw-lite'),
       	'panel' => 'eightlaw_lite_homepage_settings',
	));
    
    //enable disable Team Member section
    $wp_customize->add_setting('eightlaw_lite_teammember_setting_option', array(
      'default' => 'disable',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_enabledisable',
   ));

   $wp_customize->add_control('eightlaw_lite_teammember_setting_option', array(
      'type' => 'radio',
      'label' => __('Enable Disable Team Member', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_teammember_section',
      'setting' => 'eightlaw_lite_teammember_setting_option',
      'choices' => array(
         'enable' => __('Enable', 'eightlaw-lite'),
         'disable' => __('Disable', 'eightlaw-lite'),
      )
   ));
   
   
   //Team member Title
   $wp_customize->add_setting('eightlaw_lite_teammember_title', array(
		'default' => __('Team Member Section','eightlaw-lite'),
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
	));
    
    $wp_customize->add_control('eightlaw_lite_teammember_title',array(
        'type' => 'text',
        'label' => __('Team Memeber Title','eightlaw-lite'),
        'section' => 'eightlaw_lite_teammember_section',
        'setting' => 'eightlaw_lite_teammember_title'
    ));
    //team section description
   $wp_customize->add_setting('eightlaw_lite_teammember_desc', array(
    'default' => '',
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
  ));
    
    $wp_customize->add_control('eightlaw_lite_teammember_desc',array(
        'type' => 'textarea',
        'label' => __('Team Section Description','eightlaw-lite'),
        'section' => 'eightlaw_lite_teammember_section',
        'setting' => 'eightlaw_lite_teammember_desc'
    ));
     //select category for team member
   $wp_customize->add_setting('eightlaw_lite_teammember_setting_category',array(
        'default' => '0',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
   ));
   
   $wp_customize->add_control( new Eightlaw_lite_Customize_Category_Control( $wp_customize,'eightlaw_lite_teammember_setting_category', array(
        'label' => __('Select a Category to show in Team Member Section','eightlaw-lite'),
        'section' => 'eightlaw_lite_teammember_section',
        'setting' => 'eightlaw_lite_teammember_setting_category'
    )));
     //read more text for single team member
   $wp_customize->add_setting('eightlaw_lite_teammember_single_readmore', array(
    'default' => __('View More','eightlaw-lite'),
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
  ));
    
    $wp_customize->add_control('eightlaw_lite_teammember_single_readmore',array(
        'type' => 'text',
        'label' => __('Details','eightlaw-lite'),
        'section' => 'eightlaw_lite_teammember_section',
        'setting' => 'eightlaw_lite_teammember_single_readmore'
    ));
   
   //Case Section
    $wp_customize->add_section('eightlaw_lite_case_section', array(
        'priority' => 60,
        'title' => __('Case Section', 'eightlaw-lite'),
        'panel' => 'eightlaw_lite_homepage_settings',
  ));
    
    //enable disable Case section
    $wp_customize->add_setting('eightlaw_lite_case_setting_option', array(
      'default' => 'disable',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_enabledisable',
   ));

   $wp_customize->add_control('eightlaw_lite_case_setting_option', array(
      'type' => 'radio',
      'label' => __('Enable Disable Case section', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_case_section',
      'setting' => 'eightlaw_lite_case_setting_option',
      'choices' => array(
         'enable' => __('Enable', 'eightlaw-lite'),
         'disable' => __('Disable', 'eightlaw-lite'),
      )
   ));
   
   
   //Case section Title
   $wp_customize->add_setting('eightlaw_lite_case_title', array(
    'default' => __('Simple Process','eightlaw-lite'),
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
  ));
    
    $wp_customize->add_control('eightlaw_lite_case_title',array(
        'type' => 'text',
        'label' => __('Case Title','eightlaw-lite'),
        'section' => 'eightlaw_lite_case_section',
        'setting' => 'eightlaw_lite_case_title'
    ));
    //Case section description
   $wp_customize->add_setting('eightlaw_lite_case_desc', array(
    'default' => '',
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
  ));
    
    $wp_customize->add_control('eightlaw_lite_case_desc',array(
        'type' => 'textarea',
        'label' => __('Case Section Description','eightlaw-lite'),
        'section' => 'eightlaw_lite_case_section',
        'setting' => 'eightlaw_lite_case_desc'
    ));
     //select category for Case section
   $wp_customize->add_setting('eightlaw_lite_case_setting_category',array(
        'default' => '0',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
   ));
   
   $wp_customize->add_control( new Eightlaw_lite_Customize_Category_Control( $wp_customize,'eightlaw_lite_case_setting_category', array(
        'label' => __('Select a Category to show in Case section','eightlaw-lite'),
        'section' => 'eightlaw_lite_case_section',
        'setting' => 'eightlaw_lite_case_setting_category'
    )));
   //read more text for single page
   $wp_customize->add_setting('eightlaw_lite_case_single_readmore', array(
    'default' => __('View More','eightlaw-lite'),
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
  ));
    
    $wp_customize->add_control('eightlaw_lite_case_single_readmore',array(
        'type' => 'text',
        'label' => __('Details','eightlaw-lite'),
        'section' => 'eightlaw_lite_case_section',
        'setting' => 'eightlaw_lite_case_single_readmore'
    ));

    //Homepage Blog Section
   $wp_customize->add_section('eightlaw_lite_blog_section', array(
       	'priority' => 100,
       	'title' => __('Blog Section', 'eightlaw-lite'),
       	'panel' => 'eightlaw_lite_homepage_settings',
	));
    
    //enable disable blog section
    $wp_customize->add_setting('eightlaw_lite_blog_setting_option', array(
      'default' => 'disable',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_enabledisable',
   ));

   $wp_customize->add_control('eightlaw_lite_blog_setting_option', array(
      'type' => 'radio',
      'label' => __('Enable Disable Blog Section', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_blog_section',
      'setting' => 'eightlaw_lite_blog_setting_option',
      'choices' => array(
         'enable' => __('Enable', 'eightlaw-lite'),
         'disable' => __('Disable', 'eightlaw-lite'),
      )
   ));
   
   //blog section Title
   $wp_customize->add_setting('eightlaw_lite_blog_title', array(
		'default' => __('Blog','eightlaw-lite'),
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
	));
    
    $wp_customize->add_control('eightlaw_lite_blog_title',array(
        'type' => 'text',
        'label' => __('Blog Section Title','eightlaw-lite'),
        'section' => 'eightlaw_lite_blog_section',
        'setting' => 'eightlaw_lite_blog_title'
    ));
    //Blog content
   $wp_customize->add_setting('eightlaw_lite_blog_description', array(
    'default' => '',
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
  ));
    
    $wp_customize->add_control('eightlaw_lite_blog_description',array(
        'type' => 'textarea',
        'label' => __('Blog Section Description','eightlaw-lite'),
        'section' => 'eightlaw_lite_blog_section',
        'setting' => 'eightlaw_lite_blog_description'
    ));
    
   
   
   //select category for blog
   $wp_customize->add_setting('eightlaw_lite_blog_setting_category',array(
        'default' => '0',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
   ));
   
   $wp_customize->add_control( new Eightlaw_lite_Customize_Category_Control( $wp_customize,'eightlaw_lite_blog_setting_category', array(
        'label' => __('Select a category to show in blog section','eightlaw-lite'),
        'section' => 'eightlaw_lite_blog_section',
    )));
    
    /**
    * BCT Section
    * Benefit Clients and testimonial combination
    * Three Section combine in one section
    * @since 2.0.0
    */

    //Homepage Benefits Section
   $wp_customize->add_section('eightlaw_lite_bct_section', array(
        'priority' => 79,
        'title' => esc_html__('BCT Section', 'eightlaw-lite'),
        'description' => esc_html__('Settings for Benefit tab, client and testimonial slider.', 'eightlaw-lite'),
        'panel' => 'eightlaw_lite_homepage_settings',
  ));

  //   //Homepage Benefits Section
  //  $wp_customize->add_section('eightlaw_lite_benefit_section', array(
  //       'priority' => 79,
  //       'title' => __('Benefits Section', 'eightlaw-lite'),
  //       'panel' => 'eightlaw_lite_homepage_settings',
  // ));
    
    //enable disable benefit section
    $wp_customize->add_setting('eightlaw_lite_benefit_setting_option', array(
      'default' => 'disable',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_enabledisable',
   ));

   $wp_customize->add_control('eightlaw_lite_benefit_setting_option', array(
      'type' => 'radio',
      'label' => __('Enable Disable Benefit Section', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_bct_section',
      'setting' => 'eightlaw_lite_benefit_setting_option',
      'choices' => array(
         'enable' => __('Enable', 'eightlaw-lite'),
         'disable' => __('Disable', 'eightlaw-lite'),
      )
   ));
   
   //benefit section Title
   $wp_customize->add_setting('eightlaw_lite_benefit_title', array(
    'default' => __('Benefits','eightlaw-lite'),
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
  ));
    
    $wp_customize->add_control('eightlaw_lite_benefit_title',array(
        'type' => 'text',
        'label' => __('Benefit Section Title','eightlaw-lite'),
        'section' => 'eightlaw_lite_bct_section',
        'setting' => 'eightlaw_lite_benefit_title'
    ));
    
   //select category for benefit
   $wp_customize->add_setting('eightlaw_lite_benefit_setting_category',array(
        'default' => '0',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
   ));
   
   $wp_customize->add_control( new Eightlaw_lite_Customize_Category_Control( $wp_customize,'eightlaw_lite_benefit_setting_category', array(
        'label' => __('Select a category to show in benefit section','eightlaw-lite'),
        'section' => 'eightlaw_lite_bct_section',
    )));
   //read more text for single benefits
   $wp_customize->add_setting('eightlaw_lite_benefit_single_readmore', array(
    'default' => __('View More','eightlaw-lite'),
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
  ));
    
    $wp_customize->add_control('eightlaw_lite_benefit_single_readmore',array(
        'type' => 'text',
        'label' => __('Details','eightlaw-lite'),
        'section' => 'eightlaw_lite_bct_section',
        'setting' => 'eightlaw_lite_benefit_single_readmore'
    ));
  //   //homepage Client Logo section
  //   $wp_customize->add_section('eightlaw_lite_clientlogo_section', array(
  //       'priority' => 80,
  //       'title' => __('Client Logo Section', 'eightlaw-lite'),
  //       'panel' => 'eightlaw_lite_homepage_settings',
  // ));
    
    //enable disable clientlogo section
    $wp_customize->add_setting('eightlaw_lite_clientlogo_setting_option', array(
      'default' => 'disable',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_enabledisable',
   ));

   $wp_customize->add_control('eightlaw_lite_clientlogo_setting_option', array(
      'type' => 'radio',
      'label' => __('Enable Disable Client Logo Section', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_bct_section',
      'setting' => 'eightlaw_lite_clientlogo_setting_option',
      'choices' => array(
         'enable' => __('Enable', 'eightlaw-lite'),
         'disable' => __('Disable', 'eightlaw-lite'),
      )
   ));
   //clientlogo section Title
   $wp_customize->add_setting('eightlaw_lite_clientlogo_title', array(
    'default' => __('Client Logo','eightlaw-lite'),
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
  ));
    
    $wp_customize->add_control('eightlaw_lite_clientlogo_title',array(
        'type' => 'text',
        'label' => __('Client\'s Title','eightlaw-lite'),
        'section' => 'eightlaw_lite_bct_section',
        'setting' => 'eightlaw_lite_clientlogo_title'
    ));   
    
    //select category for client logos
   $wp_customize->add_setting('eightlaw_lite_clientlogo_category_setting',array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
   ));
   
   $wp_customize->add_control( new Eightlaw_lite_Customize_Category_Control( $wp_customize,'eightlaw_lite_clientlogo_category_setting', array(
        'label' => __('Select a Category to show in Client Logo Section','eightlaw-lite'),
        'section' => 'eightlaw_lite_bct_section',
    )));

    
 //    //Homepage Testimonial Section
 //   $wp_customize->add_section('eightlaw_lite_testimonial_section', array(
 //       	'priority' => 89,
 //       	'title' => __('Testimonial Section', 'eightlaw-lite'),
 //       	'panel' => 'eightlaw_lite_homepage_settings',
	// ));
    
    //enable disable testimonial section
    $wp_customize->add_setting('eightlaw_lite_testimonial_setting_option', array(
      'default' => 'disable',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_enabledisable',
   ));

   $wp_customize->add_control('eightlaw_lite_testimonial_setting_option', array(
      'type' => 'radio',
      'label' => __('Enable Disable Testimonial Section', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_bct_section',
      'setting' => 'eightlaw_lite_testimonial_setting_option',
      'choices' => array(
         'enable' => __('Enable', 'eightlaw-lite'),
         'disable' => __('Disable', 'eightlaw-lite'),
      )
   ));
   
   //testimonial section Title
   $wp_customize->add_setting('eightlaw_lite_testimonial_title', array(
		'default' => 'Testimonials',
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
	));
    
    $wp_customize->add_control('eightlaw_lite_testimonial_title',array(
        'type' => 'text',
        'label' => __('Testimonial Section Title','eightlaw-lite'),
        'section' => 'eightlaw_lite_bct_section',
        'setting' => 'eightlaw_lite_testimonial_title'
    ));
    
   //select category for testimonial
   $wp_customize->add_setting('eightlaw_lite_testimonial_setting_category',array(
        'default' => '0',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
   ));
   
   $wp_customize->add_control( new Eightlaw_lite_Customize_Category_Control( $wp_customize,'eightlaw_lite_testimonial_setting_category', array(
        'label' => __('Select a category to show in testimonial section','eightlaw-lite'),
        'section' => 'eightlaw_lite_bct_section',
    )));
    
    /**
    * Latest Section
    * Latest Post and News combination
    * Two Section combine in one section
    * @since 2.0.0
    */
   
   //Homepage Latest Section
   $wp_customize->add_section('eightlaw_lite_latest_section', array(
        'priority' => 120,
        'title' => __('Latest Section', 'eightlaw-lite'),
        'description' => esc_html__('Settings for Latest Post and News.', 'eightlaw-lite'),
        'panel' => 'eightlaw_lite_homepage_settings',
  ));
   
  //  //Homepage Latest Post Section
  //  $wp_customize->add_section('eightlaw_lite_latestpost_section', array(
  //       'priority' => 120,
  //       'title' => __('Latest Post Section', 'eightlaw-lite'),
  //       'panel' => 'eightlaw_lite_homepage_settings',
  // ));
    
    //enable disable latestpost section
    $wp_customize->add_setting('eightlaw_lite_latestpost_setting_option', array(
      'default' => 'disable',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_enabledisable',
   ));

   $wp_customize->add_control('eightlaw_lite_latestpost_setting_option', array(
      'type' => 'radio',
      'label' => __('Enable Disable Latest Post Section', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_latest_section',
      'setting' => 'eightlaw_lite_latestpost_setting_option',
      'choices' => array(
         'enable' => __('Enable', 'eightlaw-lite'),
         'disable' => __('Disable', 'eightlaw-lite'),
      )
   ));
   
   //latest post section Title   
   $wp_customize->add_setting('eightlaw_lite_latestpost_title', array(
    'default' => __('Latest Posts','eightlaw-lite'),
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
  ));
    
    $wp_customize->add_control('eightlaw_lite_latestpost_title',array(
        'type' => 'text',
        'label' => __('Latestpost Section Title','eightlaw-lite'),
        'section' => 'eightlaw_lite_latest_section',
        'setting' => 'eightlaw_lite_latestpost_title'
    ));
    //latest post section numbers   
   $wp_customize->add_setting('eightlaw_lite_latestpost_num', array(
    'default' => '5',
        'sanitize_callback' => 'eightlaw_lite_integer_sanitize',
  ));
    
    $wp_customize->add_control('eightlaw_lite_latestpost_num',array(
        'type' => 'number',
        'label' => __('No. of Latest post','eightlaw-lite'),
        'section' => 'eightlaw_lite_latest_section',
        'setting' => 'eightlaw_lite_latestpost_title'
    ));
    //latestposts readmore text
   $wp_customize->add_setting('eightlaw_lite_latestpost_readmore', array(
    'default' =>  __('Read More','eightlaw-lite'),
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
  ));
    
    $wp_customize->add_control('eightlaw_lite_latestpost_readmore',array(
        'type' => 'text',
        'label' => __('Latest Posts Read More Button Text','eightlaw-lite'),
        'section' => 'eightlaw_lite_latest_section',
        'setting' => 'eightlaw_lite_latestpost_readmore'
    )); 
  //   //Homepage Latest News Section
  //  $wp_customize->add_section('eightlaw_lite_latestnews_section', array(
  //       'priority' => 130,
  //       'title' => __('Latest News Section', 'eightlaw-lite'),
  //       'panel' => 'eightlaw_lite_homepage_settings',
  // ));
    
    //enable disable latestnews section
    $wp_customize->add_setting('eightlaw_lite_latestnews_setting_option', array(
      'default' => 'disable',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_enabledisable',
   ));

   $wp_customize->add_control('eightlaw_lite_latestnews_setting_option', array(
      'type' => 'radio',
      'label' => __('Enable Disable Latest News Section', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_latest_section',
      'setting' => 'eightlaw_lite_latestnews_setting_option',
      'choices' => array(
         'enable' => __('Enable', 'eightlaw-lite'),
         'disable' => __('Disable', 'eightlaw-lite'),
      )
   ));
   //latestnews section Title
   $wp_customize->add_setting('eightlaw_lite_latestnews_title', array(
    'default' =>  __('Latest News','eightlaw-lite'),
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
  ));
    
    $wp_customize->add_control('eightlaw_lite_latestnews_title',array(
        'type' => 'text',
        'label' => __('Latestnews Section Title','eightlaw-lite'),
        'section' => 'eightlaw_lite_latest_section',
        'setting' => 'eightlaw_lite_latestnews_title'
    ));
   //latestnews Read more
   $wp_customize->add_setting('eightlaw_lite_latestnews_readmore', array(
    'default' =>  __('Read More','eightlaw-lite'),
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
  ));
    
    $wp_customize->add_control('eightlaw_lite_latestnews_readmore',array(
        'type' => 'text',
        'label' => __('Latest News Read More Button Text','eightlaw-lite'),
        'section' => 'eightlaw_lite_latest_section',
        'setting' => 'eightlaw_lite_latestnews_readmore'
    ));
//select category for latest news
   $wp_customize->add_setting('eightlaw_lite_latestnews_setting_category',array(
        'default' => '0',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
   ));
   
   $wp_customize->add_control( new Eightlaw_lite_Customize_Category_Control( $wp_customize,'eightlaw_lite_latestnews_setting_category', array(
        'label' => __('Select a Category to show in Latestnews Section','eightlaw-lite'),
        'section' => 'eightlaw_lite_latest_section',
        'setting' => 'eightlaw_lite_latestnews_setting_category'
    )));
    
    
    /** Contact Form Section */
    $wp_customize->add_section('eightlaw_lite_contact_form_section', array(
       	'priority' => 110,
       	'title' => __('Contact Form Section', 'eightlaw-lite'),
       	'panel' => 'eightlaw_lite_homepage_settings',
	));
    
    //enable disable contact form section
    $wp_customize->add_setting('eightlaw_lite_contact_form_option', array(
      'default' => 'disable',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_enabledisable',
    ));
    
    $wp_customize->add_control('eightlaw_lite_contact_form_option', array(
      'type' => 'radio',
      'label' => __('Enable Disable Contact Form Section', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_contact_form_section',
      'setting' => 'eightlaw_lite_contact_form_option',
      'choices' => array(
         'enable' => __('Enable', 'eightlaw-lite'),
         'disable' => __('Disable', 'eightlaw-lite'),
      )
    ));
    
    //select contact form 7
    $wp_customize->add_setting('eightlaw_lite_contact_form',array(
        'default' => 0,
        'sanitize_callback' => 'eightlaw_lite_integer_sanitize',
        'capability' => 'edit_theme_options',
   ));
   
   $wp_customize->add_control( new Eightlaw_Lite_Contact_Form_Post_Dropdown( $wp_customize,'eightlaw_lite_contact_form', array(
        'label' => __('Select a Contact Form','eightlaw-lite'),
        'section' => 'eightlaw_lite_contact_form_section',
    )));
      
    //Contact Form title
   $wp_customize->add_setting('eightlaw_lite_contact_form_title', array(
		'default' => __('Contact Us, Its Free','eightlaw-lite'),
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
	));
    
    $wp_customize->add_control('eightlaw_lite_contact_form_title',array(
        'type' => 'text',
        'label' => __('Contact Form Title','eightlaw-lite'),
        'section' => 'eightlaw_lite_contact_form_section',
        'setting' => 'eightlaw_lite_contact_form_title'
    ));
    
   /** Law section */
   $wp_customize->add_section('eightlaw_lite_law_section', array(
       	'priority' => 40,
       	'title' => __('Law Section', 'eightlaw-lite'),
       	'panel' => 'eightlaw_lite_homepage_settings',
	));
    
    //enable disable feature section
    $wp_customize->add_setting('eightlaw_lite_law_option', array(
      'default' => 'disable',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_enabledisable',
   ));

   $wp_customize->add_control('eightlaw_lite_law_option', array(
      'type' => 'radio',
      'label' => __('Enable Disable Law Section', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_law_section',
      'setting' => 'eightlaw_lite_law_option',
      'choices' => array(
         'enable' => __('Enable', 'eightlaw-lite'),
         'disable' => __('Disable', 'eightlaw-lite'),
      )
   ));
   //Law section Title
   $wp_customize->add_setting('eightlaw_lite_law_title', array(
   'default' => __('We fight for you','eightlaw-lite'),
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
  ));
    
    $wp_customize->add_control('eightlaw_lite_law_title',array(
        'type' => 'text',
        'label' => __('Law Section Title','eightlaw-lite'),
        'section' => 'eightlaw_lite_law_section',
        'setting' => 'eightlaw_lite_law_title'
    ));
    
    //Feature section description
   $wp_customize->add_setting('eightlaw_lite_law_desc', array(
   'default' => '',
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
  ));
    
    $wp_customize->add_control('eightlaw_lite_law_desc',array(
        'type' => 'textarea',
        'label' => __('Law Section Description','eightlaw-lite'),
        'section' => 'eightlaw_lite_law_section',
        'setting' => 'eightlaw_lite_law_desc'
    ));
   //select post for law post 1
   $wp_customize->add_setting('eightlaw_lite_law_post1',array(
        'default' => '',
        'sanitize_callback' => 'eightlaw_lite_integer_sanitize',
        'capability' => 'edit_theme_options',
   ));
   
   $wp_customize->add_control('eightlaw_lite_law_post1', array(
        'type' => 'select',
        'label' => __('Law Post 1','eightlaw-lite'),
        'section' => 'eightlaw_lite_law_section',
        'setting' => 'eightlaw_lite_law_post1',
        'choices' => $options_posts
    ));
    
    //icon
    $wp_customize->add_setting(
        'eightlaw_lite_law_post_one_icon',
        array(
            'default' => 'fa-trophy',
            'sanitize_callback' => 'eightlaw_lite_sanitize_text',
            )
    );
    
    $wp_customize->add_control(
        'eightlaw_lite_law_post_one_icon',
        array(
            'section' => 'eightlaw_lite_law_section',
            'description' => __( 'Font Awesome icon name </br> Example: fa-trophy', 'eightlaw-lite' ),
            'type' => 'text',
        )
    );
    
    //select post for law post 2
   $wp_customize->add_setting('eightlaw_lite_law_post2',array(
        'default' => '',
        'sanitize_callback' => 'eightlaw_lite_integer_sanitize',
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage'
   ));
   
   $wp_customize->add_control('eightlaw_lite_law_post2', array(
        'type' => 'select',
        'label' => __('Law Post 2','eightlaw-lite'),
        'section' => 'eightlaw_lite_law_section',
        'setting' => 'eightlaw_lite_law_post2',
        'choices' => $options_posts
    ));
    
    //icon
    $wp_customize->add_setting(
        'eightlaw_lite_law_post_two_icon',
        array(
            'default' => 'fa-print',
            'sanitize_callback' => 'eightlaw_lite_sanitize_text',
            )
    );
    
    $wp_customize->add_control(
        'eightlaw_lite_law_post_two_icon',
        array(
            'section' => 'eightlaw_lite_law_section',
            'description' => __( 'Font Awesome icon name </br> Example: fa-print', 'eightlaw-lite' ),
            'type' => 'text',
        )
    );
    
    //select post for law post3
   $wp_customize->add_setting('eightlaw_lite_law_post3',array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'eightlaw_lite_integer_sanitize',
        'transport' => 'postMessage'
   ));
   
   $wp_customize->add_control('eightlaw_lite_law_post3', array(
        'type' => 'select',
        'label' => __('Law Post 3','eightlaw-lite'),
        'section' => 'eightlaw_lite_law_section',
        'setting' => 'eightlaw_lite_law_post3',
        'choices' => $options_posts
    ));
    
    //icon
    $wp_customize->add_setting(
        'eightlaw_lite_law_post_three_icon',
        array(
            'default' => 'fa-group',
            'sanitize_callback' => 'eightlaw_lite_sanitize_text',
            )
    );
    
    $wp_customize->add_control(
        'eightlaw_lite_law_post_three_icon',
        array(
            'section' => 'eightlaw_lite_law_section',
            'description' => __( 'Font Awesome icon name </br> Example: fa-group', 'eightlaw-lite' ),
            'type' => 'text',
        )
    );      
   
   //Law Know more text
   $wp_customize->add_setting('eightlaw_lite_law_button_text', array(
		'default' => __('Know More','eightlaw-lite'),
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
        'transport' => 'postMessage'
	));
    
    $wp_customize->add_control('eightlaw_lite_law_button_text',array(
        'type' => 'text',
        'label' => __('Button Text','eightlaw-lite'),
        'section' => 'eightlaw_lite_law_section',
        'setting' => 'eightlaw_lite_law_button_text'
    ));
    //Law button link
    $wp_customize->add_setting(
        'eightlaw_lite_law_button_link',
        array(
            'default' => '#',
            'sanitize_callback' => 'esc_url_raw',
            )
    );
    
    $wp_customize->add_control(
        'eightlaw_lite_law_button_link',
        array(
            'label' => __( 'Button Link' , 'eightlaw-lite' ),
            'section' => 'eightlaw_lite_law_section',
            'type' => 'text',
        )
    ); 
     
       
   
   
    
   //Social Settings panel
    $wp_customize->add_panel('eightlaw_lite_social_setting', array(
      'capabitity' => 'edit_theme_options',
      'priority' => 60,
      'title' => __('Social Settings', 'eightlaw-lite')
   ));
   
   //social Settings section
   $wp_customize->add_section('eightlaw_lite_social_setting', array(
       	'priority' => 10,
       	'title' => __('Social Section', 'eightlaw-lite'),
       	'panel' => 'eightlaw_lite_social_setting',
	));
    
    //socail setting in header
    $wp_customize->add_setting('eightlaw_lite_social_setting_option_header', array(
      'default' => 'disable',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_enabledisable',
   ));

   $wp_customize->add_control('eightlaw_lite_social_setting_option_header', array(
      'type' => 'radio',
      'label' => __('Enable Disable Social Icons in Header', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_social_setting',
      'setting' => 'eightlaw_lite_social_setting_option_header',
      'choices' => array(
         'enable' => __('Enable', 'eightlaw-lite'),
         'disable' => __('Disable', 'eightlaw-lite'),
      )
   ));
    
    $wp_customize->add_setting('eightlaw_lite_social_setting_option_footer', array(
      'default' => 'disable',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_enabledisable',
   ));

   $wp_customize->add_control('eightlaw_lite_social_setting_option_footer', array(
      'type' => 'radio',
      'label' => __('Enable Disable Social Icons in Footer', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_social_setting',
      'setting' => 'eightlaw_lite_social_setting_option_footer',
      'choices' => array(
         'enable' => __('Enable', 'eightlaw-lite'),
         'disable' => __('Disable', 'eightlaw-lite'),
      )
   ));
   
   //social facebook link
   $wp_customize->add_setting('eightlaw_lite_social_facebook', array(
		'default' => '#',
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
	));
    
    $wp_customize->add_control('eightlaw_lite_social_facebook',array(
        'type' => 'text',
        'label' => __('Facebook','eightlaw-lite'),
        'section' => 'eightlaw_lite_social_setting',
        'setting' => 'eightlaw_lite_social_facebook'
    ));
    
    //social twitter link
   $wp_customize->add_setting('eightlaw_lite_social_twitter', array(
		'default' => '#',
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
	));
    
    $wp_customize->add_control('eightlaw_lite_social_twitter',array(
        'type' => 'text',
        'label' => __('Twitter','eightlaw-lite'),
        'section' => 'eightlaw_lite_social_setting',
        'setting' => 'eightlaw_lite_social_twitter'
    ));
    
    //social googleplus link
   $wp_customize->add_setting('eightlaw_lite_social_googleplus', array(
		'default' => '#',
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
	));
    
    $wp_customize->add_control('eightlaw_lite_social_googleplus',array(
        'type' => 'text',
        'label' => __('Google Plus','eightlaw-lite'),
        'section' => 'eightlaw_lite_social_setting',
        'setting' => 'eightlaw_lite_social_googleplus'
    ));
    
     //social youtube link
   $wp_customize->add_setting('eightlaw_lite_social_youtube', array(
		'default' => '#',
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
	));
    
    $wp_customize->add_control('eightlaw_lite_social_youtube',array(
        'type' => 'text',
        'label' => __('YouTube','eightlaw-lite'),
        'section' => 'eightlaw_lite_social_setting',
        'setting' => 'eightlaw_lite_social_youtube'
    ));
    
     //social pinterest link
   $wp_customize->add_setting('eightlaw_lite_social_pinterest', array(
		'default' => '',
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
	));
    
    $wp_customize->add_control('eightlaw_lite_social_pinterest',array(
        'type' => 'text',
        'label' => __('Pinterest','eightlaw-lite'),
        'section' => 'eightlaw_lite_social_setting',
        'setting' => 'eightlaw_lite_social_pinterest'
    ));
    
    //social linkedin link
   $wp_customize->add_setting('eightlaw_lite_social_linkedin', array(
		'default' => '',
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
	));
    
    $wp_customize->add_control('eightlaw_lite_social_linkedin',array(
        'type' => 'text',
        'label' => __('Linkedin','eightlaw-lite'),
        'section' => 'eightlaw_lite_social_setting',
        'setting' => 'eightlaw_lite_social_linkedin'
    ));
    
    //social flicker link
   $wp_customize->add_setting('eightlaw_lite_social_flicker', array(
		'default' => '',
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
	));
    
    $wp_customize->add_control('eightlaw_lite_social_flicker',array(
        'type' => 'text',
        'label' => __('Flicker','eightlaw-lite'),
        'section' => 'eightlaw_lite_social_setting',
        'setting' => 'eightlaw_lite_social_flicker'
    ));
    
    
    //social vimeo link
   $wp_customize->add_setting('eightlaw_lite_social_vimeo', array(
		'default' => '',
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
	));
    
    $wp_customize->add_control('eightlaw_lite_social_vimeo',array(
        'type' => 'text',
        'label' => __('Vimeo','eightlaw-lite'),
        'section' => 'eightlaw_lite_social_setting',
        'setting' => 'eightlaw_lite_social_vimeo'
    ));
    
    //social stumbleupon link
   $wp_customize->add_setting('eightlaw_lite_social_stumbleupon', array(
		'default' => '',
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
	));
    
    $wp_customize->add_control('eightlaw_lite_social_flicker',array(
        'type' => 'text',
        'label' => __('Stumbleupon','eightlaw-lite'),
        'section' => 'eightlaw_lite_social_setting',
        'setting' => 'eightlaw_lite_social_stumbleupon'
    ));
    
    //social instagram link
   $wp_customize->add_setting('eightlaw_lite_social_instagram', array(
		'default' => '',
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
	));
    
    $wp_customize->add_control('eightlaw_lite_social_instagram',array(
        'type' => 'text',
        'label' => __('Instagram','eightlaw-lite'),
        'section' => 'eightlaw_lite_social_setting',
        'setting' => 'eightlaw_lite_social_instagram'
    ));
    
    //social soundcloud link
   $wp_customize->add_setting('eightlaw_lite_social_soundcloud', array(
		'default' => '',
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
	));
    
    $wp_customize->add_control('eightlaw_lite_social_soundcloud',array(
        'type' => 'text',
        'label' => __('Sound Cloud','eightlaw-lite'),
        'section' => 'eightlaw_lite_social_setting',
        'setting' => 'eightlaw_lite_social_soundcloud'
    ));
    
    //social github link
   $wp_customize->add_setting('eightlaw_lite_social_github', array(
		'default' => '',
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
	));
    
    $wp_customize->add_control('eightlaw_lite_social_github',array(
        'type' => 'text',
        'label' => __('Git Hub','eightlaw-lite'),
        'section' => 'eightlaw_lite_social_setting',
        'setting' => 'eightlaw_lite_social_github'
    ));
    
    //social tumbler link
   $wp_customize->add_setting('eightlaw_lite_social_tumbler', array(
		'default' => '',
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
	));
    
    $wp_customize->add_control('eightlaw_lite_social_tumbler',array(
        'type' => 'text',
        'label' => __('Tumbler','eightlaw-lite'),
        'section' => 'eightlaw_lite_social_setting',
        'setting' => 'eightlaw_lite_social_tumbler'
    ));
    
    //social skype link
   $wp_customize->add_setting('eightlaw_lite_social_skype', array(
		'default' => '',
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
	));
    
    $wp_customize->add_control('eightlaw_lite_social_skype',array(
        'type' => 'text',
        'label' => __('Skype','eightlaw-lite'),
        'section' => 'eightlaw_lite_social_setting',
        'setting' => 'eightlaw_lite_social_skype'
    ));
    
    //social Rss link
   $wp_customize->add_setting('eightlaw_lite_social_rss', array(
		'default' => '',
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
	));
    
    $wp_customize->add_control('eightlaw_lite_social_rss',array(
        'type' => 'text',
        'label' => __('RSS','eightlaw-lite'),
        'section' => 'eightlaw_lite_social_setting',
        'setting' => 'eightlaw_lite_social_rss'
    ));
       
    //Archive Page Settings panel
    $wp_customize->add_panel('eightlaw_lite_archive_setting', array(
      'capabitity' => 'edit_theme_options',
      'priority' => 70,
      'title' => __('Innerpage Settings', 'eightlaw-lite')
   ));
   
   //Archive Page Settings section : testimonial
   $wp_customize->add_section('eightlaw_lite_archive_setting_testimonial', array(
       	'priority' => 10,
       	'title' => __('Testimonial', 'eightlaw-lite'),
       	'panel' => 'eightlaw_lite_archive_setting',
	));
    
    //Archive Page setting Testimonial layout
    $wp_customize->add_setting('eightlaw_lite_archive_setting_testimonial_layout', array(
      'default' => 'grid',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_listgrid',
   ));

   $wp_customize->add_control('eightlaw_lite_archive_setting_testimonial_layout', array(
      'type' => 'radio',
      'label' => __('Testimonial Layout', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_archive_setting_testimonial',
      'setting' => 'eightlaw_lite_archive_setting_testimonial_layout',
      'choices' => array(
         'grid' => __('Grid', 'eightlaw-lite'),
         'list' => __('List', 'eightlaw-lite'),
      )
   ));
   
    //Archive Page Settings section : Blog Section
   $wp_customize->add_section('eightlaw_lite_archive_setting_blog', array(
        'priority' => 15,
        'title' => __('Blog', 'eightlaw-lite'),
        'panel' => 'eightlaw_lite_archive_setting',
  ));
    
    //Archive Page setting Blog layout
    $wp_customize->add_setting('eightlaw_lite_archive_setting_blog_layout', array(
      'default' => 'large',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_blog_layout',
   ));

   $wp_customize->add_control('eightlaw_lite_archive_setting_blog_layout', array(
      'type' => 'radio',
      'label' => __('Blog Layout', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_archive_setting_blog',
      'setting' => 'eightlaw_lite_archive_setting_blog_layout',
      'choices' => array(
        'large' => __('Large Image', 'eightlaw-lite'),
         'medium' => __('Medium Image', 'eightlaw-lite'),
         'alternate' => __('Alternate Image', 'eightlaw-lite')
      )
   ));   
   
    //Archive Page Settings section : Blog Section
   $wp_customize->add_section('eightlaw_lite_archive_setting_blog', array(
        'priority' => 15,
        'title' => __('Blog', 'eightlaw-lite'),
        'panel' => 'eightlaw_lite_archive_setting',
  ));
    
    //Archive page archives 
   
    //Archive Page Settings section : Blog Section
   $wp_customize->add_section('eightlaw_lite_archive_setting_archive', array(
        'priority' => 15,
        'title' => __('Archive', 'eightlaw-lite'),
        'panel' => 'eightlaw_lite_archive_setting',
  ));
   $wp_customize->add_setting('eightlaw_lite_archive_setting_archive_layout', array(
      'default' => 'list',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_listgrid',
   ));

   $wp_customize->add_control('eightlaw_lite_archive_setting_archive_layout', array(
      'type' => 'radio',
      'label' => __('Archive Layout', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_archive_setting_archive',
      'setting' => 'eightlaw_lite_archive_setting_archive_layout',
      'choices' => array(
         'grid' => __('Grid', 'eightlaw-lite'),
         'list' => __('List', 'eightlaw-lite'),
      )
   ));
   $wp_customize->add_setting('eightlaw_lite_archive_setting_archive_readmore', array(
		'default' => __('Read More','eightlaw-lite'),
        'sanitize_callback' => 'eightlaw_lite_sanitize_text',
	));
    
    $wp_customize->add_control('eightlaw_lite_archive_setting_archive_readmore',array(
        'type' => 'text',
        'label' => __('Read More Text for Archive list','eightlaw-lite'),
        'section' => 'eightlaw_lite_archive_setting_archive',
        'setting' => 'eightlaw_lite_archive_setting_archive_readmore'
    ));
   
   //Archive Page Settings section : teammember
   $wp_customize->add_section('eightlaw_lite_archive_setting_teammember', array(
       	'priority' => 30,
       	'title' => __('Team Member', 'eightlaw-lite'),
       	'panel' => 'eightlaw_lite_archive_setting',
	));
    
    //Archive Page setting teammember layout
    $wp_customize->add_setting('eightlaw_lite_archive_setting_teammember_layout', array(
      'default' => 'grid',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_listgrid',
   ));

   $wp_customize->add_control('eightlaw_lite_archive_setting_teammember_layout', array(
      'type' => 'radio',
      'label' => __('Team Member Layout', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_archive_setting_teammember',
      'setting' => 'eightlaw_lite_archive_setting_teammember_layout',
      'choices' => array(
         'grid' => __('Grid', 'eightlaw-lite'),
         'list' => __('List', 'eightlaw-lite'),
      )
   ));
    //Archive pages sidebar section
    $wp_customize->add_section(
        'eightlaw_lite_archive_setting_sidebar',
        array(
          'title' => __('Sidebar Layout', 'eightlaw-lite'),
          'panel' => 'eightlaw_lite_archive_setting'
          )
      );
    $wp_customize->add_setting(
      'eightlaw_lite_archive_setting_sidebar_option',
      array(
        'default' =>  'right-sidebar',
        'sanitize_callback' =>  'eightlaw_lite_radio_sanitize_archive_sidebar'
        )
      );  
    $wp_customize->add_control(
      'eightlaw_lite_archive_setting_sidebar_option',
      array(
        'description' => __('Choose the sidebar Layout for the archive page','eightlaw-lite'),
        'section' => 'eightlaw_lite_archive_setting_sidebar',
        'type'    =>  'radio',
        'choices' =>  array(
            'left-sidebar' =>  __('Left Sidebar','eightlaw-lite'),
            'right-sidebar' =>  __('Right Sidebar','eightlaw-lite'),
            'both-sidebar' =>  __('Both Sidebar','eightlaw-lite'),
            'no-sidebar' =>  __('No Sidebar','eightlaw-lite'),
          )
        )
      );

    //single post
    $wp_customize->add_section(
        'eightlaw_lite_single_post_setting',
        array(
          'title' => __('Sngle Post', 'eightlaw-lite'),
          'panel' => 'eightlaw_lite_archive_setting'
          )
      );

    $wp_customize->add_setting('eightlaw_lite_feat_img_option', array(
      'default' => 'enable',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightlaw_lite_radio_sanitize_enabledisable',
   ));

   $wp_customize->add_control('eightlaw_lite_feat_img_option', array(
      'type' => 'radio',
      'label' => __('Enable Disable Feature Image', 'eightlaw-lite'),
      'section' => 'eightlaw_lite_single_post_setting',
      'setting' => 'eightlaw_lite_feat_img_option',
      'choices' => array(
         'enable' => __('Enable', 'eightlaw-lite'),
         'disable' => __('Disable', 'eightlaw-lite'),
      )
   ));
   
   // Banner setting
    $wp_customize->add_panel( 
        'eightlaw_lite_single_setting',
         array(
            'priority' => 95,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => __( 'Banner Setting', 'eightlaw-lite' ),
        ) 
    );
    
        
    // single Page banner image
    $wp_customize -> add_section(
        'eightlaw_lite_single_setting_page_banner_image',
        array(
            'title' => __('Single Page Banner Image','eightlaw-lite'),
            'priority' => 20,
            'panel' => 'eightlaw_lite_single_setting',
        )
    );  
    $wp_customize -> add_setting(
        'eightlaw_lite_single_setting_page_banner_image_option',
        array(
            'default'     => '',
            'sanitize_callback' =>  'esc_url_raw'
        )
    );
    $wp_customize-> add_control( new WP_Customize_Image_Control($wp_customize,'eightlaw_lite_single_setting_page_banner_image_option', 
          array(
        'settings'     => 'eightlaw_lite_single_setting_page_banner_image_option',
        'label'       => __( 'Banner Image', 'eightlaw-lite' ),
        'help'        => __( 'This Image will be used in single page Banner section background imgae', 'eightlaw-lite' ),
        'section'     => 'eightlaw_lite_single_setting_page_banner_image',
        'priority'    => 20,
    ) 
    )); 
      // single Post banner image
    $wp_customize -> add_section(
        'eightlaw_lite_single_setting_post_banner_image',
        array(
            'title' => __('Single Post Banner Image','eightlaw-lite'),
            'priority' => 20,
            'panel' => 'eightlaw_lite_single_setting',
        )
    );  
    $wp_customize -> add_setting(
        'eightlaw_lite_single_setting_post_banner_image_option',
        array(
            'default'     => '',
            'sanitize_callback' =>  'esc_url_raw'
        )
    );
    $wp_customize-> add_control( new WP_Customize_Image_Control($wp_customize,'eightlaw_lite_single_setting_post_banner_image_option', 
          array(
        'settings'     => 'eightlaw_lite_single_setting_post_banner_image_option',
        'label'       => __( 'Banner Image', 'eightlaw-lite' ),
        'help'        => __( 'This Image will be used in single post banner section background imgae', 'eightlaw-lite' ),
        'section'     => 'eightlaw_lite_single_setting_post_banner_image',
        'priority'    => 20,
    ) 
    ));
      
            // single category banner image
    $wp_customize -> add_section(
        'eightlaw_lite_single_setting_category_banner_image',
        array(
            'title' => __('Archive Banner Image','eightlaw-lite'),
            'priority' => 20,
            'panel' => 'eightlaw_lite_single_setting',
        )
    );  
    $wp_customize -> add_setting(
        'eightlaw_lite_single_setting_category_banner_image_option',
        array(
            'default'     => '',
            'sanitize_callback' =>  'esc_url_raw'
        )
    );
    $wp_customize-> add_control( new WP_Customize_Image_Control($wp_customize,'eightlaw_lite_single_setting_category_banner_image_option', 
          array(
        'settings'     => 'eightlaw_lite_single_setting_category_banner_image_option',
        'label'       => __( 'Banner Image', 'eightlaw-lite' ),
        'help'        => __( 'This Image will be used in single category banner section background imgae', 'eightlaw-lite' ),
        'section'     => 'eightlaw_lite_single_setting_category_banner_image',
        'priority'    => 20,
    ) 
    ));


   function eightlaw_lite_sanitize_text( $input ) {
        return wp_kses_post( force_balance_tags( $input ) );
   }
   function eightlaw_lite_radio_sanitize_webpagelayout($input) {
      $valid_keys = array(
         'fullwidth' => __('Full Width', 'eightlaw-lite'),
         'boxed' => __('Boxed', 'eightlaw-lite')
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }
   function eightlaw_lite_radio_sanitize_headertype($input) {
      $valid_keys = array(
         'transparent'=>__('Transparent', 'eightlaw-lite'),
         'classic'=>__('Classic', 'eightlaw-lite')
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }
   function eightlaw_lite_radio_sanitize_alignment_logo($input) {
      $valid_keys = array(
        'left'=>__('Left', 'eightlaw-lite'),
        'center'=>__('Center', 'eightlaw-lite'),
        'right'=>__('Right', 'eightlaw-lite')
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }
   function eightlaw_lite_radio_sanitize_archive_sidebar($input) {
      $valid_keys = array(
        'left-sidebar' =>  __('Left Sidebar','eightlaw-lite'),
            'right-sidebar' =>  __('Right Sidebar','eightlaw-lite'),
            'both-sidebar' =>  __('Both Sidebar','eightlaw-lite'),
            'no-sidebar' =>  __('No Sidebar','eightlaw-lite'),
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }
   
   function eightlaw_lite_radio_sanitize_clientlogo_viewtype($input) {
        $valid_keys = array(
            'static' => __('Static', 'eightlaw-lite'),
            'scroll' => __('Scroll', 'eightlaw-lite')
          );
          if ( array_key_exists( $input, $valid_keys ) ) {
             return $input;
          } else {
             return '';
          }
   }
   function eightlaw_lite_radio_sanitize_gallery($input) {
      $valid_keys = array(
         'fullwidth' => __('Fullwidth', 'eightlaw-lite'),
         'regular' => __('Regular', 'eightlaw-lite'),
         'extended' =>  __('Extended', 'eightlaw-lite')
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }
   function eightlaw_lite_radio_sanitize_listgrid($input) {
      $valid_keys = array(
        'grid'=>__('Grid', 'eightlaw-lite'),
        'list'=>__('List', 'eightlaw-lite')
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }
   function eightlaw_lite_radio_sanitize_blog_layout($input) {
      $valid_keys = array(        
         'large' => __('Large Image', 'eightlaw-lite'),
         'medium' => __('Medium Image', 'eightlaw-lite'),
         'alternate' => __('Alternate Image', 'eightlaw-lite')
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }
   
   function eightlaw_lite_radio_sanitize_enabledisable($input) {
      $valid_keys = array(
        'enable'=>__('Enable', 'eightlaw-lite'),
        'disable'=>__('Disable', 'eightlaw-lite')
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }
   
   function eightlaw_lite_radio_sanitize_yesno($input) {
      $valid_keys = array(
        'yes'=>__('Yes', 'eightlaw-lite'),
        'no'=>__('No', 'eightlaw-lite')
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }
   // checkbox sanitization
   function eightlaw_lite_checkbox_sanitize($input) {
      if ( $input == 1 ) {
         return 1;
      } else {
         return '';
      }
   }

    function eightlaw_lite_radio_sanitize_transitiontype($input) {
      $valid_keys = array(
         'fade' => __('Fade', 'eightlaw-lite'),
          'horizontal' => __('Slide Horizontal', 'eightlaw-lite'),
          'vertical' => __('Slide Vertical', 'eightlaw-lite'),
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
    }

    function eightlaw_lite_sanitize_layout($input) {
      $valid_keys = array(
         'layout1' => __('Layout 1', 'eightlaw-lite'),
          'layout2' => __('Layout 2', 'eightlaw-lite'),
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
    }
    
   //integer sanitize
   function eightlaw_lite_integer_sanitize($input){
        return intval( $input );
   }
}
add_action( 'customize_register', 'eightlaw_lite_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function eightlaw_lite_customize_preview_js() {
	wp_enqueue_script( 'eightlaw_lite_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'eightlaw_lite_customize_preview_js' );