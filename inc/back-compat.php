<?php
/**
 * StackDesign back compat functionality
 *
 * Prevents Twenty Fifteen from running on WordPress versions prior to 4.1,
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