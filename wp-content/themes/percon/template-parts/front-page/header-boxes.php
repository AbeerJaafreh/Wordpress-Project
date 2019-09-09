<?php
$header_boxes = json_decode( percon_get_options( 'header_boxes' ) );
?>
<div class="header-boxes text-center">

	<div class="container">

		<div class="row">

			<?php
			if ( is_array( $header_boxes ) ) :

				foreach ( $header_boxes as $header_box ) :
					?>

					<div class="col-md header-box">
						<a href="<?php echo esc_url( $header_box->link ); ?>">
							<img src="<?php echo esc_url( $header_box->image_url ); ?>" alt="<?php echo esc_attr( $header_box->title ); ?>">
							<h5><?php echo esc_html( $header_box->title ); ?></h5>
						</a>
					</div><!-- .header-box -->

					<?php
				endforeach;

			endif;
			?>

		</div><!--	.row -->

	</div><!-- .container -->

</div><!-- .header-boxes -->
