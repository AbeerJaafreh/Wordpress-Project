<?php


/**
 * Related Posts
 */
if ( ! function_exists( 'percon_related_posts' ) ) {

	function percon_related_posts() {
		wp_reset_postdata();
		global $post;

		// Define shared post arguments
		$args = array(
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'ignore_sticky_posts'    => 1,
			'orderby'                => 'rand',
			'post__not_in'           => array( $post->ID ),
			'posts_per_page'         => 3,
		);

		$tags = get_post_meta( $post->ID, 'related-tag', true );

		if ( ! $tags ) {
			$tags            = wp_get_post_tags(
				$post->ID,
				array( 'fields' => 'ids' )
			);
			$args['tag__in'] = $tags;
		} else {
			$args['tag_slug__in'] = explode( ',', $tags );
		}
		if ( ! $tags ) {
			$break = true;
		}

		$query = ! isset( $break ) ? new WP_Query( $args ) : new WP_Query;

		return $query;
	}
}
