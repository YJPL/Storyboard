<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Storyboard
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php if ( is_single() ) {
	single_post_title( '', true );
} else {
	bloginfo( 'name' );
	echo ' - ';
	bloginfo( 'description' );
}
	?>" />
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

<header id="masthead" class="site-header" role="banner">
	<div class="wrap">
		<div class="site-branding">
			<?php // get_template_part( '/assets/inline', 'logo.svg' ); // uncomment to replace with your own custom svg logo, see sample. ?>
			<?php storyboard_the_custom_logo(); ?>

			<?php if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>

			<?php if ( has_nav_menu( 'primary' ) ) : ?>
		<nav id="site-navigation" class="main-navigation clear" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Navigation', 'storyboard' ); ?></button>
			<div><a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'storyboard' ); ?></a></div>

			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
		<?php endif; ?>

		</div><!-- .site-branding -->

	</div><!-- .entry-wrap -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">
