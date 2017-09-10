<?php
/**
* @package      Hello Serendipitous
* @link         https://helloyoudesigns.com
* @author       Hello You Designs
* @copyright    Copyright (c) 2016, Hello You Designs
* @license      GPL-2.0+
*/

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Add Image upload and Color select to WordPress Theme Customizer
require_once( get_stylesheet_directory() . '/lib/customize.php' );

//* Include Customizer CSS
include_once( get_stylesheet_directory() . '/lib/output.php' );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'hyd_scripts_styles' );
function hyd_scripts_styles() {
  wp_enqueue_style( 'dashicons', array());
	wp_enqueue_style( 'hyd-google-fonts', '//fonts.googleapis.com/css?family=Montserrat:400,700|Cormorant+Upright|Poppins|Oswald', array());
	wp_enqueue_style( 'ionicons', '//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', array());
 	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css' );
	wp_enqueue_script( 'sticky-nav', get_bloginfo( 'stylesheet_directory' ) . '/js/nav.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'localScroll', get_stylesheet_directory_uri() . '/js/jquery.localScroll.min.js', array( 'scrollTo' ), '1.2.8b', true );
	wp_enqueue_script( 'scrollTo', get_stylesheet_directory_uri() . '/js/jquery.scrollTo.min.js', array( 'jquery' ), '1.4.5-beta', true );
	wp_enqueue_script( 'hyd-fadeup-script', get_stylesheet_directory_uri() . '/js/fadeup.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'match-height', get_stylesheet_directory_uri() . '/js/jquery.matchHeight-min.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'match-height-init', get_stylesheet_directory_uri() . '/js/matchheight-init.js', array( 'match-height' ), '1.0.0', true );

}

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add new featured image size
add_image_size( 'featured-image', 400, 600, TRUE );
add_image_size( 'horizontal-featured', 1100, 600, TRUE );
add_image_size( 'portfolio', 400, 400, TRUE );



//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 1200,
	'height'          => 300,
	'header-selector' => '.site-title a',
	'header-text'     => false,
) );

//* Remove the header right widget area
unregister_sidebar( 'header-right' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Unregister layout settings
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

//* Unregister secondary sidebar
unregister_sidebar( 'sidebar-alt' );


//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before_header', 'genesis_do_nav' );

//* Relocate Secondary (Right) Navigation
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before_footer', 'genesis_do_subnav', 9, 2 );

//* Remove output of primary navigation right extras
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );


//Add Fancy Search Box
add_action( 'wp_enqueue_scripts', 'custom_enqueue_scripts_styles' );
function custom_enqueue_scripts_styles() {
	wp_enqueue_script( 'global', get_bloginfo( 'stylesheet_directory' ) . '/js/global.js', array( 'jquery' ), '1.0.0', true );
}

add_filter( 'wp_nav_menu_items', 'theme_menu_extras', 9, 2 );
function theme_menu_extras( $menu, $args ) {
	if ( 'primary' !== $args->theme_location )
		return $menu;
	$menu .= '<li class="search"><a id="main-nav-search-link" class="icon-search"></a><div class="search-div">' . get_search_form( false ) . '</div></li>';
	return $menu;

}

//* Add widget to small navigation
add_filter( 'genesis_nav_items', 'hyd_social_icons', 10, 2 );
add_filter( 'wp_nav_menu_items', 'hyd_social_icons', 10, 2 );

function hyd_social_icons($menu, $args) {
	$args = (array)$args;
	if ( 'primary' !== $args['theme_location'] )
		return $menu;
	ob_start();
	genesis_widget_area('nav-social-menu');
	$social = ob_get_clean();
	return $menu . $social;
}

/**
 * Display Home Slider widget area's contents below Navigation on homepage.
 */
function hyd_home_featured() {
	if ( is_front_page() ) {
		genesis_widget_area( 'home-slider', array(
			'before'	=> '<div class="home-slider widget-area">',
			'after'		=> '</div>',
		) );
	}
}

//* Reposition Featured Images
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
add_action( 'genesis_entry_header', 'genesis_do_post_image', 5 );


//* Customize the Post Info Function
add_filter( 'genesis_post_info', 'hyd_post_info_filter' );
function hyd_post_info_filter( $post_info ) {

	$post_info = '[post_date]';
    return $post_info;

}

//* Relocate the post info
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action( 'genesis_entry_header', 'genesis_post_info', 5 );

