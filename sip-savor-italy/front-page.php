<?php
/**
 * This file adds the Custom Home Page to the Hello Serendipitous Theme.
 *
 * @package      Hello Serendipitous
 * @link         https://helloyoudesigns.com
 * @author       Hello You Designs
 * @copyright    Copyright (c) 2016, Hello You Designs
 * @license      GPL-2.0+
 */


add_action( 'genesis_meta', 'hyd_front_page_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function hyd_front_page_genesis_meta() {

	if (    is_active_sidebar( 'home-slider' ) || is_active_sidebar( 'home-badge' ) || is_active_sidebar( 'home-welcome' ) || is_active_sidebar( 'image-section-1' ) ||  is_active_sidebar( 'home-flexible' ) || is_active_sidebar( 'image-section-2' ) || is_active_sidebar( 'home-featured-2' ) || is_active_sidebar( 'image-section-3' ) || is_active_sidebar( 'home-close' )) {

		//* Enqueue scripts
		add_action( 'wp_enqueue_scripts', 'hyd_enqueue_hyd_script' );
		function hyd_enqueue_hyd_script() {

			wp_enqueue_script( 'global-script', get_bloginfo( 'stylesheet_directory' ) . '/js/global.js', array( 'jquery' ), '1.0.0' );
			wp_enqueue_script( 'localScroll', get_stylesheet_directory_uri() . '/js/jquery.localScroll.min.js', array( 'scrollTo' ), '1.2.8b', true );
			wp_enqueue_script( 'scrollTo', get_stylesheet_directory_uri() . '/js/jquery.scrollTo.min.js', array( 'jquery' ), '1.4.5-beta', true );
			wp_enqueue_script( 'hyd-script', get_bloginfo( 'stylesheet_directory' ) . '/js/home.js', array( 'jquery' ), '1.0.0' );

			wp_enqueue_style( 'hyd-front-styles', get_stylesheet_directory_uri() . '/style-front.css', array());

		}


		//* Add front-page body class
		add_filter( 'body_class', 'hyd_body_class' );
		function hyd_body_class( $classes ) {

			$classes[] = 'front-page';
			return $classes;

		}

		//* Add featured-section body class
		if ( is_active_sidebar( 'image-section-1' ) ) {

			//* Add image-section-start body class
			add_filter( 'body_class', 'hyd_featured_body_class' );
			function hyd_featured_body_class( $classes ) {

				$classes[] = 'featured-section';
				return $classes;

			}
}

// Force full width content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

		//* Remove breadcrumbs
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

		//* Add widgets on front page
		add_action( 'genesis_after_header', 'hyd_front_page_widgets' );

		$blog = get_option( 'hyd_blog_setting', 'true' );

		if ( $blog === 'true' ) {

			//* Add opening markup for blog section
			add_action( 'genesis_before_loop', 'hyd_front_page_blog_open' );

			//* Add closing markup for blog section
			add_action( 'genesis_after_loop', 'hyd_front_page_blog_close' );

			//* Remove the post info function
			remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

			//* Remove the post meta function
			remove_action( 'genesis_entry_footer', 'genesis_post_meta' );



		} else {

			//* Remove the default Genesis loop
			remove_action( 'genesis_loop', 'genesis_do_loop' );
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );
		}

	}

}

//* Add widgets on front page
function hyd_front_page_widgets() {
	if ( get_query_var( 'paged' ) >= 2 )
		return;

		genesis_widget_area( 'home-slider', array(
			'before' => '<div class="home-slider"><div class="wrap">',
			'after'  => '</div></div>',
		) );
		genesis_widget_area( 'home-badge', array(
			'before' => '<div class="home-badge">',
			'after'  => '</div>',
		) );
		genesis_widget_area( 'home-welcome', array(
			'before' => '<div id="home-welcome" class="home-welcome"><div class="wrap"><div class="flexible-widgets widget-area fadeup-effect' . hyd_widget_area_class( 'home-welcome' ) . '">',
			'after'  => '</div></div></div>',
		) );
		genesis_widget_area( 'image-section-1', array(
			'before' => '<div id="image-section-1" class="image-section-1"><div class="image-section"><div class="flexible-widgets widget-area fadeup-effect' . hyd_widget_area_class( 'image-section-1' ) . '"><div class="wrap">',
			'after'  => '</div></div></div></div>',
		) );

	if (  is_active_sidebar( 'home-flexible' ) || is_active_sidebar( 'image-section-2' ) || is_active_sidebar( 'home-featured' ) || is_active_sidebar( 'image-section-3' ) || is_active_sidebar( 'home-close' )) {

		genesis_widget_area( 'home-flexible', array(
			'before' => '<div id="home-flexible" class="home-flexible"><div class="wrap"><div class="flexible-widgets widget-area fadeup-effect' . hyd_widget_area_class( 'home-flexible' ) . '">',
			'after'  => '</div></div></div>',
		) );
		genesis_widget_area( 'image-section-2', array(
			'before' => '<div id="image-section-2" class="image-section-2"><div class="image-section"><div class="flexible-widgets widget-area fadeup-effect' . hyd_widget_area_class( 'image-section-2' ) . '"><div class="wrap">',
			'after'  => '</div></div></div></div>',
		) );
		genesis_widget_area( 'home-featured', array(
			'before' => '<div class="home-featured"><div class="fadeup-effect">',
			'after'  => '</div></div></div>',
		) );
		genesis_widget_area( 'image-section-3', array(
			'before' => '<div id="image-section-3" class="image-section-3"><div class="image-section"><div class="flexible-widgets widget-area fadeup-effect' . hyd_widget_area_class( 'image-section-3' ) . '"><div class="wrap">',
			'after'  => '</div></div></div></div>',
		) );
		genesis_widget_area( 'home-close', array(
			'before' => '<div id="home-close" class="home-close"><div class="wrap"><div class="flexible-widgets widget-area fadeup-effect' . hyd_widget_area_class( 'home-close' ) . '">',
			'after'  => '</div></div></div>',
		) );
}}



//* Add opening markup for blog section
function hyd_front_page_blog_open() {

	$blog_text = get_option( 'hyd_blog_text', __( 'New on the Blog', 'hyd' ) );

	if ( 'posts' == get_option( 'show_on_front' ) ) {

		echo '<div class="blog widget-area fadeup-effect"><div class="wrap">';

		if ( ! empty( $blog_text ) ) {

			echo '<h2 class="widgettitle widget-title center">' . $blog_text . '</h2>';

		}

	}

}

//* Add closing markup for blog section
function hyd_front_page_blog_close() {

	if ( 'posts' == get_option( 'show_on_front' ) ) {

		echo '</div></div>';

	}

}

//* Run the Genesis function
genesis();
