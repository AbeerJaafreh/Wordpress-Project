<?php if ( is_sticky() && ! is_single() ) : ?>
	<span class="post-sticky" title="<?php echo esc_attr__( 'Sticky Post', 'percon' ); ?>"><i class="fa fa-bookmark"></i></span>
<?php endif; ?>

<div class="post-item
<?php
if ( ! has_post_thumbnail() ) {
	echo 'no-featured-image';}
?>
">

	<div class="post-image
	<?php
	if ( get_post_format() == 'video' && ! is_single() && has_post_thumbnail() ) {
		echo esc_attr( get_post_format() );}
	?>
	">

		<?php
		percon_post_thumbnail();
		percon_post_actions();
		?>

	</div>

	<?php percon_post_details(); ?>

</div><!-- .post-item -->
