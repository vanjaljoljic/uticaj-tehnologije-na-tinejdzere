<?php
/**
 * Common functions.
 *
 * @package Pen
 */

defined( 'ABSPATH' ) || die();

if ( ! function_exists( 'pen_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function pen_setup() {

		if ( pen_filter_input( 'GET', 'pen_preview_color' ) || pen_filter_input( 'GET', 'pen_preview_font' ) ) {
			// Disables the "Autoptimize" plugin.
			define( 'DONOTMINIFY', true );
			// Disables the "WP Super Cache" plugin.
			define( 'DONOTCACHEPAGE', true );
		}

		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Pen, use a find and replace
		 * to change 'pen' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'pen', PEN_THEME_DIRECTORY . '/languages' );

		add_theme_support( 'responsive-embeds' );

		add_theme_support( 'editor-styles' );
		add_theme_support( 'dark-editor-style' );

		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for custom logo.
		 */
		add_theme_support( 'custom-logo', array(
				'height'      => 512,
				'width'       => 512,
				'flex-height' => true,
		) );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 225, 225, true );

		/**
		 * Adds default RSS feed links to the <head>.
		 */
		add_theme_support( 'automatic-feed-links' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary'   => esc_html__( 'Header', 'pen' ),
				'secondary' => esc_html__( 'Footer', 'pen' ),
			)
		);

		/**
		 * Switch default core markup for search form to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'gallery',
			'caption',
			'comment-form',
			'comment-list',
		) );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters(
			'pen_custom_background_args',
			array(
				'default-color' => '333333',
				'default-image' => '',
			)
		) );

		define( 'PEN_THEME_PRESET_COLOR', get_theme_mod( 'pen_preset_color', 'preset_1' ) );
		define( 'PEN_THEME_PRESET_FONT', get_theme_mod( 'pen_preset_font', 'preset_1' ) );

		pen_content_width();

		$header_width  = 3600;
		$header_height = 1000;

		$site_width = get_post_meta( pen_post_id(), 'pen_site_width_override', true );
		if ( ! $site_width || 'default' === $site_width ) {
			$site_width = pen_option_get( 'site_width' );
			if ( 'narrow' === $site_width ) {
				$header_width  = 1280;
				$header_height = 1280;
			}
		}

		$padding_header = pen_option_get( 'padding_header' );
		if ( strpos( $padding_header, 'top' ) !== false || strpos( $padding_header, 'bottom' ) !== false ) {
			$header_height = 1000;
		}

		add_theme_support( 'custom-header', apply_filters(
			'pen_custom_header_args',
			array(
				'default-image'      => '',
				'default-text-color' => '333333',
				'header-text'        => false,
				'width'              => $header_width,
				'height'             => $header_height,
				'flex-height'        => true,
			)
		) );

		$theme = wp_get_theme( 'pen' );

		define( 'PEN_THEME_VERSION', $theme->get( 'Version' ) );
		define( 'PEN_THEME_SMALLSCREEN', wp_is_mobile() );

		pen_configuration_update();

		$date_installed = get_theme_mod( 'pen_date_installed', false );
		if ( ! $date_installed ) {
			set_theme_mod( 'pen_date_installed', time() );
		}
	}
	add_action( 'after_setup_theme', 'pen_setup' );
}

if ( ! function_exists( 'pen_activation' ) ) {
	/**
	 * On theme activation.
	 *
	 * @since Pen 1.3.9
	 * @return void
	 */
	function pen_activation() {
		$date_activated = get_theme_mod( 'pen_date_activated', false );
		if ( ! $date_activated ) {
			set_theme_mod( 'pen_date_activated', time() );
		}
	}
	add_action( 'after_switch_theme', 'pen_activation' );
}

if ( ! function_exists( 'pen_deactivation' ) ) {
	/**
	 * On theme deactivation.
	 *
	 * @since Pen 1.3.9
	 * @return void
	 */
	function pen_deactivation() {
		set_theme_mod( 'pen_date_activated', false );
	}
	add_action( 'switch_theme', 'pen_deactivation' );
}

if ( ! function_exists( 'pen_archive_title_override' ) ) {
	/**
	 * Adds extra markup to archive titles.
	 *
	 * @param string $title The title.
	 * @since Pen 1.0.5
	 * @return string
	 */
	function pen_archive_title_override( $title ) {
		$output = $title;
		if ( false !== strpos( $title, ': ' ) ) {
			$title   = explode( ': ', $title );
			$output  = '<span class="pen_heading_main">';
			$output .= sprintf(
				/* Translators: Just some words. */
				__( '%s:', 'pen' ),
				$title[0]
			);
			$output .= '</span>';
			unset( $title[0] );
			$output .= implode( '', $title );
		}
		return $output;
	}
	add_filter( 'get_the_archive_title', 'pen_archive_title_override' );
}

if ( ! function_exists( 'pen_pingback' ) ) {
	/**
	 * Add a pingback URL auto-discovery header for singularly identifiable articles.
	 *
	 * @since Pen 1.0.0
	 * @return void
	 */
	function pen_pingback() {
		if ( pen_is_singular() ) {
			$content_id = pen_post_id();
			if ( $content_id && pings_open( $content_id ) ) {
				echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">';
			}
		}
	}
	add_action( 'wp_head', 'pen_pingback' );
}

if ( ! function_exists( 'pen_content_width' ) ) {
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function pen_content_width() {

		// PEN_THEME_SMALLSCREEN is not defined yet.
		if ( wp_is_mobile() ) {
			$content_width = 640;
		} else {
			$content_width = 1140;
			$site_width    = get_post_meta( pen_post_id(), 'pen_site_width_override', true );
			if ( ! $site_width || 'default' === $site_width ) {
				$site_width = pen_option_get( 'site_width' );
			}
			if ( 'narrow' === $site_width ) {
				$content_width = 640;
			} else {
				if ( 'wide' === $site_width ) {
					$content_width = 1800;
				}
				if ( is_active_sidebar( 'sidebar-left' ) || PEN_THEME_PREVIEW ) {
					$content_width = $content_width - 200;
				}
				if ( is_active_sidebar( 'sidebar-right' ) || ( PEN_THEME_PREVIEW && 'plain' === pen_filter_input( 'GET', 'pen_preview_layout' ) ) ) {
					$content_width = $content_width - 200;
				}
			}
		}
		$GLOBALS['content_width'] = apply_filters( 'pen_content_width', $content_width );
	}
}

