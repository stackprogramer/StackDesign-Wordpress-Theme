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

<!--https://bootsnipp.com/snippets/459K9-->

<ol class="comment-list">
  <?php
        wp_list_comments( array(
            'style'       => '',
            'short_ping'  => true,
            'avatar_size' => 74,
        ) );
    ?>
</ol>
<!-- .comment-list -->
<?php endif; // have_comments() ?>
<?php comment_form(); ?>
