<?php

/**
 * Displays the hero of the homepage
 */
if ( ! function_exists( 'modul_r_hero_image' ) ) :
	function modul_r_hero_image() {
  // get theme option who set the hero's height to 100%
  $opt_hero = (get_theme_mod('modul_r_settings_hero') === true) ? ' fullpage-hero' : '' ;
  ?>
    <div class="website-hero text-center<?php echo $opt_hero; ?>">
    <?php modul_r_post_image('parallax'); ?>
      <div class="hero-title text-center">
      <?php the_title( '<h1 class="entry-title has-secondary-color">', '</h1>' ); ?>
        <p><?php bloginfo('description'); ?></p>
      <?php

      printf('<a href="%s" class="button big has-secondary-background-color">%s</a>', esc_url( get_category_link(get_cat_ID('news')) ), esc_html__('Lastest news', 'modul-r'));

      if ( class_exists( 'WooCommerce' ) ) {
        printf( '<a href="%s" class="button big outline" >%s</a>', esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ), esc_html__( 'Shop', 'modul-r' ) );
      } else {
        printf( '<a href="%s" class="button big outline" >%s</a>', esc_url( get_category_link( get_cat_ID( 'contacts' ) ) ), esc_html__( 'Contact us', 'modul-r' ) );
      }

      ?>
      </div>
    </div>
  <?php
	}
endif;

/**
 * Displays the featured image of the post/page
 * you can pass single or multiple classes to the image wrapper
 */
if ( ! function_exists( 'modul_r_post_image' ) ) :
  function modul_r_post_image( $class = null ) {
    // Check if Thumbnail exists
		if ( has_post_thumbnail() ) : ?>
      <div class="entry-image interactive<?php echo ' ' . sanitize_html_class($class); ?>">
			  <?php the_post_thumbnail( 'modul-r-fullwidth', array( 'class' => 'fit-image wp-post-image' ) ); ?>
      </div>
		<?php endif;
	}
endif;


/**
 * Displays the navigation for the archive page
 */
if ( ! function_exists( 'modul_r_archive_nav' ) ) :
	function modul_r_archive_nav() {

	  $pagination = get_the_posts_pagination( array(
		  'mid_size'  => 5,
		  'prev_text' => esc_html__( 'Prev', 'modul-r' ),
		  'next_text' => esc_html__( 'Next', 'modul-r'),
	  ) );

	  return $pagination;

	}
endif;


/**
 * Displays the next/prev navigation for the post
 */
if ( ! function_exists( 'modul_r_post_nav' ) ) :
	function modul_r_post_nav() { ?>
      <div class="post-navigation">
        <h3><?php esc_html_e('Post navigation', 'modul-r'); ?></h3>
        <div class="navigation">
          <div class="alignleft">
			      <?php previous_post_link('<i class="material-icons">arrow_back</i> %link'); ?>
          </div>
          <div class="alignright">
			      <?php next_post_link('%link <i class="material-icons">arrow_forward</i>'); ?>
          </div>
        </div> <!-- end navigation -->
      </div>
	<?php }
endif;


/**
 * The masonry navigation
 */
if ( ! function_exists( 'modul_r_masonry_nav' ) ) :
	function modul_r_masonry_nav() { ?>
    <div class="masonry navigation">
  		<?php next_posts_link(); ?>
    </div>

    <div class="page-load-status">
      <div class="loader-ellips infinite-scroll-request">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/src/img/elements/loader.svg" alt="<?php esc_attr_e('wait! loading',  'modul-r' ); ?>">
      </div>
      <div class="infinite-scroll-last">
        <div class="main-width alignwide">
          <h4><?php esc_html_e("End of content... Maybe you're interested to other categories?",  'modul-r' ); ?></h4>
          <div class="category-list-labels">
            <?php wp_list_categories(array(
	            'hierarchical' => false,
	            'separator' => '',
	            'title_li'  => ''
            ) ); ?>
          </div>
        </div>
      </div>
      <p class="infinite-scroll-error"><?php esc_html_e('No more pages to load',  'modul-r' ); ?></p>
    </div>
	<?php }
endif;


/**
 * Displays page-links for paginated posts
 */