//* Customize the entry meta in the entry header
add_filter( 'genesis_post_info', 'hyd_post_info_filter' );
function hydceo_post_info_filter( $post_info ) {

    $post_info = '[post_date] [post_edit]';

    return $post_info;

}


//* Modify the Genesis content limit read more link
add_filter( 'get_the_content_more_link', 'hyd_read_more_link' );
function hyd_read_more_link() {
	return '... <a class="more-link" href="' . get_permalink() . '">VIEW POST</a>';
}

//* Setup widget counts
function hyd_count_widgets( $id ) {

	global $sidebars_widgets;

	if ( isset( $sidebars_widgets[ $id ] ) ) {
		return count( $sidebars_widgets[ $id ] );
	}

}

//* Flexible widget classes
function hyd_widget_area_class( $id ) {

	$count = hyd_count_widgets( $id );

	$class = '';

	if( $count == 1 ) {
		$class .= ' widget-full';
	} elseif( $count % 3 == 1 ) {
		$class .= ' widget-thirds';
	} elseif( $count % 4 == 1 ) {
		$class .= ' widget-fourths';
	} elseif( $count % 2 == 0 ) {
		$class .= ' widget-halves uneven';
	} else {
		$class .= ' widget-halves even';
	}
	return $class;

}

//* Modify the size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'hyd_comments_gravatar' );
function hyd_comments_gravatar( $args ) {

	$args['avatar_size'] = 96;

	return $args;

}

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'hyd_author_box_gravatar' );
function hyd_author_box_gravatar( $size ) {

	return 150;

}

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'hyd_remove_comment_form_allowed_tags' );
function hyd_remove_comment_form_allowed_tags( $defaults ) {

	$defaults['comment_notes_after'] = '';
	return $defaults;

}

//* Hooks Widget Area Above Content
add_action( 'genesis_before_content', 'hyd_widget_above_content' );
function hyd_widget_above_content() {
		if ( ! is_front_page() ) {

    genesis_widget_area( 'widget-above-content', array(
		'before' => '<div class="widget-above-content widget-area"><div class="wrap">',
		'after'  => '</div></div>',
    ) );

}}

//* Hooks Widget Area Above Content
add_action( 'genesis_after_content', 'hyd_widget_below_content'  );
function hyd_widget_below_content() {
			if ( ! is_front_page() ) {

    genesis_widget_area( 'widget-below-content', array(
		'before' => '<div class="widget-below-content widget-area"><div class="wrap">',
		'after'  => '</div></div>',
    ) );

}}

//* Genesis Previous/Next Post Post Navigation
add_action( 'genesis_entry_footer', 'hyd_prev_next_post_nav' );

function hyd_prev_next_post_nav() {

	if ( is_single() ) {

		echo '<div class="prev-next-navigation">';
		previous_post_link( '<div class="previous">%link</div>', 'Previous' );
		next_post_link( '<div class="next">%link</div>', 'Next' );
		echo '</div><!-- .prev-next-navigation -->';
	}
}

//* Edit width of tiled gallery
if ( ! isset( $content_width ) )
    $content_width = 775;


		//* Customize the entire footer
		remove_action( 'genesis_footer', 'genesis_do_footer' );
		add_action( 'genesis_footer', 'hyd_custom_footer' );
		function hyd_custom_footer() {

			echo '<div class="creds"><p>';
			echo 'Copyright &copy; ';
			echo date('Y');
			echo ' &middot; ';
			echo get_bloginfo( 'name' );
			echo ' &middot; <a target="_blank" href="https://helloyoudesigns.com">Hello You Designs</a>';
			echo '</p></div>';

	}

//* Add Theme Support for WooCommerce
add_theme_support( 'genesis-connect-woocommerce' );

//* Add Gallery Support for WooCommerce

add_action( 'after_setup_theme', 'hyd_setup' );

function hyd_setup() {
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );
}

//* Remove Related Products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

//* Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}

add_filter('widget_text', 'do_shortcode');


// Add Archive Settings option to Portolio CPT
add_post_type_support( 'portfolio', 'genesis-cpt-archives-settings' );

/**
 * Template Redirect
 * Use archive-portfolio.php for portfolio category and tag taxonomy archives.
 */
add_filter( 'template_include', 'hyd_template_redirect' );
function hyd_template_redirect( $template ) {

	if ( is_tax( 'portfolio_category' ) || is_tax( 'portfolio_tag' ) )
		$template = get_query_template( 'archive-portfolio' );
	return $template;

}

