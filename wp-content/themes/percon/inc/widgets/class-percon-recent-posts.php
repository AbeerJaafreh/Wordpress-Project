<?php
/**
 * Widget : Percon_Recent_Posts
 *
 */
class Percon_Recent_Posts extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'recent-posts-widget',
			'description'                 => __( 'Your site&#8217;s recent/popular Posts.', 'percon' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'percon-popular-posts', __( 'Percon - Recent/Popular Posts', 'percon' ), $widget_ops );
		$this->alt_option_name = 'Percon_Recent_posts';
	}

	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( '' !== $instance['title'] ) ? $instance['title'] : __( 'Popular Posts', 'percon' );

		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( '' !== $instance['number'] ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
		$show_popular = isset( $instance['show_popular'] ) ? $instance['show_popular'] : false;

		$r = new WP_Query(
			apply_filters(
				'widget_posts_args',
				array(
					'posts_per_page'      => $number,
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
					'orderby'             => ( $show_popular ) ? 'comment_count' : 'date',
				)
			)
		);

		if ( $r->have_posts() ) :
			?>
			<?php echo wp_kses_post( $args['before_widget'] ); ?>
			<?php
			if ( $title ) {
				echo wp_kses_post( $args['before_title'] ) . esc_html( $title ) . wp_kses_post( $args['after_title'] );
			}
			?>
			<ul>
				<?php
				while ( $r->have_posts() ) :
					$r->the_post();
					?>
					<li>
						<div class="post-thumbnail">
							<?php the_post_thumbnail( 'thumbnail' ); ?>
						</div>
						<h6>
							<a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
						</h6>
						<time datetime="<?php the_time( get_option( 'date_format' ) ); ?>"><i class="fa fa-clock-o"></i><?php echo get_the_date(); ?></time>
					</li>
				<?php endwhile; ?>
			</ul>
			<?php echo wp_kses_post( $args['after_widget'] ); ?>
			<?php
			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;
	}

	public function update( $new_instance, $old_instance ) {
		$instance                 = $old_instance;
		$instance['title']        = sanitize_text_field( $new_instance['title'] );
		$instance['number']       = (int) $new_instance['number'];
		$instance['show_popular'] = isset( $new_instance['show_popular'] ) ? (bool) $new_instance['show_popular'] : false;

		return $instance;
	}

	public function form( $instance ) {
		$title        = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number       = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_popular = isset( $instance['show_popular'] ) ? (bool) $instance['show_popular'] : false;
		?>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'percon' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"/>
		</p>

		<p><label
				for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'percon' ); ?></label>
			<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1"
				value="<?php echo esc_attr( $number ); ?>" size="3"/></p>

		<p><input class="checkbox" type="checkbox"<?php checked( $show_popular ); ?>
				id="<?php echo esc_attr( $this->get_field_id( 'show_popular' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'show_popular' ) ); ?>"/>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'show_popular' ) ); ?>"><?php esc_html_e( 'Show popular posts?', 'percon' ); ?></label>
		</p>

		<?php
	}
}
