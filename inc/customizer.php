<?php
/**
 * Stack Design Customizer functionality
 *
 * @package WordPress
 * @subpackage Stack_Design
 * @since Stack Design 0.9
 */

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Stack Design 0.9
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function stackdesign_customize_register( $wp_customize ) {
	$color_scheme = stackdesign_get_color_scheme();

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname', array(
				'selector'            => '.site-title a',
				'container_inclusive' => false,
				'render_callback'     => 'stackdesign_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription', array(
				'selector'            => '.site-description',
				'container_inclusive' => false,
				'render_callback'     => 'stackdesign_customize_partial_blogdescription',
			)
		);
	}

	// Add color scheme setting and control.
	$wp_customize->add_setting(
		'color_scheme', array(
			'default'           => 'default',
			'sanitize_callback' => 'stackdesign_sanitize_color_scheme',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'color_scheme', array(
			'label'    => __( 'Base Color Scheme', 'stackdesign' ),
			'section'  => 'colors',
			'type'     => 'select',
			'choices'  => stackdesign_get_color_scheme_choices(),
			'priority' => 1,
		)
	);

	// Add custom header and sidebar text color setting and control.
	$wp_customize->add_setting(
		'sidebar_textcolor', array(
			'default'           => $color_scheme[4],
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'sidebar_textcolor', array(
				'label'       => __( 'Header and Sidebar Text Color', 'stackdesign' ),
				'description' => __( 'Applied to the header on small screens and the sidebar on wide screens.', 'stackdesign' ),
				'section'     => 'colors',
			)
		)
	);

	// Remove the core header textcolor control, as it shares the sidebar text color.
	$wp_customize->remove_control( 'header_textcolor' );

	// Add custom header and sidebar background color setting and control.
	$wp_customize->add_setting(
		'header_background_color', array(
			'default'           => $color_scheme[1],
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'header_background_color', array(
				'label'       => __( 'Header and Sidebar Background Color', 'stackdesign' ),
				'description' => __( 'Applied to the header on small screens and the sidebar on wide screens.', 'stackdesign' ),
				'section'     => 'colors',
			)
		)
	);

	// Add an additional description to the header image section.
	$wp_customize->get_section( 'header_image' )->description = __( 'Applied to the header on small screens and the sidebar on wide screens.', 'stackdesign' );
}
add_action( 'customize_register', 'stackdesign_customize_register', 11 );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Stack Design 1.5
 * @see stackdesign_customize_register()
 *
 * @return void
 */
function stackdesign_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Stack Design 1.5
 * @see stackdesign_customize_register()
 *
 * @return void
 */
function stackdesign_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Register color schemes for Stack Design.
 *
 * Can be filtered with {@see 'stackdesign_color_schemes'}.
 *
 * The order of colors in a colors array:
 * 1. Main Background Color.
 * 2. Sidebar Background Color.
 * 3. Box Background Color.
 * 4. Main Text and Link Color.
 * 5. Sidebar Text and Link Color.
 * 6. Meta Box Background Color.
 *
 * @since Stack Design 0.9
 *
 * @return array An associative array of color scheme options.
 */
