<?php
/**
 * Recent hook
 *
 * @package the_event
 */

if ( ! function_exists( 'the_event_add_recent_section' ) ) :
    /**
    * Add recent section
    *
    *@since The Event 1.0.0
    */
    function the_event_add_recent_section() {

        // Check if recent is enabled on frontpage
        $recent_enable = apply_filters( 'the_event_section_status', 'enable_recent', '' );

        if ( ! $recent_enable )
            return false;

        // Get recent section details
        $section_details = array();
        $section_details = apply_filters( 'the_event_filter_recent_section_details', $section_details );

        if ( empty( $section_details ) ) 
            return;

        // Render recent section now.
        the_event_render_recent_section( $section_details );
    }
endif;

if ( ! function_exists( 'the_event_get_recent_section_details' ) ) :
    /**
    * recent section details.
    *
    * @since The Event 1.0.0
    * @param array $input recent section details.
    */
    function the_event_get_recent_section_details( $input ) {

        // Content type.
        $recent_content_type  = the_event_theme_option( 'recent_content_type' );
        $content = array();
        switch ( $recent_content_type ) {

            case 'recent':
                $args = array(
                    'post_type'         => 'post',
                    'posts_per_page'    => 3,
                    'ignore_sticky_posts' => true,
                    );                   
            break;

            case 'category':
                $cat_id = the_event_theme_option( 'recent_content_category', '' );
                
                $args = array(
                    'post_type'         => 'post',
                    'cat'               =>  $cat_id,
                    'posts_per_page'    => 3,
                    'ignore_sticky_posts' => true,
                    );                    
            break;

            default:
            break;
        }

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            $i = 0;
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['excerpt']   = the_event_trim_content( 20 );
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : '';

                // Push to the main array.
                array_push( $content, $page_post );
                $i++;
            endwhile;
        endif;
        wp_reset_postdata();
            
        if ( ! empty( $content ) )
            $input = $content;
       
        return $input;
    }
endif;
// recent section content details.
add_filter( 'the_event_filter_recent_section_details', 'the_event_get_recent_section_details' );


if ( ! function_exists( 'the_event_render_recent_section' ) ) :
  /**
   * Start recent section
   *
   * @return string recent content
   * @since The Event 1.0.0
   *
   */
   function the_event_render_recent_section( $content_details = array() ) {
        if ( empty( $content_details ) )
            return;

        $title = the_event_theme_option( 'recent_title', '' );
        $sub_title = the_event_theme_option( 'recent_sub_title', '' );

        ?>
    	<div id="popular-posts" class="page-section relative">
            <div class="wrapper">
                <?php if ( ! empty( $title ) || ! empty( $sub_title ) ) : ?>
                    <div class="section-header align-center">
                        <?php if ( ! empty( $sub_title ) ) : ?>
                            <p class="sub-title"><?php echo esc_html( $sub_title ); ?></p>
                        <?php endif;

                        if ( ! empty( $title ) ) : ?>
                            <h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
                        <?php endif; ?>
                    </div><!-- .section-header -->
                <?php endif; ?>

                <div class="section-content column-3">
                    <?php foreach ( $content_details as $content ) : ?>
                            <article class="hentry">
                                <div class="post-wrapper">
                                    <?php if ( ! empty( $content['image'] ) ) : ?>
                                        <div class="featured-image">
                                            <a href="<?php echo esc_url( $content['url'] ); ?>">
                                                <img src="<?php echo esc_url( $content['image'] ); ?>" alt="<?php echo esc_attr( $content['title'] ); ?>">
                                            </a>
                                        </div><!-- .recent-image -->
                                    <?php endif; ?>

                                    <div class="entry-container">

                                        <header class="entry-header">
                                            <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                        </header>

                                        <div class="entry-content">
                                            <p><?php echo esc_html( $content['excerpt'] ); ?></p>
                                        </div><!-- .entry-content -->
                                        
                                        <div class="entry-meta">
                                            <span class="posted-on">
                                                <a href="<?php echo esc_url( $content['url'] ); ?>">
                                                    <time><?php echo esc_html( get_the_date( get_option('date_format'), $content['id'] ) ); ?></time>
                                                </a>
                                            </span>
                                        </div>

                                    </div><!-- .entry-container -->
                                </div><!-- .post-wrapper -->
                            </article>
                        <?php endforeach; ?>
                </div><!-- .section-content -->
            </div><!-- .wrapper -->
        </div><!-- #popular-posts -->
    <?php 
    }
endif;