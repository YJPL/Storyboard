[![Build Status](https://travis-ci.org/YJPL/Storyboard.svg?branch=master)](https://travis-ci.org/YJPL/Storyboard)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/YJPL/Storyboard/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/YJPL/Storyboard/?branch=master)
[![Code Climate](https://codeclimate.com/github/YJPL/Storyboard/badges/gpa.svg)](https://codeclimate.com/github/YJPL/Storyboard)

=== Storyboard ===


Contributors: Yves Capelle, alternatyves outc.
Requires at least: WordPress 4.4
Version; 1.2.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: white, light, one-column, flexible-header, responsive-layout, custom-background, custom-colors, custom-header, custom-menu, editor-style, featured-images, post-formats, rtl-language-support, sticky-post, theme-options, custom-logo, translation-ready

Storyboard is a WordPress theme originally designed for the [Film Storyboards site](https://film-storyboards.com "Film Storyboards portfolio site").

== Description ==

1. A lean portfolio theme to display posts in the ‘portfolio’ category on a two, three or four columns grid on the home page.

2. Doesn’t require custom post type or Jetpack to work out of the box, you just need to mark the posts you want to display in a regular category under the name "portfolio"

3. Use “Force Regenerate thumbnails” plugin if you change the size of your images, or else use the “featured” image to change the thumbnails for each post.

Getting Started
---------------

1. Upload and install `Storyboard` in your WordPress dashboard under Appearance -> Themes.

2. Create a category 'portfolio'. Only label the posts you want to display on the home page under this ‘portfolio’ category.

3. Chose how to display the home page
By default it should pick the first image for each post, assuming post(s) exist in the category 'portfolio'. Use feature image in your post to display an image of your choosing. For a post without image a blue placeholder image will appear, so you should also use featured image, even if your content post is only text.


Customize this theme
--------------------

The theme is provided with Sass files so you can easily make it your own.

Fonts are embedded into the theme so it doesn't rely on a third party to load fonts.

You can use a custom SVG logo, an image logo or the default title and description, but not all three simultaneously.

If you want to use your own SVG logo, you will need to uncomment (remove the double slash) at line 36 in the header.php file, before ```get_template_part( '/assets/inline', 'logo.svg' );``` and add your own SVG logo in BASE64 code into the inline-logo.svg.php file provided here as an example.
You can use a free online service to translate your SVG logo into BASE64 code, and paste it to replace the sample in inline-logo.svg.php. Your SVG logo will then appear in the left-hand corner of your site.

You can also add a custom image logo from the customizer → site identity → logo, or just use the site text title + description.
