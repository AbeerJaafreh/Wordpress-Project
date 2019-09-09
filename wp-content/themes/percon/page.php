<?php
/**
 * The template for displaying page single
 */

get_header(); ?>

<?php
	$default_sidebar_position = percon_get_options( array( 'blog_sidebar_dispay', 'right' ) );
?>

	<div class="row">

		<?php if ( 'full' === $default_sidebar_position ) : ?>
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
						<?php

						get_template_part( 'template-parts/content', 'page' );

						?>
					</article><!-- #post-<?php the_ID(); ?> -->
						<?php

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>

				</main><!-- .page-main -->

			</div><!-- /.page-content -->

		<?php if ( 'full' !== $default_sidebar_position ) : ?>
			<?php if ( 'right' === $default_sidebar_position ) : ?>
				<div class="col-md-4 sidebar">
			<?php elseif ( 'left' === $default_sidebar_position ) : ?>
				<div class="col-md-4 sidebar order-md-first">
			<?php endif; ?>
					<?php get_sidebar(); ?>
				</div><!-- /.sidebar -->
		<?php endif; ?>
	</div><!-- /.row -->

<?php
get_footer();
