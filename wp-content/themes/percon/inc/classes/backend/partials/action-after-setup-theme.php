<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( esc_html__( 'Direct access forbidden.', 'percon' ) );
}

/*
 * Make theme available for translation.
 * Translations can be filed in the /languages/ directory.
 * If you're building a theme based on Percon, use a find and replace
 * to change 'percon' to the name of your theme in all the template files
 */
load_theme_textdomain( 'percon', get_template_directory() . '/languages' );

/**
 * Add default posts and comments RSS feed links to head.
 * @package Percon
 * @since 1.0
 */
add_theme_support( 'automatic-feed-links' );

/**
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 * @package Percon
 * @since 1.0
 */
add_theme_support( 'title-tag' );

/**
 * Enable support for Post Thumbnails on posts and pages.
 * @package Percon
 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
 * @since 1.0
 */
add_theme_support( 'post-thumbnails' );

// Enable Post formats
add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio', 'status', 'quote', 'link' ) );

/**
 * Add Editor Style
 *
 * @since 1.0
 */
// Add support for editor styles.
add_theme_support( 'editor-styles' );

/**
 * Enable support for custom background.
 * @package Vance
 * @since 1.0
 */
add_theme_support( 'custom-background', apply_filters( 'percon_custom_background_args', array (
    'default-color' => 'fff',
    'default-image' => '',
) ) );

/**
 * Enable support for custom Editor Style.
 *
 * @since 1.0
 */
add_editor_style( 'assets/css/custom-editor-style.css' );

// This theme uses wp_nav_menu() in one location.
register_nav_menus(
	array(
		'main' => esc_html__( 'Primary', 'percon' ),
	)
);

// Switch default core markup for search form, comment form, and comments
add_theme_support(
	'html5',
	array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	)
);

// Add theme support for selective refresh for widgets.
add_theme_support( 'customize-selective-refresh-widgets' );


// Enable support for custom background.
add_theme_support(
	'custom-background',
	apply_filters(
		'gratify_custom_background_args',
		array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)
	)
);

// Add support for core custom logo.
add_theme_support(
	'custom-logo',
	array(
		'height'      => 211,
		'width'       => 48,
		'flex-width'  => true,
		'flex-height' => true,
	)
);

//Enable support for custom Header Image.
$args = array(
	'flex-width'  => true,
	'width'       => 1920,
	'height'      => 75,
	'flex-height' => true,
	'flex-width'  => true,
);
add_theme_support( 'custom-header', $args );

// Set the image size by cropping the image
add_image_size( 'thumbnail', 100, 100, true );
add_image_size( 'percon-post-thumbnail', 540, 450, true );
add_image_size( 'percon-post-thumbnail-large', 1140, 650, true );
