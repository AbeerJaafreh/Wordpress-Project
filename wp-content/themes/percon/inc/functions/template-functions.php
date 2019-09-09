<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function percon_body_classes( $classes ) {

	if ( percon_get_options( array( 'hide_sidebar_on_mobile', true ) ) ) {
		$classes[] = 'hide-mobile-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'percon_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function percon_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'percon_pingback_header' );



/**
* Add classes to navigation buttons
*/
add_filter( 'next_posts_link_attributes', 'percon_posts_link_attributes' );
add_filter( 'previous_posts_link_attributes', 'percon_posts_link_attributes' );
add_filter( 'next_comments_link_attributes', 'percon_comments_link_attributes' );
add_filter( 'previous_comments_link_attributes', 'percon_comments_link_attributes' );

function percon_posts_link_attributes() {
	return 'class="next-posts"';
}

function percon_comments_link_attributes() {
	return 'class="prev-posts"';
}



/**
* Return shorter excerpt
*/
function percon_get_short_excerpt( $length = 45, $post_obj = null ) {
	global $post;
	if ( is_null( $post_obj ) ) {
		$post_obj = $post;
	}
	$length = absint( $length );
	if ( $length < 1 ) {
		$length = 45;
	}
	$source_content = $post_obj->post_content;
	if ( ! empty( $post_obj->post_excerpt ) ) {
		$source_content = $post_obj->post_excerpt;
	}
	$source_content  = preg_replace( '`\[[^\]]*\]`', '', $source_content );
	$trimmed_content = wp_trim_words( $source_content, $length, '...' );
	return $trimmed_content;
}

/**
 *  Get theme options
 *
 * @since Percon 1.0
 *
 * @return array percon_options
 *
 */
if ( ! function_exists( 'percon_get_options' ) ) :
	function percon_get_options() {
		$result = get_theme_mod( 'percon_options' );
		foreach ( func_get_args() as $arg ) {
			if ( is_array( $arg ) ) {
				if ( ! empty( $result[ $arg[0] ] ) ) {
					$result = $result[ $arg[0] ];
				} else {
					$result = $arg[1];
				}
			} else {
				if ( ! empty( $result[ $arg ] ) ) {
					$result = $result[ $arg ];
				} else {
					$result = null;
				}
			}
		}
		return $result;
	}
endif;
