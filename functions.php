<?php
	      
		 //Register bootstrap files and jQuery:
		  function wpt_register_js() {
			  wp_register_script('jquery.bootstrap.min', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery');
			  wp_enqueue_script('jquery.bootstrap.min');
		  }
		  add_action( 'init', 'wpt_register_js' );
		  function wpt_register_css() {
			  wp_register_style( 'bootstrap.min', get_template_directory_uri() . '/css/bootstrap.min.css' );
			  wp_register_style( 'style', get_template_directory_uri() . '/style.css' );
			  wp_register_style( 'bloglist', get_template_directory_uri() . '/css/bloglist.css' );
              wp_register_style( 'comment', get_template_directory_uri() . '/css/comment.css' );
			  wp_register_style( 'widgets', get_template_directory_uri() . '/css/widgets.css' );

			  wp_enqueue_style( 'bootstrap.min' );
			  wp_enqueue_style( 'widgets' );
			  wp_enqueue_style( 'comment' );
			  wp_enqueue_style( 'style' );
			  wp_enqueue_style( 'bloglist' );
		  }
		//End register bootstrap files and jQuery:
        // Register custom navigation walker
        require_once('inc/wp_bootstrap_navwalker.php');
		// End register custom navigation walker
		//Custom logo setup implentation
		 function themename_custom_logo_setup() {
			$defaults = array(
				'height'      => 100,
				'width'       => 100,
				'flex-height' => true,
				'flex-width'  => true,
				'header-text' => array( 'site-title', 'site-description' ),
			);
			add_theme_support( 'custom-logo', $defaults );
		}
		//End custom logo setup implentation
		//Pagination implentation
		function your_themes_pagination(){
			global $wp_query; 
			echo paginate_links();
		}
		//End pagination implentation
		
		//Sidebar implentation
		
		function custom_sidebar_init() {
			register_sidebar( array(
				'name'          => 'New Custom Sidebar',
				'id'            => 'custom_sidebar_1',
				'description'   => 'Add widgets here to appear for single posts.',
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
		}
		//End sidebar implentation
		
		//Gravatar Alt Fix
		function stackdesign_gravatar_alt($text) {
		$alt = get_the_author_meta( 'display_name' );
		$text = str_replace('alt=\'\'', 'alt=\'Avatar for '.$alt.'\' title=\'Gravatar for '.$alt.'\'',$text);
		return $text;
		}
		//End gravatar Alt Fix
		//Add_theme_support style thumbnail
		if ( function_exists( 'add_theme_support' ) ) {
			set_post_thumbnail_size( 250, 200, true ); 
			the_post_thumbnail( 'thumbnail', array( 'class' => 'img-responsive' ) );
		 }
		 //End add_theme_support style thumbnail
		 
		 // Function for adding counter views/hits to wordpress post.
		 // function to display number of posts.
		function getPostViews($postID){
			$count_key = 'post_views_count';
			$count = get_post_meta($postID, $count_key, true);
			if($count==''){
				delete_post_meta($postID, $count_key);
				add_post_meta($postID, $count_key, '0');
				return "0";
			}
			return $count;
		}
		 
		// function to count views.
		function setPostViews($postID) {
			$count_key = 'post_views_count';
			$count = get_post_meta($postID, $count_key, true);
			if($count==''){
				$count = 0;
				delete_post_meta($postID, $count_key);
				add_post_meta($postID, $count_key, '0');
			}else{
				$count++;
				update_post_meta($postID, $count_key, $count);
			}
		}
		// Add it to a column in WP-Admin
		function posts_column_views($defaults){
			$defaults['post_views'] = __('Views');
			return $defaults;
		}
		function posts_custom_column_views($column_name, $id){
		 if($column_name === 'post_views'){
				echo getPostViews(get_the_ID());
			}
		}
		// End Function for adding counter views/hits to wordpress post.
		// Stack design Loading the theme's translated strings. 
		function stackdesign_textdomain_setup(){
			$result=load_theme_textdomain( 'stackdesign', get_template_directory() .'/languages' );
			
		}
	    //End stack design Loading the theme's translated strings. 

		
		
		
        // Adding  actions of functions.
		
	   /* Theme  menu setup */
		add_action( 'after_setup_theme', 'wpt_setup' );
			if ( ! function_exists( 'wpt_setup' ) ):
				function wpt_setup() {  
					register_nav_menu( 'primary', __( 'Primary navigation', 'wptuts' ) );
				} endif;
 	    /*End  theme  menu setup */
        //  add_action( 'wp_enqueue_scripts', 'wpt_register_css' );
		add_filter('get_avatar','stackdesign_gravatar_alt');
		add_theme_support( 'post-thumbnails' );
		themename_custom_logo_setup();
		your_themes_pagination();
		add_action( 'after_setup_theme', 'themename_custom_logo_setup' );
		add_action( 'widgets_init', 'custom_sidebar_init' );
		// Add it to a column in WP-Admin
		add_filter('manage_posts_columns', 'posts_column_views');
		add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
		add_action( 'after_setup_theme', 'stackdesign_textdomain_setup' );
		// End adding actions of functions.
		
				



