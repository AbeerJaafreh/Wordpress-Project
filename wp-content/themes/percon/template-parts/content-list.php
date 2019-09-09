<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-entry post-entry-wide col-md-12' ); ?>>

	<?php get_template_part( 'template-parts/content', get_post_type() ); ?>

</article><!-- #post-<?php the_ID(); ?> -->
