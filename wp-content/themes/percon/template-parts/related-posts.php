<?php
$related_posts = percon_related_posts();
if ( $related_posts->have_posts() ) : ?>
	<section class="related-posts">

		<h2 class="section-title">
			<?php printf( '<strong>%s</strong> Posts', esc_html__( 'Related', 'percon' ) ); ?>
		</h2>

		<div class="row">
		<?php
		while ( $related_posts->have_posts() ) :
			$related_posts->the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-entry col-md-4' ); ?>>

				<?php get_template_part( 'template-parts/content-related', get_post_type() ); ?>

			</article><!-- #post-<?php the_ID(); ?> -->
			<?php
		endwhile;
		?>
		</div>
	</section>
	<?php
	wp_reset_postdata();
endif;
