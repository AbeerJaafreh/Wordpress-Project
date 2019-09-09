<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 */

?>

<section class="no-results col-12">

	<h2 class="page-title"><?php esc_html_e( 'Nothing Found', 'percon' ); ?></h2>

	<div class="page-content">
		<?php
		if ( ( is_home() || is_front_page() ) && current_user_can( 'publish_posts' ) ) :
			?>

			<p>
			<?php
				printf(
					wp_kses(
						/* translators: 1: link to WP admin new post page. */
						__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'percon' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					),
					esc_url( admin_url( 'post-new.php' ) )
				);
			?>
			</p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'percon' ); ?></p>
			<?php
				get_search_form();

		else :
			?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'percon' ); ?></p>
			<?php
				get_search_form();

		endif;
		?>
	</div><!-- .page-content -->

</section><!-- .no-results -->
