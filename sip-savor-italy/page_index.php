<?php
/**
 * This file adds the Category Index to the Hello Serendipitous Theme
 *
 * @package      Hello Serendipitous
 * @link         https://helloyoudesigns.com
 * @author       Hello You Designs
 * @copyright    Copyright (c) 2016, Hello You Designs
 * @license      GPL-2.0+
 */

/*
Template Name: Category Index
*/

add_action( 'genesis_meta', 'hyd_category_genesis_meta' );
/**
 * Add widget support for category index. If no widgets active, display the default loop.
 *
 */
function hyd_category_genesis_meta() {

	if ( is_active_sidebar( 'category-index' )) {

		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'hyd_category_sections' );
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );

	}

}

function hyd_category_sections() {

	genesis_widget_area( 'category-index', array(
		'before' => '<div class="category-index widget-area">',
		'after'  => '</div>',
	) );

}

genesis();
