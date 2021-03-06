<?php
/**
 * The main template file
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

				<main id="main" class="page-main">

					<div class="row">

						<?php
						if ( have_posts() ) :
							?>

								<?php
								/* Start the Loop */
								while ( have_posts() ) :
									the_post();

									get_template_part( 'template-parts/content-list', get_post_format() );

								endwhile;

								if ( percon_get_options( array( 'blog_pagination', false ) ) ) {

									the_posts_navigation(
										array(
											'next_text' => esc_html__( 'Newer Posts', 'percon' ),
											'prev_text' => esc_html__( 'Older Posts', 'percon' ),
										)
									);

								} else {

									precon_posts_pagination();

								}

								else :

									get_template_part( 'template-parts/content', 'none' );

							endif;
								?>

					</div><!-- /.row -->

				</main><!-- .page-main -->

			</div><!-- /.page-content -->

		<?php if ( 'full' !== $default_sidebar_position ) : ?>
			<?php if ( 'right' === $default_sidebar_position ) : ?>
				<div class="col-md-4 sidebar">
			<?php elseif ( 'left' === $default_sidebar_position ) : ?>
				<div class="col-md-4 sidebar order-md-first">
			<?php endif; ?>
					<?php get_sidebar(); ?>
				</div>
				<!-- /.sidebar -->
		<?php endif; ?>
	</div><!-- /.row -->

<?php
get_footer();
