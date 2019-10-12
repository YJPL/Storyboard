<?php
/**
 * The template for displaying image attachments
 *
 * @package Storyboard
 */

get_header();
$content_width = 1272;
?>
	<div id="primary" class="content-area image-attachment">
		<div id="content" class="site-content" role="main">

			<?php
				// Start the loop.
			while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-wrap wrap clear">
					<div class="entry-content">

						<div class="entry-attachment">

<?php
						/**
						 * Filter the default storyboard image attachment size.
						 *
						 * @since Storyboard 1.0
						 *
						 * @param string $image_size Image size. Default 'full'.
						 */
						$image_size = apply_filters('storyboard_attachment_size', 'full');

						echo wp_get_attachment_image(get_the_ID(), $image_size);

						?>

						</div><!-- .entry-attachment -->

					<?php // image navigation. ?>
<nav role="navigation" id="image-navigation" class="image-navigation">

				<div class="previous"><?php previous_image_link(false, __('<span class="text-nav">&larr; Previous image</span>', 'storyboard')); ?></div>
				<div class="next"><?php next_image_link(false, __('<span class="text-nav">Next image &rarr;</span>', 'storyboard')); ?></div>

				<nav class="post-parent-title"><?php printf('<a href="%s" class="post-parent-title">%s</a>', esc_url(get_permalink($post->post_parent)), esc_html(get_the_title($post->post_parent))); ?></nav>
</nav><!-- #image-navigation -->

		<?php if (has_excerpt()) : ?>
		<div class="entry-summary">
			<?php do_action('storyboard_formatted_posts_excerpt_before'); ?>
			<?php the_excerpt(); ?>
			<?php do_action('storyboard_formatted_posts_excerpt_after'); ?>
		</div><!-- .entry-caption -->
		<?php endif; ?>

					</div><!-- .entry-content -->
				</div><!-- .entry-wrap -->
			</article><!-- #post-## -->

			<?php
			/**
			 * If comments are open or we have at least one comment, load up the comment template.
			 * Disabled by default on single images.
			 */
			// if ( comments_open() || '0' != get_comments_number() )
			// comments_template();
			// End the loop.
		endwhile;
		?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
