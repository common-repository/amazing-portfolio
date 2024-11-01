<div class="col_full">

<?php


//Get array of terms
$terms = get_the_terms( $post->ID, 'amazing-portfolio-category' );
//Pluck out the IDs to get an array of IDS
$term_ids = wp_list_pluck($terms,'term_id');

//Query posts with tax_query. Choose in 'IN' if want to query posts with any of the terms
//Chose 'AND' if you want to query for posts with all terms
  $second_query = new WP_Query( array(
      'post_type' => 'amazing-portfolio',
      'tax_query' => array(
                    array(
                        'taxonomy' => 'amazing-portfolio-category',
                        'field' => 'id',
                        'terms' => $term_ids,
                        'operator'=> 'AND' //Or 'AND' or 'NOT IN'
                     )),
      'posts_per_page' => 3,
      'ignore_sticky_posts' => 1,
      'orderby' => 'rand',
      'post__not_in'=>array($post->ID)
   ) );


    if($second_query->have_posts()) : ?>
    
    <h4>Related Projects:</h4>
    
    <div id="related-portfolio" class="owl-carousel portfolio-carousel carousel-widget" data-margin="30" data-nav="false" data-autoplay="4000" data-items-xs="1" data-items-sm="2" data-items-md="3" data-items-lg="4" data-items-xl="4">    
    
    <?php
    while ($second_query->have_posts() ) : $second_query->the_post(); 
    global $post;

    $portfolio_meta = get_post_meta(get_the_ID(), 'amazing_portfolio_options', true);
    
    $portfolio_type = $portfolio_meta['portfolio_type'];
    $image_portfolio = $portfolio_meta['portfolio_image'];
    $gallery_portfolio = $portfolio_meta['portfolio_gallery'];
    $video_type = $portfolio_meta['video_type'];
    $video_youtube = $portfolio_meta['video_youtube'];
    $video_vimeo = $portfolio_meta['video_vimeo'];
    $video_cover_image = $portfolio_meta['video_cover_image'];
    
    $image = wp_get_attachment_image_src( $image_portfolio, 'full' );
    $video_cover_image = wp_get_attachment_image_src( $video_cover_image, 'full' );     
     
     
     
    $html = '';
    $html .='<div class="oc-item">
            <div class="iportfolio">'; 
            
    $html .='<div class="apl-portfolio-image">'; 
     
        //var_dump($portfolio_type);
    if( $portfolio_type == 'image_portfolio' && !empty($image_portfolio) ) {
        
            $html .='<a href="'.get_the_permalink().'">
                    <img src="'.$image[0].'" alt="'.get_the_title().'">
                    </a>';
    }
    elseif( $portfolio_type == 'video_portfolio' && isset($video_cover_image) ) {
        
            $html .='<a href="'.get_the_permalink().'">
                    <img src="'.$video_cover_image[0].'" alt="'.get_the_title().'">
                    </a>';
    }    
    elseif( $portfolio_type == 'gallery_portfolio' && !empty($gallery_portfolio) ) {
        
            $html .='<div id="x_022_animated_layers" class="carousel slide x_022_animated_layers_indicators x_022_animated_layers_control_button thumb_scroll_x swipe_x ps_easeOutInCubic" data-ride="carousel" data-pause="hover" data-interval="3000" data-duration="2000">';

            $i = 0; 
            $html .='<ol class="carousel-indicators">';
                    $gallery_images = explode( ',', $gallery_portfolio );
                    foreach ( $gallery_images as $gallery_image ) {
                //$gallery_image = wp_get_attachment_image_src( $gallery_id, 'full' );
                $html .='<li data-target="#x_022_animated_layers" data-slide-to="'.$i.'" class="indictaor_item"></li>';
                $i++;
            }
            $html .='</ol>';
            $html .='<script> jQuery(".carousel-indicators").find(".indictaor_item:first").addClass("active") </script>';            
    
            $html .='<div class="carousel-inner" role="listbox">';
            $gallery_ids = explode( ',', $gallery_portfolio );
            foreach ( $gallery_ids as $gallery_id ) {
                $gallery_image = wp_get_attachment_image_src( $gallery_id, 'full' );
                $html .='<div class="item"><img src="'.$gallery_image[0].'" alt=""></div>';
            }
            $html .='</div></div>';
            $html .='<script> jQuery("#x_022_animated_layers").find(".item:first").addClass("active") </script>';
    } 
    
    if( $portfolio_type == 'gallery_portfolio' && !empty($gallery_portfolio) ) {   
        $html .='<div class="apl-portfolio-overlay apl-gallery">';
    }else{
        $html .='<div class="apl-portfolio-overlay">';
    }
    
    
    
    if( $portfolio_type == 'image_portfolio' && !empty($image_portfolio) ) :
    $html .='<a href="'.$image[0].'" class="left-icon" class="apl-lightbox-image"><i class="fa fa-image"></i></a>';
    endif;
    
    if( $portfolio_type == 'video_portfolio' && $video_type == 'youtube' ) :
    
        if ( !empty($video_youtube) ) {
            $html .='<a href="https://www.youtube.com/watch?v='.$video_youtube.'" class="left-icon apl-youtube-popup"><i class="fa fa-play"></i></a>';
        }   
    
    endif;
    
    if( $portfolio_type == 'video_portfolio' && $video_type == 'vimeo' ) :
    
        if ( !empty($video_vimeo) ) {
            $html .='<a href="https://vimeo.com/'.$video_vimeo.'" class="left-icon apl-vimeo-popup"><i class="fa fa-play"></i></a>';
        }    
    
    endif;    
    
    
    if( $portfolio_type == 'gallery_portfolio' && !empty($gallery_portfolio) ) : 
    
    foreach ( $gallery_ids as $gallery_id ) {
        $gallery_image = wp_get_attachment_image_src( $gallery_id, 'full' );   
        $html .='<a href="'.$gallery_image[0].'" class="left-icon"><i class="fa fa-clone"></i></a>';
    }
    endif;
    
    $html .='<a href="'.get_the_permalink().'" class="right-icon"><i class="fa fa-ellipsis-h"></i></a></div></div>';
    
    $html .='<div class="apl-portfolio-desc">';
    
    $html .='<h3><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>';
    
    
    $html .='<span>'; 
    
    $terms = get_the_terms( $post->ID, 'amazing-portfolio-category' );
    foreach ( $terms as $term ) { 
            $html .='<a href="'.get_term_link($term).'">'.$term->name.'</a>&nbsp;&nbsp;&nbsp;&nbsp;';
        } 
    $html .='</span>'; 
    
    
    
        
    $html .='</div>
        </div></div>';     
         
        
    echo $html;    
  

    endwhile; ?>
    
        </div>
        
    <?php 
    
    wp_reset_query();
    wp_reset_postdata();
    endif; ?>
       
</div>