if ( ! function_exists( 'pen_body_classes' ) ) {
	/**
	 * Adds custom classes to the array of body_class filter.
	 *
	 * @global object $post
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @since Pen 1.0.0
	 * @return array
	 */
	function pen_body_classes( $classes ) {

		$content_id = pen_post_id(); // $post->ID doesn't return the correct ID.

		$is_customize_preview = is_customize_preview();

		if ( ! is_home() && ! is_front_page() ) {
			$classes[] = 'not-home';
		}

		if ( PEN_THEME_DARK_MODE ) {
			$dark_mode = pen_option_get( 'dark_mode' );
			if ( 'none' !== $dark_mode ) {
				if ( 'clock' !== $dark_mode && ! $is_customize_preview ) {
					$classes[] = 'pen_dark_mode';
				}
				$classes[] = 'pen_dark_mode_' . sanitize_html_class( $dark_mode );
				if ( pen_option_get( 'dark_mode_allow_switch' ) ) {
					$classes[] = 'pen_dark_mode_switch_' . sanitize_html_class( pen_option_get( 'dark_mode_switch_location' ) );
				}
			}
		}

		if ( $is_customize_preview ) {
			$classes[] = 'is_customize_preview';
		}

		$sidebars = array(
			'sidebar-header-primary',
			'sidebar-header-secondary',
			'sidebar-top',
			'sidebar-search-top',
			'sidebar-search-left',
			'sidebar-search-right',
			'sidebar-search-bottom',
			'sidebar-left',
			'sidebar-right',
			'sidebar-bottom',
			'sidebar-footer-top',
			'sidebar-footer-left',
			'sidebar-footer-right',
			'sidebar-footer-bottom',
			'sidebar-mobile-menu-top',
			'sidebar-mobile-menu-bottom',
		);

		foreach ( $sidebars as $sidebar ) {
			if ( pen_sidebar_check( $sidebar, $content_id ) && is_active_sidebar( $sidebar ) ) {
				$classes[] = 'visible-' . sanitize_html_class( $sidebar );
			} else {
				$classes[] = 'invisible-' . sanitize_html_class( $sidebar );
			}
		}

		if ( PEN_THEME_PREVIEW ) {
			$classes[] = 'pen_theme_preview';
			$classes[] = 'visible-sidebar-bottom';
			$classes[] = 'visible-sidebar-left';
			$classes   = array_flip( $classes );
			if ( 'plain' === pen_filter_input( 'GET', 'pen_preview_layout' ) ) {
				$classes['visible-sidebar-right'] = '';
				if ( isset( $classes['invisible-sidebar-right'] ) ) {
					unset( $classes['invisible-sidebar-right'] );
				}
			}
			if ( isset( $classes['invisible-sidebar-bottom'] ) ) {
				unset( $classes['invisible-sidebar-bottom'] );
			}
			if ( isset( $classes['invisible-sidebar-left'] ) ) {
				unset( $classes['invisible-sidebar-left'] );
			}
			$classes = array_flip( $classes );

			$preview_site_width = pen_filter_input( 'GET', 'pen_preview_width' );
			if ( $preview_site_width ) {
				$preview_site_width = pen_sanitize_site_width( $preview_site_width );
				$classes[]          = 'pen_width_' . $preview_site_width;
			} else {
				$classes[] = 'pen_width_' . pen_option_get( 'site_width' );
			}
		}

		if ( pen_option_get( 'header_logo_display' ) ) {
			$classes[] = 'pen_header_logo_size_' . pen_option_get( 'header_logo_size' );
		}

		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		if ( pen_option_get( 'color_site_shadow_display' ) ) {
			$classes[] = 'pen_drop_shadow';
		}
		if ( pen_option_get( 'background_lights_dim' ) ) {
			$classes[] = 'pen_background_lights_dim';
		}

		$site_background_effect = pen_option_get( 'color_site_background_effect' );
		if ( 'none' !== $site_background_effect ) {
			$classes[] = 'pen_has_background_effect';
		}

		$background_dynamic = get_post_meta( $content_id, 'pen_content_background_image_site_dynamic_override', true );
		if ( ! $background_dynamic || 'default' === $background_dynamic ) {
			$background_dynamic = pen_option_get( 'background_image_site_dynamic' );
		}
		$image_dynamic = '';
		if ( 'featured_image' === $background_dynamic && $content_id ) {
			$image_dynamic = esc_url( get_the_post_thumbnail_url( null, 'original' ) );
		}
		if ( 'none' !== $background_dynamic && $image_dynamic ) {
			$classes[] = 'pen_has_background_image';
		}

		if ( pen_option_get( 'header_sticky' ) ) {
			$classes[] = 'pen_header_sticky';
			if ( pen_option_get( 'header_sticky_minimize' ) ) {
				$classes[] = 'pen_header_sticky_minimize';
			}
		}
		if ( pen_option_get( 'round_corners' ) ) {
			$classes[] = 'pen_round_corners';
		}
		if ( 'always' === pen_option_get( 'navigation_mobile_display' ) ) {
			$classes[] = 'pen_mobile_menu_always';
		}
		if ( pen_option_get( 'loading_spinner_display' ) ) {
			$classes[] = 'pen_loading_spinner';
			$classes[] = 'pen_loading_spinner_style_' . pen_option_get( 'loading_spinner_style' );
		}

		$header_logo = pen_option_get( 'header_logo_display' );
		if ( 'none' !== $header_logo ) {
			$classes[] = 'pen_header_logo_size_' . pen_option_get( 'header_logo_size' );
		}
		$padding_header = pen_option_get( 'padding_header' );
		if ( 'none' !== $padding_header ) {
			$classes[] = 'pen_padding_header_' . $padding_header;
		}

		$padding_navigation = pen_option_get( 'padding_navigation' );
		if ( 'none' !== $padding_navigation ) {
			$classes[] = 'pen_padding_navigation_' . $padding_navigation;
		}

		$classes[] = 'pen_list_effect_' . pen_option_get( 'list_effect' );
		$classes[] = 'pen_header_alignment_' . pen_option_get( 'header_alignment' );
		$classes[] = 'pen_navigation_alignment_' . pen_option_get( 'navigation_alignment' );
		$classes[] = 'pen_footer_alignment_' . pen_option_get( 'footer_alignment' );
		$classes[] = 'pen_main_container_' . pen_option_get( 'container_position' );

		if ( is_sticky() ) {
			$classes[] = 'sticky';
		}

		/**
		 * Adding these to the <body> for easier customization.
		 * CSS gets added through customize.php functions.
		 */
		$settings_transform_text = array(
			'transform_text_sitetitle',
			'transform_text_sitedescription',
			'transform_text_navigation',
			'transform_text_navigation_mobile',
			'transform_text_navigation_submenu',
			'transform_text_navigation_submenu_mobile',
			'transform_text_buttons',
			'transform_text_footer_menu',
		);
		foreach ( $settings_transform_text as $setting_transform_text ) {
			$transform_text = pen_option_get( $setting_transform_text );
			if ( 'disable' !== $transform_text ) {
				$classes[] = 'pen_' . $setting_transform_text . '_' . $transform_text;
			}
		}

		$pen_is_singular = pen_is_singular();

		if ( $pen_is_singular ) {

			// Hiding parts of the content with Web accessibility and SEO in mind.
			$options_content = array(
				'site_header_display'          => 'site_header',
				'site_footer_display'          => 'site_footer',
				'navigation_display'           => 'navigation',
				'content_header_display'       => 'content_header',
				'content_title_display'        => 'content_title',
				'content_author_display'       => 'content_author',
				'content_date_display'         => 'content_date',
				'content_date_updated_display' => 'content_date_updated',
				'content_category_display'     => 'content_category',
				'content_thumbnail_display'    => 'content_thumbnail',
				'content_share_display'        => 'content_share',
				'content_tags_display'         => 'content_tags',
				'content_footer_display'       => 'content_footer',
			);
			foreach ( $options_content as $option => $class ) {
				$display = get_post_meta( $content_id, 'pen_' . $option . '_override', true );
				if ( ! $display || 'default' === $display ) {
					$display = pen_option_get( $option );
				}
				if ( ! $display || 'no' === $display ) {
					$classes[] = 'pen_' . $class . '_hide';
				}

				/**
				 * Please refer to the comments for the pen_header_show class in
				 * /themes/pen/include/content.php, pen_post_classes() function.
				 */
				if ( $display && 'content_header_display' === $option ) {
					$classes[] = 'pen_content_header_show';
				}
			}

			if ( ! PEN_THEME_PREVIEW ) {
				$site_width = get_post_meta( $content_id, 'pen_site_width_override', true );
				if ( ! $site_width || 'default' === $site_width ) {
					$site_width = pen_option_get( 'site_width' );
				}
				$classes[] = 'pen_width_' . $site_width;
			}

			$sidebar_left_width = get_post_meta( $content_id, 'pen_sidebar_left_width_override', true );
			if ( ! $sidebar_left_width || 'default' === $sidebar_left_width ) {
				$sidebar_left_width = pen_option_get( 'sidebar_left_width' );
			}
			$classes[] = 'pen_sidebar_left_width_' . str_replace( '%', '', $sidebar_left_width );

			$sidebar_right_width = get_post_meta( $content_id, 'pen_sidebar_right_width_override', true );
			if ( ! $sidebar_right_width || 'default' === $sidebar_right_width ) {
				$sidebar_right_width = pen_option_get( 'sidebar_right_width' );
			}
			$classes[] = 'pen_sidebar_right_width_' . str_replace( '%', '', $sidebar_right_width );

			$header_alignment = get_post_meta( $content_id, 'pen_content_header_alignment_override', true );
			if ( ! $header_alignment || 'default' === $header_alignment ) {
				$header_alignment = pen_option_get( 'content_header_alignment' );
			}
			if ( $header_alignment && 'no' !== $header_alignment ) {
				// Right now there's only one option: Center-align the content header.
				$classes[] = 'pen_content_header_center';
			}

			$title_alignment = get_post_meta( $content_id, 'pen_content_title_alignment_override', true );
			if ( ! $title_alignment || 'default' === $title_alignment ) {
				$title_alignment = pen_option_get( 'content_title_alignment' );
			}
			if ( $title_alignment && 'no' !== $title_alignment ) {
				$classes[] = 'pen_content_title_center';
			}

			$thumbnail_rotate = get_post_meta( $content_id, 'pen_content_thumbnail_rotate_override', true );
			if ( ! $thumbnail_rotate || 'default' === $thumbnail_rotate ) {
				$thumbnail_rotate = pen_option_get( 'content_thumbnail_rotate' );
			}
			if ( $thumbnail_rotate && 'no' !== $thumbnail_rotate ) {
				$classes[] = 'pen_content_thumbnail_rotate';
			}

			$thumbnail_frame = get_post_meta( $content_id, 'pen_content_thumbnail_frame_override', true );
			if ( ! $thumbnail_frame || 'default' === $thumbnail_frame ) {
				$thumbnail_frame = pen_option_get( 'content_thumbnail_frame' );
			}
			if ( $thumbnail_frame && 'no' !== $thumbnail_frame ) {
				$classes[] = 'pen_content_thumbnail_frame';
			}

			$thumbnail_frame_color = get_post_meta( $content_id, 'pen_color_content_thumbnail_frame_override', true );
			if ( ! $thumbnail_frame_color || 'default' === $thumbnail_frame_color ) {
				$thumbnail_frame_color = pen_option_get( 'color_content_thumbnail_frame' );
			}
			if ( '#000000' === $thumbnail_frame_color ) {
				$classes[] = 'pen_thumbnail_frame_dark';
			}

			$thumbnail_alignment = get_post_meta( $content_id, 'pen_content_thumbnail_alignment_override', true );
			if ( ! $thumbnail_alignment || 'default' === $thumbnail_alignment ) {
				$thumbnail_alignment = pen_option_get( 'content_thumbnail_alignment' );
			}
			$classes[] = 'pen_content_thumbnail_' . $thumbnail_alignment;
			$classes[] = 'pen_content_thumbnail_' . pen_option_get( 'content_thumbnail_resize' );

			$author_avatar_style = pen_option_get( 'content_author_avatar_style' );
			if ( $author_avatar_style ) {
				$classes[] = 'pen_author_avatar_style_' . $author_avatar_style;
			} else {
				$classes[] = 'pen_author_avatar_style_none';
			}

			$classes[] = 'pen_singular';

		} else {

			// Hiding parts of the content with Web accessibility and SEO in mind.
			$visibility_options = array(
				'list_header_display'           => 'list_header_hide',
				'list_title_display'            => 'list_title_hide',
				'list_author_display'           => 'list_author_hide',
				'list_date_display'             => 'list_date_hide',
				'list_date_updated_display'     => 'list_date_updated_hide',
				'list_category_display'         => 'list_category_hide',
				'list_thumbnail_display'        => 'list_thumbnail_hide',
				'list_summary_display'          => 'list_summary_hide',
				'list_footer_display'           => 'list_footer_hide',
				'list_tags_display'             => 'list_tags_hide',
				'list_button_comment_display'   => 'list_button_comment_hide',
				'list_button_edit_display'      => 'list_button_edit_hide',
				'list_button_read_more_display' => 'list_button_read_more_hide',
			);
			foreach ( $visibility_options as $option => $class ) {
				$value = pen_option_get( $option );
				if ( ! $value ) {
					$classes[] = 'pen_' . $class;
				} elseif ( 'list_header_display' === $option ) {
					/**
					 * Please refer to the comments for the pen_header_show class in
					 * /themes/pen/include/content.php, pen_post_classes() function.
					 */
					$classes[] = 'pen_list_header_show';
				}
			}

			if ( ! PEN_THEME_PREVIEW ) {
				$classes[] = 'pen_width_' . pen_option_get( 'site_width' );
			}

			$classes[] = 'pen_sidebar_left_width_' . str_replace( '%', '', pen_option_get( 'sidebar_left_width' ) );

			$classes[] = 'pen_sidebar_right_width_' . str_replace( '%', '', pen_option_get( 'sidebar_right_width' ) );

			if ( pen_option_get( 'list_header_alignment' ) ) {
				$classes[] = 'pen_list_header_center';
			}
			if ( pen_option_get( 'list_header_icon' ) ) {
				$classes[] = 'pen_list_header_icon';
			}
			if ( pen_option_get( 'list_title_alignment' ) ) {
				$classes[] = 'pen_list_title_center';
			}

			if ( 'none' !== pen_option_get( 'list_animation_reveal' ) ) {
				$classes[] = 'pen_has_animation';
			} else {
				$classes[] = 'pen_no_animation';
			}

			$author_avatar_style = (int) pen_option_get( 'list_author_avatar_style' );
			if ( $author_avatar_style ) {
				$classes[] = 'pen_author_avatar_style_' . $author_avatar_style;
			} else {
				$classes[] = 'pen_author_avatar_style_none';
			}

			$classes[] = 'pen_multiple';
			$classes[] = 'hfeed';
		}

		$list_type = pen_list_type( $content_id );

		if ( ! $pen_is_singular ) {

			$classes[] = 'pen_list_' . $list_type;

			if ( 'masonry' === $list_type || 'tiles' === $list_type ) {
				$type      = ( ( 'tiles' === $list_type ) ? 'tile' : $list_type );
				$classes[] = 'pen_' . $list_type . '_columns_' . pen_option_get( 'list_' . $type . '_columns' );
				$classes[] = 'pen_thumbnail_' . pen_option_get( 'list_' . $type . '_thumbnail_effect' );
			} else {
				// The following apply to all the posts in the list.
				if ( '#000000' === pen_option_get( 'color_list_thumbnail_frame' ) ) {
					$classes[] = 'pen_thumbnail_frame_dark';
				}
				$classes[] = 'pen_list_thumbnail_' . pen_option_get( 'list_thumbnail_alignment' );
				$classes[] = 'pen_list_thumbnail_' . pen_option_get( 'list_thumbnail_resize' );
				if ( pen_option_get( 'list_thumbnail_rotate' ) ) {
					$classes[] = 'pen_list_thumbnail_rotate';
				}
				if ( pen_option_get( 'list_thumbnail_frame' ) ) {
					$classes[] = 'pen_list_thumbnail_frame';
				}
			}
		}

		return $classes;
	}
	add_filter( 'body_class', 'pen_body_classes' );
}

