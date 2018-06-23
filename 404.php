<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package stackdesign
 */

get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">
    <section class="error-404 not-found">
      <header class="page-header alert alert-danger ">
        <h1 class="page-title">
          <?php _e( 'Oops! That page can&rsquo;t be found.', 'twentyfifteen' ); ?>
        </h1>
      </header>
      <!-- .page-header -->
      
      <div class="page-content ">
        <p   class="page-header alert alert-success">
          <?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentyfifteen' ); ?>
        </p>
        <?php get_search_form(); ?>
      </div>
      <!-- .page-content --> 
    </section>
    <!-- .error-404 --> 
    
  </main>
  <!-- .site-main --> 
</div>
<!-- .content-area --> 

<br>
<br>
<br>
<?php get_footer(); ?>
