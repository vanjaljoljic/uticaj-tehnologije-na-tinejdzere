<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Software Company Elementor
 */

?>

<footer>
  <div class="container">
    <?php
      if ( is_active_sidebar('software-company-elementor-footer-sidebar')) {
        echo '<div class="row footer-area">';
          dynamic_sidebar('software-company-elementor-footer-sidebar');
        echo '</div>';
      }
    ?>
    <div class="row">
      <div class="col-lg-6 col-md-6 align-self-center">
        <p class="mb-0 py-3 text-center text-md-left">
          <?php
              if (!get_theme_mod('software_company_elementor_footer_text') ) { ?>
                <a href="<?php echo esc_url(__('https://www.wpelemento.com/elementor/free-software-company-wordpress-theme/', 'software-company-elementor' )); ?>" target="_blank">
                  <?php esc_html_e('Software Company WordPress Theme','software-company-elementor'); ?>
                </a>
          <?php } else {
              echo esc_html(get_theme_mod('software_company_elementor_footer_text'));
            }
          ?>
          <?php if ( get_theme_mod('software_company_elementor_copyright_enable', true) == true ) : ?>
          <?php
            /* translators: %s: WP Elemento */
            printf( esc_html__( ' By %s', 'software-company-elementor' ), 'WP Elemento' ); ?>
          <?php endif; ?>
        </p>
      </div>
      <div class="col-lg-6 col-md-6 align-self-center text-center text-md-right">
        <?php if ( get_theme_mod('software_company_elementor_copyright_enable', true) == true ) : ?>
          <a href="<?php echo esc_url('https://wordpress.org'); ?>" rel="generator"><?php  /* translators: %s: WordPress */ printf( esc_html__( 'Proudly powered by %s', 'software-company-elementor' ), 'WordPress' ); ?></a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