if ( ! function_exists( 'pen_content_classes' ) ) {
	/**
	 * Content classes.
	 *
	 * @param int $content_id Content ID.
	 *
	 * @since Pen 1.0.3
	 * @return string
	 */
	function pen_content_classes( $content_id = null ) {
		return 'site-main';
	}
}

if ( ! function_exists( 'pen_post_id' ) ) {
	/**
	 * Returns the correct post ID.
	 *
	 * @since Pen 1.2.1
	 * @return int
	 */
	function pen_post_id() {
		if ( in_the_loop() ) {
			return get_the_ID();
		}
		$id = (int) get_queried_object_id();
		if ( $id ) {
			return $id;
		}
		return 0;
	}
}

if ( ! function_exists( 'pen_is_singular' ) ) {
	/**
	 * More accurate is_singular() check.
	 *
	 * @since Pen 1.3.4
	 * @return int
	 */
	function pen_is_singular() {
		if ( is_singular() ) {
			return true;
		} else {
			if ( is_404() ) {
				return true;
			}
		}
		return false;
	}
}

if ( ! function_exists( 'pen_categorized_blog' ) ) {
	/**
	 * Returns true if a blog has more than 1 category.
	 *
	 * @since Pen 1.0.0
	 * @return bool
	 */
	function pen_categorized_blog() {
		$all_the_cool_cats = get_transient( 'pen_categories' );
		if ( false === $all_the_cool_cats ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories(
				array(
					'fields'     => 'ids',
					'hide_empty' => 1,
					// We only need to know if there is more than one category.
					'number'     => 2,
				)
			);

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'pen_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so pen_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so pen_categorized_blog should return false.
			return false;
		}

	}
}

if ( ! function_exists( 'pen_category_transient_flusher' ) ) {
	/**
	 * Flush out the transients used in pen_categorized_blog.
	 *
	 * @since Pen 1.0.0
	 * @return void|string
	 */
	function pen_category_transient_flusher() {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Like, beat it. Dig?
		delete_transient( 'pen_categories' );
	}
	add_action( 'edit_category', 'pen_category_transient_flusher' );
	add_action( 'save_post', 'pen_category_transient_flusher' );
}

if ( ! function_exists( 'pen_editor_styles' ) ) {
	/**
	 * Adds theme stylesheet to the visual editor.
	 *
	 * @uses add_editor_style()           Links a stylesheet to visual editor.
	 * @uses get_template_directory_uri() Through PEN_THEME_DIRECTORY_URI which returns URI of theme directory.
	 * @since Pen 1.0.0
	 */
	function pen_editor_styles() {
		add_editor_style( PEN_THEME_DIRECTORY_URI . '/assets/css/pen-editor.css' );
	}
	add_action( 'admin_init', 'pen_editor_styles' );
}

if ( ! function_exists( 'pen_class_lists' ) ) {
	/**
	 * Creates a class name for hidden elements.
	 *
	 * @param string $option      Option ID.
	 * @param int    $content_id  Content ID.
	 * @param bool   $is_singular Whether list view or not.
	 *
	 * @since Pen 1.0.0
	 * @return string
	 */
	function pen_class_lists( $option, $content_id = null, $is_singular = null ) {
		// For maximum compatibility.
		if ( is_null( $content_id ) ) {
			$content_id = pen_post_id();
		}
		if ( is_null( $is_singular ) ) {
			$is_singular = pen_is_singular();
		}

		if ( ! $is_singular ) {
			$display = get_post_meta( $content_id, 'pen_list_' . $option, true );
			if ( 'no' === $display ) {
				return 'pen_element_hidden';
			} elseif ( 'yes' === $display ) {
				return 'pen_element_visible';
			} else {
				return 'pen_element_default';
			}
		}
	}
}

if ( ! function_exists( 'pen_filter_input' ) ) {
	/**
	 * Sanitization function similar to filter_input and filter_input_array.
	 *
	 * @param string $source The input source, can be GET, POST, or SERVER.
	 * @param string $name   The input name, false returns an array similar to $_GET etc.
	 *
	 * @since Pen 1.0.0
	 * @return mixed Returns null when source is not provided or input does not exist.
	 */
	function pen_filter_input( $source, $name = false ) {
		if ( 'GET' !== $source && 'POST' !== $source && 'SERVER' !== $source ) {
			return null;
		}
		// Gets the sources.
		/* phpcs:disable */
		if ( 'GET' === $source ) {
			$source = $_GET;
		} elseif ( 'POST' === $source ) {
			$source = $_POST;
		} else {
			$source = $_SERVER;
		}
		/* phpcs:enable */
		// Sanitization.
		if ( ! $name ) {
			array_walk_recursive( $source, 'pen_filter_input_help' );
			if ( $source ) {
				return $source;
			} else {
				return null;
			}
		} elseif ( ! isset( $source[ $name ] ) ) {
			return null;
		} elseif ( is_array( $source[ $name ] ) ) {
			array_walk_recursive( $source[ $name ], 'pen_filter_input_help' );
			return $source[ $name ];
		} else {
			return htmlspecialchars( trim( stripslashes( $source[ $name ] ) ), ENT_NOQUOTES, 'UTF-8' );
		}
		return null;
	}
}

if ( ! function_exists( 'pen_filter_input_help' ) ) {
	/**
	 * Helper function necessary for array_walk_recursive on older PHP versions.
	 *
	 * @param mixed $value The value to be processed.
	 *
	 * @since Pen 1.0.0
	 * @return void
	 */
	function pen_filter_input_help( &$value ) {
		$value = htmlspecialchars( trim( stripslashes( $value ) ), ENT_NOQUOTES, 'UTF-8' );
	}
}

if ( ! function_exists( 'pen_list_type' ) ) {
	/**
	 * Returns the content list type.
	 *
	 * @param int $content_id Content ID.
	 *
	 * @since Pen 1.0.5
	 * @return string
	 */
	function pen_list_type( $content_id = null ) {
		if ( is_null( $content_id ) ) {
			$content_id = pen_post_id();
		}
		if ( is_page() ) {
			$list_type = get_post_meta( $content_id, 'pen_list_type_override', true );
			if ( $list_type && 'default' !== $list_type ) {
				return $list_type;
			}
		}
		$preview = pen_filter_input( 'GET', 'pen_preview_layout' );
		if ( $preview && in_array( $preview, array( 'jquery_masonry', 'plain' ), true ) ) {
			return $preview;
		}
		return pen_option_get( 'list_type' );
	}
}

