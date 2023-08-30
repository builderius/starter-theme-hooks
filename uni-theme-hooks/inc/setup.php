<?php

namespace UNI\Setup;

use UNI\Extras;

/**
 * Theme setup
 */
function setup() {
	// Make theme available for translation
	load_theme_textdomain( 'uni', get_template_directory() . '/language' );

	// Enable plugins to manage the document title
	// http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
	add_theme_support( 'title-tag' );

	// Register wp_nav_menu() menus
	// http://codex.wordpress.org/Function_Reference/register_nav_menus
	register_nav_menus( [
		'primary_navigation'  => __( 'Primary menu', 'uni' )
	] );

	// Enable post thumbnails
	// http://codex.wordpress.org/Post_Thumbnails
	// http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
	// http://codex.wordpress.org/Function_Reference/add_image_size
	add_theme_support( 'post-thumbnails' );
	//add_image_size( 'uni_highlighted_tour', 560, 700, true );

	// Enable post formats
	// http://codex.wordpress.org/Post_Formats
	//add_theme_support( 'post-formats', [ 'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio' ] );

	// Enable HTML5 markup support
	// http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
	add_theme_support( 'html5', [ 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ] );
}

add_action( 'after_setup_theme', __NAMESPACE__ . '\\setup' );

/**
 * Register sidebars
 */
function widgets_init() {
    register_sidebar([
        'name'          => __('Footer #1', 'uni'),
        'id'            => 'footer-1',
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ]);
}

add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Theme assets
 */
function assets() {
	if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

    wp_register_style( 'theme-css', get_template_directory_uri() . '/assets/css/main.css', date( 'H:i:s' ), null );
    wp_enqueue_style('theme-css');

	// scripts
    wp_register_script( 'theme-js', get_template_directory_uri() . '/assets/main.js', ['jquery'], date( 'H:i:s' ), true );
    wp_enqueue_script('theme-js');

	// Localize the script with new data
	$data = array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'i18n'     => array(),
		'lang' => Extras\get_cur_lang()
	);
	wp_localize_script( 'theme-js', 'uniTheme', $data );
}

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100 );
