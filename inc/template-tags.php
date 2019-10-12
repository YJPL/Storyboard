<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Storyboard
 */

/**
 * Add custom header image to header area
 */
function storyboard_header_background() {
	if (get_header_image()) {
		$css = '.site-branding { background-image: url(' . esc_url(get_header_image()) . '); }';
		wp_add_inline_style('storyboard-style', $css);
	}
}
add_action('wp_enqueue_scripts', 'storyboard_header_background', 11);

if ( ! function_exists('storyboard_posted_on')) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 *
	 * @since 1.0.0
	 */
	function storyboard_posted_on() {
		printf(wp_kses('Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'storyboard'),
			esc_url(get_permalink()),
			esc_attr(get_the_time()),
			esc_attr(get_the_date('c')),
			esc_html(get_the_date()),
			esc_url(get_author_posts_url(get_the_author_meta('ID'))),
			esc_attr(sprintf(__('View all posts by %s', 'storyboard'), get_the_author())),
			esc_html(get_the_author())
		);
	}
endif;

if ( ! function_exists('storyboard_entry_footer')) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function storyboard_entry_footer() {
		// Hide category and tag text for pages.
		if ('post' === get_post_type()) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list(esc_html__(', ', 'storyboard'));
			if ($categories_list && storyboard_categorized_blog()) {
				printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'storyboard') . '</span>', $categories_list); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list('', esc_html__(', ', 'storyboard'));
			if ($tags_list) {
				printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'storyboard') . '</span>', $tags_list); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && (comments_open() || get_comments_number())) {
			echo '<span class="comments-link">';
			comments_popup_link(esc_html__('Leave a comment', 'storyboard'), esc_html__('1 Comment', 'storyboard'), esc_html__('% Comments', 'storyboard'));
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__('Edit %s', 'storyboard'),
				the_title('<span class="screen-reader-text">"', '"</span>', false)
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function storyboard_categorized_blog() {
	if (false === ($all_the_cool_cats = get_transient('storyboard_categories'))) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories(array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		));

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count($all_the_cool_cats);

		set_transient('storyboard_categories', $all_the_cool_cats);
	}

	if ($all_the_cool_cats > 1) {
		// This blog has more than 1 category so storyboard_categorized_blog should return true.
		return true;
	}
		// This blog has only 1 category so storyboard_categorized_blog should return false.
		return false;
}

/**
 * Flush out the transients used in storyboard_categorized_blog.
 */
function storyboard_category_transient_flusher() {
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient('storyboard_categories');
}
add_action('edit_category', 'storyboard_category_transient_flusher');
add_action('save_post', 'storyboard_category_transient_flusher');

if ( ! function_exists('storyboard_the_custom_logo')) :
	/**
	 * Displays the optional site logo.
	 *
	 * Returns early if the site logo is not available.
	 *
	 * @since storyboard 1.0
	 */
	function storyboard_the_custom_logo() {
		if (function_exists('the_custom_logo')) {
			the_custom_logo();
		}
	}
endif;