if ( ! function_exists( 'pen_animations' ) ) {
	/**
	 * Returns a list of the available animations.
	 *
	 * @since Pen 1.0.5
	 * @return string
	 */
	function pen_animations() {
		return array(
			'none'              => __( 'None', 'pen' ),
			'bounce'            => 'bounce',
			'flash'             => 'flash',
			'pulse'             => 'pulse',
			'rubberBand'        => 'rubberBand',
			'headShake'         => 'headShake',
			'heartBeat'         => 'heartBeat',
			'jackInTheBox'      => 'jackInTheBox',
			'jello'             => 'jello',
			'swing'             => 'swing',
			'tada'              => 'tada',
			'wobble'            => 'wobble',
			'backInDown'        => 'backInDown',
			'backInLeft'        => 'backInLeft',
			'backInRight'       => 'backInRight',
			'backInUp'          => 'backInUp',
			'bounceIn'          => 'bounceIn',
			'bounceInDown'      => 'bounceInDown',
			'bounceInLeft'      => 'bounceInLeft',
			'bounceInRight'     => 'bounceInRight',
			'bounceInUp'        => 'bounceInUp',
			'fadeIn'            => 'fadeIn',
			'fadeInBottomLeft'  => 'fadeInBottomLeft',
			'fadeInBottomRight' => 'fadeInBottomRight',
			'fadeInDown'        => 'fadeInDown',
			'fadeInDownBig'     => 'fadeInDownBig',
			'fadeInLeft'        => 'fadeInLeft',
			'fadeInLeftBig'     => 'fadeInLeftBig',
			'fadeInRight'       => 'fadeInRight',
			'fadeInRightBig'    => 'fadeInRightBig',
			'fadeInTopLeft'     => 'fadeInTopLeft',
			'fadeInTopRight'    => 'fadeInTopRight',
			'fadeInUp'          => 'fadeInUp',
			'fadeInUpBig'       => 'fadeInUpBig',
			'flip'              => 'flip',
			'flipInX'           => 'flipInX',
			'flipInY'           => 'flipInY',
			'lightSpeedIn'      => 'lightSpeedIn',
			'lightSpeedInLeft'  => 'lightSpeedInLeft',
			'lightSpeedInRight' => 'lightSpeedInRight',
			'rollIn'            => 'rollIn',
			'rotateIn'          => 'rotateIn',
			'rotateInDownLeft'  => 'rotateInDownLeft',
			'rotateInDownRight' => 'rotateInDownRight',
			'rotateInUpLeft'    => 'rotateInUpLeft',
			'rotateInUpRight'   => 'rotateInUpRight',
			'shakeX'            => 'shakeX',
			'shakeY'            => 'shakeY',
			'slideInDown'       => 'slideInDown',
			'slideInLeft'       => 'slideInLeft',
			'slideInRight'      => 'slideInRight',
			'slideInUp'         => 'slideInUp',
			'zoomIn'            => 'zoomIn',
			'zoomInDown'        => 'zoomInDown',
			'zoomInLeft'        => 'zoomInLeft',
			'zoomInRight'       => 'zoomInRight',
			'zoomInUp'          => 'zoomInUp',
		);
	}
}

if ( ! function_exists( 'pen_animations_delay' ) ) {
	/**
	 * Returns a list of the available animation delay options.
	 *
	 * @since Pen 1.2.8
	 * @return string
	 */
	function pen_animations_delay() {
		return array(
			0 => __( 'None', 'pen' ),
			1 => 1,
			2 => 2,
			3 => 3,
			4 => 4,
			5 => 5,
		);
	}
}

if ( ! function_exists( 'pen_class_animation' ) ) {
	/**
	 * Generates animation class names.
	 *
	 * @param string  $option     Option ID.
	 * @param boolean $echo       Whether to echo or return.
	 * @param int     $content_id Content ID.
	 *
	 * @since Pen 1.0.7
	 * @return void|string
	 */
	function pen_class_animation( $option, $echo, $content_id = null ) {
		// For maximum compatibility.
		if ( is_null( $content_id ) ) {
			$content_id = pen_post_id();
		}

		$classes = array();

		$animation = get_post_meta( $content_id, 'pen_' . $option . '_animation_reveal_override', true );
		if ( ! $animation || 'default' === $animation ) {
			$animation = pen_option_get( $option . '_animation_reveal' );
		}
		if ( $animation ) {
			if ( 'none' !== $animation ) {
				$classes[] = 'pen_animate_on_scroll';
				$classes[] = 'pen_custom_animation_' . sanitize_html_class( $animation );
			}

			$animation_delay = get_post_meta( $content_id, 'pen_' . $option . '_animation_delay_reveal_override', true );
			if ( ! $animation_delay || 'default' === $animation_delay ) {
				$animation_delay = pen_option_get( $option . '_animation_delay_reveal' );
			}
			if ( (int) $animation_delay ) {
				$classes[] = 'pen_custom_animation_delay_' . $animation_delay;
			}
		}

		$classes = implode( ' ', array_filter( $classes ) );

		if ( $echo ) {
			echo $classes; /* phpcs:ignore */
		} else {
			return $classes;
		}
	}
}

if ( ! function_exists( 'pen_url_customizer' ) ) {
	/**
	 * Generates a URL for the customizer.
	 *
	 * @param string $focus Focus on specific option.
	 *
	 * @since Pen 1.0.8
	 * @return string
	 */
	function pen_url_customizer( $focus = '' ) {
		if ( is_customize_preview() ) {
			return '#';
		}
		$query['return'] = rawurlencode( pen_filter_input( 'SERVER', 'REQUEST_URI' ) );
		if ( $focus && false !== strpos( $focus, ',' ) ) {

			$container      = explode( ',', $focus );
			$container_type = $container[0];
			$container_name = $container[1];

			$generic = array( // Also in the pen_html_jump_menu().
				'background_image',
				'header_image',
				'nav_menus',
				'title_tagline',
				'widgets',
				'woocommerce',
			);
			if ( ! in_array( $container_name, $generic, true ) && false === strpos( $container_name, 'sidebar-widgets-' ) ) {
				$container_name = 'pen_' . $container_type . '_' . $container_name;
			}
			$query[ 'autofocus[' . $container_type . ']' ] = $container_name;
		}

		$url_customize = wp_customize_url();
		if ( ! is_admin() ) {
			$content_id = pen_post_id();
			if ( $content_id ) {
				$url_customize = add_query_arg( 'pen_content_id', $content_id, wp_customize_url() );
			}
		}
		return add_query_arg( $query, $url_customize );
	}
}

