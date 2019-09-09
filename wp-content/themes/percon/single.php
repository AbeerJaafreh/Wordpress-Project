<?php
/**
 * The template for displaying all single posts
 */

get_header(); ?>

<?php
	$post_sidebar_position = percon_get_options( array( 'single_post_sidebar_dispay', 'right' ) );
?>

	<div class="row">

		<?php if ( 'full' === $post_sidebar_position ) : ?>
			<div class="col-md-12 page-content">
		<?php else : ?>
			<div class="col-md-8 page-content">
		<?php endif; ?>

				<main class="page-main">

					<?php
					while ( have_posts() ) :
						the_post();
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-entry' ); ?>>

							<?php get_template_part( 'template-parts/content', get_post_type() ); ?>

						</article><!-- #post-<?php the_ID(); ?> -->

						<?php
					endwhile; // End of the loop.
					wp_reset_postdata();

						get_template_part( 'template-parts/post-sharing' );

					if ( percon_get_options( array( 'blog_posts_navigation', true ) ) ) {

						get_template_part( 'template-parts/posts-nav' );

					}

					if ( percon_get_options( array( 'blog_related_posts', true ) ) ) {

						get_template_part( 'template-parts/related-posts' );

					}


						// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
						endif;

					?>

				</main><!-- .page-main -->

			</div><!-- /.page-content -->

		<?php if ( 'full' !== $post_sidebar_position ) : ?>
			<?php if ( 'right' === $post_sidebar_position ) : ?>
				<div class="col-md-4 sidebar">
			<?php elseif ( 'left' === $post_sidebar_position ) : ?>
				<div class="col-md-4 sidebar order-md-first">
			<?php endif; ?>
					<?php get_sidebar(); ?>
				</div>
				<!-- /.sidebar -->
		<?php endif; ?>
	</div><!-- /.row -->

<?php
get_footer();
