<?php get_header(); ?>

<br>
<br>
<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">در حال توسعه</h4>
  <p>.این وبلاگ در حال توسعه و بازسازی قالب خود است. محتوا هم چنان قابل دسترس است. از صبوری شما سپاسگذارم</p>
  <hr>
  <p class="mb-0">Developing <?php echo get_locale(); ?> This blog is developing and rebuilding your template. Content is still available. Thank you for your patience.</p>
</div>
<div class="row">
  <div class="col-sm-8 blog-main">
    <?php 
			if ( have_posts() ) : while ( have_posts() ) : the_post();
  	
				get_template_part( 'content', get_post_format() );
  
			endwhile; 
			endif; 
			echo paginate_links();
			echo "<br><br>";

			?>
  </div>
  <!-- /.blog-main -->
  
  <?php get_sidebar(); ?>
</div>
<!-- /.row -->

<?php get_footer(); ?>
