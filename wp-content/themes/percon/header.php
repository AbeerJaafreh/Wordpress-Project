<?php
/**
 * Header
 *
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="header <?php echo ( has_header_image() ) ? 'custom-header' : ''; ?>">
	<?php
	$header_socials_status     = percon_get_options( 'socials_status' );
	$header_search_form_status = percon_get_options( 'header_search_form_status' );
	?>
	<div class="container">
		<div class="row">

			<div class="col-md header-widgets-left">
				<?php if ( $header_socials_status ) : ?>

					<ul class="social-item">
						<?php
							$social_url_field = percon_get_options( 'social_url' );
							$item_json_decode = json_decode( $social_url_field );
							$item_open        = percon_get_options( array( 'social_profile_target', '_blank' ) );
						if ( ! empty( $social_url_field ) ) :
							foreach ( $item_json_decode as $key ) {
								?>
								<li><a href="<?php echo esc_url( $key->link ); ?>" target="<?php echo esc_attr( $item_open ); ?>">
								<i class="fa <?php echo esc_attr( $key->icon_value ); ?>"></i>
								</a></li>
								<?php
							}
							endif;
						?>
					</ul>

				<?php endif; ?>
			</div><!-- .header-widgets-left -->

			<div class="col-md logo text-center">

			<?php
			if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {

				the_custom_logo();

			} else {
				?>

				<div class="site-branding-text">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

					<?php
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) :
						?>
					<p class="site-description"><?php echo esc_html( $description ); ?></p>
					<?php endif; ?>
				</div><!-- .site-branding-text -->

			<?php } ?>

			</div><!-- .logo -->

			<div class="col-md header-widgets-right">
				<?php if ( $header_search_form_status ) : ?>
					<div class="header-search-form">
						<?php get_search_form(); ?>
					</div><!-- .header-search-form -->
				<?php endif; ?>
			</div><!-- .header-widgets-right -->

		</div><!-- .row -->
	</div><!-- .container -->
</header>

<?php if ( has_nav_menu( 'main' ) ) : ?>
	<div class="navigation text-center">
		<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'main',
					'container'       => 'nav',
					'container_class' => 'stellarnav container',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				)
			);
		?>
	</div><!-- .navigation -->
<?php endif; ?>

<?php
/* Posts slider */
if ( percon_get_options( array( 'header_slideshow_status', false ) ) ) {
	if ( is_home() ) {
		get_template_part( 'template-parts/front-page/posts-slider' );
	}
}

/* Header Boxes */
if ( percon_get_options( array( 'header_boxes_status', false ) ) ) {
	if ( is_home() ) {
		get_template_part( 'template-parts/front-page/header-boxes' );
	}
}

/* Show Page header */
if ( ! is_home() ) {
	get_template_part( 'template-parts/page-header' );
}

?>

<div class="site-content container">
