<?php
/**
 * Stack Design functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package Stack Design
 * @subpackage Stack_Design
 * @since StackDesign 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Stack Design 1.0
 */
		
		 if ( ! isset( $content_width ) ) {
			  $content_width = 660;
		  }
		  
		  /**
		   * Stack Design only works in WordPress 4.1 or later.
		   */
		  if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
			  require get_template_directory() . '/inc/back-compat.php';
		  }	
		      
		if ( ! function_exists( 'stackdesign_setup' ) ) :
		  /**
		   * Sets up theme defaults and registers support for various WordPress features.
		   *
		   * Note that this function is hooked into the after_setup_theme hook, which
		   * runs before the init hook. The init hook is too late for some features, such
		   * as indicating support for post thumbnails.
		   *
		   * @since Twenty Fifteen 1.0
		   */
		  function stackdesign_setup() {
	  
			  /*
			   * Make theme available for translation.
			   * Translations can be filed at WordPress.org. See: http://wordpress.org
			   * If you're building a theme based on stackdesign, use a find and replace
			   * to change 'stackdesign' to the name of your theme in all the template files
			   */
			   // Stack design Loading the theme's translated strings. 

			  load_theme_textdomain('stackdesign', get_template_directory() .'/languages' );

	  
			  // Add default posts and comments RSS feed links to head.
			  add_theme_support( 'automatic-feed-links' );
	  
			  /*
			   * Let WordPress manage the document title.
			   * By adding theme support, we declare that this theme does not use a
			   * hard-coded <title> tag in the document head, and expect WordPress to
			   * provide it for us.
			   */
			  add_theme_support( 'title-tag' );


			  //Register and enqueue  css,bootstrap files and jQuery:

			  wp_register_style( 'bootstrap.min', get_template_directory_uri() . '/css/bootstrap.min.css' );
			  wp_enqueue_style( 'bootstrap.min' );


			   if (get_locale()==('fa_IR') )  {
                 wp_register_style( 'bootstrap-rtl.min', get_template_directory_uri() . '/css/bootstrap-rtl.min.css' );
                 wp_enqueue_style( 'bootstrap-rtl.min' );
                 wp_register_style( 'widgets-rtl', get_template_directory_uri() . '/css/widgets-rtl.css');
                 wp_enqueue_style('widgets-rtl' );
			   }else{

			     wp_register_style( 'widgets-ltr', get_template_directory_uri() . '/css/widgets.css' );
			     wp_enqueue_style( 'widgets-ltr' );

			   }
			  wp_register_style( 'style', get_template_directory_uri() . '/style.css' );
			  wp_register_style( 'bloglist', get_template_directory_uri() . '/css/bloglist.css' );
              wp_register_style( 'comment', get_template_directory_uri() . '/css/comment.css' );
              wp_register_style( 'ribboncorner', get_template_directory_uri() . '/css/ribboncorner.css' );


			  wp_enqueue_style( 'style' );
			  wp_enqueue_style( 'bloglist' );
			  wp_enqueue_style( 'comment' );
              wp_enqueue_style( 'ribboncorner');

			  wp_register_script('jquery.bootstrap.min', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery');
			  wp_register_script('jquery.min', get_template_directory_uri() . '/js/jquery.min.js', 'jquery');
			  wp_enqueue_script('jquery.bootstrap.min');
			  wp_enqueue_script('jquery.min');



		
		

	  
	        }
		endif;// stackdesign_setup
		add_action( 'after_setup_theme', 'stackdesign_setup' );

		
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

		//Topbar implentation
		function custom_topbar_init() {
			register_sidebar( array(
				'name'          => 'Custom Topbar',
				'id'            => 'custom_topbar_1',
				'description'   => 'Add widgets here to appear on the top of posts',
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
		}
		//ENd topbar implentation

        //Bottombar 1 implentation
		function custom_bottombar1_init() {
			register_sidebar( array(
				'name'          => 'Custom Bottombar 1',
				'id'            => 'custom_bottombar_1',
				'description'   => 'Add widgets here to appear on the bottom of posts',
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
		}
		//ENd bottombar 1 implentation
		 //Bottombar 2 implentation
		function custom_bottombar2_init() {
			register_sidebar( array(
				'name'          => 'Custom Bottombar 2',
				'id'            => 'custom_bottombar_2',
				'description'   => 'Add widgets here to appear on the bottom of posts',
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
		}
		//ENd bottombar 2 implentation

		 //Bottombar 3 implentation
		function custom_bottombar3_init() {
			register_sidebar( array(
				'name'          => 'Custom Bottombar 3',
				'id'            => 'custom_bottombar_3',
				'description'   => 'Add widgets here to appear on the bottom of posts',
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
		}
		//ENd bottombar 3 implentation

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
		add_action( 'widgets_init', 'custom_topbar_init' );
		add_action( 'widgets_init', 'custom_bottombar1_init' );
		add_action( 'widgets_init', 'custom_bottombar2_init' );
		add_action( 'widgets_init', 'custom_bottombar3_init' );



		// Add it to a column in WP-Admin
		add_filter('manage_posts_columns', 'posts_column_views');
		add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
		// End adding actions of functions.
		
		/**
		* Implement the Custom Header feature.
		*
		* @since Twenty Fifteen 1.0
		*/
		require get_template_directory() . '/inc/custom-header.php';

	   /**
	   * Custom template tags for this theme.
	   *
	   * @since stackdesign .11
	   */
	   require get_template_directory() . '/inc/template-tags.php';

	    /**
		* Customizer additions.
		*
		* @since Twenty Fifteen 1.0
		*/
		require get_template_directory() . '/inc/customizer.php';

			   

				
						



