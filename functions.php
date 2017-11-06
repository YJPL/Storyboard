<?php
/**
 * Storyboard functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Storyboard
 */

if ( ! function_exists( 'storyboard_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function storyboard_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Storyboard, use a find and replace
		 * to change 'storyboard' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'storyboard', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for site logo.
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 78,
			'width'       => 156,
			'flex-height' => true,
			'flex-width'  => true,
		) );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size();
		add_image_size( 'post-thumb', 600, 371, true ); // cropped.
		add_image_size( 'featured', 1272, 312, true ); // cropped.

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'storyboard' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'storyboard_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
	}

	/**
	* Clean wp_head.
	*
	* @link: http://strip.org/clean-up-and-optimize-wordpress-for-your-next-theme
	*/
			remove_action( 'wp_head', 'wp_generator' );
			remove_action( 'wp_head', 'wlwmanifest_link' );
			remove_action( 'wp_head', 'rsd_link' );
			remove_action( 'wp_head', 'wp_shortlink_wp_head' );

			remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );

			add_filter( 'the_generator', '__return_false' );

			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
			remove_action( 'wp_print_styles', 'print_emoji_styles' );

	/**
* This theme styles the visual editor to resemble the theme style,
* specifically font, colors, icons, and column width.
*/
	add_editor_style( array( '/assets/css/editor-style.css', '/assets/fonts/inconsolata.css' ) );
	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );

