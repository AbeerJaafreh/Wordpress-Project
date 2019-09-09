<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( esc_html__( 'Direct access forbidden.', 'percon' ) );
}

register_sidebar(
	array(
		'name'          => esc_html__( 'Sidebar', 'percon' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'percon' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
		'before_title'  => '</div><h5 class="widget-title">',
		'after_title'   => '</h5><div class="widget-content">',
	)
);

register_sidebar(
	array(
		'name'          => esc_html__( 'Footer Column 1', 'percon' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'percon' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	)
);

register_sidebar(
	array(
		'name'          => esc_html__( 'Footer Column 2', 'percon' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'percon' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	)
);

register_sidebar(
	array(
		'name'          => esc_html__( 'Footer Column 3', 'percon' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'percon' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	)
);
