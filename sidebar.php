<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Storyboard
 */

if ( ! is_active_sidebar( 'sidebar' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area" role="complementary">

	<div class="widget-wrap">

		<div class="main-sidebar">

	<?php dynamic_sidebar( 'sidebar' ); ?>

		</div>
	</div><!-- .widget-wrap -->
</div><!-- #secondary -->
