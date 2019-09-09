<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( esc_html__( 'Direct access forbidden.', 'percon' ) );
}

/* Enqueue styles */
wp_enqueue_style( 'percon-bootstrap-4', get_template_directory_uri() . '/assets/css/bootstrap.css', array(), 'v4.1.2', 'all' );

wp_enqueue_style( 'percon-main-style', get_stylesheet_uri(), array(), '1.0.0', 'all' );

wp_enqueue_style( 'percon-font-awesome', get_stylesheet_directory_uri() . '/assets/css/font-awesome.min.css' );

wp_enqueue_style( 'percon-stellarnav-style', get_stylesheet_directory_uri() . '/assets/css/stellarnav.min.css' );

wp_enqueue_style( 'percon-flexslider-style', get_stylesheet_directory_uri() . '/assets/css/flexslider.css' );


/* Enqueue styles */
wp_enqueue_script(
	'percon-custom-js',
	get_stylesheet_directory_uri() . '/assets/js/custom.js',
	array( 'jquery' ),
	date( 'h:i:s' ),
	true
);

wp_enqueue_script( 'percon-stellarnav-js', get_stylesheet_directory_uri() . '/assets/js/stellarnav.min.js', array( 'jquery' ), true );

wp_enqueue_script( 'percon-fitvids-js', get_stylesheet_directory_uri() . '/assets/js/jquery.fitvids.js', array( 'jquery' ), true );

wp_enqueue_script( 'percon-query.instagramFeed-js', get_stylesheet_directory_uri() . '/assets/js/jquery.instagramFeed.min.js', array( 'jquery' ), true );

wp_enqueue_script( 'percon-flexslider-js', get_template_directory_uri() . '/assets/js/jquery.flexslider-min.js', array( 'jquery' ), true );

if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
}
