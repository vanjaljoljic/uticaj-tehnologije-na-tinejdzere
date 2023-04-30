<?php
/**
 * Template Name: Homepage
 * 
 * @package 8Law Lite
 */
get_header();
?>
<?php
if ( is_active_sidebar( 'widget_icon' ) ) :
    ?>
<div class="section-wrapper">
    <?php dynamic_sidebar( 'widget_icon' );?>
</div>
<?php
endif;
if (get_theme_mod('eightlaw_lite_about_setting_option','disable')=='enable') {
    $post_id = get_theme_mod('eightlaw_lite_about_setting_post', '' );
    $about_layout = get_theme_mod('eightlaw_lite_aboutus_layout', 'layout1');
    if(!empty($post_id)):
        ?>
    <section class="about <?php echo esc_attr( $about_layout );?>">
        <div class="ed-container">
            <?php 
            $about_args  = array('post_type'=>'post', 'p' => $post_id, 'post_status' => 'publish','posts_per_page'=>1);
            $about_query = new WP_Query($about_args);
            if ($about_query->have_posts()):
                while ($about_query->have_posts()):
                    $about_query->the_post();
                    if (has_post_thumbnail()):

                    ?>          
                        <figure class="about-img" >
                          <?php 
                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full',true); ?>
                            <a href="<?php the_permalink();?>">
                                <img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title_attribute(); ?>" />
                            </a>
                      </figure>
                    <?php
                    endif; ?>
                    <div class="about-content-wrap">
                      <h2 class="title home-title"><?php the_title(); ?></h2>
                      <div class="about-excerpt home-description"><?php echo eightlaw_lite_excerpt(get_the_content(),450); ?></div>

                      <div class="btn-wrapper"><a href="<?php the_permalink(); ?>" class="btn"><?php echo esc_html(get_theme_mod('eightlaw_lite_aboutus_viewmore_text',__('Details','eightlaw-lite'))); ?></a></div>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata();
                endif;

              ?>
          </div>
      </section>
      <?php
      endif;
  }
  ?>

  <?php

  if(get_theme_mod('eightlaw_lite_callto_setting_option','disable')== 'enable'){
    $call_to_action = get_theme_mod('eightlaw_lite_callto_desc');
    if(!empty($call_to_action)):
        ?>
    <section class="call-to-action">
        <div class="ed-container">
            <h2 class="cta-title home-title"><?php echo esc_html(get_theme_mod('eightlaw_lite_callto_title',__('Our Moto','eightlaw-lite'))); ?></h2>
            <div class="call-to-action-desc home-description"><?php echo wp_kses_post(get_theme_mod('eightlaw_lite_callto_desc')); ?></div>
            <?php
            if(get_theme_mod('eightlaw_lite_callto_link','#')!=''){?>
            <div class="author"><a href="<?php echo esc_url(get_theme_mod('eightlaw_lite_callto_link','#')); ?>"><?php echo esc_html(get_theme_mod('eightlaw_lite_callto_readmore',__('Immanuel Kant','eightlaw-lite'))); ?></a></div>
            <?php
        }
        ?>
    </div>
</section>
<?php
endif;
}
?>


