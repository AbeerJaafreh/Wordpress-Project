<?php

/**
 * Breadcrumbs
 */
if ( ! function_exists( 'percon_custom_breadcrumbs' ) ) {
	function percon_custom_breadcrumbs() {

		$delimiter      = '/';
		$name           = 'Home';
		$current_before = '<span class="current">';
		$current_after  = '</span>';

		if ( ! is_home() && ! is_front_page() || is_paged() ) {

			echo '<div id="breadcrumb">';

			global $post;
			$home = home_url();
			echo '<a href="' . esc_url( $home ) . '">' . esc_attr( $name ) . '</a> ' . esc_html( $delimiter ) . ' ';

			if ( is_category() ) {
				global $wp_query;
				$cat_obj    = $wp_query->get_queried_object();
				$this_cat   = $cat_obj->term_id;
				$this_cat   = get_category( $this_cat );
				$parent_cat = get_category( $this_cat->parent );
				if ( 0 != $this_cat->parent ) {
					echo( wp_kses_post( get_category_parents( $parent_cat, true, ' ' . $delimiter . ' ' ) ) );
				}
				echo wp_kses_post( $current_before );
				single_cat_title();
				echo wp_kses_post( $current_after );

			} elseif ( is_day() ) {
				echo wp_kses_post( '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a> ' . esc_attr( $delimiter ) . ' ' );
				echo wp_kses_post( '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a> ' . esc_attr( $delimiter ) . ' ' );
				echo esc_attr( $current_before . get_the_time( 'd' ) . $current_after );

			} elseif ( is_month() ) {
				echo wp_kses_post( '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a> ' . esc_attr( $delimiter ) . ' ' );
				echo esc_attr( $current_before . get_the_time( 'F' ) . $current_after );

			} elseif ( is_year() ) {
				echo esc_attr( $current_before . get_the_time( 'Y' ) . $current_after );

			} elseif ( is_single() && ! is_attachment() ) {
				$cat = get_the_category();
				$cat = $cat[0];
				echo wp_kses_post( get_category_parents( $cat, true, ' ' . $delimiter . ' ' ) );
				echo wp_kses_post( $current_before );
				the_title();
				echo wp_kses_post( $current_after );

			} elseif ( is_attachment() ) {
				$parent = get_post( $post->post_parent );
				$cat    = get_the_category( $parent->ID );
				$cat    = $cat[0];
				echo wp_kses_post( get_category_parents( $cat, true, ' ' . $delimiter . ' ' ) );
				echo wp_kses_post( '<a href="' . get_permalink( $parent ) . '">' . esc_attr( $parent->post_title ) . '</a> ' . esc_attr( $delimiter ) . ' ' );
				echo wp_kses_post( $current_before );
				the_title();
				echo wp_kses_post( $current_after );

			} elseif ( is_page() && ! $post->post_parent ) {
				echo wp_kses_post( $current_before );
				the_title();
				echo wp_kses_post( $current_after );

			} elseif ( is_page() && $post->post_parent ) {
				$parent_id   = $post->post_parent;
				$breadcrumbs = array();
				while ( $parent_id ) {
					$page          = get_post( $parent_id );
					$breadcrumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
					$parent_id     = $page->post_parent;
				}
				$breadcrumbs = array_reverse( $breadcrumbs );
				foreach ( $breadcrumbs as $crumb ) {
					echo wp_kses_post( $crumb ) . ' ' . esc_attr( $delimiter ) . ' ';
				}
				echo wp_kses_post( $current_before );
				the_title();
				echo wp_kses_post( $current_after );

			} elseif ( is_search() ) {
				echo wp_kses_post( $current_before ) . esc_attr( 'Search results for &#39;', 'percon' ) . get_search_query() . '&#39;' . wp_kses_post( $current_after );

			} elseif ( is_tag() ) {
				echo wp_kses_post( $current_before ) . esc_attr( 'Posts tagged &#39;', 'percon' );
				single_tag_title();
				echo '&#39;' . wp_kses_post( $current_after );

			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata( $author );
				echo wp_kses_post( $current_before ) . esc_attr( 'Articles posted by ', 'percon' ) . esc_html( $userdata->display_name ) . wp_kses_post( $current_after );

			} elseif ( is_404() ) {
				echo wp_kses_post( $current_before ) . esc_attr__( 'Error 404', 'percon' ) . wp_kses_post( $current_after );
			}

			if ( get_query_var( 'paged' ) ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
					echo ' (';
				}

				echo esc_attr__( 'Page', 'percon' ) . ' ' . wp_kses_post( get_query_var( 'paged' ) );

				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
					echo ')';
				}
			}

			echo '</div>';

		}

	}
}
