<?php
/**
 * Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package My_Persian_Theme
 */

if ( ! function_exists( 'theme_enqueue_styles' ) ) :
    /**
     * Enqueue scripts and styles.
     */
    function theme_enqueue_styles() {
        wp_enqueue_style( 'main-style', get_stylesheet_uri() );
        wp_enqueue_style( 'maasir-theme-ltr', get_template_directory_uri() . '/css/ltr.css', array('main-style'), '1.0.0' );
    }
endif;
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

if ( ! function_exists( 'theme_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    function theme_setup() {
        load_theme_textdomain( 'maasir-theme', get_template_directory() . '/languages' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        register_nav_menus( array(
            'primary' => esc_html__( 'Primary Menu', 'maasir-theme' ),
            'social'  => esc_html__( 'Social Links Menu', 'maasir-theme' ),
        ) );
    }
endif;
add_action( 'after_setup_theme', 'theme_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function maasir_theme_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 1', 'maasir-theme' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'maasir-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 2', 'maasir-theme' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'maasir-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 3', 'maasir-theme' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'maasir-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 4', 'maasir-theme' ),
        'id'            => 'footer-4',
        'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'maasir-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'maasir_theme_widgets_init' );
