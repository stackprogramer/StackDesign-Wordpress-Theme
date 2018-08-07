<?php
/**
 * StackDesign back compat functionality
 *
 * Prevents Stack Designfrom running on WordPress versions prior to 4.1,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.1.
 *
 * @package stackdesign
 */

/**
 * Prevent switching to StackDesign on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @package stackdesign
 */
 
function stackdesign_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'stackdesign_upgrade_notice' );
}
add_action( 'after_switch_theme', 'stackdesign_switch_theme' );

/**
 * Add message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Stack Designon WordPress versions prior to 4.1.
 *
 * @since Stack Design .11
 */
function stackdesign_upgrade_notice() {
	$message = sprintf( __( 'Stack Designrequires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'stackdesign' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevent the Customizer from being loaded on WordPress versions prior to 4.1.
 *
 * @since Stack Design .11
 */
function stackdesign_customize() {
	wp_die(
		sprintf( __( 'Stack Design requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'stackdesign' ), $GLOBALS['wp_version'] ), '', array(
			'back_link' => true,
		)
	);
}
add_action( 'load-customize.php', 'stackdesign_customize' );

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 4.1.
 *
 * @since Stack Design .11
 */
function stackdesign_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Stack Design requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'stackdesign' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'stackdesign_preview' );
