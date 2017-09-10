<?php
/**
 * This file adds the custom portfolio post type archive template to the Hello Serendipitous Portfolio.
 *
 */
// Add portfolio body class
add_filter( 'body_class', 'hyd_add_portfolio_body_class' );
function hyd_add_portfolio_body_class( $classes ) {
	$classes[] = 'hyd-portfolio';
	return $classes;
}
// Load Isotope
wp_enqueue_script( 'isotope', get_stylesheet_directory_uri() . '/js/jquery.isotope.min.js', array( 'jquery' ), '1.5.26', true );
wp_enqueue_script( 'isotope_init', get_stylesheet_directory_uri() . '/js/isotope_init.js', array( 'isotope' ), '1.0.0', true );
// Enqueue script for revealing title and excerpt on hover
add_action( 'wp_enqueue_scripts', 'hyd_enqueue_scripts' );
function hyd_enqueue_scripts() {
	if ( wp_is_mobile() ) {
		return;
	}
	wp_enqueue_script( 'portfolio-archive', get_stylesheet_directory_uri() .'/js/portfolio-archive.js' , array( 'jquery' ), '1.0.0', true );
}

//* Add the portfolio blurb section
add_action( 'genesis_before_content', 'hyd_portfolioblurb_before_content' );
function hyd_portfolioblurb_before_content() {

	genesis_widget_area( 'portfolioblurb', array(
	'before' => '<div class="portfolioblurb">',
	'after' => '</div>',
	) );

}

// Force full width content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
// Display Portfolio Categories Filter
add_action( 'genesis_before_loop', 'hyd_isotope_filter' );
function hyd_isotope_filter() {
	if ( is_post_type_archive( 'portfolio' ) )
		$terms = get_terms( 'portfolio_category' );
		$count = count( $terms ); $i=0;
		if ( $count > 0 ) { ?>
			<ul id="portfolio-cats" class="filter clearfix">
				<li><a href="#" class="active" data-filter="*"><span><?php _e('All', 'genesis'); ?></span></a></li>
				<?php foreach ( $terms as $term ) : ?>
					<li><a href="#" data-filter=".<?php echo $term->slug; ?>"><span><?php echo $term->name; ?></span></a></li>
				<?php endforeach; ?>
			</ul><!-- /portfolio-cats -->
		<?php }
}
// Display 'back to portfolio' link and Title on Portfolio Category archive pages
add_action( 'genesis_before_loop', 'hyd_taxonomy_page_additions' );
function hyd_taxonomy_page_additions() {
	if ( is_tax( 'portfolio_category' ) ) {
		echo '<a href="' . get_bloginfo( 'url' ) . '/portfolio/">&laquo; Back to Full Portfolio</a>';
		global $wp_query;
		$term = $wp_query->get_queried_object();
		echo '<h2 class="taxonomy-title">' . $term->name . '</h2>';
	}
}
// Wrap Portfolio items in a custom div - opening
add_action('genesis_before_loop', 'portfolio_content_opening_div' );
function portfolio_content_opening_div() {
	echo '<div class="portfolio-content">';
}
// Remove the breadcrumb navigation
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
// Force Excerpts
add_filter( 'genesis_pre_get_option_content_archive', 'hyd_show_excerpts' );
function hyd_show_excerpts() {
	return 'excerpts';
}
// Modify the length of post excerpts
add_filter( 'excerpt_length', 'sp_excerpt_length' );
function sp_excerpt_length( $length ) {
	return 10; // pull first 10 words
}
// Modify the Excerpt read more link
add_filter( 'excerpt_more', 'new_excerpt_more' );
function new_excerpt_more( $more ) {
    return '... <span class="read-more">Read more</span> &raquo;';
}
// Remove entry header
remove_action( 'genesis_entry_header', 'genesis_do_post_format_image', 4 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_post_info', 5 );

// Remove the post image
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
// Remove post meta function
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
// Remove post content
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
// Do not show Featured image if set in Theme Settings > Content Archives
add_filter( 'genesis_pre_get_option_content_archive_thumbnail', '__return_false' );
// Add featured image, title and excerpt (both linking to entry's permalink) in .entry-content
add_action( 'genesis_entry_content', 'hyd_portfolio_grid_item' );
function hyd_portfolio_grid_item() {
	// Store the URL of featured image in a variable
	$image = genesis_get_image( array(
		'format'  => 'url',
		'size'    => 'portfolio',
	));
	// if there is no Featured Image, set a default image to appear.
	if ( ! $image ) {
		$image = get_stylesheet_directory_uri() . '/images/default.jpg';
	} ?>

	<a href="<?php the_permalink(); ?>" rel="bookmark" class="link-hover">
		<img src="<?php echo $image; ?>" alt="<?php the_title_attribute(); ?>" />
		<div class="item-hover">
			<div class="item-container">
				<h4 class="entry-title"><?php the_title(); ?></h4>
			</div>
		</div>
	</a>

<?php }
// add category names in post class
add_filter( 'post_class', 'portfolio_category_class' );
function portfolio_category_class( $classes ) {
	$terms = get_the_terms( get_the_ID(), 'portfolio_category' );
	if( $terms ) foreach ( $terms as $term )
		$classes[] = $term->slug;
	return $classes;
}

// Wrap Portfolio items in a custom div - closing
add_action( 'genesis_after_loop', 'portfolio_content_closing_div' );
function portfolio_content_closing_div() {
	echo "</div>";
}
genesis();
