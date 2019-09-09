<?php
$prev_post      = get_previous_post();
$prev_id        = ( isset( $prev_post->ID ) ) ? $prev_post->ID : '';
$prev_permalink = get_permalink( $prev_id );
$next_post      = get_next_post();
$next_id        = ( isset( $next_post->ID ) ) ? $next_post->ID : '';
$next_permalink = get_permalink( $next_id );
?>

<section class="posts-nav">
	<?php if ( ! empty( $prev_id ) ) : ?>
		<a href="<?php echo esc_url( $prev_permalink ); ?>" class="post-prev text-left">
			<div class="post-prev-icon">
				<i class="fa fa-arrow-left"></i>
			</div>
			<h5><?php esc_html_e( 'Previous', 'percon' ); ?></h5>
			<h4>
			<?php
				$thelength = 25;
				echo esc_html( substr( esc_html( $prev_post->post_title ), 0, $thelength ) );
			if ( strlen( $prev_post->post_title ) > $thelength ) {
				esc_html_e( '...', 'percon' );
			}
			?>
			</h4>
		</a>
	<?php endif; ?>

	<?php if ( ! empty( $next_id ) ) : ?>
		<a href="<?php echo esc_html( $next_permalink ); ?>" class="post-next text-right">
			<div class="post-next-icon">
				<i class="fa fa-arrow-right"></i>
			</div>
			<h5><?php esc_html_e( 'Next', 'percon' ); ?></h5>
			<h4>
			<?php
				$thelength = 25;
				echo esc_html( substr( esc_html( $next_post->post_title ), 0, $thelength ) );
			if ( strlen( $next_post->post_title ) > $thelength ) {
				esc_html_e( '...', 'percon' );
			}
			?>
			</h4>
		</a>
	<?php endif; ?>
</section>