add_action( 'pre_get_posts', 'hyd_change_portfolio_posts_per_page' );
/**
 * Set all the entries to appear on Portfolio archive page
 */
function hyd_change_portfolio_posts_per_page( $query ) {

	if( $query->is_main_query() && !is_admin() && is_post_type_archive( 'portfolio' ) ) {
			$query->set( 'posts_per_page', '-1' );
	}

}



//* Hooks widget area before footer
add_action( 'genesis_before_footer', 'hyd_social_bar' );
function hyd_social_bar() {{

    genesis_widget_area( 'social-bar', array(
		'before' => '<div class="social-bar widget-area"><div class="social-wrap">',
		'after'  => '</div></div>',
    ) );

}}

//* Register widget areas

genesis_register_sidebar( array(
	'id'			=> 'home-slider',
	'name'			=> 'Home Slider',
	'description'	=> 'This is the home slider section.  1200pxH x 500pxW'
) );
genesis_register_sidebar( array(
	'id'			=> 'home-badge',
	'name'			=> 'Home Badge',
	'description'	=> 'This is the home badge section - Image size 400x400'
) );
genesis_register_sidebar( array(
	'id'           => 'home-welcome',
	'name'         => __( 'Home Welcome', 'hyd' ),
	'description'  => __( 'This is the home Welcome widget area on the home page. - Flexible Layout', 'hyd' ),
) );
genesis_register_sidebar( array(
	'id'           => 'image-section-1',
	'name'         => __( 'Image Section 1', 'hyd' ),
	'description'  => __( 'This is the first image section.  Change the image in the customizer. 1600x1050px', 'hyd' ),
) );
genesis_register_sidebar( array(
	'id'            => 'home-flexible',
	'name'          => __( 'Home Flexible', 'hyd' ),
	'description'   => __( 'Solid white section below the home grid.  - Flexible Layout', 'hyd' ),
) );
genesis_register_sidebar( array(
	'id'           => 'image-section-2',
	'name'         => __( 'Image Section 2', 'hyd' ),
	'description'  => __( 'This is the Second image section.  Change the image in the customizer. 1600x1050px', 'hyd' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-featured',
	'name'        => __( 'Home Featured', 'hyd' ),
	'description' => __( 'Full Width Featured Area', 'hyd' ),
) );
genesis_register_sidebar( array(
	'id'           => 'image-section-3',
	'name'         => __( 'Image Section 3', 'hyd' ),
	'description'  => __( 'This is the third image section.  Change the image in the customizer. 1600x1050px', 'hyd' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-close',
	'name'        => __( 'Home Close', 'hyd' ),
	'description' => __( 'This is the last white section before the blog/footer on the homepage', 'hyd' ),
) );
genesis_register_sidebar( array(
	'id'            => 'widget-above-content',
	'name'          => __( 'Widget Above Content', 'hyd' ),
	'description'   => __( 'This widget area appears on top of the content on interior pages and posts', 'hyd' ),
) );
genesis_register_sidebar( array(
	'id'            => 'widget-below-content',
	'name'          => __( 'Widget Below Content', 'hyd' ),
	'description'   => __( 'This widget area appears below the content on interior pages and posts.', 'hyd' ),
) );
genesis_register_sidebar( array(
	'id'            => 'category-index',
	'name'          => __( 'Category Index', 'hyd' ),
	'description'   => __( 'This widget area creates a Category Index page - Page must use Category Template', 'hyd' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'blog-slider',
	'name'			=> __( 'Blog Slider', 'hyd' ),
	'description'	=> __( 'Carousel Slider on Blog Template', 'hyd' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'blog-featured',
	'name'			=> __( 'Blog Featured', 'hyd' ),
	'description'	=> __( 'Flexible widget featured on the Blog page', 'hyd' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'portfolioblurb',
	'name'			=> __( 'Portfolio Blurb', 'hyd' ),
	'description'	=> __( 'Add a CTA or other message to your Portfolio Archive page.', 'hyd' ),
) );
genesis_register_sidebar( array(
	'id'          	=> 'nav-social-menu',
	'name'        	=> __( 'Nav Social Menu', 'hyd' ),
	'description' 	=> __( 'This is the nav social menu section.', 'hyd' ),
) );
genesis_register_sidebar( array(
	'id'          => 'social-bar',
	'name'        => __( 'Social Bar', 'hyd' ),
	'description' => __( 'This is the full width Social Bar above the footer.', 'hyd' ),
) );
