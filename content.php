<div class="blog-post"> 
  <!--	<h2 class="blog-post-title"><?php the_title(); ?></h2>
	<p class="blog-post-meta"><?php the_date(); ?> by <a href="#"><?php the_author(); ?></a></p>

--> 
  <!--blog list them ref.
https://bootsnipp.com/snippets/r1kjW-->
  
  <div class="container-fluid">
    <div class="row">
      <div class="row">
        <div class="col-xs-12 col-sm-5 col-md-5">
          <?php if ( has_post_thumbnail()) : ?>
          <!--                     <a href="<?php //the_permalink(); ?>" title="<?php //the_title_attribute(); ?>" >
--> <!-- Trigger the Modal --> 
          <!--<img id="myImg" src="img_snow.jpg" alt="Snow" style="width:100%;max-width:300px">
-->
          <?php the_post_thumbnail(); ?>
          <!-- The Modal -->
          <div id="myModal" class="modal"> 
            
            <!-- The Close Button --> 
            <span class="close">&times;</span> 
            
            <!-- Modal Content (The Image) --> 
            <!--  <img class="modal-content" id="img01">
-->
            <?php the_post_thumbnail(); ?>
            <!-- Modal Caption (Image Text) -->
            <div id="caption"></div>
          </div>
          
          <!--                     </a>
-->
          <?php endif; ?>
        </div>
        <div class="col-xs-12 col-sm-7 col-md-7">
          <h2><a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
            </a></h2>
          <div class="list-group">
            <div class="list-group-item">
              <div class="row-picture"> <a href="#" title="sintret">
                <?php 
									  
									  echo get_avatar( get_the_author_meta( 'ID' ) , 128); ?>
                </a> </div>
              <div class="row-content">
                <div class="list-group-item-heading"> <a href="#" title="sintret"> <?php echo __( 'Published by','stackdesign'); ?>:
                  <?php the_author(); ?>
                  </a> </div>
                <small> <i class="glyphicon glyphicon-time"></i> <?php echo get_the_date('F j, Y g:i a'); ?> <br>
                <i class="glyphicon  glyphicon-eye-open"></i> <?php echo getPostViews(get_the_ID()).' '.__( 'is viewed','stackdesign'); ?> <br>
                <span class="explore"><i class="glyphicon glyphicon-education"></i> <a href="#"> <?php echo __( 'Number of posts:','stackdesign'); ?>
                <?php the_author_posts(); ?>
                </a></span> </small> </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row readmore">
        <?php the_content(); ?>
      </div>
      <p class="postmetadata">
        <?php 		 _ex( 'Posted on', 'Used before publish date.', 'stackdesign' );
               ?>
        <i class="glyphicon glyphicon-book"></i>
        <?php the_category(', ') ?>
        <strong>|</strong>
        <?php 
				edit_post_link(__( 'Edit', 'stackdesign'),' <i class="glyphicon glyphicon-edit">      </i>','<strong>|</strong>');                ?>
        <i class="glyphicon glyphicon-comment"> </i>
        <?php comments_popup_link(__( 'Leave a comment', 'stackdesign'), __( '1 comment', 'stackdesign'),__( '% Comments', 'stackdesign')); ?>
      </p>
      <p> <i class="glyphicon glyphicon-tags"></i>
        <?php  
		the_tags(_x( 'Tags', 'Used before tag names.','stackdesign'),' , ' ); ?>
      </p>
      <hr>
    </div>
  </div>
</div>
<!-- /.blog-post -->