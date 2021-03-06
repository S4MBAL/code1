<?php
/**
 * Law16 functions and definitions
 *
 * @package Law16
 */

/**
 * Define theme constants
 */
$theme_data   = wp_get_theme();
if ( $theme_data->exists() ) {
	define( 'WPC_THEME_NAME', $theme_data->get( 'Name' ) );
	define( 'WPC_THEME_VERSION', $theme_data->get( 'Version' ) );
}

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 700; /* pixels */
}

if ( ! function_exists( 'law16_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function law16_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Law16, use a find and replace
	 * to change 'law16' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'law16', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Use shortcodes in text widgets.
	add_filter( 'widget_text', 'do_shortcode' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
	add_image_size( 'medium-thumb', 500, 300, true );
	add_image_size( 'blog-large', 700, 420, true );/* cleanup: */

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary', 'law16' ),
		'topbar' => __( 'Top Bar', 'law16' ),
		'footer' => __( 'Footer', 'law16' ),
	) );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( 'assets/css/editor-style.css' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	// add_theme_support( 'post-formats', array(
	// 	'aside', 'image', 'video', 'quote', 'link',
	// ) );

	/*
	 * Enable excerpt for page by default.
	 * See https://codex.wordpress.org/Function_Reference/add_post_type_support
	 */
	add_post_type_support('page', 'excerpt');

}
endif; // law16_setup
add_action( 'after_setup_theme', 'law16_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function law16_widgets_init() {
	global $wpc_option;
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'law16' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'law16' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	if (isset($wpc_option['enable_header_widget'])){
	register_sidebar( array(
		'name'          => __( 'Header Right', 'base' ),
		'id'            => 'header-right',
		'before_widget' => '<aside class="header-right-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	}
	register_sidebar( array(
		'name'          => __( 'Footer 1', 'base' ),
		'id'            => 'footer-1',
		'description'   => law16_sidebar_desc( 'footer-1' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 2', 'base' ),
		'id'            => 'footer-2',
		'description'   => law16_sidebar_desc( 'footer-2' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 3', 'base' ),
		'id'            => 'footer-3',
		'description'   => law16_sidebar_desc( 'footer-3' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 4', 'base' ),
		'id'            => 'footer-4',
		'description'   => law16_sidebar_desc( 'footer-4' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'law16_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function law16_scripts() {
	global $wpc_option;
	
	// Stylesheet
	wp_enqueue_style( 'law16-style', get_stylesheet_uri() );
	wp_enqueue_style( 'law16-fontawesome', get_template_directory_uri() .'/assets/css/font-awesome.min.css', array(), '4.2.0' );

	// jQuery Core
	wp_enqueue_script( 'jquery' );

	// Js vars from settings
	$is_fixed_header = array('fixed_header' => $wpc_option['header_fixed']);
	wp_localize_script('jquery','header_fixed_setting', $is_fixed_header);


	wp_enqueue_script( 'law16-modernizr', get_template_directory_uri() . '/assets/js/modernizr.min.js', array(), '2.6.2', false );
	wp_enqueue_script( 'law16-libs', get_template_directory_uri() . '/assets/js/libs.js', array(), '', true );
	wp_enqueue_script( 'law16-theme', get_template_directory_uri() . '/assets/js/theme.js', array(), '', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'law16_scripts' );

/**
 * Theme Options
 */
if ( !class_exists( 'ReduxFramework' ) ) {
	require_once( dirname( __FILE__ ) . '/inc/options/framework.php' );
}
if ( !isset( $redux_demo ) ) {
	require_once( dirname( __FILE__ ) . '/inc/options-config.php' );
}

/**
 * Move Visual Composer stylesheet file to the top.
 */
function move_vc_css() {
	wp_enqueue_style( 'js_composer_front' );
}
/**
 * Load VC addons if Visual Compressor is installed.
 */
if ( class_exists('WPBakeryVisualComposerAbstract') ) {
	vc_set_as_theme( $disable_updater = true );
	require get_template_directory() . '/inc/vc_mods/vc_mods.php';
	require get_template_directory() . '/inc/vc_mods/vc_general_elements.php';
	require get_template_directory() . '/inc/vc_mods/vc_special_elements.php';
	$vc_template_dir =  get_template_directory() . '/inc/vc_mods/vc_templates';
	vc_set_shortcodes_templates_dir( $vc_template_dir );
	add_action( 'wp_enqueue_scripts', 'move_vc_css', 1 );
}

/**
 * Remove VC Teaser on page/post editor screen.
 */
function remove_vc_teaser() {
	remove_meta_box( 'vc_teaser' , 'page' , 'normal' ); 
	remove_meta_box( 'vc_teaser' , 'post' , 'normal' ); 
}
add_action( 'admin_menu' , 'remove_vc_teaser' );

/**
 * Recomend plugins via TGM activation class
 */
require get_template_directory() . '/inc/tgm/plugin-activation.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load custom metaboxes and fields.
 */
require get_template_directory() . '/inc/meta/usage.php';

/**
 * Load custom theme widget.
 */
require get_template_directory() . '/inc/widgets/wpc_posts.php';

/**
 * One click demo importer, it's awesome too.
 */
require get_template_directory() .'/inc/importer/init.php';
