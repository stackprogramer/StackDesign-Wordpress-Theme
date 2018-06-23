<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php echo get_bloginfo( 'description' );?>">
<title><?php echo get_bloginfo( 'name' ); ?></title>
<link href="<?php echo get_bloginfo( 'template_directory' );?>/css/bootstrap.min.css" rel="stylesheet">
<?php
   if (get_locale()==('fa_IR') )  {
    echo'<link href="'.get_bloginfo( 'template_directory' ).'/css/bootstrap-rtl.min.css" rel="stylesheet">';
    echo'<link href="'.get_bloginfo( 'template_directory' ).'/css/widgets-rtl.css" rel="stylesheet">';
    }
	else{
	echo'<link href="'.get_bloginfo( 'template_directory' ).'/css/widgets.css" rel="stylesheet">';
	}
	?>
<link href="<?php echo get_bloginfo( 'template_directory' );?>/style.css" rel="stylesheet">
<link href="<?php echo get_bloginfo( 'template_directory' );?>/css/bloglist.css" rel="stylesheet">
<link href="<?php echo get_bloginfo( 'template_directory' );?>/css/comment.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo get_bloginfo( 'template_directory' );?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo( 'template_directory' );?>/js/bootstrap.min.js"></script>
<?php wp_head();?>
</head>

<body>
<div class="blog-masthead">
  <div class="container">
    <div class="blog-header">
      <?php $custom_logo_id = get_theme_mod( 'custom_logo' );
              $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
              if ( has_custom_logo() ) {
                      echo '<img src="'. esc_url( $logo[0] ) .'"  >';
              } else {
				    
                      echo '<a  href="'. get_bloginfo('url').'"><h1  class="blog-title" >'. get_bloginfo( 'name' ) .'</h1>';
					  echo'<p class="lead  blog-description">'.get_bloginfo( 'description' ).'</p><a>';
              }?>
    </div>
  </div>
</div>
<div class="navbar-header"> 
  <!--<button type="button" class="navbar-toggle" data-toggle="collapse"                               n                           data-target="#bs-example-navbar-collapse-1">
                              <span class="sr-only">Toggle navigation</span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
		               	</button>--> 
  <a class="navbar-brand" href="<?php echo home_url(); ?>">
  <?php //bloginfo('name'); ?>
  </a> </div>
<nav class="navbar navbar-default" role="navigation">
  <div class="container">
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav">
        <?php
							wp_nav_menu( array(
								'theme_location'    => 'primary',
								'depth'             => 2,
								'container'         => 'div',
								'container_class'   => 'collapse navbar-collapse',
								'container_id'      => 'bs-example-navbar-collapse-1',
								'menu_class'        => 'nav navbar-nav',
								'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
								'walker'            => new WP_Bootstrap_Navwalker())
							);
							?>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
