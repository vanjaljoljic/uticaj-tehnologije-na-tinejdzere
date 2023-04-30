<?php
/**
  *
 * @package 8Law Lite
 */
$ed_search_placeholder  = get_theme_mod('eightlaw_lite_search_placeholder',__('Search...','eightlaw-lite'));
$ed_search_button_text  = get_theme_mod('eightlaw_lite_search_button_text',__('Search','eightlaw-lite'));
 ?>
<div class="search-icon">
    <i class="fa fa-search"></i>
    <div class="ed-search" style="display: none;"> 
    <div class="search-close"><i class="fa fa-close"></i></div>
     <form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form" method="get" role="search">
        <label>
            <span class="screen-reader-text"><?php _e('Search for:','eightlaw-lite'); ?></span>
            <input type="search" title="<?php _e('Search for:','eightlaw-lite'); ?>" name="s" value="" placeholder="<?php echo esc_attr($ed_search_placeholder); ?>" class="search-field" />
        </label>
        <input type="submit" value="<?php echo esc_attr($ed_search_button_text); ?>" class="search-submit" />
     </form> 
    </div>
</div> 