function stackdesign_get_color_schemes() {
	/**
	 * Filter the color schemes registered for use with Stack Design.
	 *
	 * The default schemes include 'default', 'dark', 'yellow', 'pink', 'purple', and 'blue'.
	 *
	 * @since Stack Design 0.9
	 *
	 * @param array $schemes {
	 *     Associative array of color schemes data.
	 *
	 *     @type array $slug {
	 *         Associative array of information for setting up the color scheme.
	 *
	 *         @type string $label  Color scheme label.
	 *         @type array  $colors HEX codes for default colors prepended with a hash symbol ('#').
	 *                              Colors are defined in the following order: Main background, sidebar
	 *                              background, box background, main text and link, sidebar text and link,
	 *                              meta box background.
	 *     }
	 * }
	 */
	return apply_filters(
		'stackdesign_color_schemes', array(
			'default' => array(
				'label'  => __( 'Default', 'stackdesign' ),
				'colors' => array(
                    '#ffffff',
					'#337ab7',
					'#337ab7',
					'#ffffff',
					'#ffffff',
					'#f9f9f9',
					'#d2d2d2',
					'#ffffff',
					'#f9f9f9',
					'#000000',
					'#337ab7',
					'#337af0',
					'#ffffff',
					'#000000',
					'#000000',
					'#000000',
					'#000000',
				),
			),
			'Lighblue'    => array(
				'label'  => __( 'Light blue', 'stackdesign' ),
				'colors' => array(
					'#ffffff',
					'#5bc0de',
					'#5bc0de',
					'#ffffff',
					'#ffffff',
					'#e7e7e7',
					'#d2d2d2',
					'#ffffff',
					'#e7e7e7',
					'#000000',
					'#337ab7',
					'#337af0',
					'#ffffff',
					'#000000',
					'#000000',
					'#000000',
					'#000000',
				),
			),
			'green'  => array(
				'label'  => __( 'Green', 'stackdesign' ),
				'colors' => array(
					'#ffffff',
					'#5cb85c',
					'#5cb85c',
					'#ffffff',
					'#ffffff',
					'#e7e7e7',
					'#d2d2d2',
					'#ffffff',
					'#e7e7e7',
					'#000000',
					'#337ab7',
					'#337af0',
					'#ffffff',
					'#000000',
					'#000000',
					'#000000',
					'#000000',
				),
			),
			'Oranage'    => array(
				'label'  => __( 'Oranage', 'stackdesign' ),
				'colors' => array(
					'#ffffff',
					'#e67e22',
					'#e67e22',
					'#ffffff',
					'#ffffff',
					'#e7e7e7',
					'#d2d2d2',
					'#ffffff',
					'#e7e7e7',
					'#000000',
					'#337ab7',
					'#337af0',
					'#ffffff',
					'#000000',
					'#000000',
					'#000000',
					'#000000',
				),
			),
			'darkblue'  => array(
				'label'  => __( 'Dark blue', 'stackdesign' ),
				'colors' => array(
					'#ffffff',
					'#34495e',
					'#34495e',
					'#ffffff',
					'#ffffff',
					'#e7e7e7',
					'#d2d2d2',
					'#ffffff',
					'#e7e7e7',
					'#000000',
					'#337ab7',
					'#337af0',
					'#ffffff',
					'#000000',
					'#000000',
					'#000000',
					'#000000',
				),
			),
			'black'    => array(
				'label'  => __( 'Black', 'stackdesign' ),
				'colors' => array(
					'#ffffff',
					'#000000',
					'#000000',
					'#ffffff',
					'#ffffff',
					'#e7e7e7',
					'#d2d2d2',
					'#ffffff',
					'#e7e7e7',
					'#000000',
					'#337ab7',
					'#337af0',
					'#ffffff',
					'#000000',
					'#000000',
					'#000000',
					'#000000',
				),
			),

				'red'    => array(
				'label'  => __( 'Red', 'stackdesign' ),
				'colors' => array(
					'#ffffff',
					'#e74c3c',
					'#e74c3c',
					'#ffffff',
					'#ffffff',
					'#e7e7e7',
					'#d2d2d2',
					'#ffffff',
					'#e7e7e7',
					'#000000',
					'#337ab7',
					'#337af0',
					'#ffffff',
					'#000000',
					'#000000',
					'#000000',
					'#000000',
				),
			),
		)
	);
}

if ( ! function_exists( 'stackdesign_get_color_scheme' ) ) :
	/**
	 * Get the current Stack Design color scheme.
	 *
	 * @since Stack Design 0.9
	 *
	 * @return array An associative array of either the current or default color scheme hex values.
	 */
	function stackdesign_get_color_scheme() {
		$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
		$color_schemes       = stackdesign_get_color_schemes();

		if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
			return $color_schemes[ $color_scheme_option ]['colors'];
		}

		return $color_schemes['default']['colors'];
	}
endif; // stackdesign_get_color_scheme

if ( ! function_exists( 'stackdesign_get_color_scheme_choices' ) ) :
	/**
	 * Returns an array of color scheme choices registered for Stack Design.
	 *
	 * @since Stack Design 0.9
	 *
	 * @return array Array of color schemes.
	 */
	function stackdesign_get_color_scheme_choices() {
		$color_schemes                = stackdesign_get_color_schemes();
		$color_scheme_control_options = array();

		foreach ( $color_schemes as $color_scheme => $value ) {
			$color_scheme_control_options[ $color_scheme ] = $value['label'];
		}

		return $color_scheme_control_options;
	}
