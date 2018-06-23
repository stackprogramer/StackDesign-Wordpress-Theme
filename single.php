<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
get_header(); ?>

<div class="row">
  <div class="col-sm-8 blog-main">
    <main id="main" class="site-main" role="main">
      <?php
		// Start the loop.
		while ( have_posts() ) :
			the_post();

			/*
			 * Include the post format-specific template for the content. If you want to
			 * use this in a child theme, then include a file called content-___.php
			 * (where ___ is the post format) and that will be used instead.
			 */
			get_template_part( 'content', get_post_format() );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
				
			endif;
		  

			// Previous/next post navigation.
			the_post_navigation(
				array(
					'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'twentyfifteen' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Next post:', 'twentyfifteen' ) . '</span> ' .
						'<span class="post-title">%title</span>',
					'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'twentyfifteen' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Previous post:', 'twentyfifteen' ) . '</span> ' .
						'<span class="post-title">%title</span>',
				)
			);
           setPostViews(get_the_ID());
			// End the loop.
		endwhile;
		?>
    </main>
    <!-- .site-main --> 
    
  </div>
  <!-- /.blog-main -->
  
  <?php get_sidebar(); ?>
</div>
<!-- /.row --> 
<br>
<br>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