<?php 
if(get_theme_mod('eightlaw_lite_law_option','disable')=='enable'){ 
    $law_post1 = get_theme_mod('eightlaw_lite_law_post1');
    $law_post2 = get_theme_mod('eightlaw_lite_law_post2');
    $law_post3 = get_theme_mod('eightlaw_lite_law_post3');
    $law_post1_icon = get_theme_mod('eightlaw_lite_law_post_one_icon','fa-trophy');
    $law_post2_icon = get_theme_mod('eightlaw_lite_law_post_two_icon','fa-print');
    $law_post3_icon = get_theme_mod('eightlaw_lite_law_post_three_icon','fa-group');
    $law_post_readmore = get_theme_mod('eightlaw_lite_law_button_text', __('Know More','eightlaw-lite'));
    $law_post_btn_link = get_theme_mod('eightlaw_lite_law_button_link','#');
    ?>      
    <section class="law-post-section">
        <div class="ed-container"> 
            <div class="post-law-wrapper">
                <?php if(!empty($law_post1) || !empty($law_post2) || !empty($law_post3)){
                  if(!empty($law_post1)) { ?>
                  <div id="law-post-1" class="law-post">

                    <?php
                    $query1 = new WP_Query( 'p='.$law_post1 );
                        // the Loop
                    while ($query1->have_posts()) : $query1->the_post();                                                         
                    ?>
                    <div class="law-icon">
                        <i class="fa <?php echo esc_attr($law_post1_icon); ?>"></i>
                    </div>                            
                    <div class="law-content">
                        <h2 class="law-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>                                
                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>             
            </div>
            <?php } 

            if(!empty($law_post2)) { ?>
            <div id="law-post-2" class="law-post">

                <?php
                $query2 = new WP_Query( 'p='.$law_post2 );
                        // the Loop
                while ($query2->have_posts()) : $query2->the_post();   ?>
                <div class="law-icon">
                    <i class="fa <?php echo esc_attr($law_post2_icon); ?>"></i>
                </div>                             
                <div class="law-content">
                    <h2 class="law-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>                                
                </div>
            <?php endwhile;
            wp_reset_postdata(); ?>             
        </div>
        <?php } 
        if(!empty($law_post3)) { ?>
        <div id="law-post-3" class="law-post">

            <?php
            $query3 = new WP_Query( 'p='.$law_post3 );
                        // the Loop
            while ($query3->have_posts()) : $query3->the_post();   ?>
            <div class="law-icon">
                <i class="fa <?php echo esc_attr($law_post3_icon); ?>"></i>
            </div>  

            <div class="law-content">
                <h2 class="law-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>                                
            </div>
        <?php endwhile;
        wp_reset_postdata(); ?>             
    </div>
    <?php } ?>   

    <?php } ?>
</div>
<div class="wrap-law-post-right">
    <h2><?php echo esc_html(get_theme_mod('eightlaw_lite_law_title',__('We fight for you','eightlaw-lite')));?></h2>
    <p><?php echo wp_kses_post(get_theme_mod('eightlaw_lite_law_desc'));?></p>
    <?php if(!empty($law_post_readmore)){?>
    <a href="<?php echo esc_url($law_post_btn_link);?>" class="view-more"><?php echo esc_html($law_post_readmore); ?></a>
    <?php } ?>
</div>
</div>
</section>            
<?php } ?>


<?php
if(get_theme_mod('eightlaw_lite_case_setting_option','disable')=='enable'){
    $ed_case_cat    =   get_theme_mod('eightlaw_lite_case_setting_category');
    $ed_case_btn    =   get_theme_mod('eightlaw_lite_case_single_readmore',__('View More','eightlaw-lite'));
    if($ed_case_cat!='0'):
        ?>
    <section class="case">
        <div class="ed-container">
            <div class="section-description">
                <h2 class="case-title home-title"><?php echo esc_html(get_theme_mod('eightlaw_lite_case_title',__('Simple Process','eightlaw-lite'))); ?></h2>
                <p><?php echo wp_kses_post(get_theme_mod('eightlaw_lite_case_desc')); ?></p>                
            </div>
           <div class="case-step-wrap">
               <?php

               $case_args      =   array('category_name'=>$ed_case_cat, 'post_status'=>'publish', 'posts_per_page'=>4,'order'=>'Asc');
               $case_query     =   new WP_Query($case_args);
               $i=0;
               if($case_query->have_posts()):
                while($case_query->have_posts()):$case_query->the_post();            
            ?>               
            <div class="case-step">
                <div class="case-name"><?php the_title(); ?></div>
                <div class="case-text"><?php echo eightlaw_lite_excerpt(get_the_content(), 60);?></div>
                <div class="case-btn"><a href="<?php the_permalink();?>"><?php echo esc_html($ed_case_btn);?></a></div>
            </div>                
            <?php 
            endwhile;
            wp_reset_postdata();
            endif;
            
            ?>
        </div>
    </div>
</section>
<?php
endif;
}
?>

