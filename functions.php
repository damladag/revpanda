<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

if ( ! class_exists( \RVP\Main::class ) && is_readable( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

if ( class_exists( \RVP\Main::class ) ) {
	new \RVP\Main();
}

if ( ! function_exists( 'rvpGetIcon' ) ) {
	function rvpGetIcon( $icon ) {
		include get_template_directory() . '/build/images/' . $icon;
	}
}

if ( ! function_exists( 'rvpGetIconUrl' ) ) {
	function rvpGetIconUrl( $icon ) {
		return get_template_directory_uri() . '/build/images/' . $icon;
	}
}