if ( ! function_exists( 'pen_jump_menu' ) ) {
	/**
	 * Provides easier access to various parts of the back-end.
	 *
	 * @param string $element    Target element.
	 * @param int    $content_id Content ID.
	 *
	 * @since Pen 1.0.8
	 * @return string
	 */
	function pen_jump_menu( $element, $content_id = null ) {
		// For maximum compatibility.
		if ( is_null( $content_id ) ) {
			$content_id = pen_post_id();
		}

		$is_customize_preview = is_customize_preview();

		if ( ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}
		if ( $is_customize_preview && ! pen_option_get( 'shortcut_menus_back_display' ) ) {
			return;
		}
		if ( ! $is_customize_preview && ! pen_option_get( 'shortcut_menus_front_display' ) ) {
			return;
		}

		$url_customize = wp_customize_url();
		if ( ! is_admin() && $content_id ) {
			$url_customize = add_query_arg( 'pen_content_id', $content_id, wp_customize_url() );
		}

		switch ( $element ) {
			case 'color_schemes':
				$preset_color_current = (int) str_replace( 'preset_', '', pen_preset_get( 'color' ) );

				$items = array();
				for ( $i = 1; $i <= PEN_THEME_NUMBER_COLOR_SCHEMES; $i++ ) {

					$url_customize_color = add_query_arg(
						array(
							'autofocus[panel]'  => 'pen_panel_colors',
							'pen_preview_color' => (int) $i,
						),
						$url_customize
					);

					$items[ $url_customize_color ] = sprintf(
						/* Translators: Just a number. */
						__( 'Style %d', 'pen' ),
						$i
					);
					if ( $i > 10 ) {
						$items[ $url_customize_color ] .= ' ' . sprintf(
							/* Translators: Just some word. */
							__( '(%s)', 'pen' ),
							__( 'Flat', 'pen' )
						);
					}
					if ( $i === $preset_color_current ) {
						$items[ $url_customize_color ] .= ' ' . sprintf(
							/* Translators: Just some word. */
							__( '(%s)', 'pen' ),
							__( 'Current', 'pen' )
						);
					}
				}

				$menu = array(
					'name'  => __( 'Color Scheme', 'pen' ),
					'items' => $items,
				);
				return $menu;

			case 'font_presets':
				$preset_font_current = (int) str_replace( 'preset_', '', pen_preset_get( 'font_family' ) );

				$items = array();

				for ( $i = 1; $i <= PEN_THEME_NUMBER_FONT_PAIRS; $i++ ) {

					$url_customize_font = add_query_arg(
						array(
							'autofocus[panel]' => 'pen_panel_typography',
							'pen_preview_font' => (int) $i,
						),
						$url_customize
					);

					$items[ $url_customize_font ] = sprintf(
						'%s %d',
						__( 'Font Group', 'pen' ),
						$i
					);
					if ( $i === $preset_font_current ) {
						$items[ $url_customize_font ] .= ' ' . sprintf(
							/* Translators: Just some word. */
							__( '(%s)', 'pen' ),
							__( 'Current', 'pen' )
						);
					}
				}

				$menu = array(
					'name'  => __( 'Font Group', 'pen' ),
					'items' => $items,
				);
				return $menu;

			case 'site':
				$menu = array(
					'name'  => __( 'General Settings', 'pen' ),
					'items' => array(
						'section,background_image'   => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'Site', 'pen' ),
							__( 'Background Image', 'pen' )
						),
						'section,colors_general'     => __( 'Colors', 'pen' ),
						'section,typography_general' => __( 'Typography', 'pen' ),
						'section,layout'             => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'Site', 'pen' ),
							__( 'Layout', 'pen' )
						),
					),
				);
				if ( is_front_page() ) {
					$menu['items'][ ( 'panel,front' ) ] = __( 'Front Page', 'pen' );
				}
				return $menu;

			case 'header':
				return array(
					'name'  => __( 'Header', 'pen' ),
					'items' => array(
						'section,header_general'    => sprintf(
							'%1$s<span> &rarr; %2$s</span>',
							__( 'General', 'pen' ),
							__( 'Header', 'pen' )
						),
						'section,animation_header'  => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'Header', 'pen' ),
							__( 'Animation', 'pen' )
						),
						'section,header_image'      => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'Header', 'pen' ),
							__( 'Background Image', 'pen' )
						),
						'section,title_tagline'     => __( 'Logo', 'pen' ),
						'section,phone'             => __( 'Phone', 'pen' ),
						'panel,nav_menus'           => __( 'Menu', 'pen' ),
						'section,header_search'     => __( 'Search', 'pen' ),
						'section,header_register'   => __( 'Registration Button', 'pen' ),
						'section,colors_header'     => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'Header', 'pen' ),
							__( 'Colors', 'pen' )
						),
						'section,typography_header' => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'Header', 'pen' ),
							__( 'Typography', 'pen' )
						),
						'panel,contact'             => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'Site', 'pen' ),
							sprintf(
								/* Translators: Just some words. */
								__( '%1$s & %2$s', 'pen' ),
								__( 'RSS', 'pen' ),
								__( 'Social Media', 'pen' )
							)
						),
						'panel,widgets'             => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'Header', 'pen' ),
							__( 'Widget Areas', 'pen' )
						),
					),
				);

			case 'navigation':
				return array(
					'name'  => __( 'Navigation', 'pen' ),
					'items' => array(
						'section,header_navigation'     => sprintf(
							'%1$s<span> &rarr; %2$s</span>',
							__( 'General', 'pen' ),
							__( 'Navigation', 'pen' )
						),
						'panel,nav_menus'               => __( 'Menu', 'pen' ),
						'section,background_image_navigation' => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'Navigation', 'pen' ),
							__( 'Background Image', 'pen' )
						),
						'section,animation_navigation'  => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'Navigation', 'pen' ),
							__( 'Animation', 'pen' )
						),
						'section,colors_navigation'     => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'Navigation', 'pen' ),
							__( 'Colors', 'pen' )
						),
						'section,typography_navigation' => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'Navigation', 'pen' ),
							__( 'Typography', 'pen' )
						),
						'panel,widgets'                 => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'Navigation', 'pen' ),
							__( 'Widget Areas', 'pen' )
						),
					),
				);

			case 'search_bar':
				return array(
					'name'  => __( 'Search Bar', 'pen' ),
					'items' => array(
						'section,header_search'           => sprintf(
							'%1$s<span> &rarr; %2$s</span>',
							__( 'General', 'pen' ),
							__( 'Search', 'pen' )
						),
						'section,animation_search'        => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'Search Bar', 'pen' ),
							__( 'Animation', 'pen' )
						),
						'section,background_image_search' => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'Search Bar', 'pen' ),
							__( 'Background Image', 'pen' )
						),
						'section,colors_search'           => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'Search Bar', 'pen' ),
							__( 'Colors', 'pen' )
						),
						'panel,widgets'                   => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'Search Bar', 'pen' ),
							__( 'Widget Areas', 'pen' )
						),
					),
				);

			case 'content':
				$menu = array(
					'name'  => __( 'Content Area', 'pen' ),
					'items' => array(
						'section,content'                => sprintf(
							'%1$s<span> &rarr; %2$s</span>',
							__( 'General', 'pen' ),
							__( 'Content Area', 'pen' )
						),
						'section,animation_full_content' => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'Content Area', 'pen' ),
							__( 'Animation', 'pen' )
						),
						'section,colors_content'         => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'Content Area', 'pen' ),
							__( 'Colors', 'pen' )
						),
						'section,layout'                 => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'Site', 'pen' ),
							__( 'Layout', 'pen' )
						),
					),
				);

				if ( $content_id ) {
					$url_post_edit                   = self_admin_url(
						sprintf(
							'post.php?post=%d&action=edit',
							esc_attr( $content_id )
						)
					);
					$post_type_object                = get_post_type_object( get_post_type() );
					$menu['items'][ $url_post_edit ] = __( 'Edit', 'pen' );
				}
				return $menu;

			case 'list':
				return array(
					'name'  => __( 'List View', 'pen' ),
					'items' => array(
						'section,list'           => sprintf(
							'%1$s<span> &rarr; %2$s</span>',
							__( 'General', 'pen' ),
							__( 'List View', 'pen' )
						),
						'section,animation_list' => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'List View', 'pen' ),
							__( 'Animation', 'pen' )
						),
						'section,colors_list'    => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'List View', 'pen' ),
							__( 'Colors', 'pen' )
						),
						'section,layout'         => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'Site', 'pen' ),
							__( 'Layout', 'pen' )
						),
					),
				);

			case 'sidebar-header-primary':
				return array(
					'name'  => sprintf(
						'%1$s &rarr; %2$s',
						__( 'Header', 'pen' ),
						__( 'Primary', 'pen' )
					),
					'items' => array(
						'section,animation_widget_areas' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								'%1$s &rarr; %2$s',
								__( 'Header', 'pen' ),
								__( 'Primary', 'pen' )
							),
							__( 'Animation', 'pen' )
						),
						'section,sidebar-widgets-sidebar-header-primary' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								'%1$s &rarr; %2$s',
								__( 'Header', 'pen' ),
								__( 'Primary', 'pen' )
							),
							__( 'Configure Widgets', 'pen' )
						),
					),
				);

			case 'sidebar-header-secondary':
				return array(
					'name'  => sprintf(
						'%1$s &rarr; %2$s',
						__( 'Header', 'pen' ),
						__( 'Secondary', 'pen' )
					),
					'items' => array(
						'section,animation_widget_areas' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								'%1$s &rarr; %2$s',
								__( 'Header', 'pen' ),
								__( 'Secondary', 'pen' )
							),
							__( 'Animation', 'pen' )
						),
						'section,sidebar-widgets-sidebar-header-secondary' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								'%1$s &rarr; %2$s',
								__( 'Header', 'pen' ),
								__( 'Secondary', 'pen' )
							),
							__( 'Configure Widgets', 'pen' )
						),
					),
				);

			case 'sidebar-top':
				return array(
					'name'  => sprintf(
						/* Translators: Part of the theme, e.g. "Left" Widget Area. */
						__( '"%s" Widget Area', 'pen' ),
						__( 'Top', 'pen' )
					),
					'items' => array(
						'section,animation_widget_areas' => sprintf(
							'<span>%1$s </span>%2$s',
							__( 'Top', 'pen' ),
							__( 'Animation', 'pen' )
						),
						'section,sidebar-widgets-sidebar-top' => sprintf(
							'<span>%1$s </span>%2$s',
							__( 'Top', 'pen' ),
							__( 'Configure Widgets', 'pen' )
						),
					),
				);

			case 'sidebar-search-top':
				return array(
					'name'  => sprintf(
						/* Translators: Part of the theme, e.g. "Left" Widget Area. */
						__( '"%s" Widget Area', 'pen' ),
						sprintf(
							'%1$s &rarr; %2$s',
							__( 'Search Bar', 'pen' ),
							__( 'Top', 'pen' )
						)
					),
					'items' => array(
						'section,animation_widget_areas' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								'%1$s &rarr; %2$s',
								__( 'Search Bar', 'pen' ),
								__( 'Top', 'pen' )
							),
							__( 'Animation', 'pen' )
						),
						'section,sidebar-widgets-sidebar-search-top' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								/* Translators: Part of the theme, e.g. "Left" Widget Area. */
								__( '"%s" Widget Area', 'pen' ),
								sprintf(
									'%1$s &rarr; %2$s',
									__( 'Search Bar', 'pen' ),
									__( 'Top', 'pen' )
								)
							),
							__( 'Configure Widgets', 'pen' )
						),
					),
				);

			case 'sidebar-search-left':
				return array(
					'name'  => sprintf(
						/* Translators: Part of the theme, e.g. "Left" Widget Area. */
						__( '"%s" Widget Area', 'pen' ),
						sprintf(
							'%1$s &rarr; %2$s',
							__( 'Search Bar', 'pen' ),
							__( 'Left', 'pen' )
						)
					),
					'items' => array(
						'section,animation_widget_areas' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								'%1$s &rarr; %2$s',
								__( 'Search Bar', 'pen' ),
								__( 'Left', 'pen' )
							),
							__( 'Animation', 'pen' )
						),
						'section,sidebar-widgets-sidebar-search-left' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								/* Translators: Part of the theme, e.g. "Left" Widget Area. */
								__( '"%s" Widget Area', 'pen' ),
								sprintf(
									'%1$s &rarr; %2$s',
									__( 'Search Bar', 'pen' ),
									__( 'Left', 'pen' )
								)
							),
							__( 'Configure Widgets', 'pen' )
						),
					),
				);

			case 'sidebar-search-right':
				return array(
					'name'  => sprintf(
						/* Translators: Part of the theme, e.g. "Left" Widget Area. */
						__( '"%s" Widget Area', 'pen' ),
						sprintf(
							'%1$s &rarr; %2$s',
							__( 'Search Bar', 'pen' ),
							__( 'Right', 'pen' )
						)
					),
					'items' => array(
						'section,animation_widget_areas' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								'%1$s &rarr; %2$s',
								__( 'Search Bar', 'pen' ),
								__( 'Right', 'pen' )
							),
							__( 'Animation', 'pen' )
						),
						'section,sidebar-widgets-sidebar-search-right' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								/* Translators: Part of the theme, e.g. "Left" Widget Area. */
								__( '"%s" Widget Area', 'pen' ),
								sprintf(
									'%1$s &rarr; %2$s',
									__( 'Search Bar', 'pen' ),
									__( 'Right', 'pen' )
								)
							),
							__( 'Configure Widgets', 'pen' )
						),
					),
				);

			case 'sidebar-search-bottom':
				return array(
					'name'  => sprintf(
						/* Translators: Part of the theme, e.g. "Left" Widget Area. */
						__( '"%s" Widget Area', 'pen' ),
						sprintf(
							'%1$s &rarr; %2$s',
							__( 'Search Bar', 'pen' ),
							__( 'Bottom', 'pen' )
						)
					),
					'items' => array(
						'section,animation_widget_areas' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								'%1$s &rarr; %2$s',
								__( 'Search Bar', 'pen' ),
								__( 'Bottom', 'pen' )
							),
							__( 'Animation', 'pen' )
						),
						'section,sidebar-widgets-sidebar-search-bottom' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								/* Translators: Part of the theme, e.g. "Left" Widget Area. */
								__( '"%s" Widget Area', 'pen' ),
								sprintf(
									'%1$s &rarr; %2$s',
									__( 'Search Bar', 'pen' ),
									__( 'Bottom', 'pen' )
								)
							),
							__( 'Configure Widgets', 'pen' )
						),
					),
				);

			case 'sidebar-content-top':
				return array(
					'name'  => sprintf(
						/* Translators: Part of the theme, e.g. "Left" Widget Area. */
						__( '"%s" Widget Area', 'pen' ),
						sprintf(
							'%1$s &rarr; %2$s',
							__( 'Content', 'pen' ),
							__( 'Top', 'pen' )
						)
					),
					'items' => array(
						'section,animation_widget_areas' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								'%1$s &rarr; %2$s',
								__( 'Content', 'pen' ),
								__( 'Top', 'pen' )
							),
							__( 'Animation', 'pen' )
						),
						'section,sidebar-widgets-sidebar-content-top' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								/* Translators: Part of the theme, e.g. "Left" Widget Area. */
								__( '"%s" Widget Area', 'pen' ),
								sprintf(
									'%1$s &rarr; %2$s',
									__( 'Content', 'pen' ),
									__( 'Top', 'pen' )
								)
							),
							__( 'Configure Widgets', 'pen' )
						),
					),
				);

			case 'sidebar-content-bottom':
				return array(
					'name'  => sprintf(
						/* Translators: Part of the theme, e.g. "Left" Widget Area. */
						__( '"%s" Widget Area', 'pen' ),
						sprintf(
							'%1$s &rarr; %2$s',
							__( 'Content', 'pen' ),
							__( 'Bottom', 'pen' )
						)
					),
					'items' => array(
						'section,animation_widget_areas' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								'%1$s &rarr; %2$s',
								__( 'Content', 'pen' ),
								__( 'Bottom', 'pen' )
							),
							__( 'Animation', 'pen' )
						),
						'section,sidebar-widgets-sidebar-content-bottom' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								/* Translators: Part of the theme, e.g. "Left" Widget Area. */
								__( '"%s" Widget Area', 'pen' ),
								sprintf(
									'%1$s &rarr; %2$s',
									__( 'Content', 'pen' ),
									__( 'Bottom', 'pen' )
								)
							),
							__( 'Configure Widgets', 'pen' )
						),
					),
				);

			case 'sidebar-left':
				return array(
					'name'  => __( 'Left Sidebar', 'pen' ),
					'items' => array(
						'section,animation_widget_areas' => sprintf(
							'<span>%1$s </span>%2$s',
							__( 'Left Sidebar', 'pen' ),
							__( 'Animation', 'pen' )
						),
						'section,sidebar-widgets-sidebar-left' => sprintf(
							'<span>%1$s </span>%2$s',
							__( 'Left Sidebar', 'pen' ),
							__( 'Configure Widgets', 'pen' )
						),
					),
				);

			case 'sidebar-right':
				return array(
					'name'  => __( 'Right Sidebar', 'pen' ),
					'items' => array(
						'section,animation_widget_areas' => sprintf(
							'<span>%1$s </span>%2$s',
							__( 'Right Sidebar', 'pen' ),
							__( 'Animation', 'pen' )
						),
						'section,sidebar-widgets-sidebar-right' => sprintf(
							'<span>%1$s </span>%2$s',
							__( 'Right Sidebar', 'pen' ),
							__( 'Configure Widgets', 'pen' )
						),
					),
				);

			case 'sidebar-bottom':
				return array(
					'name'  => __( 'Bottom', 'pen' ),
					'items' => array(
						'section,animation_widget_areas'  => sprintf(
							'<span>%1$s </span>%2$s',
							__( 'Bottom', 'pen' ),
							__( 'Animation', 'pen' )
						),
						'section,background_image_bottom' => sprintf(
							'<span>%1$s %2$s &rarr; </span>%2$s',
							sprintf(
								/* Translators: Part of the theme, e.g. "Left" Widget Area. */
								__( '"%s" Widget Area', 'pen' ),
								__( 'Bottom', 'pen' )
							),
							__( 'Background Image', 'pen' )
						),
						'section,colors_bottom'           => sprintf(
							'<span>%1$s %2$s &rarr; </span>%2$s',
							sprintf(
								/* Translators: Part of the theme, e.g. "Left" Widget Area. */
								__( '"%s" Widget Area', 'pen' ),
								__( 'Bottom', 'pen' )
							),
							__( 'Colors', 'pen' )
						),
						'section,sidebar-widgets-sidebar-bottom' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								/* Translators: Part of the theme, e.g. "Left" Widget Area. */
								__( '"%s" Widget Area', 'pen' ),
								__( 'Bottom', 'pen' )
							),
							__( 'Configure Widgets', 'pen' )
						),
					),
				);

			case 'sidebar-footer-top':
				return array(
					'name'  => sprintf(
						'%1$s &rarr; %2$s',
						__( 'Footer', 'pen' ),
						__( 'Top', 'pen' )
					),
					'items' => array(
						'section,animation_widget_areas' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								'%1$s &rarr; %2$s',
								__( 'Footer', 'pen' ),
								__( 'Top', 'pen' )
							),
							__( 'Animation', 'pen' )
						),
						'section,sidebar-widgets-sidebar-footer-top' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								/* Translators: Part of the theme, e.g. "Left" Widget Area. */
								__( '"%s" Widget Area', 'pen' ),
								sprintf(
									'%1$s &rarr; %2$s',
									__( 'Footer', 'pen' ),
									__( 'Top', 'pen' )
								)
							),
							__( 'Configure Widgets', 'pen' )
						),
					),
				);

			case 'sidebar-footer-left':
				return array(
					'name'  => sprintf(
						'%1$s &rarr; %2$s',
						__( 'Footer', 'pen' ),
						__( 'Left', 'pen' )
					),
					'items' => array(
						'section,animation_widget_areas' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								'%1$s &rarr; %2$s',
								__( 'Footer', 'pen' ),
								__( 'Left', 'pen' )
							),
							__( 'Animation', 'pen' )
						),
						'section,sidebar-widgets-sidebar-footer-left' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								/* Translators: Part of the theme, e.g. "Left" Widget Area. */
								__( '"%s" Widget Area', 'pen' ),
								sprintf(
									'%1$s &rarr; %2$s',
									__( 'Footer', 'pen' ),
									__( 'Left', 'pen' )
								)
							),
							__( 'Configure Widgets', 'pen' )
						),
					),
				);

			case 'sidebar-footer-right':
				return array(
					'name'  => sprintf(
						'%1$s &rarr; %2$s',
						__( 'Footer', 'pen' ),
						__( 'Right', 'pen' )
					),
					'items' => array(
						'section,animation_widget_areas' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								'%1$s &rarr; %2$s',
								__( 'Footer', 'pen' ),
								__( 'Right', 'pen' )
							),
							__( 'Animation', 'pen' )
						),
						'section,sidebar-widgets-sidebar-footer-right' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								/* Translators: Part of the theme, e.g. "Left" Widget Area. */
								__( '"%s" Widget Area', 'pen' ),
								sprintf(
									'%1$s &rarr; %2$s',
									__( 'Footer', 'pen' ),
									__( 'Right', 'pen' )
								)
							),
							__( 'Configure Widgets', 'pen' )
						),
					),
				);

			case 'sidebar-footer-bottom':
				return array(
					'name'  => sprintf(
						'%1$s &rarr; %2$s',
						__( 'Footer', 'pen' ),
						__( 'Bottom', 'pen' )
					),
					'items' => array(
						'section,animation_widget_areas' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								'%1$s &rarr; %2$s',
								__( 'Footer', 'pen' ),
								__( 'Bottom', 'pen' )
							),
							__( 'Animation', 'pen' )
						),
						'section,sidebar-widgets-sidebar-footer-bottom' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								/* Translators: Part of the theme, e.g. "Left" Widget Area. */
								__( '"%s" Widget Area', 'pen' ),
								sprintf(
									'%1$s &rarr; %2$s',
									__( 'Footer', 'pen' ),
									__( 'Bottom', 'pen' )
								)
							),
							__( 'Configure Widgets', 'pen' )
						),
					),
				);

			case 'sidebar-mobile-menu-top':
				return array(
					'name'  => sprintf(
						'%1$s &rarr; %2$s',
						__( 'Mobile Menu', 'pen' ),
						__( 'Top', 'pen' )
					),
					'items' => array(
						'section,animation_widget_areas' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								'%1$s &rarr; %2$s',
								__( 'Mobile Menu', 'pen' ),
								__( 'Top', 'pen' )
							),
							__( 'Animation', 'pen' )
						),
						'section,sidebar-widgets-sidebar-mobile-menu-top' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								/* Translators: Part of the theme, e.g. "Left" Widget Area. */
								__( '"%s" Widget Area', 'pen' ),
								sprintf(
									'%1$s &rarr; %2$s',
									__( 'Mobile Menu', 'pen' ),
									__( 'Top', 'pen' )
								)
							),
							__( 'Configure Widgets', 'pen' )
						),
					),
				);

			case 'sidebar-mobile-menu-bottom':
				return array(
					'name'  => sprintf(
						'%1$s &rarr; %2$s',
						__( 'Mobile Menu', 'pen' ),
						__( 'Bottom', 'pen' )
					),
					'items' => array(
						'section,animation_widget_areas' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								'%1$s &rarr; %2$s',
								__( 'Mobile Menu', 'pen' ),
								__( 'Bottom', 'pen' )
							),
							__( 'Animation', 'pen' )
						),
						'section,sidebar-widgets-sidebar-mobile-menu-Bottom' => sprintf(
							'<span>%1$s </span>%2$s',
							sprintf(
								/* Translators: Part of the theme, e.g. "Left" Widget Area. */
								__( '"%s" Widget Area', 'pen' ),
								sprintf(
									'%1$s &rarr; %2$s',
									__( 'Mobile Menu', 'pen' ),
									__( 'Bottom', 'pen' )
								)
							),
							__( 'Configure Widgets', 'pen' )
						),
					),
				);

			case 'footer':
				return array(
					'name'  => __( 'Footer', 'pen' ),
					'items' => array(
						'section,footer'                  => sprintf(
							'%1$s<span> &rarr; %2$s</span>',
							__( 'General', 'pen' ),
							__( 'Footer', 'pen' )
						),
						'section,animation_footer'        => sprintf(
							'<span>%1$s </span>%2$s',
							__( 'Footer', 'pen' ),
							__( 'Animation', 'pen' )
						),
						'section,background_image_footer' => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'Footer', 'pen' ),
							__( 'Background Image', 'pen' )
						),
						'section,colors_footer'           => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'Footer', 'pen' ),
							__( 'Colors', 'pen' )
						),
						'section,typography_footer'       => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'Footer', 'pen' ),
							__( 'Typography', 'pen' )
						),
						'panel,contact'                   => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'Site', 'pen' ),
							sprintf(
								/* Translators: Just some words. */
								__( '%1$s & %2$s', 'pen' ),
								__( 'RSS', 'pen' ),
								__( 'Social Media', 'pen' )
							)
						),
					),
				);

			case 'woocommerce':
				return array(
					'name'  => __( 'WooCommerce', 'pen' ),
					'items' => array(
						'panel,woocommerce'          => sprintf(
							'%1$s<span> &rarr; %2$s</span>',
							__( 'General', 'pen' ),
							__( 'WooCommerce', 'pen' )
						),
						'section,colors_woocommerce' => sprintf(
							'<span>%1$s &rarr; </span>%2$s',
							__( 'WooCommerce', 'pen' ),
							__( 'Colors', 'pen' )
						),
					),
				);
		}
	}
}

