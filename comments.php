<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package stackdesign
 */
 
 /*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
    return;
?>
<?php if ( have_comments() ) : ?>

<h2 class="comments-title">
  <?php
				$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				/* translators: %s: post title */
				printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'stackdesign' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s thought on &ldquo;%2$s&rdquo;',
						'%1$s thoughts on &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'stackdesign'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
			?>
</h2>
<?php stackdesign_comment_nav(); ?>
<ol class="comment-list">
  <?php
				wp_list_comments(
					array(
						'style'       => 'ol',
						'short_ping'  => true,
						'avatar_size' => 56,
					)
				);
			?>
</ol>
<!-- .comment-list -->

<?php stackdesign_comment_nav(); ?>
<?php endif; // have_comments() ?>
<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
<p class="no-comments">
  <?php _e( 'Comments are closed.', 'stackdesign' ); ?>
</p>
<?php endif; ?>
<?php comment_form(); ?>