endif; // storyboard_setup.
add_action( 'after_setup_theme', 'storyboard_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
// function storyboard_content_width() {
// $GLOBALS['content_width'] = apply_filters( 'storyboard_content_width', 1272 );
// }
// add_action( 'after_setup_theme', 'storyboard_content_width', 0 );
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function storyboard_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'storyboard' ),
		'id'            => 'sidebar',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	// First footer widget area, located in the footer. Empty by default.
	register_sidebar( array(
		'name' 		     	=> __( 'First Footer Widget', 'storyboard' ),
		'id' 			      => 'first-footer-widget',
		'description'   => __( 'The first footer widget', 'storyboard' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Second Footer Widget Area, located in the footer. Empty by default.
	register_sidebar( array(
		'name' 		    	=> __( 'Second Footer Widget', 'storyboard' ),
		'id' 			      => 'second-footer-widget',
		'description'   => __( 'The second footer widget', 'storyboard' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Third Footer Widget Area, located in the footer. Empty by default.
	register_sidebar( array(
		'name' 		    	=> __( 'Third Footer Widget', 'storyboard' ),
		'id' 			      => 'third-footer-widget',
		'description' 	=> __( 'The third footer widget', 'storyboard' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Fourth Footer Widget Area, located in the footer. Empty by default.
	register_sidebar( array(
		'name' 		     	=> __( 'Fourth Footer Widget', 'storyboard' ),
		'id' 			      => 'fourth-footer-widget',
		'description' 	=> __( 'The fourth footer widget', 'storyboard' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'storyboard_widgets_init' );

/**
 * Enqueues scripts and styles.
 *
 * @since Storyboard 1.0
 */
function storyboard_scripts() {
	// custom font served from assets/fonts.
	wp_enqueue_style( 'inconsolata', get_template_directory_uri() . '/assets/fonts/inconsolata.css', array(), null );
	wp_enqueue_style( 'storyboard-style', get_stylesheet_uri() );

		// Load the html5 shiv.
	wp_enqueue_script( 'storyboard-html5', get_template_directory_uri() . '/assets/js/min/html5.min.js', array(), '3.7.3' );
	wp_script_add_data( 'storyboard-html5', 'conditional', 'lt IE 9' );

	if ( has_nav_menu( 'primary' ) ) {
		wp_enqueue_script( 'storyboard-navigation', get_template_directory_uri() . '/assets/js/min/navigation-min.js', array(), '20160412', true );
	}

	wp_enqueue_script( 'storyboard-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/min/skip-link-focus-fix-min.js', array(), '20160412', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );

			// toggle comments js.
		wp_enqueue_script( 'storyboard-toggle-comments', get_template_directory_uri() . '/assets/js/min/toggle-comments-min.js', array( 'jquery' ), '1.12.3', true );
	}

	if ( is_single() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'storyboard-keyboard-image-navigation', get_template_directory_uri() . '/assets/js/min/keyboard-image-navigation-min.js', array( 'jquery' ), '20160412', true );

	}
}
add_action( 'wp_enqueue_scripts', 'storyboard_scripts' );

/**
 * Excerpt customization
 *
 * @param string $more more excerpt.
 */
function storyboard_new_excerpt_more( $more ) {
	return ' <a class="read-more" href="' . get_permalink( get_the_ID() ) . '">' . __( 'Read more...', 'storyboard' ) . '</a>';
	if ( '' !== get_the_post_thumbnail() ) : the_post_thumbnail( 'storyboard-featured-thumbnail' );
	endif;
}
add_filter( 'excerpt_more', 'storyboard_new_excerpt_more' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Get the first image in a post. Storyboard version. Works, except gifs (animation killed)
 *
 * @link https://css-tricks.com/snippets/wordpress/get-the-first-image-from-a-post/
 */
function get_first_image() {
	global $post, $posts;
	$first_img = '';

	if ( $output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', do_shortcode( $post->post_content, 'gallery' ), $matches ) ) {	$first_img = $matches [1][0];
	}
	if ( empty( $first_img ) ) {
			return get_template_directory_uri() . '/assets/images/empty.png'; // path to default image.
	}
	// Converts the $first_img link to the link of that image's thumbnail.
	 $explode = explode( '.',$first_img );
	 $count = count( $explode );
	 $size = '-600x371'; // Golden Ratio rectangle.
	 $explode[ $count -2 ] = $explode[ $count -2 ] . '' . $size;
	 $thumb_img = implode( '.',$explode );
	 return $thumb_img;
}
		add_filter( 'first_img', 'get_first_image' );

/**
 * Estimated reading time
 *
 * @param string $post get reading time.
 * @return string $post get_reading_time
 **/
function get_reading_time( $post ) {
	if ( ! is_object( $post ) ) { return '' . __( 'less than a minute', 'storyboard' ) . '';
	}

			  $w = str_word_count( strip_tags( $post->post_content ) );
			  $t = $w / 200 * 60;

			  $m = intval( $t / 60 );
			  $s = intval( $t % 60 );

	   // Special case for really small times ...
	if ( 0 !== $m ) {
		return '' . __( 'less than a minute', 'storyboard' ) . '';
	}

	  // Everything else ...
	if ( $s > 45 ) {
		$m++;
		return '' . __( 'almost', 'storyboard' ) . ' ' . $m . ' ' . __( 'minutes', 'storyboard' ) . '';
	} else {
		return (1 !== $m)? '' . __( 'about a minute', 'storyboard' ) . '': '' . __( 'about', 'storyboard' ) . ' ' . $m . ' ' . __( 'minutes', 'storyboard' ) . '';
	}
}

/**
* WooCommerce Hooks
* Layout
*/
remove_action( 'woocommerce_before_main_content', 	'woocommerce_breadcrumb', 					20, 0 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 		10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 		10 );
remove_action( 'woocommerce_after_shop_loop', 		'woocommerce_pagination', 					10 );
remove_action( 'woocommerce_before_shop_loop', 		'woocommerce_result_count', 				20 );
remove_action( 'woocommerce_before_shop_loop', 		'woocommerce_catalog_ordering', 			30 );

add_action( 'woocommerce_before_main_content', 'storyboard_wrapper_start', 					10 );
add_action( 'woocommerce_after_main_content', 'storyboard_wrapper_end', 						10 );

/**
 * WooCommerce wrapper start
 */
function storyboard_wrapper_start() {
	echo '<section id="content" class="woocommerce-content" role="main"><div class="entry-wrap wrap clear">';
}

/**
 * WooCommerce end wrapper
 */
function storyboard_wrapper_end() {
	echo '</section>';
}

add_action( 'after_setup_theme', 'woocommerce_support' );
/**
 * Add WooCommerce support
 */
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

add_action( 'pre_get_posts', 'storyboard_cat_posts_per_page' );
/**
 * Change posts per page displayed in the portfolio category.
 *
 * @param WP_Query $query portfolio.
 */
function storyboard_cat_posts_per_page( $query ) {
	if ( $query->is_main_query() && is_category( 'portfolio' ) && ! is_admin() ) {
		$query->set( 'posts_per_page', '6' );
	}
}

/**
 * Remove jquery migrate $scripts for enhanced performance.
 *
 * @param strings $scripts remove_jquery_migrate.
 */
function remove_jquery_migrate( $scripts ) {
	if ( is_admin() ) { return;
	}
	$scripts->remove( 'jquery' );
	$scripts->add( 'jquery', false, array( 'jquery-core' ), '1.10.2' );
}
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );

/**
 * Remove login errors notices (security measure)
 */
function no_wordpress_errors() {
	return 'Something is wrong!';
}
add_filter( 'login_errors', 'no_wordpress_errors' );
