<?php
/**
 * Template Name: Home 4 columns
 * This template displays a 4 columns grid with image thumbnails from posts in the "portfolio" category on the home page.
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

<div class="four-columns">
	<?php
				// get the correct paged figure on a static page.
				$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;

	$loop = new WP_Query( array(
			'post_type'       => 'post',
			'category_name'   => 'portfolio', // call a specific category (slug), uncomment if you want to show all posts.
			'posts_per_page' 	=> 12, // changes default Blog pages number "reading settings" set in dashboard.
			'paged'           => $paged,
			'orderby' 			  => 'date',
			'order'				    => 'DESC',
		)
	);

			// Start the loop.
	while ( $loop->have_posts() ) : $loop->the_post(); ?>

			   <div class="four-column">
						 <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_html_e( 'Permanent Link to %s', 'storyboard' ),the_title_attribute( 'echo=0' ) ); ?>"></a>
							<?php if ( get_the_post_thumbnail() !== '' ) {

								echo '<a href="';
								the_permalink();
								echo '" class="thumbnail">';
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

		<?php
		global $wp_query;

		$big = 999999999; // need an unlikely integer.
		$translated = __( 'Page', 'storyboard' ); // supply translatable string.

		echo wp_kses_post( paginate_links(
			array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var( 'page', 1 ) ),
			'total' => $loop->max_num_pages,
			'before_page_number' => '<span class="screen-reader-text">' . $translated . ' </span>',
		) ) ); ?>

<?php // clean up after the query and pagination.
wp_reset_postdata();
?>
			</div><!-- .wrap -->
		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