if ( ! function_exists( 'pen_post_meta_options' ) ) {
	/**
	 * Returns a list of post meta options.
	 *
	 * @param string $group Which group of options to return.
	 *
	 * @since Pen 1.0.5
	 * @return array
	 */
	function pen_post_meta_options( $group = 'all' ) {
		$options_list = array(
			// Do not reorder alphabetically.
			'pen_list_header_alignment_override'           => sprintf(
				'%1$s &rarr; %2$s &rarr; %3$s &rarr; %4$s',
				__( 'Content', 'pen' ),
				__( 'Header', 'pen' ),
				__( 'Alignment', 'pen' ),
				__( 'Center', 'pen' )
			),
			'pen_list_title_alignment_override'            => sprintf(
				'%1$s &rarr; %2$s &rarr; %3$s &rarr; %4$s',
				__( 'Content', 'pen' ),
				__( 'Title', 'pen' ),
				__( 'Alignment', 'pen' ),
				__( 'Center', 'pen' )
			),
			'pen_list_title_display_override'              => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Title', 'pen' )
			),
			'pen_list_animation_reveal_override'           => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Animation', 'pen' ),
				__( 'Content', 'pen' )
			),
			'pen_list_animation_delay_reveal_override'     => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Animation', 'pen' ),
				__( 'Content', 'pen' )
			),
			'pen_list_author_display_override'             => __( 'Author', 'pen' ),
			'pen_list_date_display_override'               => __( 'Publish Date', 'pen' ),
			'pen_list_date_location_override'              => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Location', 'pen' ),
				__( 'Content Date', 'pen' )
			),
			'pen_list_header_display_override'             => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Header', 'pen' )
			),
			'pen_list_footer_display_override'             => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Footer', 'pen' )
			),
			'pen_list_summary_display_override'            => __( 'Summary', 'pen' ),
			'pen_list_tags_display_override'               => __( 'Tags', 'pen' ),
			'pen_list_thumbnail_animation_reveal_override' => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Animation', 'pen' ),
				__( 'Featured Image', 'pen' )
			),
			'pen_list_thumbnail_animation_delay_reveal_override' => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Animation', 'pen' ),
				__( 'Featured Image', 'pen' )
			),
			'pen_list_category_display_override'           => __( 'Categories', 'pen' ),
			'pen_list_category_location_override'          => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Location', 'pen' ),
				__( 'Categories', 'pen' )
			),
			'pen_list_profile_display_override'            => __( 'Author Profile', 'pen' ),
			'pen_list_button_read_more_text_override'      => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Wording', 'pen' ),
				__( 'Read More', 'pen' )
			),
			'pen_list_author_location_override'            => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Location', 'pen' ),
				__( 'Author', 'pen' )
			),
			'pen_list_share_location_override'             => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Location', 'pen' ),
				sprintf(
					'%1$s &rarr; %2$s',
					__( 'Button', 'pen' ),
					__( 'Share', 'pen' )
				)
			),
			'pen_list_background_image_content_title_dynamic_override' => sprintf(
				'%1$s &rarr; %2$s &rarr; %3$s &rarr; %4$s',
				__( 'Background', 'pen' ),
				__( 'Content', 'pen' ),
				__( 'Header', 'pen' ),
				__( 'Featured Image', 'pen' )
			),
			'pen_list_thumbnail_display_override'          => __( 'Featured Image', 'pen' ),
			'pen_list_thumbnail_alignment_override'        => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Alignment', 'pen' ),
				__( 'Featured Image', 'pen' )
			),
			'pen_color_list_thumbnail_frame_override'      => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s (%3$s)', 'pen' ),
				__( 'Colors', 'pen' ),
				__( 'Featured Image', 'pen' ),
				_x( 'Frame', 'As in photo or picture frame.', 'pen' )
			),
			'pen_list_thumbnail_frame_override'            => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Featured Image', 'pen' ),
				_x( 'Frame', 'As in photo or picture frame.', 'pen' )
			),
			'pen_list_thumbnail_resize_override'           => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Featured Image', 'pen' ),
				__( 'Size', 'pen' )
			),
			'pen_list_thumbnail_rotate_override'           => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Rotate', 'pen' ),
				__( 'Featured Image', 'pen' )
			),
			'pen_list_tile_thumbnail_style_override'       => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s (%3$s)', 'pen' ),
				__( 'Featured Image', 'pen' ),
				__( 'Style', 'pen' ),
				__( 'Tiles', 'pen' )
			),
			'pen_list_masonry_thumbnail_style_override'    => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s (%3$s)', 'pen' ),
				__( 'Featured Image', 'pen' ),
				__( 'Style', 'pen' ),
				'jQuery Masonry'
			),
			'pen_list_button_comment_display_override'     => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Button', 'pen' ),
				__( 'Comment', 'pen' )
			),
			'pen_list_button_edit_display_override'        => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Button', 'pen' ),
				__( 'Edit', 'pen' )
			),
		);

		$options_content = array(
			// Do not reorder alphabetically.
			'pen_content_custom_preset_color_override'    => __( 'Color Scheme', 'pen' ),
			'pen_content_custom_preset_font_override'     => __( 'Font Group', 'pen' ),
			'pen_site_width_override'                     => __( 'Site Layout', 'pen' ),
			'pen_sidebar_left_width_override'             => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Left Sidebar', 'pen' ),
				__( 'Width', 'pen' )
			),
			'pen_sidebar_right_width_override'            => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Right Sidebar', 'pen' ),
				__( 'Width', 'pen' )
			),
			// This one has pen_list_ prefix but also belongs to full content view, hence added here.
			'pen_list_type_override'                      => __( 'List Type', 'pen' ),
			'pen_site_header_display_override'            => __( 'Site Header', 'pen' ),
			'pen_site_footer_display_override'            => __( 'Site Footer', 'pen' ),
			'pen_navigation_display_override'             => __( 'Main Menu', 'pen' ),
			'pen_content_header_alignment_override'       => sprintf(
				'%1$s &rarr; %2$s &rarr; %3$s &rarr; %4$s',
				__( 'Content', 'pen' ),
				__( 'Header', 'pen' ),
				__( 'Alignment', 'pen' ),
				__( 'Center', 'pen' )
			),
			'pen_content_title_alignment_override'        => sprintf(
				'%1$s &rarr; %2$s &rarr; %3$s &rarr; %4$s',
				__( 'Content', 'pen' ),
				__( 'Title', 'pen' ),
				__( 'Alignment', 'pen' ),
				__( 'Center', 'pen' )
			),
			'pen_content_title_display_override'          => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Title', 'pen' )
			),
			'pen_content_animation_reveal_override'       => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Animation', 'pen' ),
				__( 'Content Area', 'pen' )
			),
			'pen_content_animation_delay_reveal_override' => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				sprintf(
					'%1$s &rarr; %2$s',
					__( 'Animation', 'pen' ),
					__( 'Delay', 'pen' )
				),
				__( 'Content Area', 'pen' )
			),
			'pen_content_author_display_override'         => __( 'Author', 'pen' ),
			'pen_content_date_display_override'           => __( 'Publish Date', 'pen' ),
			'pen_content_date_location_override'          => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Location', 'pen' ),
				__( 'Content Date', 'pen' )
			),
			'pen_content_header_display_override'         => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Header', 'pen' )
			),
			'pen_content_footer_display_override'         => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Footer', 'pen' )
			),
			'pen_content_tags_display_override'           => __( 'Tags', 'pen' ),
			'pen_content_profile_display_override'        => __( 'Author Profile', 'pen' ),
			'pen_content_author_location_override'        => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Location', 'pen' ),
				__( 'Author', 'pen' )
			),
			'pen_content_share_display_override'          => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Button', 'pen' ),
				__( 'Share', 'pen' )
			),
			'pen_content_share_location_override'         => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Location', 'pen' ),
				sprintf(
					'%1$s &rarr; %2$s',
					__( 'Button', 'pen' ),
					__( 'Share', 'pen' )
				)
			),
			'pen_content_category_display_override'       => __( 'Categories', 'pen' ),
			'pen_content_category_location_override'      => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Location', 'pen' ),
				__( 'Categories', 'pen' )
			),
			'pen_content_search_display_override'         => __( 'Search Box', 'pen' ),
			'pen_content_search_location_override'        => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Location', 'pen' ),
				__( 'Search Box', 'pen' )
			),
			'pen_content_previous_display_override'       => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Button', 'pen' ),
				__( 'Previous', 'pen' )
			),
			'pen_content_next_display_override'           => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Button', 'pen' ),
				__( 'Next', 'pen' )
			),
			'pen_content_background_image_content_title_dynamic_override' => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Dynamic Background Image', 'pen' ),
				__( 'Title', 'pen' )
			),
			'pen_content_background_image_bottom_dynamic_override' => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Dynamic Background Image', 'pen' ),
				sprintf(
					/* Translators: Part of the theme, e.g. "Left" Widget Area. */
					__( '"%s" Widget Area', 'pen' ),
					__( 'Bottom', 'pen' )
				)
			),
			'pen_content_background_image_footer_dynamic_override' => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Dynamic Background Image', 'pen' ),
				__( 'Footer', 'pen' )
			),
			'pen_content_background_image_header_dynamic_override' => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Dynamic Background Image', 'pen' ),
				__( 'Header', 'pen' )
			),
			'pen_content_background_image_navigation_dynamic_override' => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Dynamic Background Image', 'pen' ),
				__( 'Navigation', 'pen' )
			),
			'pen_content_background_image_navigation_submenu_dynamic_override' => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Dynamic Background Image', 'pen' ),
				__( 'Sub-menus', 'pen' )
			),
			'pen_content_background_image_search_dynamic_override' => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Dynamic Background Image', 'pen' ),
				__( 'Search Bar', 'pen' )
			),
			'pen_content_background_image_site_dynamic_override' => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Dynamic Background Image', 'pen' ),
				__( 'Site', 'pen' )
			),
			'pen_content_thumbnail_display_override'      => __( 'Featured Image', 'pen' ),
			'pen_color_content_thumbnail_frame_override'  => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s (%3$s)', 'pen' ),
				__( 'Colors', 'pen' ),
				__( 'Featured Image', 'pen' ),
				_x( 'Frame', 'As in photo or picture frame.', 'pen' )
			),
			'pen_content_thumbnail_alignment_override'    => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Alignment', 'pen' ),
				__( 'Featured Image', 'pen' )
			),
			'pen_content_thumbnail_animation_reveal_override' => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Animation', 'pen' ),
				__( 'Featured Image', 'pen' )
			),
			'pen_content_thumbnail_animation_delay_reveal_override' => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				sprintf(
					'%1$s &rarr; %2$s',
					__( 'Animation', 'pen' ),
					__( 'Delay', 'pen' )
				),
				__( 'Featured Image', 'pen' )
			),
			'pen_content_thumbnail_frame_override'        => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Featured Image', 'pen' ),
				_x( 'Frame', 'As in photo or picture frame.', 'pen' )
			),
			'pen_content_thumbnail_resize_override'       => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Featured Image', 'pen' ),
				__( 'Size', 'pen' )
			),
			'pen_content_thumbnail_rotate_override'       => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Rotate', 'pen' ),
				__( 'Featured Image', 'pen' )
			),
		);

		$options_sidebar = array(
			'pen_sidebar_header_primary_display'   => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Header', 'pen' ),
				__( 'Primary', 'pen' )
			),
			'pen_sidebar_header_secondary_display' => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Header', 'pen' ),
				__( 'Secondary', 'pen' )
			),
			'pen_sidebar_search_top_display'       => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Search Bar', 'pen' ),
				__( 'Top', 'pen' )
			),
			'pen_sidebar_search_left_display'      => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Search Bar', 'pen' ),
				__( 'Left', 'pen' )
			),
			'pen_sidebar_search_right_display'     => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Search Bar', 'pen' ),
				__( 'Right', 'pen' )
			),
			'pen_sidebar_search_bottom_display'    => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Search Bar', 'pen' ),
				__( 'Bottom', 'pen' )
			),
			'pen_sidebar_top_display'              => __( 'Top', 'pen' ),
			'pen_sidebar_left_display'             => __( 'Left', 'pen' ),
			'pen_sidebar_right_display'            => __( 'Right', 'pen' ),
			'pen_sidebar_content_top_display'      => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Top', 'pen' )
			),
			'pen_sidebar_content_bottom_display'   => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Bottom', 'pen' )
			),
			'pen_sidebar_bottom_display'           => __( 'Bottom', 'pen' ),
			'pen_sidebar_footer_top_display'       => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Footer', 'pen' ),
				__( 'Top', 'pen' )
			),
			'pen_sidebar_footer_left_display'      => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Footer', 'pen' ),
				__( 'Left', 'pen' )
			),
			'pen_sidebar_footer_right_display'     => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Footer', 'pen' ),
				__( 'Right', 'pen' )
			),
			'pen_sidebar_footer_bottom_display'    => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Footer', 'pen' ),
				__( 'Bottom', 'pen' )
			),
		);

		if ( ! $group || 'all' === $group ) {
			return array_merge( $options_list, $options_content, $options_sidebar );
		}

		if ( 'list' === $group ) {
			return $options_list;
		}

		if ( 'content' === $group ) {
			return $options_content;
		}

		if ( 'sidebar' === $group ) {
			return $options_sidebar;
		}

	}
}

