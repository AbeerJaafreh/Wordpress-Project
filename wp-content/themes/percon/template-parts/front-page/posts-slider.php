<?php
$slideshow_cat   = percon_get_options( 'header_slideshow_category' );
$slideshow_count = percon_get_options( array( 'header_slideshow_count', 4 ) );

if ( $slideshow_cat > 0 && $slideshow_count > 0 ) {
	$args = array(
		'post_type'           => array( 'post' ),
		'category__in'        => $slideshow_cat,
		'showposts'           => $slideshow_count,
		'orderby'             => 'post__in',
		'ignore_sticky_posts' => true,
	);
}

$slideshow_query = new WP_Query( $args );

?>

<?php if ( $slideshow_query->have_posts() ) : ?>
<div class="flexslider-wrap">
	<div class="container">
		<div class="flexslider">
			<ul class="slides">
				<?php
				while ( $slideshow_query->have_posts() ) :
					$slideshow_query->the_post();
					?>
					<?php
					$feat_image   = get_template_directory_uri() . '/assets/images/default.jpg';
					$feat_img_alt = '';
					if ( has_post_thumbnail() ) {
						$get_feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'percon-post-thumbnail-large' );
						$feat_image     = $get_feat_image[0];
						$feat_img_alt   = get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true );
					}
					if ( '' === $feat_img_alt ) {
						$feat_img_alt = get_the_title();
					}
					?>
					<li>
						<img src="<?php echo esc_url( $feat_image ); ?>" alt="<?php echo esc_attr( $feat_img_alt ); ?>" />
						<div class="flex-caption">
							<span class="cat-links">
								<?php the_category( ', ' ); ?>
							</span>
							<h3 class="caption-title">
								<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a>
							</h3>
							<div class="caption-content">
							<?php echo esc_html( percon_get_short_excerpt( 20 ) ); ?>
							</div>
							<div class="caption-button">
								<a class="readmore-button" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php esc_html_e( 'Keep Reading', 'percon' ); ?></a>
								<time class="post-time" datetime="<?php the_time( get_option( 'date_format' ) ); ?>">
									<?php the_time( get_option( 'date_format' ) ); ?>
								</time>
							</div>
						</div>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>
	</div>
</div>
<?php endif; ?>
