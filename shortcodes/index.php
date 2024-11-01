<?php

if ( ! defined( 'ABSPATH' ) ) { die; }

function apl_portfolio_shortcode($atts, $content = null){
    extract( shortcode_atts( array(
    
        'id'                     => '',
        'style'                  => 'grid',
        'column'                 => 'apl-portfolio',
        'title_visibility'       => '',
        'margin'                 => '',
        'apl_filter'             => '',
        'apl_filter_style'       => '',
        'apl_filter_position'    => '',
        'cat'                    => '',
        'category_name'          => '',
        'num'                    => 10,
        'order'                  => 'DESC',
        'orderby'                => 'date',
        
    ), $atts) );
      
    
    if (is_front_page()) {
        $paged = (get_query_var('page')) ? get_query_var('page') : 1;
    }
    else {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    }    
    
    // Allowed args in WP Query
    $custom_args = array(
        'cat'                    => '',
        //'category_name'        => $category_name,
        'post_type'              => 'amazing-portfolio',
        'post_status'            => 'publish',
        'posts_per_page'         => $num,
        'order'                  => $order,
        'orderby'                => $orderby,
        'paged'                  => $paged
        //'p'                      => $id
    ); 
/*    $custom_args['tax_query']     = array(
        array(
            'taxonomy'     => 'amazing-portfolio-category',
            'terms'     => $cat
        ) ); */           
    
    $custom_query = new WP_Query( $custom_args );

    
    $output ='';
    
    
    $output .='<section id="apl-portfolio-content"><div class="apl-content-wrap"><div class="apl-container clearfix">';
                        
    
    
    if ( $apl_filter == true ) {
        
    $output .='<ul class="apl-portfolio-filter '.$apl_filter_style.' '.$apl_filter_position.' clearfix" data-container="#apl-portfolio">';
    
    $output .='<li><a href="#" data-filter="*">Show All</a></li>';
    
    $filter_terms = get_categories(array('type' => 'amazing-portfolio', 'taxonomy' => 'amazing-portfolio-category'));
    //var_dump($filter_terms);
    
    foreach($filter_terms as $filter_term) {
        $output .='<li><a href="#" data-filter=".'.$filter_term->slug.'">'.$filter_term->cat_name.'</a></li>';
    
    }
    
    $output .='</ul>';
    //$output .='<script> jQuery(".apl-portfolio-filter").find("li:first").addClass("activeFilter") </script>'; 
    
    
    }
    
    
    $output .='<div id="apl-portfolio" class="apl-portfolio grid-container '.$column.' '.$margin.' '.$title_visibility.' clearfix apl-clear">';
    
    if ( $custom_query->have_posts() ) :
    
    while($custom_query->have_posts()) : $custom_query->the_post();
    $idd = get_the_ID();  
    global $post;

    $portfolio_meta = get_post_meta(get_the_ID(), 'amazing_portfolio_options', true);
    
    $portfolio_type = $portfolio_meta['portfolio_type'];
    $image_portfolio = $portfolio_meta['portfolio_image'];
    $gallery_portfolio = $portfolio_meta['portfolio_gallery'];
    //$video_portfolio = $portfolio_meta['portfolio_video'];
    $video_type = $portfolio_meta['video_type'];
    $video_youtube = $portfolio_meta['video_youtube'];
    $video_vimeo = $portfolio_meta['video_vimeo'];
    
    
    $video_cover_image = $portfolio_meta['video_cover_image'];
    
    $image = wp_get_attachment_image_src( $image_portfolio, 'full' );
    $video_cover_image = wp_get_attachment_image_src( $video_cover_image, 'full' );
    //var_dump($image);
     
    
    $catgory_terms = get_the_terms( $post->ID, 'amazing-portfolio-category' );
    $cat_slug = '';
    foreach ( $catgory_terms  as $vallue=>$key ) { 
        $cat_slug  .= strtolower($key->slug) . " ";
    }
    
    $output .='<article class="apl-portfolio-item '.esc_attr($cat_slug).'">';
    
    $output .='<div class="apl-portfolio-image">';
    
        //var_dump($portfolio_type);
    if( $portfolio_type == 'image_portfolio' && !empty($image_portfolio) ) {
        
            $output .='<a href="'.get_the_permalink().'">
                    <img src="'.$image[0].'" alt="'.get_the_title().'">
                    </a>';
    }
    elseif( $portfolio_type == 'video_portfolio' && isset($video_cover_image) ) {
        
            $output .='<a href="'.get_the_permalink().'">
                    <img src="'.$video_cover_image[0].'" alt="'.get_the_title().'">
                    </a>';
    }    
    elseif( $portfolio_type == 'gallery_portfolio' && !empty($gallery_portfolio) ) {
        
            $output .='<div id="x_022_animated_layers_'.$idd.'" class="carousel slide x_022_animated_layers_indicators x_022_animated_layers_control_button thumb_scroll_x swipe_x ps_easeOutInCubic" data-ride="carousel" data-pause="hover" data-interval="3000" data-duration="2000">';

            $i = 0; 
            $output .='<ol class="carousel-indicators">';
                    $gallery_images = explode( ',', $gallery_portfolio );
                    foreach ( $gallery_images as $gallery_image ) {
                //$gallery_image = wp_get_attachment_image_src( $gallery_id, 'full' );
                $output .='<li data-target="#x_022_animated_layers_'.$idd.'" data-slide-to="'.$i.'" class="indictaor_item"></li>';
                $i++;
            }
            $output .='</ol>';
            $output .='<script> jQuery(".carousel-indicators").find(".indictaor_item:first").addClass("active") </script>';            
    
            $output .='<div class="carousel-inner" role="listbox">';
            $gallery_ids = explode( ',', $gallery_portfolio );
            foreach ( $gallery_ids as $gallery_id ) {
                $gallery_image = wp_get_attachment_image_src( $gallery_id, 'full' );
                $output .='<div class="item"><img src="'.$gallery_image[0].'" alt=""></div>';
            }
            $output .='</div></div>';
            $output .='<script> jQuery("#x_022_animated_layers_'.$idd.'").find(".item:first").addClass("active") </script>';
    } 
    
    if( $portfolio_type == 'gallery_portfolio' && !empty($gallery_portfolio) ) {   
        $output .='<div class="apl-portfolio-overlay apl-gallery">';
    }else{
        $output .='<div class="apl-portfolio-overlay">';
    }
    
    
    
    if( $portfolio_type == 'image_portfolio' && !empty($image_portfolio) ) :
    $output .='<a href="'.$image[0].'" class="left-icon" class="apl-lightbox-image"><i class="fa fa-image"></i></a>';
    endif;
    
    if( $portfolio_type == 'video_portfolio' && $video_type == 'youtube' ) :
    
        if ( !empty($video_youtube) ) {
            $output .='<a href="https://www.youtube.com/watch?v='.$video_youtube.'" class="left-icon apl-youtube-popup"><i class="fa fa-play"></i></a>';
        }   
    
    endif;
    
    if( $portfolio_type == 'video_portfolio' && $video_type == 'vimeo' ) :
    
        if ( !empty($video_vimeo) ) {
            $output .='<a href="https://vimeo.com/'.$video_vimeo.'" class="left-icon apl-vimeo-popup"><i class="fa fa-play"></i></a>';
        }    
    
    endif;    
    
    
    if( $portfolio_type == 'gallery_portfolio' && !empty($gallery_portfolio) ) : 
    
    foreach ( $gallery_ids as $gallery_id ) {
        $gallery_image = wp_get_attachment_image_src( $gallery_id, 'full' );   
        $output .='<a href="'.$gallery_image[0].'" class="left-icon"><i class="fa fa-file"></i></a>';
    }
    endif;
    
    $output .='<a href="'.get_the_permalink().'" class="right-icon"><i class="fa fa-ellipsis-h"></i></a></div></div>';
    
    $output .='<div class="apl-portfolio-desc">';
    
    $output .='<h3><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>';
    
    
    $output .='<span>'; 
    
    $terms = get_the_terms( $post->ID, 'amazing-portfolio-category' );
    foreach ( $terms as $term ) { 
            $output .='<a href="'.get_term_link($term).'">'.$term->name.'</a>&nbsp;&nbsp;&nbsp;&nbsp;';
        } 
    $output .='</span>'; 
    
    $output .='</div></article>';
           
    endwhile;
    
    
    $output .='</div></div></div></section>';
    $output .='';
    
    wp_reset_query();
    wp_reset_postdata();
    
    $output .='<div class="apl-pagination">';
    $output .= apl_pagination($custom_query->max_num_pages);
    $output .='</div>';     
    
    else :
    $output .='<p>Sorry, no posts matched your criteria.</p>';
    endif;
    return $output;
    
}
add_shortcode('amazing-portfolio', 'apl_portfolio_shortcode');