<?php if(get_theme_mod('eightlaw_lite_practice_setting_option','disable') == 'enable'){ ?>
<section class="practice-section">
    <div class="ed-container">
        <?php

        $ed_practice_title = get_theme_mod('eightlaw_lite_practice_title',__('Practice','eightlaw-lite'));
        $ed_practice_desc = get_theme_mod('eightlaw_lite_practice_desc','');
        $practice_layout = get_theme_mod('eightlaw_lite_practice_layout', 'layout1');
        $practice_btn_text = get_theme_mod('eightlaw_lite_practice_button_text',__('Read More','eightlaw-lite'));
        $practice_btn_link = get_theme_mod('eightlaw_lite_practice_button_link','#');
        ?>
        <div class="practice-list <?php echo esc_attr( $practice_layout );?>">  
            <?php
            $practiceimage = get_theme_mod('eightlaw_lite_practice_image','');
            if(!empty($practiceimage)):
                switch ($practice_layout) {
                    case 'layout2':
                        ?>
                        <div class="practice-desc">
                            <h2 class="practice-title" ><?php echo esc_html($ed_practice_title);?></h2>
                            <p><?php echo wp_kses_post($ed_practice_desc);?></p>
                            <div class="btn-wrapper">
                                <a class="practice-btn bttn" href="<?php echo esc_url( $practice_btn_link );?>"><?php echo esc_html($practice_btn_text);?></a>
                            </div>
                        </div> 
                        <div class="practice-image">
                            <a href="<?php the_permalink();?>"><img src="<?php echo esc_url($practiceimage); ?>" alt="<?php echo esc_attr($ed_practice_title); ?>" />
                            </a>
                        </div>
                        <?php   
                         break;
                     
                    default: ?>
                        <div class="practice-image">
                            <a href="<?php the_permalink();?>"><img src="<?php echo esc_url($practiceimage); ?>" alt="<?php echo esc_attr($ed_practice_title); ?>" />
                            </a>
                        </div>
                        <div class="practice-desc">
                            <h2 class="practice-title" ><?php echo esc_html($ed_practice_title);?></h2>
                            <p><?php echo wp_kses_post($ed_practice_desc);?></p>
                            <div class="btn-wrapper">
                                <a class="practice-btn bttn" href="<?php echo esc_url( $practice_btn_link );?>"><?php echo esc_html($practice_btn_text);?></a>
                            </div>
                        </div> 
                        <?php   
                        break;
                } ?>
                <?php   
            else:
                ?>
                <div class="practice-desc-full">
                    <h2 class="practice-title" ><?php echo esc_html($ed_practice_title);?></h2>
                    <p><?php echo wp_kses_post($ed_practice_desc);?></p>
                    <div class="btn-wrapper">
                        <a class="practice-btn btn" href="<?php echo esc_url( $practice_btn_link );?>"><?php echo esc_html($practice_btn_text);?></a>
                    </div>

                </div> 
                <?php
            endif;
            ?>
        </div>    
        
    </div>
</section>      
<?php
}
?>   


<?php if(get_theme_mod('eightlaw_lite_gallery_setting_option','disable')=='enable'){ 
  $ed_ga_cat  =   get_theme_mod('eightlaw_lite_gallery_setting_category');   
  $gallery_title = get_theme_mod('eightlaw_lite_gallery_title',__('Gallery','eightlaw-lite'));
  $gallery_description = get_theme_mod('eightlaw_lite_gallery_description','');
  if(!empty($ed_ga_cat)):?>   

  <section  class="thumbnail-gallery">  
    <div class="ed-container">
            <div class="section-description">
                <h2 class="gallery-title home-title">
                    <?php echo esc_html($gallery_title);?>
                </h2>
                <p><?php echo wp_kses_post( $gallery_description );?></p>                
            </div>
    </div>          
    <?php 

    $loop = new WP_Query(array(
        'category_name' => $ed_ga_cat,
        'posts_per_page' => -1    
        ));
        ?>    

        <ul class="gallery">
            <?php
            if($loop->have_posts()) : 
                while($loop->have_posts()) : $loop-> the_post();
                    $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full', false );
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'eightlaw-lite-blog-medium', false );
                    ?>                      
                    <li>
                        <img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title_attribute(); ?>" />
                        <div class="gallery-view-link">
                            <a href="<?php echo esc_url($image_full[0]);?>"><i class="fa fa-search-plus"></i></a>
                        </div>
                    </li>
            <?php 
                endwhile; 
                wp_reset_postdata();
            endif; ?> 
        </ul>       
    </section>
    <?php
    endif;
}?>

