<?php
/**
 * Single portfolio
 *
 * @package amazing-portfolio
 * @since 1.0
 *
 */
get_header();

while (have_posts()) : the_post(); ?>

        <section id="apl-content">

            <div class="apl-content-wrap">

                <div class="container clearfix">
                    
                    <div class="col_full apl-portfolio-single-image">
                    

                <?php 
                
                $portfolio_meta = get_post_meta($post->ID, 'amazing_portfolio_options');
                $portfolio_type = $portfolio_meta[0]['portfolio_type'];
                $image_portfolio = $portfolio_meta[0]['portfolio_image'];
                $gallery_portfolio = $portfolio_meta[0]['portfolio_gallery'];
                $video_type = $portfolio_meta[0]['video_type'];
                $video_youtube = $portfolio_meta[0]['video_youtube'];
                $video_vimeo = $portfolio_meta[0]['video_vimeo'];
                
                $single_image = wp_get_attachment_image_src( $image_portfolio, 'full' );
                
                //var_dump($single_image);
                //http://player.vimeo.com/video/88585065
                if ($portfolio_type == 'image_portfolio') { ?>
                    <a href="#"><img src="<?php echo $single_image[0]; ?>" alt=""></a>
                <?php }    
                    
                if ($portfolio_type == 'video_portfolio') { ?>
                
                <?php if ( $video_type == 'youtube' && !empty($video_youtube) ) { ?>
                    <iframe src="https://www.youtube.com/embed/<?php echo $video_youtube; ?>" width="900" height="400" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> <?php } ?>

                <?php if ( $video_type == 'vimeo' && !empty($video_vimeo) ) { ?>
                    <iframe src="https://player.vimeo.com/video/<?php echo $video_vimeo; ?>" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> <?php } ?>
                
                
                <?php }                    
                
                if ($portfolio_type == 'gallery_portfolio') { ?>
                
                
                
                
            <div id="fw_al_003" class="carousel ps_fade ps_control_bsquare swipe_x ps_easeOutQuint" data-ride="carousel" data-pause="hover" data-interval="5000" data-duration="2000">
        
            <!-- Wrapper For Slides -->
            <div class="carousel-inner" role="listbox">
            
                                    
                            <?php
                                $gallery_ids = explode( ',', $gallery_portfolio );
                                foreach ( $gallery_ids as $gallery_id ) {
                                $gallery_image = wp_get_attachment_image_src( $gallery_id, 'full' ); ?>
                                    
                                <div class="item"><img src="<?php echo $gallery_image[0]; ?>" alt="<?php echo the_title(); ?>" /></div>
                                
                            <?php } ?>                                

                        
                             
                
                </div>
                
                <script> jQuery("#fw_al_003").find(".item:first").addClass("active") </script>                
                    
                <!-- Left Control -->
                <a class="left carousel-control" href="#fw_al_003" role="button" data-slide="prev">
                    <span class="fa fa-angle-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>

                <!-- Right Control -->
                <a class="right carousel-control" href="#fw_al_003" role="button" data-slide="next">
                    <span class="fa fa-angle-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>                    
                    
                </div><!-- End Paradise Slider -->
                
               <?php } ?>   
                
            
                </div><!-- portfolio-single-image -->
                
                <div class="col_full">
                    
                    <div class="col_one_third nobottommargin">

                    <?php

                        $metadata = $portfolio_meta[0]['metadata'];
                        //var_dump($metadata);
                        $apl_date = $portfolio_meta[0]['apl_date'];
                        $apl_client = $portfolio_meta[0]['apl_client'];
                        $apl_skill = $portfolio_meta[0]['apl_skill'];
                        $apl_url = $portfolio_meta[0]['apl_url'];
                        $apl_url_text = $portfolio_meta[0]['apl_url_text'];
                        $apl_url_open = $portfolio_meta[0]['apl_url_open'];
                        
                    if ( $metadata == 'yes') { ?> 

                        <div class="card events-meta">
                            <div class="card-body">
                                <ul class="apl-portfolio-meta nobottommargin">
                                <?php 
                                    if ( !empty($apl_date) ) {
                                        $portfolio_metadata = '<li><span><i class="icon-calendar3"></i>Date:</span> '.$apl_date.'</li>';
                                    }
                                    if ( !empty($apl_skill) ) {
                                        $portfolio_metadata .= '<li><span><i class="icon-lightbulb"></i>Skills:</span> '.$apl_skill.'</li>';
                                    }                                    
                                    if ( !empty($apl_client) ) {
                                        $portfolio_metadata .= '<li><span><i class="icon-user"></i>Client:</span> '.$apl_client.'</li>';
                                    } 
                                    if ( !empty($apl_url) ) {
                                        if ( !empty($apl_url_open) ) {
                                            $open_link = 'target="_blank"';
                                        }else{
                                            $open_link = '';
                                        }
                                        $portfolio_metadata .= '<li><span><i class="icon-link"></i>Project URL:</span> <a '.$open_link.' href="'.$apl_url.'">'.$apl_url_text.'</a></li>';
                                    }
                                    
                                    
                                        $portfolio_metadata .='<li><span><i class="icon-laptop"></i>Category:</span>';
                                    
                                        $terms = get_the_terms( $post->ID, 'amazing-portfolio-category' );
                                        foreach ( $terms as $term ) { 
                                                $portfolio_metadata .='<a href="'.get_term_link($term).'">'.$term->name.'</a>&nbsp;&nbsp;&nbsp;';
                                            }                                                                       
                                        $portfolio_metadata .='</li>';
                                    
                                    
                                    echo $portfolio_metadata;
                                ?>
                                    
                    
                                    
                                </ul>
                            </div>
                        </div>
                    <?php }   
                        
                    $apl_social_share = $portfolio_meta[0]['apl_social_share'];

                    if ( $apl_social_share == 'yes') { ?> 

                        <div class="si-share noborder clearfix">
                            <span>Share:</span>
                            <div>
                                
                                <a href="http://www.facebook.com/sharer.php?u=<?php esc_url(the_permalink()); ?>&amp;t=<?php echo esc_attr(urlencode(the_title('', '', false))); ?>" class="social-icon si-borderless si-facebook">
                                    <i class="icon-facebook"></i>
                                    <i class="icon-facebook"></i>
                                </a>
                            
                                <a href="http://twitter.com/home?status=<?php echo esc_attr(urlencode(the_title('', ' ', false))); ?><?php esc_url(the_permalink()); ?>" class="social-icon si-borderless si-twitter">
                                    <i class="icon-twitter"></i>
                                    <i class="icon-twitter"></i>
                                </a>
                                
                                <a href="http://plus.google.com/share?url=<?php esc_url(the_permalink()); ?>&amp;title=<?php echo esc_attr(urlencode(the_title('', '', false))); ?>" class="social-icon si-borderless si-gplus">
                                    <i class="icon-gplus"></i>
                                    <i class="icon-gplus"></i>
                                </a>
                                
                                <a href="http://pinterest.com/pin/create/link/?url=<?php echo esc_url(urlencode(get_permalink())); ?>&amp;media=<?php echo esc_attr($single_image[0]); ?>&amp;description=<?php esc_attr(the_title()); ?>" class="social-icon si-borderless si-pinterest">                                          <i class="icon-pinterest"></i>
                                    <i class="icon-pinterest"></i>
                                </a>                                
                                
                            </div>
                        </div>
                    <?php } ?>

                    </div>
                    
                    <div class="col_two_third apl-portfolio-single-content col_last nobottommargin">

                        <div class="fancy-title title-dotted-border">
                            <h2><?php echo the_title(); ?></h2>
                        </div>

                        <div class="col_full nobottommargin">
                            <?php echo the_content(); ?>
                        </div>

                    </div>
                    
                    </div>

                    <div class="clear"></div>
                    

                    <?php 
                    $related_portfolio = $portfolio_meta[0]['related_portfolio'];
                    
                    if ( $related_portfolio == true ) {
                        require_once ( APL_DIR . '/inc/related-portfolio.php'); 
                    
                    }?>


                </div>

            </div>

    </section>


<?php
endwhile;

get_footer(); 