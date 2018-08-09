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

           /**
		   * Sets up theme defaults and registers support for various WordPress features.
		   * we here define stackdesign_setup function to initialize theme.
		   */
		      
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

              // This theme uses wp_nav_menu() For two language.

			  register_nav_menus( array(
				'primary' => __( 'Persian Menu', 'stackdesign' ),
				'social'  => __( 'English Menu', 'stackdesign' ),
			  ) );
               
             /*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			 add_theme_support(
				'html5', array(
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
				)
			 );

			 /*
			 * Enable support for Post Formats.
			 *
			 * See: https://codex.wordpress.org/Post_Formats
			 */
			 add_theme_support(
				'post-formats', array(
					'aside',
					'image',
					'video',
					'quote',
					'link',
					'gallery',
					'status',
					'audio',
					'chat',
				)
			 );

			 /*
			  * Enable support for custom logo.
			  *
			  * @since Stack Design .1
			  */
			  add_theme_support(
				'custom-logo', array(
				'height'      => 100,
				'width'       => 100,
				'flex-height' => true,
				'flex-width'  => true,
				'header-text' => array( 'site-title', 'site-description' ),
			  )
			  );


			  // Setup the WordPress core custom background feature.
			  $color_scheme  = stackdesign_get_color_scheme();
			  $default_color = trim( $color_scheme[0], '#' );

			 /**
			 * Filter Stack Design  custom-header support arguments.
			 *
			 * @since Stack Design 0.9
			 *
			 * @param array $args {
			 *     An array of custom-header support arguments.
			 *
			 *     @type string $default-color          Default color of the header.
			 *     @type string $default-attachment     Default attachment of the header.
			 * }
			 */
		    	add_theme_support(
				'custom-background', apply_filters(
					'stackdesign_custom_background_args', array(
						'default-color'      => $default_color,
						'default-attachment' => 'fixed',
					)
				)
			 );

			 /*
			 * This theme styles the visual editor to resemble the theme style,
			 * specifically font, colors, icons, and column width.
			 */
			add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', stackdesign_fonts_url() ) );

			// Indicate widget sidebars can use selective refresh in the Customizer.
			add_theme_support( 'customize-selective-refresh-widgets' );





	        }
		endif;// stackdesign_setup
		add_action( 'after_setup_theme', 'stackdesign_setup' );

		 /**
		 * Register widget areas.
		 *
		 * @since Stack Design 0.1
		 *
		 */
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

		add_action( 'widgets_init', 'custom_sidebar_init' );
		add_action( 'widgets_init', 'custom_topbar_init' );
		add_action( 'widgets_init', 'custom_bottombar1_init' );
		add_action( 'widgets_init', 'custom_bottombar2_init' );
		add_action( 'widgets_init', 'custom_bottombar3_init' );



	if ( ! function_exists( 'stackdesign_fonts_url' ) ) :
	/**
	 * Register Google fonts for Stack Design.
	 *
	 * @since Stack Design 0.9
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function stackdesign_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/*
		 * Translators: If there are characters in your language that are not supported
		 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'stackdesign' ) ) {
			$fonts[] = 'Noto Sans:400italic,700italic,400,700';
		}

		/*
		 * Translators: If there are characters in your language that are not supported
		 * by Noto Serif, translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'stackdesign' ) ) {
			$fonts[] = 'Noto Serif:400italic,700italic,400,700';
		}

		/*
		 * Translators: If there are characters in your language that are not supported
		 * by Inconsolata, translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'stackdesign' ) ) {
			$fonts[] = 'Inconsolata:400,700';
		}

		/*
		 * Translators: To add an additional character subset specific to your language,
		 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
		 */
		$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'stackdesign' );

		if ( 'cyrillic' == $subset ) {
			$subsets .= ',cyrillic,cyrillic-ext';
		} elseif ( 'greek' == $subset ) {
			$subsets .= ',greek,greek-ext';
		} elseif ( 'devanagari' == $subset ) {
			$subsets .= ',devanagari';
		} elseif ( 'vietnamese' == $subset ) {
			$subsets .= ',vietnamese';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg(
				array(
					'family' => urlencode( implode( '|', $fonts ) ),
					'subset' => urlencode( $subsets ),
				), 'https://fonts.googleapis.com/css'
			);
		}

		return $fonts_url;
	}
	endif;

		/**
		 * JavaScript Detection.
		 *
		 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
		 *
		 * @since Twenty Fifteen 1.1
		 */
		function stackdesign_javascript_detection() {
			echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
		}
		add_action( 'wp_head', 'stackdesign_javascript_detection', 0 );


		/**
		 * Enqueue scripts and styles.
		 *
		 * @since Stack Design 0.9
		 */
		function stackdesign_scripts() {

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
			  wp_register_style( 'bloglist', get_template_directory_uri() . '/css/bloglist.css' );
              wp_register_style( 'comment', get_template_directory_uri() . '/css/comment.css' );
              wp_register_style( 'ribboncorner', get_template_directory_uri() . '/css/ribboncorner.css' );
              wp_register_style( 'style', get_template_directory_uri() . '/style.css' );



			  wp_enqueue_style( 'bloglist' );
			  wp_enqueue_style( 'comment' );
              wp_enqueue_style( 'ribboncorner');
              wp_enqueue_style( 'style' );

			  wp_register_script('jquery.bootstrap.min', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery');
			  wp_register_script('jquery.min', get_template_directory_uri() . '/js/jquery.min.js', 'jquery');
			  wp_enqueue_script('jquery.bootstrap.min');
			  wp_enqueue_script('jquery.min');


	    }

    add_action( 'wp_enqueue_scripts', 'stackdesign_scripts' );


		 /**
		 * Add preconnect for Google Fonts.
		 *
		 * @since Stack Design 1.7
		 *
		 * @param array   $urls          URLs to print for resource hints.
		 * @param string  $relation_type The relation type the URLs are printed.
		 * @return array URLs to print for resource hints.
		 */
		function stackdesign_resource_hints( $urls, $relation_type ) {
			if ( wp_style_is( 'stackdesign-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
				if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '>=' ) ) {
					$urls[] = array(
						'href' => 'https://fonts.gstatic.com',
						'crossorigin',
					);
				} else {
					$urls[] = 'https://fonts.gstatic.com';
				}
			}

			return $urls;
		}
		add_filter( 'wp_resource_hints', 'stackdesign_resource_hints', 10, 2 );





		/**
		 * Add featured image as background image to post navigation elements.
		 *
		 * @since Stack Design 0.9
		 *
		 * @see wp_add_inline_style()
		 */
		function stackdesign_post_nav_background() {
			if ( ! is_single() ) {
				return;
			}

			$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
			$next     = get_adjacent_post( false, '', false );
			$css      = '';

			if ( is_attachment() && 'attachment' == $previous->post_type ) {
				return;
			}

			if ( $previous && has_post_thumbnail( $previous->ID ) ) {
				$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
				$css      .= '
					.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
					.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
					.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
				';
			}

			if ( $next && has_post_thumbnail( $next->ID ) ) {
				$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
				$css      .= '
					.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); border-top: 0; }
					.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
					.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
				';
			}

			wp_add_inline_style( 'stackdesign-style', $css );
		}
		add_action( 'wp_enqueue_scripts', 'stackdesign_post_nav_background' );


    if ( ! function_exists( 'stackdesign_themes_pagination' ) ) :

		//Pagination function implentation
		function stackdesign_themes_pagination(){
			global $wp_query; 
			echo paginate_links();
		}

	endif;

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
		
	   
        //  add_action( 'wp_enqueue_scripts', 'wpt_register_css' );
		add_filter('get_avatar','stackdesign_gravatar_alt');
		add_theme_support( 'post-thumbnails' );
		


		// Add it to a column in WP-Admin
		add_filter('manage_posts_columns', 'posts_column_views');
		add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
		// End adding actions of functions.


	   /**
	   * Adding nawwalker menu to theme.
	   *
	   * @since stackdesign .11
	   */
        require_once('inc/wp_bootstrap_navwalker.php');
		
		/**
		* Implement the Custom Header feature.
		*
		* @since Stack Design .11
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
		* @since Stack Design .11
		*/
		require get_template_directory() . '/inc/customizer.php';

			   

				
						



