<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// SHORTCODE GENERATOR OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options       = array();

// -----------------------------------------
// Basic Shortcode Examples                -
// -----------------------------------------
$options[]     = array(
  'title'      => 'Basic Shortcode Examples',
  'shortcodes' => array(

    // begin: shortcode
    array(
      'name'      => 'amazing-portfolio',
      'title'     => 'Amazing Blog Design',
      'fields'    => array(




                array(
                    'id'      => 'num',
                    'type'    => 'text',
                    'title'   => 'Number of post to show',
                    'desc'    => 'Leave blank to show all or enter how many you want display.',
                ),
/*                array(
                    'id'          => 'cat',
                    'type'        => 'checkbox',
                    'title'       => 'Portfolio Categories',
                    'options'     => 'categories',
                    'query_args'  => array(
                        'type'      => 'amazing-portfolio',
                        'taxonomy'  => 'amazing-portfolio-category',
                    ),
                    'desc'    => 'You can choose to show only the categories you want by checking the boxes.',
                ),*/                     
                array(
                    'id'       => 'order',
                    'type'     => 'select',
                    'title'    => 'Order',
                    'options'  => array(
                        'DESC'  => 'Descending',
                        'ASC'   => 'Ascending',
                    ),
                    'default'  => 'DESC',
                    'desc'    => 'Select posts order.',
                ),                
                                       
             



                array(
                    'id'       => 'style',
                    'type'     => 'select',
                    'title'    => 'Select Style',
                    'options'  => array(
                        'grid'  => 'Grid',
                        ''   => 'Coming more...',
                    ),
                    'default'  => 'grid',
                ),
                array(
                    'id'       => 'column',
                    'type'     => 'select',
                    'title'    => 'Select Grid Column',
                    'options'  => array(
                        'apl-portfolio-1'  => '1',
                        'apl-portfolio-2'   => '2',
                        'apl-portfolio-3'   => '3',
                        'apl-portfolio'   => '4',
                        'apl-portfolio-5'   => '5',
                        'apl-portfolio-6'   => '6',
                    ),
                    'default'  => 'apl-portfolio',
                    'dependency'   => array( 'style', '==', 'grid' ),
                ),
                array(
                    'id'       => 'margin',
                    'type'     => 'select',
                    'title'    => 'Column Space',
                    'options'  => array(
                    
                        ''    => 'Default',
                        'apl-portfolio-nomargin'   => 'No Space',
                    ),
                    'dependency'   => array( 'style', '==', 'grid' ),
                ),
                array(
                    'id'       => 'title_visibility',
                    'type'     => 'select',
                    'title'    => 'Title Visibility',
                    'options'  => array(
                    
                        ''    => 'Default',
                        'apl-portfolio-notitle'   => 'Title on Hover',
                    ),
                    'dependency'   => array( 'style|column', '==|!=', 'grid|apl-portfolio-1' ),
                ),
                
                
                

                array(
                    'id'      => 'apl_filter',
                    'type'    => 'switcher',
                    'title'   => 'Show Portfolios Filter',
                    'default' => false,
                ),
                array(
                    'id'       => 'apl_filter_style',
                    'type'     => 'select',
                    'title'    => 'Select Filter Style',
                    'options'  => array(
                        ''  => 'Default',
                        'style-2'   => 'Style 2',
                        'style-3'   => 'Style 3',
                        'style-4'   => 'Style 4',
                    ),
                    'dependency'   => array( 'apl_filter', '==', true ),
                ),                
                array(
                    'id'       => 'apl_filter_position',
                    'type'     => 'select',
                    'title'    => 'Select Filter Position',
                    'options'  => array(
                        ''  => 'Left',
                        'apl-text-center'   => 'Center',
                    ),
                    'dependency'   => array( 'apl_filter', '==', true ),
                ),                

      ),
    ),
    // end: shortcode


    // end: shortcode

  ),
);

CSFramework_Shortcode_Manager::instance( $options );
