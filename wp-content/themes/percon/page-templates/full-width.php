<?php
/*
* Template Name: No Sidebar (Full Width)
*/

get_header(); ?>

	<div class="row">

		<div class="col-md-12 page-content">

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

	</div><!-- /.row -->

<?php
get_footer();
