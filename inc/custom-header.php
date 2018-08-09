<?php
/**
 * Custom Header functionality for Stack Design
 *
 * @package WordPress
 * @subpackage Stack_Design
 * @since Stack Design 0.9
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses stackdesign_header_style()
 */
function stackdesign_custom_header_setup() {
	$color_scheme       = stackdesign_get_color_scheme();
	$default_text_color = trim( $color_scheme[4], '#' );

	/**
	 * Filter Stack Design custom-header support arguments.
	 *
	 * @since Stack Design 0.9
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default_text_color     Default color of the header text.
	 *     @type int    $width                  Width in pixels of the custom header image. Default 954.
	 *     @type int    $height                 Height in pixels of the custom header image. Default 1300.
	 *     @type string $wp-head-callback       Callback function used to styles the header image and text
	 *                                          displayed on the blog.
	 * }
	 */
	add_theme_support(
		'custom-header', apply_filters(
			'stackdesign_custom_header_args', array(
				'default-text-color' => $default_text_color,
				'width'              => 954,
				'height'             => 1300,
				'wp-head-callback'   => 'stackdesign_header_style',
			)
		)
	);
}
add_action( 'after_setup_theme', 'stackdesign_custom_header_setup' );

/**
 * Convert HEX to RGB.
 *
 * @since Stack Design 0.9
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function stackdesign_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) == 3 ) {
		$r = hexdec( substr( $color, 0, 1 ) . substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ) . substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ) . substr( $color, 2, 1 ) );
	} elseif ( strlen( $color ) == 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array(
		'red'   => $r,
		'green' => $g,
		'blue'  => $b,
	);
}

if ( ! function_exists( 'stackdesign_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @since Stack Design 0.9
	 *
	 * @see stackdesign_custom_header_setup()
	 */
	function stackdesign_header_style() {
		$header_image = get_header_image();

		// If no custom options for text are set, let's bail.
		if ( empty( $header_image ) && display_header_text() ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css" id="stackdesign-header-css">
		<?php
		// Short header for when there is no Custom Header and Header Text is hidden.
		if ( empty( $header_image ) && ! display_header_text() ) :
	?>
		.site-header {
			padding-top: 14px;
			padding-bottom: 14px;
		}

		.site-branding {
			min-height: 42px;
		}

		@media screen and (min-width: 46.25em) {
			.site-header {
				padding-top: 21px;
				padding-bottom: 21px;
			}
			.site-branding {
				min-height: 56px;
			}
		}
		@media screen and (min-width: 55em) {
			.site-header {
				padding-top: 25px;
				padding-bottom: 25px;
			}
			.site-branding {
				min-height: 62px;
			}
		}
		@media screen and (min-width: 59.6875em) {
			.site-header {
				padding-top: 0;
				padding-bottom: 0;
			}
			.site-branding {
				min-height: 0;
			}
		}
	<?php
		endif;

		// Has a Custom Header been added?
		if ( ! empty( $header_image ) ) :
	?>
		.site-header {

			/*
			 * No shorthand so the Customizer can override individual properties.
			 * @see https://core.trac.wordpress.org/ticket/31460
			 */
			background-image: url(<?php header_image(); ?>);
			background-repeat: no-repeat;
			background-position: 50% 50%;
			-webkit-background-size: cover;
			-moz-background-size:    cover;
			-o-background-size:      cover;
			background-size:         cover;
		}

		@media screen and (min-width: 59.6875em) {
			body:before {

				/*
				 * No shorthand so the Customizer can override individual properties.
				 * @see https://core.trac.wordpress.org/ticket/31460
				 */
				background-image: url(<?php header_image(); ?>);
				background-repeat: no-repeat;
				background-position: 100% 50%;
				-webkit-background-size: cover;
				-moz-background-size:    cover;
				-o-background-size:      cover;
				background-size:         cover;
				border-right: 0;
			}

			.site-header {
				background: transparent;
			}
		}
	<?php
		endif;

		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
	<?php endif; ?>
	</style>
	<?php
	}
endif; // stackdesign_header_style

/**
 * Enqueues front-end CSS for the header background color.
 *
 * @since Stack Design 0.9
 *
 * @see wp_add_inline_style()
 */
function stackdesign_header_background_color_css() {
	$color_scheme            = stackdesign_get_color_scheme();
	$default_color           = $color_scheme[1];
	$header_background_color = get_theme_mod( 'header_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $header_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Header Background Color */
		body:before,
		.site-header {
			background-color: %1$s;
		}

		@media screen and (min-width: 59.6875em) {
			.site-header,
			.secondary {
				background-color: transparent;
			}

			.widget button,
			.widget input[type="button"],
			.widget input[type="reset"],
			.widget input[type="submit"],
			.widget_calendar tbody a,
			.widget_calendar tbody a:hover,
			.widget_calendar tbody a:focus {
				color: %1$s;
			}
		}
	';

	wp_add_inline_style( 'stackdesign-style', sprintf( $css, $header_background_color ) );
}
add_action( 'wp_enqueue_scripts', 'stackdesign_header_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the sidebar text color.
 *
 * @since Stack Design 0.9
 */
function stackdesign_sidebar_text_color_css() {
	$color_scheme       = stackdesign_get_color_scheme();
	$default_color      = $color_scheme[4];
	$sidebar_link_color = get_theme_mod( 'sidebar_textcolor', $default_color );

	// Don't do anything if the current color is the default.
	if ( $sidebar_link_color === $default_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	$sidebar_link_color_rgb     = stackdesign_hex2rgb( $sidebar_link_color );
	$sidebar_text_color         = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.7)', $sidebar_link_color_rgb );
	$sidebar_border_color       = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.1)', $sidebar_link_color_rgb );
	$sidebar_border_focus_color = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.3)', $sidebar_link_color_rgb );

	$css = '
		
	';

   wp_add_inline_style( 'style', sprintf( $css, $sidebar_link_color, $sidebar_text_color, $sidebar_border_color, $sidebar_border_focus_color ) );
	
		               
		 wp_add_inline_style( 'ekto', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'stackdesign_sidebar_text_color_css', 11 );
