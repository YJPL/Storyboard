<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package WordPress
 * @subpackage Storyboard
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/infinite-scroll/
 * See: https://jetpack.me/support/responsive-videos/
 */
function storyboard_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support('infinite-scroll', array(
		'container' => 'main',
		'render'    => 'storyboard_infinite_scroll_render',
		'footer'    => 'page',
	));

	// Add theme support for Responsive Videos.
	add_theme_support('jetpack-responsive-videos');
}
add_action('after_setup_theme', 'storyboard_jetpack_setup');

/**
 * Custom render function for Infinite Scroll.
 */
function storyboard_infinite_scroll_render() {
	while (have_posts()) {
		the_post();
		if (is_search()) :
			get_template_part('template-parts/content', 'search');
		else {
			:
			get_template_part('template-parts/content', get_post_format());
		}
		endif;
	}
}
