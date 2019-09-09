<?php

function percon_comment( $comment, $args, $depth ) {
	?>

	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

		<?php
			$wb_gravatar_url = get_avatar_url( $comment );
		?>
		<article class="media">
			<?php if ( ! empty( $wb_gravatar_url ) ) : ?>
				<img class="d-flex align-self-start comment-img" src="<?php echo esc_url( $wb_gravatar_url ); ?>" alt="<?php echo esc_attr( get_comment_author() ); ?>" width="100">
			<?php endif; ?>
			<div class="media-body">
				<h6 class="comment-author">
					<?php echo get_comment_author_link(); ?>
				</h6>
				<time class="comment-time" datetime="<?php echo esc_html( get_comment_date() ); ?>">
					<i class="fa fa-clock-o"></i><?php echo esc_html( get_comment_date() ); ?>
				</time>
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<small><em class="comment-awaiting text-muted"><?php esc_html_e( 'Comment is awaiting approval', 'percon' ); ?></em></small>
					<br />
				<?php endif; ?>

				<div class="comment-text">
					<?php comment_text(); ?>
				</div>

				<?php
					$args['before'] = '';
				?>

				<small class="reply">
					<?php
					comment_reply_link(
						array_merge(
							$args,
							array(
								'reply_text' => '<i class="fa fa-mail-reply"></i>' . esc_html__( 'Reply', 'percon' ),
								'depth'      => $depth,
								'max_depth'  => $args['max_depth'],
							)
						),
						$comment->comment_ID
					);
					?>
					<?php edit_comment_link( esc_html__( 'Edit', 'percon' ) ); ?>
				</small>
			</div>
			<!-- /.media-body -->
		</article>

	<?php
}
