<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Saifa
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
add_action( 'after_setup_theme', 'saifa_jetpack_setup' );

function saifa_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
