<?php

/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package pumori
 * @subpackage pumori
 * @since 1.0.0
 */
if ( !defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

/*--------------------------------------------------------------
# Theme Supports
--------------------------------------------------------------*/

if ( !function_exists( 'pumori_setup' ) ) {
  function pumori_setup() {

      /*
        * Make theme available for translation.
        * Translations can be filed in the /languages/ directory.
        * to change 'dablam' to the name of your theme in all the template files.
      */
      load_theme_textdomain( 'pumori' );

      // Add default posts and comments RSS feed links to head.
      add_theme_support( 'automatic-feed-links' );
      /*
       * Enable support for Post Thumbnails on posts and pages.
       *
       * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
       */
      add_theme_support( 'post-thumbnails' );
      set_post_thumbnail_size( 1568, 9999 );
      // Add support for Block Styles.
      add_theme_support( 'wp-block-styles' );
      // Add support for editor styles.
      add_theme_support( 'editor-styles' );
      // Add support for responsive embedded content.
      add_theme_support( 'responsive-embeds' );
      // Add support for experimental link color control.
      add_theme_support( 'experimental-link-color' );
      // Add support for custom units.
      add_theme_support( 'custom-units' );
      add_theme_support( 'automatic-feed-links' );
      // Add support for title tag
      add_theme_support( 'title-tag' );
      // Add support for html5
      add_theme_support( 'html5', array( 'comment-form', 'comment-list' ) );
      // Add support for refresh widget
      add_theme_support( 'customize-selective-refresh-widgets' );
  }
}
add_action( 'after_setup_theme', 'pumori_setup' );

/**
 * Show '(no title)' in frontend if post has no title to make it selectable
 */
add_filter(
  'the_title',
  function( $title ) {
      if ( ! is_admin() && empty( $title ) ) {
          $title = __( '(no title)', 'pumori' );
      }
      return $title;
  }
);