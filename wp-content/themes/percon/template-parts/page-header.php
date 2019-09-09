<header class="page-header text-center">
	<div class="container">
		<?php
		if ( is_search() ) {
			$header_title = esc_html( sprintf( 'Search Results for: %s', get_search_query() ) );
		} else {
			$header_title = get_the_title();
		}
		?>
		<h2 class="page-header-title"><?php echo esc_html( $header_title ); ?></h2>
		<?php percon_custom_breadcrumbs(); ?>
	</div>
</header>