if ( ! function_exists( 'modul_r_page_links' ) ) :
	function modul_r_page_links() {

	  $args = array(
		  'before'           => '<p>' . esc_html__( 'Pages:',  'modul-r' ),
		  'after'            => '</p>',
		  'link_before'      => '',
		  'link_after'       => '',
		  'next_or_number'   => 'number',
		  'separator'        => ' ',
		  'nextpagelink'     => esc_html__( 'Next page',  'modul-r'),
		  'previouspagelink' => esc_html__( 'Previous page',  'modul-r' ),
		  'pagelink'         => '%'
	  );

	  $pagination = wp_link_pages( $args );

	  return $pagination;
  }
endif;


/**
 * Displays the comments template
 */
if ( ! function_exists('modul_r_comments') ) :
	function modul_r_comments() {
		// If comments are open or we have at least one comment, load up the comment template.
		comments_template();
	}
endif;


/**
 * Displays the tags
 */
if ( ! function_exists('modul_r_tags') ) :
	function modul_r_tags() {

		if( has_tag() ): ?>
			<div class="post-tags">
				<h3><?php esc_html_e('Tags:',  'modul-r'); ?></h3>
				<ul><?php the_tags( '<li class="post-tag">', '</li><li class="post-tag">', '</li>');  ?></ul>
			</div>
		<?php endif;

	}
endif;

/**
 * Displays the article meta (author / date / comments number if isn't zero)
 */
if ( ! function_exists('modul_r_meta') ) :
	function modul_r_meta() {

    global $post;
    $post_comments = get_comment_count($post->ID);
	  $approved = $post_comments['approved'];

		?>
    <div class="post-meta">

      <a href="<?php the_permalink(); ?>" rel="bookmark" class="hide"><?php the_title(); ?></a>

      <div class="meta-wrapper">

        <p>
          <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" rel="author" class="h-card url" >
            <span class="author fn"><?php the_author_meta( 'display_name' ); ?></span>
          </a>
        </p>

        <p><b> | </b></p>

        <p>
          <a href="<?php echo get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ); ?>">

            <?php if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) : ?>
              <time class="entry-date published updated hide" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ) ?>"><?php echo esc_html( get_the_date() ); ?></time>
	          <?php else : ?>
              <time class="entry-date published hide" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
              <time class="updated hide" datetime="<?php echo esc_attr( get_the_modified_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_modified_date() ); ?></time>
		        <?php endif; ?>

	          <span><?php echo apply_filters( 'the_date', get_the_date(), get_option( 'date_format' ), '', '' ); ?></span>

          </a>
        </p>

        <?php if ( $approved > 0 ) { ?>

        <p><b> | </b></p>

        <p>
          <a href="<?php the_permalink(); ?>#comments">
            <?php
            /* translators: %s: the number of comments */
            printf( _n( '%s comment', '%s comments', $approved, 'modul-r' ), $approved );
            ?>
          </a>
        </p>

        <?php } ?>

      </div>
    </div>

		<?php

	}
endif;


/**
 * Displays the article breadcrumbs
 */
if ( ! function_exists('modul_r_breadcrumbs') ) :
	function modul_r_breadcrumbs() {
	  if ( function_exists('yoast_breadcrumb') ) {
		  yoast_breadcrumb( '<p class="breadcrumbs">','</p>' );
	  } else {
	    printf('<p class="breadcrumbs"><a href="%s">%s</a> / %s</p>', esc_url(home_url()) , esc_html__('Home', 'modul-r'), get_the_category_list(' &#47; ') );
    }
  }
endif;


/**
 * Displays the article shares buttons
 */
if ( ! function_exists('modul_r_social_sharer') ) :
	function modul_r_social_sharer() {
  $sharer_page_link = urlencode(esc_attr(get_page_link()));
  $sharer_blog_title = urlencode(esc_attr(get_bloginfo('title')));
  $sharer_page_title = urlencode(esc_attr(get_the_title()));

    ?>
    <div id="share-buttons">

      <h3>
	      <?php is_page() ? esc_html_e( 'Share this page', 'modul-r' ) : esc_html_e( 'Share this post', 'modul-r' ) ; ?>
      </h3>

      <!-- Facebook -->
      <a href="http://www.facebook.com/sharer.php?u=<?php echo $sharer_page_link; ?>" target="_blank" title="<?php esc_attr_e( 'Share on Facebook', 'modul-r' ) ; ?>">
        <i class="social-ico facebook"></i>
      </a>


      <!-- LinkedIn -->
      <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $sharer_page_link; ?>" target="_blank" title="<?php esc_attr_e( 'Share on Linkedin', 'modul-r' ) ; ?>">
        <i class="social-ico linkedin"></i>
      </a>

      <!-- Twitter -->
      <a href="https://twitter.com/intent/tweet?url=<?php echo $sharer_page_link; ?>&amp;text=<?php echo $sharer_blog_title; ?>+<?php echo $sharer_page_title; ?>" target="_blank" title="<?php esc_attr_e( 'Share on Twitter', 'modul-r' ); ?>">
        <i class="social-ico twitter"></i>
      </a>


      <!-- Email -->
      <a href="mailto:?Subject=<?php echo $sharer_blog_title; ?>&amp;Body=<?php echo $sharer_page_link; ?>" target="_blank" title="<?php esc_attr_e( 'Send by mail', 'modul-r' ); ?>">
        <i class="social-ico email"></i>
      </a>

      <!-- Print -->
      <a href="javascript:" onclick="window.print()" title="<?php esc_attr_e( 'Print this page', 'modul-r' ); ?>">
        <i class="social-ico print"></i>
      </a>

    </div>
    <?php
	}
