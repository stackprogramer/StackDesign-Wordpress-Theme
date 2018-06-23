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
        <p>My Site features articles about </p>
        <?php  echo get_bloginfo( 'description' );?>
        <p><?php echo the_tags(); ?></p>
      </div>
      <p>To search my website, please use the form below.</p>
      <?php get_search_form(); ?>
      <?php
                  
                  global $query_string;
                  
                  $search_query = wp_parse_str( $query_string );
                  $search = new WP_Query( $search_query );
                  
                  ?>
      <?php
				  
                  global $wp_query;
                  $total_results = $wp_query->found_posts;
                  echo $total_results;
				  get_template_part( 'content', get_post_format() );
				 
                  ?>
      <h2 class="pagetitle">Search Result for
        <?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); _e('<span class="search-terms">'); echo $key; _e('</span>'); _e(' &mdash; '); echo $count . ' '; _e('articles'); wp_reset_query(); ?>
      </h2>
    </main>
  </div>
</div>
<?php get_footer();?>
