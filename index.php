<?php get_header(); ?>

<br>
<br>
<!-- <div class="alert alert-success" role="alert">
  <h4 class="alert-heading">در حال توسعه</h4>
  <p>.این وبلاگ در حال توسعه و بازسازی قالب خود است. محتوا هم چنان قابل دسترس است. از صبوری شما سپاسگذارم</p>
  <hr>
  <p class="mb-0">Developing <?php echo get_locale(); ?> This blog is developing and rebuilding your template. Content is still available. Thank you for your patience.</p>
</div> -->
<!-- Topbar position -->
<div   class="row">
			<?php
			if ( is_active_sidebar( 'custom_topbar_1' ) ){
				dynamic_sidebar( 'custom_topbar_1' );
			}
			?>
</div>
<!-- End topbar position -->



<div class="row">
  <div class="col-sm-8 blog-main">
    <?php 
			if ( have_posts() ) : while ( have_posts() ) : the_post();
  	
				get_template_part( 'content', get_post_format() );
  
			endwhile; 
			endif; 
			 // Previous/next page navigation.
			    the_posts_pagination(array('screen_reader_text'=> __( 'Posts navigation', 'stackdesign' ),
												'prev_text'          => __( 'Previous page', 'stackdesign' ),
												'next_text'          => __( 'Next page', 'stackdesign' ),
												'before_page_number' => '<span class="meta-nav screen-reader-text">' . __(                                            'Page', 'stackdesign' ) . ' </span>',));
			?>
  </div>
  <!-- /.blog-main -->
  
  <?php get_sidebar(); ?>
</div>
<!-- /.row -->


<!--   Bottombar position -->
<div   class="row">
	<div class="col-xm-4 col-sm-4 col-md-4 col-lg-4">
			<?php
			if ( is_active_sidebar( 'custom_bottombar_1' ) ){
				dynamic_sidebar( 'custom_bottombar_1' );
			}
			?>
	</div>
	<div class="col-xm-4 col-sm-4 col-md-4 col-lg-4">
			<?php
			if ( is_active_sidebar( 'custom_bottombar_2' ) ){
				dynamic_sidebar( 'custom_bottombar_2' );
			}
			?>
	</div>
	<div class="col-xm-4 col-sm-4 col-md-4 col-lg-4">
			<?php
			if ( is_active_sidebar( 'custom_bottombar_3' ) ){
				dynamic_sidebar( 'custom_bottombar_3' );
			}
			?>
	</div>

</div>
<!-- End  bottombar position -->



<?php get_footer(); ?>
