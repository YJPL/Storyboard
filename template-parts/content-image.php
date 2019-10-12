<?php
/**
 * Template part for displaying the image post format
 *
 * @package WordPress
 * @subpackage Storyboard
 */

// Access global variable directly to set content_width.
if (isset($GLOBALS['content_width'])) {
	$GLOBALS['content_width'] = 1272;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-wrap wrap clear">

		    <?php // remove the post thumbnail so the post displays the video in full frame, while the featured image gets used by the portfolio template
			// if ('' != get_the_post_thumbnail() ) :
			// the_post_thumbnail('storyboard-featured-thumbnail');
			// endif; Need testing.
	?>
		<header class="entry-header">
		<?php
		if (is_single()) {
			the_title('<h1 class="entry-title">', '</h1>');
		} else {
			the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
		}

		if ('post' === get_post_type()) : ?>
		<div class="entry-meta">
			<?php storyboard_posted_on(); ?>
			<div class="reading-time"><?php printf(__('Average Reading Time: %s.', 'storyboard'), get_reading_time($post)); ?></div>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>

	</header><!-- .entry-header -->

<?php if (is_home()) : // Display Excerpts on blog posts. ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else {
	: ?>

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

		<?php
			the_content(sprintf(
				/* translators: %s: Name of current post. */
				wp_kses(__('Continue reading %s <span class="meta-nav">&rarr;</span>', 'storyboard'), array('span' => array('class' => array()))),
				the_title('<span class="screen-reader-text">"', '"</span>', false)
			));

			wp_link_pages(array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'storyboard'),
				'after'  => '</div>',
			));
		?>
	</div><!-- .entry-content -->
		<?php endif; ?>

		<?php if (has_excerpt()) : ?>
		<div class="entry-summary">
			<?php do_action('storyboard_formatted_posts_excerpt_before'); ?>
			<?php the_excerpt(); ?>
			<?php do_action('storyboard_formatted_posts_excerpt_after'); ?>
		</div><!-- .entry-caption -->
		<?php endif; ?>

		<footer class="entry-footer">
			<?php storyboard_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .entry-wrap -->
</article><!-- #post-## -->
