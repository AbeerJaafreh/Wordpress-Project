<?php
/**
 * Custom template tags for this theme
 */

/**
 * Displays an optional post thumbnail.
 */
if ( ! function_exists( 'percon_post_thumbnail' ) ) :
	function percon_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		global $post;

		$video_url = get_post_meta( $post->ID, 'post_video_url', true );

		if ( is_single() ) :
			?>

			<?php if ( get_post_format() === 'video' && '' !== $video_url ) : ?>
				<div class="post-video">
					<?php echo wp_kses_post( wp_oembed_get( $video_url ) ); ?>
				</div><!-- .post-video -->
			<?php else : ?>
				<div class="post-thumbnail">
					<?php
						the_post_thumbnail(
							'percon-post-thumbnail-large',
							array(
								'alt' => the_title_attribute(
									array(
										'echo' => false,
									)
								),
							)
						);
					?>
				</div><!-- .post-thumbnail -->
			<?php endif; ?>

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php
				the_post_thumbnail(
					'percon-post-thumbnail',
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
			?>
		</a>

			<?php
		endif; // End is_single().
	}
endif;

/**
 * Displays comments & linkes.
 */
if ( ! function_exists( 'percon_post_actions' ) ) :
	function percon_post_actions() {
		?>
	<div class="post-actions">
		<div class="post-comments">
			<a class="comments-link" href="<?php comments_link(); ?>">
				<i class="fa fa-comment"></i>
				<?php comments_number( '0', '0', '%' ); ?>
			</a>
		</div>
		<div class="post-likes">
			<?php
			if ( function_exists( 'heart_this_hearts' ) ) {
				heart_this_hearts();}
			?>
		</div>
	</div>
		<?php
	}
endif;

/**
 * Displays List of tags
 */
if ( ! function_exists( 'percon_tags_list' ) ) {
	function percon_tags_list() {

		$out       = '';
		$tags_list = get_the_tag_list( '', __( ', ', 'percon' ) );
		if ( $tags_list ) {
			$out = '
			<div class="tags-links">
				<strong>' . __( 'Tagged: ', 'percon' ) . '</strong>
				' . $tags_list . '
			</div>';
		}

		return $out;
	}
}

/**
 * Displays content & meta_data
 */
if ( ! function_exists( 'percon_post_details' ) ) :
	function percon_post_details( $type = 'post' ) {
		?>
	<div class="post-details">

		<?php if ( 'post' === $type ) : ?>

			<h5 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>

			<div class="post-meta">

				<a class="posted-on" href="<?php the_permalink(); ?>">
					<time datetime="<?php the_time( get_option( 'date_format' ) ); ?>">
						<i class="fa fa-clock-o"></i>
						<?php the_time( get_option( 'date_format' ) ); ?>
					</time>
				</a>

				<span class="byline">
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
						<i class="fa fa-user-o"></i>
						<?php echo esc_html( get_the_author() ); ?>
					</a>
				</span>

				<span class="cat-links">
					<i class="fa fa-folder-o"></i>
					<?php the_category( ', ' ); ?>
				</span>

				<?php if ( has_tag() ) : ?>
					<span class="tags-links">
						<i class="fa fa-tag"></i>
						<?php the_tags( '', ', ', '' ); ?>
					</span>
				<?php endif; ?>

			</div><!-- .post-meta -->


		<?php else : ?>

			<h3 class="page-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

		<?php endif; ?>

		<div class="post-content">
			<?php
			the_content(
				'<a href="' . get_permalink() . '" class="post-more-link"><i class="fa fa-long-arrow-right"></i></a>'
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'percon' ),
					'after'  => '</div>',
				)
			);
			echo wp_kses_post( percon_tags_list() );
			?>
		</div><!-- .post-content -->
	</div><!-- .post-details -->
		<?php
	}
endif;
