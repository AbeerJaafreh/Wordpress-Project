<?php
/**
 * Widget Init
 *
 */
function percon_recent_posts() {

	register_widget( 'percon_recent_posts' );

}
	add_action( 'widgets_init', 'percon_recent_posts' );
