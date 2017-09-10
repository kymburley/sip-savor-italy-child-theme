<?php
/**
 * This file adds the Landing Page template to the Hello Serendipitous Theme
 *
 * @package      Hello Serendipitous
 * @link         https://helloyoudesigns.com
 * @author       Hello You Designs
 * @copyright    Copyright (c) 2016, Hello You Designs
 * @license      GPL-2.0+
 */

 /*
 Template Name: Landing
 */

 //* Add custom body class to the head
 add_filter( 'body_class', 'hyd_add_body_class' );
 function hyd_add_body_class( $classes ) {

    $classes[] = 'hyd-landing';
    return $classes;

 }

 //* Force full width content layout
 add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

 //* Remove site header elements
 remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
 remove_action( 'genesis_header', 'genesis_do_header' );
 remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

 //* Remove navigation
 remove_action( 'genesis_header', 'genesis_do_nav', 12 );
 remove_action( 'genesis_header', 'genesis_do_subnav', 5 );
 remove_action( 'genesis_footer', 'hydceo_footer_menu', 7 );

 //* Remove breadcrumbs
 remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

 //* Remove site footer widgets
 remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );

 //* Run the Genesis loop
 genesis();