endif; // stackdesign_get_color_scheme_choices

if ( ! function_exists( 'stackdesign_sanitize_color_scheme' ) ) :
	/**
	 * Sanitization callback for color schemes.
	 *
	 * @since Stack Design 0.9
	 *
	 * @param string $value Color scheme name value.
	 * @return string Color scheme name.
	 */
	function stackdesign_sanitize_color_scheme( $value ) {
		$color_schemes = stackdesign_get_color_scheme_choices();

		if ( ! array_key_exists( $value, $color_schemes ) ) {
			$value = 'default';
		}

		return $value;
	}
endif; // stackdesign_sanitize_color_scheme

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @since Stack Design 0.9
 *
 * @see wp_add_inline_style()
 */
function stackdesign_color_scheme_css() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );

	// Don't do anything if the default color scheme is selected.
	if ( 'default' === $color_scheme_option ) {
		//return;
	}

	$color_scheme = stackdesign_get_color_scheme();

	// Convert main and sidebar text hex color to rgba.
	$color_textcolor_rgb         = stackdesign_hex2rgb( $color_scheme[3] );
	$color_sidebar_textcolor_rgb = stackdesign_hex2rgb( $color_scheme[4] );
	$colors                      = array(
		'body_background_color'            => $color_scheme[0],
		'header_background_color'     => $color_scheme[1],
		'theme_background_color'        => $color_scheme[2],
		'theme_text_color'                   => $color_scheme[3],
		'sidebar_widget_inner_background_color'=>$color_scheme[4] ,
		'menu_background_color'  => $color_scheme[5],
		'active_menu_background_color' => $color_scheme[6],
		'form_background_color' => $color_scheme[7],
		'footer_background_color' => $color_scheme[8],
		'ordinary_text_color'   => $color_scheme[9],
		'link_text_color'    => $color_scheme[10],
		'hover_link_text_color'=> $color_scheme[11],
		'header_text_color' => $color_scheme[12],
		'sidebar_widget_text_color' => $color_scheme[13],
		'menu_text_color'  => $color_scheme[14],
	    'form_text_color' => $color_scheme[15],
	    'footer_text_color' => $color_scheme[16],

     //                '#00ffff ',
					// '#337ab7',
					// '#337ab7',
					// '#ffffff',
					// '#ffffff',
					// '#e7e7e7',
					// '#d2d2d2',
					// '#ffffff',
					// '#e7e7e7',
					// '#000000',
					// '#337ab7',
					// '#337af0',
					// '#ffffff',
					// '#000000',
					// '#000000',
					// '#000000',
					// '#000000',

	);


   

	$color_scheme_css = stackdesign_get_color_scheme_css( $colors );

	wp_add_inline_style( 'style', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'stackdesign_color_scheme_css' );

/**
 * Binds JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 * @since Stack Design 0.9
 */
function stackdesign_customize_control_js() {
	wp_enqueue_script( 'color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20141216', true );
	wp_localize_script( 'color-scheme-control', 'colorScheme', stackdesign_get_color_schemes() );
}
add_action( 'customize_controls_enqueue_scripts', 'stackdesign_customize_control_js' );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Stack Design 0.9
 */
function stackdesign_customize_preview_js() {
	wp_enqueue_script( 'stackdesign-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20141216', true );
}
add_action( 'customize_preview_init', 'stackdesign_customize_preview_js' );

