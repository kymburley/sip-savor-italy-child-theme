<?php
/**
* @package      Hello Serendipitous
* @link         https://helloyoudesigns.com
* @author       Hello You Designs
* @copyright    Copyright (c) 2016, Hello You Designs
* @license      GPL-2.0+
*/

//* Remove the breadcrumb navigation
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

//* Remove the post info function
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//* Force full width content layout
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

//* Remove the post content
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

//* Remove the post image
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

//* Add archive body class to the head
add_filter( 'body_class', 'hyd_add_archive_body_class' );
function hyd_add_archive_body_class( $classes ) {
   $classes[] = 'hyd-archive';
   return $classes;
}

//* Display Category Description
add_action( 'genesis_before_loop', 'hyd_category_archives_description');
function hyd_category_archives_description () {
	echo category_description( '$category_ID' );
}

//* Remove the post meta function
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

genesis();
