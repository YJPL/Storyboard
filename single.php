<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Storyboard
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while (have_posts()) : the_post();

			get_template_part('template-parts/content', get_post_format());

			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()) :
				comments_template();
			endif;

			the_post_navigation(array(
				'prev_text' => '<span class="screen-reader-text">' . __('Previous Post', 'storyboard') . '</span><span aria-hidden="true" class="nav-subtitle">' . esc_html_x('&larr;', 'Previous post link', 'storyboard') . '</span> %title</span>',
				'next_text' => '<span class="screen-reader-text">' . __('Next Post', 'storyboard') . '</span> %title <span aria-hidden="true" class="nav-subtitle">' . esc_html_x('&rarr;', 'Next post link', 'storyboard') . '</span> </span>',
			));

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