/**
 * Returns CSS for the color schemes.
 *
 * @since Stack Design 0.9
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function stackdesign_get_color_scheme_css( $colors ) {
	$colors = wp_parse_args(
		$colors, array(
		'body_background_color' => '',
		'header_background_color' => '',
		'theme_background_color'  => '',
		'theme_text_color' =>'',
		'sidebar_widget_inner_background_color' => '',
		'menu_background_color'  => '',
		'active_menu_background_color' => '',
		'form_background_color' =>'',
		'footer_background_color'   => '',
		'ordinary_text_color' => '',
		'link_text_color' => '',
		'hover_link_text_color' => '',
		'header_text_color' => '',
		'sidebar_widget_text_color' => '',
		'menu_text_color'=> '',
	    'form_background_color' =>'',
	    'footer_text_color' => '',


		)
	);

	$css = <<<CSS
	/* Color Scheme */

	/* Background Color */
	body {
		background-color:{$colors['body_background_color']};
		color:{$colors['ordinary_text_color']};
	}

	.blog-title,.blog-description,.blog-post-meta {
    color:{$colors['header_text_color']};
    }

   .blog-masthead {
	background-color:{$colors['header_background_color']};
	border-color:{$colors['header_background_color']};
   }

   .blog-footer {
   	background-color:{$colors['footer_background_color']};
   }
  .widget-title,.fn,.corner-ribbon {
	background-color:{$colors['theme_background_color']};
	color:{$colors['theme_text_color']};
   }	
   #s,#cntctfrm_contact_name, #cntctfrm_contact_email, #cntctfrm_contact_subject,#cntctfrm_contact_message ,.input, .input-email, .input-text,.field-select,blockquote,.comment-body,#author, #email, #url, .cptch_input,#comment {
  	background-color:{$colors['form_background_color']};
  	 color:{$colors['form_text_color']};
   }
   #searchsubmit,.cntctfrm_contact_submit,.button,.submit,.more-link{
  	  		background-color:{$colors['theme_background_color']};
  	  		border-color:{$colors['theme_background_color']};
  	  		color:{$colors['theme_text_color']};
  }

 .widget_recent_entries li,.widget_categories li,.widget_polylang li,.widget_recent_comments li,.widget_archive li {
  		background-color:{$colors['sidebar_widget_inner_background_color']};
  		color:{$colors['sidebar_widget_text_color']};
  }
  .sidebar-module-inset{
  	background-color:{$colors['sidebar_widget_inner_background_color']};
}

.navbar-default{
	background-color:{$colors['menu_background_color']};
	color:{$colors['menu_text_color']};
	border-color:{$colors['menu_background_color']};
}
.current_page_item,.navbar-default .navbar-nav .active a
 {
	background-color:{$colors['active_menu_background_color']};

}
.current_page_item:hover,.navbar-default .navbar-nav .active a:hover{
	background-color:{$colors['theme_background_color']};
	color:{$colors['theme_text_color']};
}
a{
	color:{$colors['link_text_color']};
}
a:hover{
	color:{$colors['hover_link_text_color']};
}

CSS;

	return $css;
}

/**
 * Output an Underscore template for generating CSS for the color scheme.
 *
 * The template generates the css dynamically for instant display in the Customizer
 * preview.
 *
 * @since Stack Design 0.9
 */
function stackdesign_color_scheme_css_template() {
	$colors = array(
		
		'body_background_color' => '{{ data.body_background_color}}',
		'header_background_color' => '{{ data.header_background_color}}',
		'theme_background_color'  => '{{ data.theme_background_color}}',
		'theme_text_color' =>'{{ data.theme_text_color}}',
		'sidebar_widget_inner_background_color' => '{{ data.sidebar_widget_inner_background_color}}',
		'menu_background_color'  => '{{ data.menu_background_color}}',
		'active_menu_background_color' => '{{ data.active_menu_background_color}}',
		'form_background_color' => '{{ data.form_background_color}}',
		'footer_background_color'   => '{{ data.footer_background_color}}',
		'ordinary_text_color' => '{{ data.ordinary_text_color}}',
		'link_text_color' => '{{ data.link_text_color}}',
		'hover_link_text_color' => '{{ data.hover_link_text_color}}',
		'header_text_color' => '{{ data.header_text_color}}',
		'sidebar_widget_text_color' => '{{ data.sidebar_widget_text_color}}',
		'menu_text_color'=> '{{ data.menu_text_color}}',
		'form_text_color' => '{{ data.form_text_color}}',
		'footer_text_color' => '{{ data.footer_text_color}}',

	);
	?>
	<script type="text/html" id="tmpl-stackdesign-color-scheme">
		<?php echo stackdesign_get_color_scheme_css( $colors ); ?>
	</script>
	<?php
}
add_action( 'customize_controls_print_footer_scripts', 'stackdesign_color_scheme_css_template' );
