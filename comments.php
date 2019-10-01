<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package leadcon
 */

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
			$leadcon_comment_count = get_comments_number();
			if ( '1' === $leadcon_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One Reply to &ldquo;%1$s&rdquo;', 'leadcon' ),
					'<span>' . get_the_title() . '</span>'
				);
			} else {
				printf( // WPCS: XSS OK.
					/* translators: 1: comment count number, 2: title. */
					esc_html( 
                        _nx( 
                            '%1$s Reply to &ldquo;%2$s&rdquo;', 
                            '%1$s Replies to &ldquo;%2$s&rdquo;', 
                            $leadcon_comment_count, 
                            'comments title', 
                            'leadcon' 
                        ) 
                    ),
					number_format_i18n( $leadcon_comment_count ),
					'<span>' . get_the_title() . '</span>'
				);
			}
			?>
		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments( 
                array(
    				'style'      => 'ol',
    				'short_ping' => true,
                    'avatar_size' => '70',
    			) 
            );
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'leadcon' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	$fields = array(
        'author' => '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . esc_attr__( 'Name *', 'leadcon' ) . '" />',
        'email'  => '<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="' . esc_attr__( 'Email *', 'leadcon' ) . '" required />',
    );

    $args = apply_filters(
        'leadcon_comment_form_args',
        array(
            'title_reply_before'   => '<span id="reply-title" class="gamma comment-reply-title">',
            'title_reply_after'    => '</span>',
            'title_reply'          => esc_html__( 'Leave a comment', 'leadcon' ),
            'comment_notes_before' => '',
            'comment_field'        => '<textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Your comment *', 'leadcon' ) . '" required ></textarea>',
            'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
            'label_submit'         => esc_html__( 'Submit', 'leadcon' ),
        )
    );

    comment_form( $args );
	?>

</div><!-- #comments -->
