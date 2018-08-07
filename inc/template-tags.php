<?php
/**
 * Custom template tags for StackDesign
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage Stack_Design
 * @since StackDesign .11
 */

if ( ! function_exists( 'stackdesign_comment_nav' ) ) :
	/**
	 * Display navigation to next/previous comments when applicable.
	 *
	 * @since StackDesign .11
	 */
	function stackdesign_comment_nav() {
		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'stackdesign' ); ?></h2>
		<div class="nav-links">
			<?php
			if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'stackdesign' ) ) ) :
				printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

			if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'stackdesign' ) ) ) :
				printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
			</div><!-- .nav-links -->
		</nav><!-- .comment-navigation -->
		<?php
		endif;
	}
endif;

if ( ! function_exists( 'stackdesign_modify_read_more_link' ) && ! is_admin() ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a 'Continue reading' link.
	 *
	 * @since stacdesign .1
	 *
	 * @return string 'Continue reading' link prepended with an ellipsis.
	 */
	function stackdesign_modify_read_more_link() {
    $hellip='&hellip;';
    $read_more_defined= '<br><br><a class="more-link" href="' . get_permalink() . '">'.sprintf( __( 'Continue reading %s',    'stackdesign' ), '<span class="screen-reader-text">' .$hellip. '</span></a>' );
	
    return $read_more_defined;
    }
endif;
    add_filter( 'the_content_more_link', 'stackdesign_modify_read_more_link' );
	
	/**
	 * Generate custom search form
	 *
	 * @param string $form Form HTML.
	 * @return string Modified form HTML.**/
	function wpdocs_my_search_form( $form ) {
		$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
		<div><label class="screen-reader-text" for="s">' . __( 'Search for:','stackdesign') . '</label>
		<input type="text" value="' . get_search_query() . '" name="s" id="s" />
		<input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search','stackdesign' ) .'" />
		</div>
		</form>';
	 
		return $form;
	}
	add_filter( 'get_search_form', 'wpdocs_my_search_form' );
	/**
	 * Generate custom comment form
	 *
	 * @param string $form Form HTML.
	 * @return string Modified form HTML.**/
	
   function stackdesign_comment_form( $form ) {
	  $comments_args = array(
		  // change the title of send button 
		  'label_submit'=>'Send',
		  // change the title of the reply section
		  'title_reply'=>'Write a Reply or Comment',
		  // remove "Text or HTML to be displayed after the set of comment fields"
		  'comment_notes_after' => '',
		  // redefine your own textarea (the comment body)
		  'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label>           <br /><textarea id="comment" name="comment" aria-required="true"></textarea></p>',
           );
   
   }
   add_filter( 'comment_form_defaults', 'stackdesign_comment_form' );


	add_filter( 'comment_form_defaults', 'cd_pre_comment_text' );
		/**
		 * Change the text output that appears before the comment form
		 * Note: Logged in user will not see this text.
		 * 
		 * @author Carrie Dils <http://www.carriedils.com>
		 * @uses comment_notes_before <http://codex.wordpress.org/Function_Reference/comment_form>
		 * 
		 */
		function cd_pre_comment_text( $arg ) {
		  $arg['comment_notes_before'] = "Want to see your ugly mug by your comment? Get a free custom avatar at <a href='http://www.gravatar.com' target='_blank' >Gravatar</a>.";
		  return $arg;
		}

		function wpb_comment_reply_text( $link ) {
		$link = str_replace( 'Reply', __( 'Reply','stackdesign'), $link );
		return $link;
		}
		add_filter( 'comment_reply_link', 'wpb_comment_reply_text' );