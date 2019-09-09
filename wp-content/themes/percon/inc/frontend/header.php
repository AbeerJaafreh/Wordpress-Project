<?php
/**
 * Hooks for template header
 *
 * @package Percon
 * Custom scripts and styles on header
 *
 * @since  1.0
 */

function percon_header_scripts_css() {
	ob_start();
	get_template_part( '/inc/frontend/helpers' );
	$custom_css_code = ob_get_clean();
	wp_add_inline_style( 'percon-main-style', $custom_css_code );
}
add_action( 'wp_enqueue_scripts', 'percon_header_scripts_css', 300 );
