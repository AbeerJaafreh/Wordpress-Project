<?php

/**
 * Adding a custom filed for video url
 */
if ( ! function_exists( 'percon_add_video_custom_meta_box' ) ) {
	function percon_add_video_custom_meta_box() {
		add_meta_box( 'video-meta-box', __( 'Video', 'percon' ), 'percon_video_meta_box_markup', 'post', 'side', 'high', null );
	}
}
add_action( 'add_meta_boxes', 'percon_add_video_custom_meta_box' );

if ( ! function_exists( 'percon_video_save_custom_meta_box' ) ) {
	function percon_video_save_custom_meta_box( $post_id, $post, $update ) {
		if ( ! isset( $_POST['video-meta-box-nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['video-meta-box-nonce'] ), basename( __FILE__ ) ) ) {
			return $post_id;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		$slug = 'post';
		if ( $slug != $post->post_type ) {
			return $post_id;
		}

		$video_meta_box_text_value = '';

		if ( isset( $_POST['post_video_url'] ) ) {
			$video_meta_box_text_value = sanitize_text_field( wp_unslash( $_POST['post_video_url'] ) );
		}
		update_post_meta( $post_id, 'post_video_url', $video_meta_box_text_value );
	}
}
add_action( 'save_post', 'percon_video_save_custom_meta_box', 10, 3 );
