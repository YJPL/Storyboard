<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Storyboard
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function storyboard_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'storyboard_body_classes' );

/**
 * Disable emojis introduced in WordPress 4.2.
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
} add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param array $plugins disable_emojis_tinymce.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} return array();
}
	/**
	 * Remove emoji CDN hostname from DNS prefetching hints.
	 *
	 * @param array  $urls URLs to print for resource hints.
	 * @param string $relation_type The relation type the URLs are printed for.
	 * @return array Difference betwen the two arrays.
	 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' !== $relation_type ) { /** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
		$urls = array_diff( $urls, array( $emoji_svg_url ) );
	}
	return $urls; }

	//Adding the Open Graph in the Language Attributes
	function add_opengraph_doctype( $output ) {
	        return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
	    }
	add_filter('language_attributes', 'add_opengraph_doctype');

	//Lets add Open Graph Meta Info

	function insert_fb_in_head() {
	    global $post;
	    if ( !is_singular()) //if it is not a post or a page
	        return;
	        echo '<meta property="fb:admins" content="172189793548569"/>';
	        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
	        echo '<meta property="og:type" content="article"/>';
	        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
	        echo '<meta property="og:site_name" content="Film Storyboards"/>';
	    if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
	        $default_image="https://film-storyboards.com/wp-content/uploads/2017/07/dancing-feet-storyboard_063.jpg"; //replace this with a default image on your server or an image in your media library
	        echo '<meta property="og:image" content="' . $default_image . '"/>';
	    }
	    else{
	        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
	        echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	    }
	    echo "
	";
	}
	add_action( 'wp_head', 'insert_fb_in_head', 5 );
