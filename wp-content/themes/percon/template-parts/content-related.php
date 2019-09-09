<div class="post-item <?php if ( ! has_post_thumbnail() ) {
	echo 'no-featured-image';} ?>">

	<div class="post-image
	<?php
	if ( get_post_format() == 'video' && ! is_singular() ) {
		echo esc_attr( get_post_format() );}
	?>
	">

		<?php
		percon_post_thumbnail();
		percon_post_actions();
		?>

	</div>

	<div class="post-details">

		<h5 class="post-title">
			<a href="<?php the_permalink(); ?>">
				<?php
					$thelength = 25;
					echo esc_html( substr( get_the_title(), 0, $thelength ) );
				if ( strlen( get_the_title() ) > $thelength ) {
					esc_html_e( '...', 'percon' );
				}
				?>
			</a>
		</h5>

		<a class="posted-on" href="<?php the_permalink(); ?>">
			<time datetime="<?php the_time( get_option( 'date_format' ) ); ?>">
				<i class="fa fa-clock-o"></i>
				<?php the_time( get_option( 'date_format' ) ); ?>
			</time>
		</a>
	</div><!-- .post-details -->

</div><!-- .post-item -->
