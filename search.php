<?php
/*
Template Name: Search Page
*/
?>
<?php
get_header(); ?>

<div class="wrap">
  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
      <div class="alert alert-success" >
        <?php  echo get_bloginfo( 'description' );?>
        <p><?php echo the_tags(_x( 'Tags', 'Used before tag names.','stackdesign'),' , ' ); ?></p>
      </div>
      
      <?php get_search_form(); ?>
      <?php
                  
                  global $query_string;
                  
                  $search_query = wp_parse_str( $query_string );
                  $search = new WP_Query( $search_query );
                  
                  ?>
                  <?php
				  if ( have_posts() ) :
	               $total_results = $wp_query->found_posts;
				   echo '<div class="alert alert-success" >'.sprintf(__( 'Search Results for: %s', 'stackdesign' ),$total_results).'</div>';
					// Start the loop.
					while ( have_posts() ) :
						the_post();
							
							  global $wp_query;
							
							  get_template_part( 'content', get_post_format() );
							  
							  
				  // End the loop.
			      endwhile;	
				  // Previous/next page navigation.
							  the_posts_pagination(array('screen_reader_text'=> __( 'Posts navigation', 'stackdesign' ),
												'prev_text'          => __( 'Previous page', 'stackdesign' ),
												'next_text'          => __( 'Next page', 'stackdesign' ),
												'before_page_number' => '<span class="meta-nav screen-reader-text">' . __(                                            'Page', 'stackdesign' ) . ' </span>',		));
							 
				  else :
							  get_template_part( 'content', 'none' );	  
							echo'  <div class="alert alert-warning" ><p>'.__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'stackdesign' ).'</p></div>';

		          endif;
                  ?>
     
    </main>
  </div>
</div>
<?php get_footer();?>