if ( ! function_exists( 'pen_wp_image_sizes' ) ) {
	/**
	 * Get size information for all currently-registered image sizes.
	 * https://codex.wordpress.org/Function_Reference/get_intermediate_image_sizes
	 *
	 * @global $_wp_additional_image_sizes
	 * @uses   get_intermediate_image_sizes()
	 *
	 * @param bool $return_data Only return a data array.
	 *
	 * @since Pen 1.2.8
	 * @return array $sizes Data for all currently-registered image sizes.
	 */
	function pen_wp_image_sizes( $return_data = false ) {
		global $_wp_additional_image_sizes;

		$data = array();
		foreach ( get_intermediate_image_sizes() as $_size ) {
			if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ), true ) ) {
				$data[ $_size ]['width']  = (int) get_option( $_size . '_size_w' );
				$data[ $_size ]['height'] = (int) get_option( $_size . '_size_h' );
				$data[ $_size ]['crop']   = (bool) get_option( $_size . '_crop' );
			} elseif ( ! empty( $_wp_additional_image_sizes[ $_size ]['width'] ) ) {
				$data[ $_size ] = array(
					'width'  => (int) $_wp_additional_image_sizes[ $_size ]['width'],
					'height' => 0,
					'crop'   => false,
				);
				if ( ! empty( $_wp_additional_image_sizes[ $_size ]['height'] ) ) {
					$data[ $_size ]['height'] = (int) $_wp_additional_image_sizes[ $_size ]['height'];
				}
				if ( ! empty( $_wp_additional_image_sizes[ $_size ]['crop'] ) ) {
					$data[ $_size ]['crop'] = (bool) $_wp_additional_image_sizes[ $_size ]['crop'];
				}
			}
		}
		if ( $return_data ) {
			return $data;
		}

		$list = array();
		foreach ( $data as $id => $size ) {
			if ( $size['height'] ) {
				$dimensions = sprintf(
					' - %1$sx%2$s',
					$size['width'],
					$size['height']
				);
			} else {
				$dimensions = sprintf(
					' - %1$s %2$spx',
					sprintf(
						/* Translators: Just some words. */
						__( '%s:', 'pen' ),
						__( 'Maximum', 'pen' )
					),
					$size['width']
				);
			}

			$list[ $id ] = esc_html(
				sprintf(
					'%1$s%2$s%3$s',
					$id,
					$dimensions,
					$size['crop'] ? ' ' . sprintf(
						/* Translators: Just some words. */
						__( '(%s)', 'pen' ),
						__( 'Cropped Image', 'pen' )
					) : ''
				)
			);
		}
		return $list;
	}
}

