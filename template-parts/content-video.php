<?php
/**
 * @package storyboard
 */


?>

<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>
	<div class="entry-wrap wrap clear">


	<?php // remove the post thumbnail so the post displays the video in full frame, while the featured image gets used by the portfolio template
	// if ('' != get_the_post_thumbnail() ) :
	// the_post_thumbnail('storyboard-featured-thumbnail');
	// endif;
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
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content(sprintf(
				/* translators: %s: Name of current post. */
				wp_kses(__('Continue reading %s <span class="meta-nav">&rarr;</span>', 'storyboard'), array('span' => array('class' => array()))),
				the_title('<span class="screen-reader-text">"', '"</span>', false)
			));
		?>
	</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php storyboard_entry_footer(); ?>
		</footer><!-- .entry-footer -->

	<?php // use the excerpt to add credit text on video posts ?>
	<?php if (has_excerpt()) : ?>
		<div class="entry-summary">
	<?php do_action('storyboard_formatted_posts_excerpt_before'); ?>
	<?php the_excerpt(); ?>
	<?php do_action('storyboard_formatted_posts_excerpt_after'); ?>
		</div><!-- .entry-caption -->
	<?php endif; ?>

	</div><!-- .entry-wrap -->
</article><!-- #post-## -->
