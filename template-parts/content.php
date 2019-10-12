<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Storyboard
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-wrap wrap clear">

			<?php if ( '' != get_the_post_thumbnail( 'featured' ) ) : ?>
				<?php if ( ! is_single() ) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'storyboard' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="<?php the_ID(); ?>" class="storyboard-featured-thumbnail">
				<?php the_post_thumbnail( 'featured' ); ?>
			</a>
				<?php else : ?>
					<?php the_post_thumbnail( 'featured' ); ?>
					<?php endif; ?>
					<?php endif; ?>

	<header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php storyboard_posted_on(); ?>
			<div class="reading-time"><?php printf(__('Average Reading Time: %s.', 'storyboard'), get_reading_time($post)); ?></div>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>

	</header><!-- .entry-header -->

	<?php if ( is_search() || is_home() || is_category() || is_tag()) : // Display Excerpts for Search and blog posts ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php else : ?>

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'storyboard' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'storyboard' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-footer">
			<?php storyboard_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .entry-wrap -->
</article><!-- #post-## -->