endif;

/**
 * Displays the related articles
 */
if ( ! function_exists( 'modul_r_relateds' ) ) :
	function modul_r_relateds() {

		  $args = array(
			  'post_type'      => 'post',
			  'orderby'        => 'rand',
			  'posts_per_page' => 3,
		  );

		  $query = new WP_Query( $args );

		  if ( $query->have_posts() ) : ?>
        <div class="relateds">

          <h3><?php esc_html_e( 'You might be interested in...', 'modul-r' ); ?></h3>
          <ul class="relateds-list">

            <?php while ( $query->have_posts() ) : $query->the_post();
              get_template_part( 'template-parts/content/content', 'related' );
            endwhile; ?>

          </ul>

        </div>

      <?php

		  wp_reset_postdata();

      endif;
	}
endif;

// add 'has-featured-image' to body class if post has a featured image
if ( ! function_exists('modul_r_custom_body_class') ) :
	function modul_r_custom_body_class( $classes ) {
		global $post;

		if (is_page() || is_single()) {

      // add the class "has-featured-image" if page or article and it ha a post thumbnail set
      if ( isset ( $post->ID ) && get_the_post_thumbnail($post->ID) ) {$classes[] = 'has-featured-image';}

      // get theme option "sidebar enabled"
      $opt_sidebar = get_theme_mod('modul_r_settings_sidebar');
      if ( $opt_sidebar === true ) {$classes[] = 'has-sidebar';}
    }


		return $classes;
	}
endif;

add_filter( 'body_class', 'modul_r_custom_body_class' );

/**
 * Add a background to the headline if changed in the customizer
 */
if ( ! function_exists('modul_r_header_image') ) :
	function modul_r_header_image() {
    $header_image = get_header_image();
	  if ($header_image) {
	    printf('<img src="%s" alt="%s" class="site-header-image" />', $header_image, get_bloginfo( 'title' ));
    }
	}
endif;


/**
 * Display the author of the post
 */
if ( ! function_exists('modul_r_author') ) :
	function modul_r_author() {

	  global $post;

	  ?>

    <div class="article-metas">

      <div class="article-author author vcard">
        <div class="author-image">
          <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
            <span class="avatar u-photo"><?php echo get_avatar( get_the_author_meta( 'ID' ), '64', null, get_the_author() ); ?> </span>
          </a>
        </div>
        <div class="author-details">
          <a class="url" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" rel="author">
            <h3 class="name fn n"><?php the_author_meta( 'display_name' ); ?></h3>
          </a>
          <div class="author-description note">
            <p><?php the_author_meta( 'description' ); ?></p>
            <?php

            $website = get_the_author_meta( 'url', $post->post_author );
            if ( $website ) {echo '<a href="' . $website . '" class="u-url" rel="nofollow" target="_blank"><i class="social-ico www"></i></a>';}

            $twitter = get_the_author_meta( 'twitter', $post->post_author );
            if ( $twitter ) {echo '<a href="https://twitter.com/' . $twitter . '" class="u-url" rel="nofollow" target="_blank"><i class="social-ico twitter"></i></a>';}

            $facebook = get_the_author_meta( 'facebook', $post->post_author );
            if ( $facebook ) {echo '<a href="' . $facebook . '" class="u-url" rel="nofollow" target="_blank"><i class="social-ico facebook"></i></a>';}

            ?>
          </div>
        </div>
      </div>

    </div>

  <?php
	}
endif;