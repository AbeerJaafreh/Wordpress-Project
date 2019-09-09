<?php
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
			<?php
			/* translators: %s: search term */
			echo esc_html( sprintf( _nx( '%s Comment', '%s Comments', get_comments_number(), 'comments title', 'percon' ), number_format_i18n( get_comments_number() ) ) );
			?>
		</h2><!-- .comments-title -->

		<ol class="comment-list">
			<?php
				wp_list_comments(
					array(
						'style'       => 'ul',
						'short_ping'  => true,
						'avatar_size' => 60,
						'callback'    => 'percon_comment',
					)
				);
			?>
		</ol><!-- .comment-list -->

		<div class="comments-pagination">

			<?php paginate_comments_links(); ?>

		</div><!-- .comments-pagination -->


		<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'percon' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().
	?>

	<?php if ( comments_open() ) : ?>
		<div class="wb-comment-form">
			<?php
				$percon_fields        = array(
					'author' => '<div class="comment-form-author form-group col-md-6">
				  <label for="author">' . esc_attr__( 'Name *', 'percon' ) . '</label>
				  <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" class="form-control" required /></div>',
					'email'  => '<div class="comment-form-email form-group col-md-6">
				  <label for="email">' . esc_attr__( 'Email *', 'percon' ) . '</label>
				  <input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" class="form-control" required /></div>',
				);
				$percon_comment_field = '<div class="comment-form-textarea form-group col-md-12">
				<label for="comment">' . esc_attr__( 'Message*', 'percon' ) . '</label>
				<textarea id="comment" name="comment" cols="45" rows="3" aria-required="true" class="form-control"></textarea></div>';

				comment_form(
					array(
						'title_reply_before'   => '<h5 class="reply-title">',
						'title_reply_after'    => '</h5>',
						'title_reply'          => esc_html__( 'Leave a Reply', 'percon' ),
						'cancel_reply_link'    => esc_html__( 'Cancel', 'percon' ),
						'label_submit'         => esc_html__( 'Post Comment', 'percon' ),
						'class_submit'         => 'submit btn btn-primary comment-submit-btn',
						'submit_field'         => '<div class="form-submit col-md-12">%1$s %2$s</div>',
						'cancel_reply_before'  => '<small class="wb-cancel-reply">',
						'class_form'           => 'comment-form row align-items-center',
						'comment_notes_before' => '',
						'comment_notes_after'  => '',
						'comment_field'        => $percon_comment_field,
						'fields'               => $percon_fields,
					)
				);
			?>
		</div>
	<?php endif; ?>

</div><!-- #comments -->
