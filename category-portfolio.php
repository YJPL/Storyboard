<?php
/**
 * Template Name: Category portfolio 3 columns
 * The template for displaying portfolio archive pages. *Edit — Use as reference for SilentComics also*
 * TO DO: Fix pagination
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Storyboard
 */

	get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="wrap">
	<?php
	// Check if there are any posts to display.
	if ( have_posts() ) : ?>

						  <header class="archive-header">
			  <h4 class="taxonomy-description">
				<?php
				// Show an optional term description.
				$term_description = term_description();
				if ( ! empty( $term_description ) ) :
					echo '<div class="taxonomy-description">';
					echo term_description();
					echo '</div>';
			  endif;
				?>
			  </h4>

			<?php endif; ?>
	</header><!-- .page-header -->

	<div class="three-columns">
		<?php
				 // get the correct paged figure on a static page. You no longer need this line tho.
				 $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;

		$loop = new WP_Query( array(
			'post_type'       => 'post',
			'paged'           => $paged,
			'orderby' 			  => 'title',
			'order'				    => 'DESC',
			)
		);

			// Start the loop.
		while ( have_posts() ) : the_post(); ?>

							   <div class="three-column">
									   <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_html_e( 'Permanent Link to %s', 'storyboard' ),the_title_attribute( 'echo=0' ) ); ?>"></a>
										<?php if ( get_the_post_thumbnail() !== '' ) {

											echo '<a href="';
											the_permalink();
											echo '" class="thumbnail-wrapper">';
											the_post_thumbnail( 'post-thumb' );

											echo '</a>';

} else {
	echo '<a href="';
	the_permalink();
	echo '" class="story-thumb">';
	echo '<img src="';
	echo esc_html( get_first_image( 'post-thumb' ) );
	echo '" alt="" />';
	echo '</a>';
} ?>

		<h2 class="story-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_html_e( 'Permanent Link to %s', 'storyboard' ),the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>

		</div><!-- .column -->
		<?php endwhile; ?>
			<?php
			wp_reset_postdata();
			?>
		</div><!-- .columns -->

		<div class="wrap">
			<?php the_posts_pagination( array(
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'storyboard' ) . ' </span>',
				'prev_text' => __( 'Previous page', 'storyboard' ), // In case you want to change the previous link text.
				'next_text' => __( 'Next page', 'storyboard' ), // In case you want to change the next link text.
				'type' => 'title', // How you want the return value to be formatted.
				'add_fragment' => '#result', // Your anchor.
			) ); ?>
</div>

	<?php // clean up after the query and pagination.
	wp_reset_postdata();
	?>
	<br>
		<h3 class="entry-content">
			<?php  printf( esc_html__( 'Watch all stories by:', 'storyboard' ) ); ?>
			<span class="title"><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>

		</h3><!-- .entry content (change this class to style it better)-->
	<br>

			</div><!-- .wrap -->
		</div><!-- #content -->
	</section><!-- #primary -->

	<?php get_sidebar(); ?>
	<?php get_footer(); ?>
