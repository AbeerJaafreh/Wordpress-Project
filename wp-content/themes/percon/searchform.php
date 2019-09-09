<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" class="s form-control" name="s" placeholder="<?php esc_attr_e( 'Search&hellip;', 'percon' ); ?>" value="<?php the_search_query(); ?>" >
	<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
</form>
