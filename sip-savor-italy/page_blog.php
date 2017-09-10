<?php
/**
* @package      Hello Serendipitous
* @link         https://helloyoudesigns.com
* @author       Hello You Designs
* @copyright    Copyright (c) 2016, Hello You Designs
* @license      GPL-2.0+
*/

/*
Template Name: Blog Page
*/


//* Add the blog slider widget
add_action( 'genesis_before_content', 'hyd_blog_slider_before_content', 5 );
function hyd_blog_slider_before_content() {
	if ( get_query_var( 'paged' ) >= 1 )
		return;
	genesis_widget_area( 'blog-slider', array(
	'before' => '<div class="blog-slider">',
	'after'  => '</div>',
	) );
}

//* Add blog featured section
add_action( 'genesis_before_content', 'hyd_blog_featured_before_content', 6 );
function hyd_blog_featured_before_content() {
	if ( get_query_var( 'paged' ) >= 1 )
		return;
	genesis_widget_area( 'blog-featured', array(
	'before' => '<div id="blog-featured"><div class="fadeup-effect">',
	'after'  => '</div></div>',
	) );
}


//* Remove entry meta
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );


genesis();