if ( ! function_exists( 'pen_domain_name' ) ) {
	/**
	 * Returns the domain name.
	 *
	 * @param bool $scheme Whether to add the URL scheme.
	 *
	 * @since Pen 1.3.8
	 * @return string
	 */
	function pen_domain_name( $scheme = false ) {
		// Sanitized $_SERVER.
		$domain_name = pen_filter_input( 'SERVER', 'SERVER_NAME' );
		if ( ! $domain_name ) {
			$domain_name = pen_filter_input( 'SERVER', 'HTTP_HOST' );
		}
		if ( $domain_name ) {
			if ( $scheme ) {
				$domain_name = esc_url( ( is_ssl() ? 'https://' : 'http://' ) . $domain_name );
			}
			return $domain_name;
		}
	}
}

if ( ! function_exists( 'pen_remind_rate_review' ) ) {
	/**
	 * Reminding users about rating the theme.
	 *
	 * @since Pen 1.3.9
	 * @return boolean
	 */
	function pen_remind_rate_review() {
		$date_activated = (int) get_theme_mod( 'pen_date_activated', false );
		if ( $date_activated && ( time() - $date_activated ) > MONTH_IN_SECONDS ) {
			return true;
		} else {
			$date_downloaded = (int) filemtime( get_template_directory() );
			if ( $date_downloaded && ( time() - $date_downloaded ) > ( 2 * MONTH_IN_SECONDS ) ) {
				return true;
			}
		}
		return false;
	}
}

if ( ! function_exists( 'pen_meta_tags_dark_mode' ) ) {
	/**
	 * Adds the "Dark Mode" meta tags to the <head>.
	 *
	 * @since Pen 1.4.1
	 * @return void
	 */
	function pen_meta_tags_dark_mode() {
		if ( PEN_THEME_DARK_MODE ) {
			echo '<meta name="color-scheme" content="light dark">';
			echo '<meta name="supported-color-schemes" content="light dark">';
		}
	}
	add_action( 'wp_head', 'pen_meta_tags_dark_mode' );
}

if ( ! function_exists( 'pen_privacy_policy_dark_mode' ) ) {
	/**
	 * LocalStorage information for the Privacy Policy guide.
	 * Courtesy of the Twenty Twenty-One theme.
	 *
	 * @since Pen 1.4.1
	 * @return void
	 */
	function pen_privacy_policy_dark_mode() {
		if ( ! function_exists( 'wp_add_privacy_policy_content' ) ) {
			return;
		}
		$content = sprintf(
			'<p class="privacy-policy-tutorial">%s</p>',
			__( 'It uses LocalStorage when Dark Mode support is enabled.', 'pen' )
		);

		$content .= sprintf(
			'<p><strong class="privacy-policy-tutorial">%1$s</strong>%2$s</p>',
			esc_html__( 'Suggested text:', 'pen' ),
			__( 'This website uses LocalStorage to save the setting when Dark Mode support is turned on or off.<br> LocalStorage is necessary for the setting to work and is only used when a user clicks on the Dark Mode button.<br> No data is saved in the database or transferred.', 'pen' )
		);

		wp_add_privacy_policy_content( 'Pen', wp_kses_post( wpautop( $content, false ) ) );
	}
	add_action( 'admin_init', 'pen_privacy_policy_dark_mode' );
}