<?php
//check if one of bct is enabled
if(get_theme_mod('eightlaw_lite_benefit_setting_option','disable')=='enable' ||
    get_theme_mod('eightlaw_lite_testimonial_setting_option','disable')=='enable' ||
    get_theme_mod('eightlaw_lite_clientlogo_setting_option','disable')=='enable'){
        $bct_width_class = 'bct-width';
        if(get_theme_mod('eightlaw_lite_benefit_setting_option','disable')=='enable'){
            $bct_width_class = $bct_width_class.'-full';
        }
        if(get_theme_mod('eightlaw_lite_testimonial_setting_option','disable')=='enable'){
            $bct_width_class = $bct_width_class.'-full';
        }
        if(get_theme_mod('eightlaw_lite_clientlogo_setting_option','disable')=='enable'){
            $bct_width_class = $bct_width_class.'-full';
        }

        ?>
        <div class="wrap-bct <?php echo esc_attr( $bct_width_class );?>">
            <div class="ed-container">
                <?php if(get_theme_mod('eightlaw_lite_benefit_setting_option','disable')=='enable'){ 
                  $ed_bf_cat  =   get_theme_mod('eightlaw_lite_benefit_setting_category');  
                  $ed_bf_btn    =   get_theme_mod('eightlaw_lite_benefit_single_readmore',__('View More','eightlaw-lite'));
                  if(!empty($ed_bf_cat)):
                    ?>

                <section class="benefit bct-child">        
                    <h2 class="benefit-title"><?php echo esc_html(get_theme_mod('eightlaw_lite_benefit_title',__('Benefits','eightlaw-lite'))); ?></h2>
                    <?php 
                    $bf_args    =   array('category_name'=>$ed_bf_cat, 'post_status'=>'publish', 'posts_per_page'=>3);
                    $bf_query   =   new WP_Query($bf_args);
                    if($bf_query->have_posts()):
                        $i=0;
                    ?>            
                    <div id="tabs">
                        <ul class="title">
                            <?php
                            while($bf_query->have_posts()):$bf_query->the_post();                
                            $i++;
                            ?>        

                            <li class="tabs-<?php echo $i;?> tabs-title"><a href="javascript:void(0);"><?php the_title();?></a></li>

                            <?php
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </ul>
                        <div class='content'>
                            <?php
                            $j=0;
                            while($bf_query->have_posts()):$bf_query->the_post();                
                            $j++;
                            ?>                 
                            <div  class="tabs-<?php echo $j; ?>-content tabs-content">
                                <div class="tab-image">
                                  <?php 
                                  if (has_post_thumbnail()){
                                     $image=wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'eightlaw-lite-rectangle');
                                 }
                                 ?>
                                 <a href="<?php the_permalink();?>"><img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title_attribute(); ?>" /></a>
                             </div>
                             <div class="tab-content"><p><?php echo eightlaw_lite_excerpt(get_the_excerpt(), 100);?></p></div>
                             <div class="tab-btn"><a href="<?php the_permalink();?>"><?php echo esc_html($ed_bf_btn);?></a></div>
                         </div>    


                         <?php
                         endwhile;
                         wp_reset_postdata();
                         ?>
                     </div>
                 </div>
             <?php endif;?>       
         </section>
         <?php
         endif;
     }?>

     <?php
     if(get_theme_mod('eightlaw_lite_clientlogo_setting_option','disable')=='enable'){
         $ed_cl_cat  = get_theme_mod('eightlaw_lite_clientlogo_category_setting');
         if(!empty($ed_cl_cat)){ ?>
         <section class="clients-logo bct-child">        
            <h2 class="clients-logo-title"><?php echo esc_html(get_theme_mod('eightlaw_lite_clientlogo_title',__('Client Logo','eightlaw-lite'))); ?></h2>
            <div class="clients-logo-wrapper">
                <?php
                $port_args      =   array('category_name'=>$ed_cl_cat, 'post_status'=>'publish', 'posts_per_page'=>3);
                $port_query     =   new WP_Query($port_args);
                if($port_query->have_posts()):
                    while($port_query->have_posts()):
                        $port_query->the_post();
                    ?>
                    <div class="client-slider">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()):
                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'eightlaw-lite-rectangle'); ?>
                            <div class="client-image"><img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title_attribute(); ?>" /></div>
                        <?php endif; ?>
                    </a>
                </div>
                <?php
                endwhile;
                wp_reset_postdata();
                endif;            
                ?>
            </div>

        </section>
        <?php }
    }
    ?>
    <?php if(get_theme_mod('eightlaw_lite_testimonial_setting_option','disable')=='enable'){ 
      $ed_tm_cat  =   get_theme_mod('eightlaw_lite_testimonial_setting_category');      
      if(!empty($ed_tm_cat)):
        ?>
    <section class="testimonial bct-child">
        <h2 class="testimonial-title"><?php echo esc_html(get_theme_mod('eightlaw_lite_testimonial_title',__('Testimonials','eightlaw-lite'))); ?></h2>
        <?php 
        ?>
        <div class="testimonial-slider">
            <?php
            $tm_args    =   array('category_name'=>$ed_tm_cat, 'post_status'=>'publish','posts_per_page'=>-1);
            $tm_query   =   new WP_Query($tm_args);
            if($tm_query->have_posts()):
                while($tm_query->have_posts()):$tm_query->the_post();
            ?>
            <div class="tm-slider">                    
                <div class="testimonials-image">
                    <?php if (has_post_thumbnail()):
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'eightlaw-lite-feature-image'); ?>
                    <img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title_attribute(); ?>" />
                    <?php 
                    else: ?>
                    <img src="<?php echo esc_url(get_template_directory_uri().'/images/testimonial-fallback.jpg'); ?>" alt="<?php the_title_attribute(); ?>" />                            
                <?php endif; ?>
            </div>
            <div class="title-test"> <?php the_title();?> </div>
            <div class="tm-content"><?php echo eightlaw_lite_excerpt(get_the_content(), 320);?></div>

        </div>
        <?php 
        endwhile;
        wp_reset_postdata();
        endif;

        ?>
    </div>
