</div><!-- .site-content -->

<footer class="footer">

	<?php if ( percon_get_options( array( 'footer_widgets_status', true ) ) ) : ?>
		<section class="footer-widgets">
			<div class="container">
				<div class="row">
					<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
						<div class="col-md-4">
							<aside class="footer-widget footer-1-area">
								<?php dynamic_sidebar( 'footer-1' ); ?>
							</aside>
						</div>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
						<div class="col-md-4">
							<aside class="footer-widget footer-2-area">
								<?php dynamic_sidebar( 'footer-2' ); ?>
							</aside>
						</div>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
						<div class="col-md-4">
							<aside class="footer-widget footer-3-area">
								<?php dynamic_sidebar( 'footer-3' ); ?>
							</aside>
						</div>
					<?php endif; ?>

				</div>
				<!-- /.row -->
			</div>
		</section>
	<?php endif; ?>

	<?php $instagram_username = percon_get_options( 'footer_instagram_username' ); ?>
	<section data-instagram-username="<?php echo esc_attr( $instagram_username ); ?>" class="instagram-area">
	<?php
	if ( percon_get_options( 'footer_instagram_status' ) ) :
		if ( '' !== $instagram_username ) :
			?>
		<a target="_blank" href="<?php echo esc_url( 'https://instagram.com/' . $instagram_username ); ?>" class="follow-me-btn">
			<i class="fa fa-instagram"></i>
			<span><?php esc_html_e( 'Follow me!', 'percon' ); ?></span>
		</a>
		<div class="instagram-posts"></div>
		<?php else : ?>
			<p><?php esc_html_e( 'Insert your instagram username via theme options!', 'percon' ); ?></p>
			<?php
		endif;
	endif;
	?>
	</section>

	<div class="container">
		<footer class="sub-footer">
			<div class="site-info">
				<?php echo wp_kses_post( percon_get_options( array( 'footer_copyright_text', 'Percon - Copyright 2018. All Right Reserved. Design by <a target="_blank" href="http://tortoiz.com/">Tortoiz</a>.' ) ) ); ?>
			</div><!-- .site-info -->
			<?php if ( percon_get_options( array( 'footer_top_btn_status', true ) ) ) : ?>
				<a href="#0" class="go-top"><i class="fa fa-arrow-up"></i></a>
			<?php endif; ?>
		</footer>
	</div>
</footer><!-- #Footer -->

<?php wp_footer(); ?>

</body>
</html>
