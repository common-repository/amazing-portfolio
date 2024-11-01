<?php
/*
Plugin Name: Amazing Portfolio
Plugin URI: http://themebon.com/item/amazing-portfolio
Description: Amazing Portfolio is an easy to use responsive and filterable Portfolio-Grid Plugin for WordPress, offering a wide range of customization options.
Author: themebon
Author URI: http://themebon.com/
TextDomain: apl
Version: 1.0.2
*/


if ( ! defined( 'ABSPATH' ) ) { die;}

define( 'APL_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );
define( 'APL_DIR', rtrim( plugin_dir_path( __FILE__ ), '/' ) );



// Add image size support
add_action( 'init', 'apl_add_image_size_func' );
function apl_add_image_size_func() {
    add_image_size('apl-image-large', 1200, 900, true);
    add_image_size('apl-image-medium', 800, 600, true);
    add_image_size('apl-image-small', 300, 200, true);
    
    add_image_size('apl-image-square-medium', 300, 300, true); // 1:1
    add_image_size('apl-image-square-small', 150, 150, true); // 1:1
}
        
# Load plugin Translations
function apl_load_textdomain(){

    load_plugin_textdomain('apl', false, dirname( plugin_basename( __FILE__ ) ) .'/languages/' );

}

//Loading CSS
function amazing_portfolio_scripts() {
    
    // CSS
    //wp_enqueue_style('ucw_bootstrap', plugins_url( '/assets/css/bootstrap.min.css' , __FILE__ ) );
    wp_enqueue_style('apl_font_awesome', plugins_url( '/assets/css/font-awesome.min.css' , __FILE__ ) );
    wp_enqueue_style('apl_carousel', plugins_url( '/assets/css/bootstrap.min.css' , __FILE__ ) );
    wp_enqueue_style('apl_magnific-popup', plugins_url( '/assets/css/magnific-popup.css' , __FILE__ ) );
    wp_enqueue_style('apl_animated-layers', plugins_url( '/assets/css/animated-layers.css' , __FILE__ ) );
    wp_enqueue_style('apl_all', plugins_url( '/assets/css/amazing-portfolio.css' , __FILE__ ) );
    wp_enqueue_style('apl_font-icons', plugins_url( '/assets/css/font-icons.css' , __FILE__ ) );
    wp_enqueue_style('apl_custom', plugins_url( '/assets/css/custom.css' , __FILE__ ) );
    wp_enqueue_style('apl_responsive', plugins_url ('/assets/css/responsive.css' , __FILE__ ) );
    
    // JS
    wp_enqueue_script('jquery');
    wp_enqueue_script('apl_bootstrap_js', plugins_url( '/assets/js/bootstrap.min.js' , __FILE__ ), array(), '', true);
    wp_enqueue_script('apl_touchSwipe_js', plugins_url( '/assets/js/jquery.touchSwipe.min.js' , __FILE__ ), array(), '', true);
    wp_enqueue_script('apl_paradise_slider_js', plugins_url( '/assets/js/paradise_slider.js' , __FILE__ ), array(), '', true);
    wp_enqueue_script('apl_plugins', plugins_url( '/assets/js/plugins.js' , __FILE__ ), array(), '', true );
    wp_enqueue_script('apl_isotope', plugins_url( '/assets/js/jquery.isotope.js' , __FILE__ ), array(), '', true );
    wp_enqueue_script('apl_responsive_js', plugins_url( '/assets/js/functions.js' , __FILE__ ), array(), '', true );
    
}
add_action( 'wp_enqueue_scripts', 'amazing_portfolio_scripts' );



        
function amazing_portfolio_custom_post_register() {
    
    $taxonomy_labels = array(
        'name'                       => 'Category',
        'singular_name'              => 'Category',
        'menu_name'                  => 'Categories',
        'all_items'                  => 'All Categories',
        'parent_item'                => 'Parent Category',
        'parent_item_colon'          => 'Parent Category:',
        'new_item_name'              => 'New Category Name',
        'add_new_item'               => 'Add New Category',
        'edit_item'                  => 'Edit Category',
        'update_item'                => 'Update Category',
        'separate_items_with_commas' => 'Separate categories with commas',
        'search_items'               => 'Search categories',
        'add_or_remove_items'        => 'Add or remove categories',
        'choose_from_most_used'      => 'Choose from the most used categories',
    );

    $taxonomy_rewrite = array(
        'slug'         => 'amazing-portfolio-category',
        'with_front'   => true,
        'hierarchical' => true,
    );

    $taxonomy_args = array(
        'labels'            => $taxonomy_labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'query_var'         => true,
        'show_tagcloud'     => true,
        'rewrite'           => $taxonomy_rewrite,
    );
    register_taxonomy( 'amazing-portfolio-category', array( 'amazing-portfolio' ), $taxonomy_args );


    //Register new post type
    $post_type_labels = array(
        'name'               => 'Amazing Portfolio',
        'singular_name'      => 'Portfolio',
        'menu_name'          => 'Amazing Portfolio',
        'parent_item_colon'  => 'Parent Portfolio:',
        'all_items'          => 'All Portfolios',
        'view_item'          => 'View Portfolio',
        'add_new_item'       => 'Add New Portfolio',
        'add_new'            => 'Add New',
        'edit_item'          => 'Edit Portfolio',
        'update_item'        => 'Update Portfolio',
        'search_items'       => 'Search portfolios',
        'not_found'          => 'No portfolios found',
        'not_found_in_trash' => 'No portfolios found in Trash',
    );

    $post_type_rewrite = array(
        'slug'       => 'amazing-portfolio-item',
        'with_front' => true,
        'pages'      => true,
        'feeds'      => true,
    );

    $post_type_args = array(
        'label'              => 'portfolio',
        'description'        => 'Portfolio information pages',
        'labels'             => $post_type_labels,
        'supports'           => array( 'title', 'editor', 'comments', 'revisions'),
        'taxonomies'         => array( 'post' ),
        'hierarchical'       => false,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-format-gallery',
        'has_archive'        => true,
        'publicly_queryable' => true,
        'rewrite'            => array( 'slug' => 'amazing-portfolio' ),
        'capability_type'    => 'post',
    );

    register_post_type( 'amazing-portfolio', $post_type_args );
}
add_action('init', 'amazing_portfolio_custom_post_register');


function apl_flush_rules_on_save_posts( $post_id ) {
 
    flush_rewrite_rules();
 
}
add_action( 'save_post', 'apl_flush_rules_on_save_posts', 20, 2);


//Load Framework
require_once ( APL_DIR . '/inc/framework/cs-framework.php');



//Shortcode
require_once ( APL_DIR . '/shortcodes/index.php');

// Pagination
require_once ( APL_DIR . '/inc/apl-pagination.php');



add_filter( 'template_include', 'apl_include_template_function', 1 );
function apl_include_template_function( $template_path ) {
    global $post;
    if ( get_post_type() == 'amazing-portfolio' ) {
        if ( is_single() ) {
                $template_path = dirname( __FILE__ ) . '/inc/single-portfolio.php';
        }
    }
    return $template_path;
}


//widget shortcode support
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');