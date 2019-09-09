<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header(); ?>

	<div class="container">
		<div class="row">

			<div class="col-md-12 text-center">

				<div id="primary" class="content-area">
					<main id="main" class="site-main">

						<section class="error-404 not-found">
							<h1><?php esc_html_e( 'OOPS! THAT PAGE CAN\'T BE FOUND.', 'percon' ); ?></h1>
							<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'percon' ); ?></p>
							<?php get_search_form(); ?>
							<a class="btn btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Go to Homepage', 'percon' ); ?></a>
						</section>

					</main><!-- #main -->
				</div><!-- #primary -->

			</div>
			<!-- /.col-md-12 -->

		</div>
		<!-- /.row -->
	</div>
	<!-- /.container -->
<?php
get_footer();