</section>
<?php
endif;
}?>
</div>
</div>
<?php
} //check if one of bct is enabled
?>
<?php
if(get_theme_mod('eightlaw_lite_teammember_setting_option','disable')=='enable'){
    $ed_team_cat    =   get_theme_mod('eightlaw_lite_teammember_setting_category');
    $ed_team_btn    =   get_theme_mod('eightlaw_lite_teammember_single_readmore',__('View More','eightlaw-lite'));
    if($ed_team_cat!='0'):
        ?>
    <section class="our-team-member">
        <div class="ed-container">
            <div class="section-description">
               <h2 class="team-title home-title"><?php echo esc_html(get_theme_mod('eightlaw_lite_teammember_title',__('Team Member Section','eightlaw-lite'))); ?></h2>
               <div class="team-content"><?php echo wp_kses_post(get_theme_mod('eightlaw_lite_teammember_desc')); ?></div>
           </div>
           <div class="team-member-wrap">
               <?php

               $team_args      =   array('category_name'=>$ed_team_cat, 'post_status'=>'publish', 'posts_per_page'=>4);
               $team_query     =   new WP_Query($team_args);
               $i=0;
               if($team_query->have_posts()):
                while($team_query->have_posts()):$team_query->the_post();
            ?>         
            <div class="team-block">
                <figure class="team-image">
                    <div class="team-img">
                        <?php if (has_post_thumbnail()):
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'eightlaw-lite-feature-image'); ?>
                        <a href="<?php the_permalink();?>"><img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title_attribute(); ?>" /></a><?php
                        else:?>
                        <img src="<?php echo esc_url(get_template_directory_uri().'/images/team-fallback-240-130.jpg'); ?>" alt="<?php the_title_attribute(); ?>" />                            
                    <?php endif; ?>
                </div>
            </figure>
            <div class="team-hover">
                <div class="team-name"><?php the_title(); ?></div>                    
                <div class="team-hover-text"><?php echo eightlaw_lite_excerpt(get_the_content(), 120);?></div>
            </div>
            <div class="team-hover-btn"><a href="<?php the_permalink(); ?>"> <?php echo esc_html($ed_team_btn);?>  </a> </div>

        </div>
        <?php 
        endwhile;
        wp_reset_postdata();
        endif;

        ?>
    </div>
