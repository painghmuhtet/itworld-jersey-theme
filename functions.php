<?php
/**
 * Theme setup and functions for iT World Jersey
 */

if ( ! function_exists( 'itworld_setup' ) ) :
    function itworld_setup() {
        load_theme_textdomain( 'itworld-jersey', get_template_directory() . '/languages' );

        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'html5', array( 'search-form', 'comment-form', 'gallery', 'caption' ) );
        add_theme_support( 'custom-logo' );

        // WooCommerce support
        add_theme_support( 'woocommerce' );

        register_nav_menus( array(
            'primary' => esc_html__( 'Primary Menu', 'itworld-jersey' ),
        ) );

        // Editor style
        add_theme_support( 'editor-styles' );
        add_editor_style( 'style-editor.css' );
    }
endif;
add_action( 'after_setup_theme', 'itworld_setup' );

// Enqueue styles and scripts
function itworld_enqueue_assets() {
    wp_enqueue_style( 'itworld-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
    wp_enqueue_style( 'itworld-main', get_template_directory_uri() . '/assets/css/style-main.css', array(), '1.0' );

    wp_enqueue_script( 'itworld-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array('jquery'), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'itworld_enqueue_assets' );

// Widget areas
function itworld_widgets_init() {
    register_sidebar( array(
        'name' => esc_html__( 'Sidebar', 'itworld-jersey' ),
        'id' => 'sidebar-1',
        'description' => esc_html__( 'Add widgets here.', 'itworld-jersey' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ) );
}
add_action( 'widgets_init', 'itworld_widgets_init' );

// Excerpt length
function itworld_excerpt_length( $length ) {
    return 24;
}
add_filter( 'excerpt_length', 'itworld_excerpt_length', 999 );

// Add body classes
function itworld_body_classes( $classes ) {
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }
    return $classes;
}
add_filter( 'body_class', 'itworld_body_classes' );

// WooCommerce content wrapper compatibility
function itworld_woocommerce_support() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

    add_action( 'woocommerce_before_main_content', 'itworld_wrapper_start', 10 );
    add_action( 'woocommerce_after_main_content', 'itworld_wrapper_end', 10 );
}
add_action( 'after_setup_theme', 'itworld_woocommerce_support' );

function itworld_wrapper_start() {
    echo '<main id="site-main" class="site-main">';
}
function itworld_wrapper_end() {
    echo '</main>'; 
}
