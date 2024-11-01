<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// METABOX OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options      = array();



// -----------------------------------------
// Portfolio Metabox Options                    -
// -----------------------------------------
$options[]    = array(
    'id'        => 'amazing_portfolio_options',
    'title'     => 'Amazing Portfolio Options',
    'post_type' => 'amazing-portfolio',
    'context'   => 'normal',
    'priority'  => 'high',
    'sections'  => array(

        // begin: a section
        array(
            'name'  => 'post-filter',
            'title' => 'Portfolio Item',
            'icon'  => 'fa fa-picture-o',

            // begin: fields
            'fields' => array(
            


                array(
                    'id'       => 'portfolio_type',
                    'type'     => 'select',
                    'title'    => 'Portfolio Type',
                    'options'  => array(
                        'image_portfolio'  => 'Image',
                        'gallery_portfolio'   => 'Gallery',
                        'video_portfolio'   => 'Video',
                    ),
                    'default'  => 'image_portfolio',
                    'desc'    => 'Select your portfolio type image, gallery or video.',
                ),
                array(
                    'id'        => 'portfolio_image',
                    'type'      => 'image',
                    'title'     => 'Select Image',
                    'add_title' => 'Add Image',
                    'dependency'   => array( 'portfolio_type', '==', 'image_portfolio' ),
                ),
                array(
                    'id'          => 'portfolio_gallery',
                    'type'        => 'gallery',
                    'title'       => 'Select Gallery Images',
                    'add_title'   => 'Add Images',
                    'edit_title'  => 'Edit Images',
                    'clear_title' => 'Remove Images',
                    'dependency'   => array( 'portfolio_type', '==', 'gallery_portfolio' ),
                ),
                
                array(
                    'id'       => 'video_type',
                    'type'     => 'select',
                    'title'    => 'Video Source',
                    'options'  => array(
                        'youtube'  => 'Youtube',
                        'vimeo'   => 'Vimeo',
                    ),
                    'desc'    => 'Select your video source from, youtube or vimeo.',
                    'dependency'   => array( 'portfolio_type', '==', 'video_portfolio' ),
                ),                
                
                
                array(
                    'id'      => 'video_youtube',
                    'type'    => 'text',
                    'title'   => 'Youtube Video ID',
                    'desc'    => 'Please enter youtube video id not url.',
                    'after' => '<p class="cs-text-info">Ex: https://www.youtube.com/watch?v=<strong>r-i6XpcL1Fs</strong></p> ',
                    'dependency'   => array( 'portfolio_type|video_type', '==|==', 'video_portfolio|youtube' ),
                ),
                
                array(
                    'id'      => 'video_vimeo',
                    'type'    => 'text',
                    'title'   => 'Vimeo Video ID',
                    'desc'    => 'Please enter vimeo id not url.',
                    'after' => '<p class="cs-text-info">Ex: https://vimeo.com/<strong>88585065</strong></p> ',
                    'dependency'   => array( 'portfolio_type|video_type', '==|==', 'video_portfolio|vimeo' ),
                    //'dependency'   => array( 'portfolio_type', '==', 'video_portfolio' ),
                ),                
                
                array(
                    'id'        => 'video_cover_image',
                    'type'      => 'image',
                    'title'     => 'Select Video Cover Image',
                    'add_title' => 'Add Image',
                    'dependency'   => array( 'portfolio_type', '==', 'video_portfolio' ),
                ),                               
                    
               
                                
  

            ), // end: fields   
        ), // end: a section



        // begin: a section
        array(
            'name'  => 'single_portfolio',
            'title' => 'Single Portfolio Item',
            'icon'  => 'fa fa-image',

            // begin: fields
            'fields' => array(



                array(
                    'id'       => 'metadata',
                    'type'     => 'select',
                    'title'    => 'Show Project Metadata Information',
                    'options'  => array(
                        'yes'  => 'Yes',
                        'no'   => 'No',
                    ),
                    'default'  => 'yes',
                ),

/*                array(
                    'id'      => 'metadata',
                    'type'    => 'switcher',
                    'title'   => 'Enable Portfolio Meta Information',
                    'default' => true,
                ),*/
                array(
                    'id'    => 'apl_date',
                    'type'  => 'text',
                    'title' => 'Project Date',
                    'desc' => 'Leave empty, it wont show',
                    'dependency'   => array( 'metadata', '==', 'yes' ),
                ),                 
                array(
                    'id'    => 'apl_client',
                    'type'  => 'text',
                    'title' => 'Client Name',
                    'desc' => 'Leave empty, it wont show',
                    'dependency'   => array( 'metadata', '==', 'yes' ),
                ),                
                array(
                    'id'    => 'apl_skill',
                    'type'  => 'text',
                    'title' => 'Project Skills',
                    'desc' => 'Leave empty, it wont show',
                    'dependency'   => array( 'metadata', '==', 'yes' ),
                ),
                array(
                    'id'    => 'apl_url',
                    'type'  => 'text',
                    'title' => 'Project URL',
                    'desc' => 'Leave empty, it wont show',
                    'dependency'   => array( 'metadata', '==', 'yes' ),
                ),                
                array(
                    'id'    => 'apl_url_text',
                    'type'  => 'text',
                    'title' => 'Project URL Text',
                    'default' => 'View Project',
                    'desc' => 'Leave empty, it wont show',
                    'dependency'   => array( 'metadata', '==', 'yes' ),
                ),                
                array(
                    'id'    => 'apl_url_open',
                    'type'  => 'checkbox',
                    'title' => 'Open Link in New Window',
                    'desc' => 'Leave empty, it wont show',
                    'dependency'   => array( 'metadata', '==', 'yes' ),
                ),                
                array(
                    'id'       => 'apl_social_share',
                    'type'     => 'select',
                    'title'    => 'Show Social Share Buttons',
                    'options'  => array(
                        'yes'  => 'Yes',
                        'no'   => 'No',
                    ),
                    'default'  => 'yes',
                ),                         

                array(
                    'id'      => 'related_portfolio',
                    'type'    => 'switcher',
                    'title'   => 'Show Related Portfolios',
                    'default' => true,
                ),



            ), // end: fields   
        ), // end: a section

/*
        // begin: a section
        array(
            'name'  => 'typography',
            'title' => 'Typography',
            'icon'  => 'fa fa-font',

            // begin: fields
            'fields' => array(


                        array(
                            'id'        => 'heading_font',
                            'type'      => 'typography',
                            'title'     => 'Select Heading Font',
                            'default'   => array(
                                'family'  => 'Open Sans',
                                'variant' => '800',
                                'font'    => 'google', // this is helper for output
                            ),
                        ),

                        array(
                            'id'      => 'heading_font_size',
                            'type'    => 'number',
                            'title'   => 'Heading Font Size',
                            'after'   => '<i class="cs-text-muted">(px)</i>',
                            'desc'    => 'default value is 24px',
                            'default'  => '24',
                        ),                    
                        array(
                            'id'      => 'heading_color',
                            'type'    => 'color_picker',
                            'title'   => 'Heading Color',
                            'default' => '#fff',
                            'desc'    => 'default color is #fff',
                        ),
                        array(
                            'id'       => 'heading_text_transform',
                            'type'     => 'select',
                            'title'    => 'Heading Text Transform',
                            'options'  => array(
                                ''  => 'Default',
                                'uppercase'   => 'Upercase',
                            ),
                        ),            
                        array(
                            'id'       => 'heading_italic',
                            'type'     => 'select',
                            'title'    => 'Heading Font Style:',
                            'options'  => array(
                                'normal'  => 'Default',
                                'italic'   => 'Italic',
                            ),
                        ),            
                        
                            
                        array(
                            'id'        => 'desc_font',
                            'type'      => 'typography',
                            'title'     => 'Select Description Font',
                            'default'   => array(
                                'family'  => 'Open Sans',
                                'variant' => 'regular',
                                'font'    => 'google', // this is helper for output
                            ),
                        ),         
                        array(
                            'id'      => 'desc_font_size',
                            'type'    => 'number',
                            'title'   => 'Description Font Size',
                            'after'   => '<i class="cs-text-muted">(px)</i>',
                            'desc'    => 'default value is 20px',
                            'default'  => '18',
                        ),
                        array(
                            'id'      => 'desc_color',
                            'type'    => 'color_picker',
                            'title'   => 'Description Color',
                            'default' => '#fff',
                            'desc'    => 'default color is #fff',
                        ),
                        array(
                            'id'       => 'desc_text_transform',
                            'type'     => 'select',
                            'title'    => 'Description Text Transform',
                            'options'  => array(
                                ''  => 'Default',
                                'uppercase'   => 'Upercase',
                            ),
                        ),
                        array(
                            'id'       => 'desc_italic',
                            'type'     => 'select',
                            'title'    => 'Description Font Style:',
                            'options'  => array(
                                'normal'  => 'Default',
                                'italic'   => 'Italic',
                            ),
                        ),            
                        array(
                            'id'      => 'desc_line_height',
                            'type'    => 'number',
                            'title'   => 'Description Text Line Height',
                            'after'   => '<i class="cs-text-muted">(px)</i>',
                            'desc'    => 'default value is 22px',
                            'default'  => '22',
                        ),            
                        


            ), // end: fields   
        ), // end: a section

*/

    ),
);

CSFramework_Metabox::instance( $options );