</div>
</section>
<?php
endif;
}
?>

<?php
if(get_theme_mod('eightlaw_lite_blog_setting_option','disable')=='enable'){
    $ed_blog_cat    =   get_theme_mod('eightlaw_lite_blog_setting_category', '' );
    $blog_description = get_theme_mod('eightlaw_lite_blog_description','');
    ?>
    <?php 
    if($ed_blog_cat!=0):?>

    <section class="blog-section">
     <div class="ed-container">
            <div class="section-description">
                <h2 class="blog-title home-title"><?php echo esc_html(get_theme_mod('eightlaw_lite_blog_title',__('Blog','eightlaw-lite'))); ?></h2>        
                <p><?php echo wp_kses_post( $blog_description );?></p>                
            </div>
        <div class="blog-wrap">
         <?php
         $blog_args      =   array('category_name'=>$ed_blog_cat, 'post_status'=>'publish', 'posts_per_page'=>3);
         $blog_query     =   new WP_Query($blog_args);
         if($blog_query->have_posts()):
            while($blog_query->have_posts()):$blog_query->the_post();
        $blog_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'eightlaw-lite-blog-medium', true); 
        ?><div class="blog-in-wrap">
        <div class="blog-image">
            <a href="<?php the_permalink();?>"><img src="<?php echo esc_url($blog_image[0]); ?>" alt="<?php the_title_attribute(); ?>" /></a>
        </div>
        <div class="blog-content-wrap clearfix">
            <span class="blog-date"><a href="<?php echo esc_url( home_url( '/'.get_the_date('Y/m/d') ) );?>">
                <span><?php echo get_the_date('d'); ?></span>
                <?php echo get_the_date('M'); ?>
            </a></span>
            <div class="home-blog-desc">
                <div class="blog-title-comment">
                    <h5 class="blog-single-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                    <div class="date-author-wrap">
                        <div class="blog-author">
                            <a href="<?php echo  get_author_posts_url( get_the_author_meta( 'ID' ) );  ?>"><i class="fa fa-pencil"></i><?php the_author(); ?></a>
                        </div>
                        <div class="blog-comment">
                            <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
                                <span class="comments-link"><?php comments_popup_link( __( 'No comment', 'eightlaw-lite' ), __( '1 Comment', 'eightlaw-lite' ), __( '% Comments', 'eightlaw-lite' ) ); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="blog-content">
                    <p><?php echo eightlaw_lite_excerpt(get_the_excerpt(), 240); ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php
    endwhile;
    wp_reset_postdata();
    endif;
    ?>
</div>
<?php
if(get_theme_mod('eightlaw_lite_blog_button_option','disable')=='enable'){
    $ed_blog_cat_url = get_category_link($ed_blog_cat);
    ?> 

    <?php } 

    ?>  
</div> 
</section>
<?php    
endif;    
}
?>
<?php if(get_theme_mod('eightlaw_lite_contact_form_option','disable')=='enable') { 
    $form_id = get_theme_mod('eightlaw_lite_contact_form', 0);
    $contact_title = get_theme_mod('eightlaw_lite_contact_form_title',__('Contact Us, Its Free','eightlaw-lite'));             
    if($form_id){
        $form = get_post($form_id);
        ?>
        <section class="contact-form-section">
            <div class="ed-container">
                <h2 class="title home-title"><?php echo esc_html($contact_title); ?></h2>
                <div class="contact-form">
                    <?php echo do_shortcode('[contact-form-7 id="'.$form_id.'" title="'.$form->post_title.'"]'); ?>
                </div>
            </div>
        </section>        
        <?php } 
    }
    ?>

    <?php
//check if latest wrap has content
    if(get_theme_mod('eightlaw_lite_latestpost_setting_option','disable')=='enable' ||
        get_theme_mod('eightlaw_lite_latestnews_setting_option','disable')=='enable'){
            $latest_width_class = 'latest-width';
            if(get_theme_mod('eightlaw_lite_latestpost_setting_option','disable')=='enable'){
                $latest_width_class = $latest_width_class.'-full';
            }
            if(get_theme_mod('eightlaw_lite_latestnews_setting_option','disable')=='enable'){
                $latest_width_class = $latest_width_class.'-full';
            }  
           ?>
           <div class="wrap-latest <?php echo esc_attr( $latest_width_class );?>"> 
            <div class="ed-container">
                <?php if(get_theme_mod('eightlaw_lite_latestpost_setting_option','disable')=='enable'){        
                   ?>
                   <section class="latest-post latest-child">           
                    <h2 class="latest-post-title home-title"><?php echo esc_html(get_theme_mod('eightlaw_lite_latestpost_title',__('Latest Posts','eightlaw-lite'))); ?></h2>
                    <div class="post-slider">

                        <?php 
                        $read_more_archive = get_theme_mod('eightlaw_lite_latestpost_readmore',__('Read More','eightlaw-lite'));
                        $args_posts = array(
                            'post_type' => 'post',
                            'posts_per_page'   => get_theme_mod('eightlaw_lite_latestpost_num',5),
                            );
                        $query_posts = new WP_Query($args_posts);
                        if($query_posts->have_posts()):
                            while($query_posts->have_posts()): $query_posts->the_post();
                        ?>
                        <div class="lp-wrap">
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                                <div class="entry-content clearfix">
                                    <?php if(has_post_thumbnail()){?>
                                    <div class="archive-thumbnail">
                                        <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'eightlaw-lite-rectangle'); 
                                        if(has_post_thumbnail()){
                                          ?>
                                          <a href="<?php the_permalink();?>"><img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title_attribute(); ?>" /></a><?php
                                          
                                      }
                                      ?> 
                                  </div>                        
                                  <?php } ?>
                                  <header class="entry-header">                        
                                    <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                                    <?php if ( 'post' == get_post_type() ) : ?>
                                        <div class="entry-meta">
                                            <?php eightlaw_lite_posted_on(); ?>
                                        </div><!-- .entry-meta -->
                                    <?php endif; ?>
                                </header>
                                <div class="short-content">
                                    <?php echo eightlaw_lite_excerpt( get_the_excerpt() , 200 ); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="bttn"><?php echo esc_html($read_more_archive); ?></a>

                            </div><!-- .entry-content -->
                        </article><!-- #post-## -->
                    </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    endif; ?>               
                </div>
            </section>

            <?php }?>
            <?php if(get_theme_mod('eightlaw_lite_latestnews_setting_option','disable')=='enable'){ 
              $ed_ln_cat  =   get_theme_mod('eightlaw_lite_latestnews_setting_category');      
              if(!empty($ed_ln_cat)):
                ?>
            <section class="latestnews latest-child">
                <h2 class="latestnews-title"><?php echo esc_html(get_theme_mod('eightlaw_lite_latestnews_title',__('Latest News','eightlaw-lite'))); ?></h2>
                <?php 
                ?>
                <div class="latestnews-slider">
                    <?php
                    $ln_args    =   array('category_name'=>$ed_ln_cat, 'post_status'=>'publish','posts_per_page' => 2, );
                    $ln_query   =   new WP_Query($ln_args);
                    if($ln_query->have_posts()):
                        while($ln_query->have_posts()):$ln_query->the_post();              ?>
                    <div class="ln-slider">
                        <div class="news-title"><a href="<?php the_permalink();?>"> <?php the_title();?></a> </div>
                        <div class="post-date"><?php echo get_the_date();?></div>
                        <?php                     
                        if(has_post_thumbnail()){
                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'eightlaw-lite-blog-medium', true ); 
                            ?>
                            <div class="news-image"><a href="<?php the_permalink();?>"><img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title_attribute(); ?>" /></a></div>
                            <?php

                        }
                        ?> 
                        <div class="news-content"><?php echo eightlaw_lite_excerpt(get_the_content(), 150);?></div>
                        <div class="btn"><a href="<?php the_permalink();?>"><?php echo esc_html(get_theme_mod('eightlaw_lite_latestnews_readmore',__('Read More','eightlaw-lite')));?> </a></div>

                    </div>
                    <?php 
                    endwhile;
                    wp_reset_postdata();
                    endif;

                    ?>
                </div>
            </section>

            <?php
            endif;
        }?>
    </div>
</div>   
<?php
} //check if latest wrap has content

get_footer();
?>