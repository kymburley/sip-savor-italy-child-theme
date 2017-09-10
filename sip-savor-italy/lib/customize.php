<?php

function hyd_customizer_get_default_navigation_color() {
 	return '#333';
 }
function hyd_customizer_get_default_navlink_color() {
	return '#fff';
}
function hyd_customizer_get_default_navhover_color() {
	return '#e4cbcd';
}
function hyd_customizer_get_default_imagesection2_color() {
	return '#fff';
}
function hyd_customizer_get_default_accenttext_color() {
	return '#fae7df';
}
function hyd_customizer_get_default_button_color() {
	return '#333';
}
function hyd_customizer_get_default_buttonfont_color() {
  return '#fff';
}
function hyd_customizer_get_default_buttonhover_color() {
 	return '#e4cbcd';
 }
function hyd_customizer_get_default_buttonfonthover_color() {
  return '#333';
 }
function hyd_customizer_get_default_primarylink_color() {
	return '#999';
}
function hyd_customizer_get_default_primaryhover_color() {
	return '#e4cbcd';
}
function hyd_customizer_get_default_portfolio_color() {
	return '#ccc';
}
function hyd_customizer_get_default_footer_color() {
	return '#333';
}
function hyd_customizer_get_default_footerfont_color() {
	return '#fff';
}
function hyd_customizer_get_default_shareicons_color() {
	return '#333';
}



add_action( 'customize_register', 'hyd_customizer_register' );
/**
 * Register settings and controls with the Customizer.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function hyd_customizer_register() {

	/**
	 * Customize Background Image Control Class
	 *
	 * @package WordPress
	 * @subpackage Customize
	 * @since 3.4.0
	 */
	class Child_hyd_Image_Control extends WP_Customize_Image_Control {

		/**
		 * Constructor.
		 *
		 * If $args['settings'] is not defined, use the $id as the setting ID.
		 *
		 * @since 3.4.0
		 * @uses WP_Customize_Upload_Control::__construct()
		 *
		 * @param WP_Customize_Manager $manager
		 * @param string $id
		 * @param array $args
		 */
		public function __construct( $manager, $id, $args ) {
			$this->statuses = array( '' => __( 'No Image', 'hyd' ) );

			parent::__construct( $manager, $id, $args );

			$this->add_tab( 'upload-new', __( 'Upload New', 'hyd' ), array( $this, 'tab_upload_new' ) );
			$this->add_tab( 'uploaded',   __( 'Uploaded', 'hyd' ),   array( $this, 'tab_uploaded' ) );

			if ( $this->setting->default )
				$this->add_tab( 'default',  __( 'Default', 'hyd' ),  array( $this, 'tab_default_background' ) );

			// Early priority to occur before $this->manager->prepare_controls();
			add_action( 'customize_controls_init', array( $this, 'prepare_control' ), 5 );
		}

		/**
		 * @since 3.4.0
		 * @uses WP_Customize_Image_Control::print_tab_image()
		 */
		public function tab_default_background() {
			$this->print_tab_image( $this->setting->default );
		}

	}

	global $wp_customize;

  $images = apply_filters( 'hyd_images', array( '1', '2', '3' ) );

	$wp_customize->add_section( 'hyd-settings', array(
		'description' => __( 'Customize the image sections on the homepage.  Default size is 1600 wide x 1050 high.', 'hyd' ),
		'title'    => __( 'Image Sections', 'hyd' ),
		'priority' => 35,
	) );

	foreach( $images as $image ){

		$wp_customize->add_setting( $image .'-hyd-image', array(
			'default'  => sprintf( '%s/images/bg-%s.jpg', get_stylesheet_directory_uri(), $image ),
			'type'     => 'option',
		) );

		$wp_customize->add_control( new Child_hyd_Image_Control( $wp_customize, $image .'-hyd-image', array(
			'label'    => sprintf( __( 'Image Section %s :', 'hyd' ), $image ),
			'section'  => 'hyd-settings',
			'settings' => $image .'-hyd-image',
			'priority' => $image+1,
		) ) );

	}


	$wp_customize->add_setting(
		'hyd_navigation_color',
		array(
			'default'           => hyd_customizer_get_default_navigation_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_setting(
	  'hyd_navlink_color',
	  array(
	    'default'           => hyd_customizer_get_default_navlink_color(),
	    'sanitize_callback' => 'sanitize_hex_color',
	  )
	);
	$wp_customize->add_setting(
	  'hyd_navhover_color',
	  array(
	    'default'           => hyd_customizer_get_default_navhover_color(),
	    'sanitize_callback' => 'sanitize_hex_color',
	  )
	);
  $wp_customize->add_setting(
	  'hyd_imagesection2_color',
	  array(
	    'default'           => hyd_customizer_get_default_imagesection2_color(),
	    'sanitize_callback' => 'sanitize_hex_color',
	  )
	);
  $wp_customize->add_setting(
	  'hyd_accenttext_color',
	  array(
	    'default'           => hyd_customizer_get_default_accenttext_color(),
	    'sanitize_callback' => 'sanitize_hex_color',
	  )
	);
	$wp_customize->add_setting(
	  'hyd_primarylink_color',
	  array(
	    'default'           => hyd_customizer_get_default_primarylink_color(),
	    'sanitize_callback' => 'sanitize_hex_color',
	  )
	);
	$wp_customize->add_setting(
	  'hyd_primaryhover_color',
	  array(
	    'default'           => hyd_customizer_get_default_primaryhover_color(),
	    'sanitize_callback' => 'sanitize_hex_color',
	  )
	);
  $wp_customize->add_setting(
	  'hyd_portfolio_color',
	  array(
	    'default'           => hyd_customizer_get_default_portfolio_color(),
	    'sanitize_callback' => 'sanitize_hex_color',
	  )
	);
  $wp_customize->add_setting(
	  'hyd_footer_color',
	  array(
	    'default'           => hyd_customizer_get_default_footer_color(),
	    'sanitize_callback' => 'sanitize_hex_color',
	  )
	);
  $wp_customize->add_setting(
	  'hyd_footerfont_color',
	  array(
	    'default'           => hyd_customizer_get_default_footerfont_color(),
	    'sanitize_callback' => 'sanitize_hex_color',
	  )
	);
	$wp_customize->add_setting(
	  'hyd_shareicons_color',
	  array(
	    'default'           => hyd_customizer_get_default_shareicons_color(),
	    'sanitize_callback' => 'sanitize_hex_color',
	  )
	);
  $wp_customize->add_setting(
	  'hyd_button_color',
	  array(
	    'default'           => hyd_customizer_get_default_button_color(),
	    'sanitize_callback' => 'sanitize_hex_color',
	  )
	);
  $wp_customize->add_setting(
    'hyd_buttonfont_color',
    array(
      'default'           => hyd_customizer_get_default_buttonfont_color(),
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );
  $wp_customize->add_setting(
    'hyd_buttonhover_color',
    array(
      'default'           => hyd_customizer_get_default_buttonhover_color(),
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );
  $wp_customize->add_setting(
    'hyd_buttonfonthover_color',
    array(
      'default'           => hyd_customizer_get_default_buttonfonthover_color(),
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'hyd_navigation_color',
			array(
				'description' => __( 'Change the default color for your primary navigation.', 'hyd' ),
			    'label'       => __( 'Navigation', 'hyd' ),
			    'section'     => 'colors',
			    'settings'    => 'hyd_navigation_color',
			)
		)
	);
	$wp_customize->add_control(
	  new WP_Customize_Color_Control(
	    $wp_customize,
	    'hyd_navlink_color',
	    array(
	      'description' => __( 'Change the link color in the navigation', 'hyd' ),
	        'label'       => __( 'Navigation Link Color', 'hyd' ),
	        'section'     => 'colors',
	        'settings'    => 'hyd_navlink_color',
	    )
	  )
	);
	$wp_customize->add_control(
	  new WP_Customize_Color_Control(
	    $wp_customize,
	    'hyd_navhover_color',
	    array(
	      'description' => __( 'Change the link hover color in the navigation', 'hyd' ),
	        'label'       => __( 'Navigation Hover Color', 'hyd' ),
	        'section'     => 'colors',
	        'settings'    => 'hyd_navhover_color',
	    )
	  )
	);

  $wp_customize->add_control(
	  new WP_Customize_Color_Control(
	    $wp_customize,
	    'hyd_imagesection2_color',
	    array(
	      'description' => __( 'Change the white text in Image Section 2', 'hyd' ),
	        'label'       => __( 'Text Image Section 2', 'hyd' ),
	        'section'     => 'colors',
	        'settings'    => 'hyd_imagesection2_color',
	    )
	  )
	);
  $wp_customize->add_control(
	  new WP_Customize_Color_Control(
	    $wp_customize,
	    'hyd_accenttext_color',
	    array(
	      'description' => __( 'Change the pink of the Accent Text', 'hyd' ),
	        'label'       => __( 'Accent Text', 'hyd' ),
	        'section'     => 'colors',
	        'settings'    => 'hyd_accenttext_color',
	    )
	  )
	);
  $wp_customize->add_control(
	  new WP_Customize_Color_Control(
	    $wp_customize,
	    'hyd_portfolio_color',
	    array(
	      'description' => __( 'Change filter button color on the portfolio page', 'hyd' ),
	        'label'       => __( 'Portfolio Filter', 'hyd' ),
	        'section'     => 'colors',
	        'settings'    => 'hyd_portfolio_color',
	    )
	  )
	);
  $wp_customize->add_control(
	  new WP_Customize_Color_Control(
	    $wp_customize,
	    'hyd_footer_color',
	    array(
	      'description' => __( 'Change the footer color', 'hyd' ),
	        'label'       => __( 'Footer Color', 'hyd' ),
	        'section'     => 'colors',
	        'settings'    => 'hyd_footer_color',
	    )
	  )
	);
  $wp_customize->add_control(
	  new WP_Customize_Color_Control(
	    $wp_customize,
	    'hyd_footerfont_color',
	    array(
	      'description' => __( 'Change the footer font color', 'hyd' ),
	        'label'       => __( 'Footer Fonts', 'hyd' ),
	        'section'     => 'colors',
	        'settings'    => 'hyd_footerfont_color',
	    )
	  )
	);
	$wp_customize->add_control(
	  new WP_Customize_Color_Control(
	    $wp_customize,
	    'hyd_primarylink_color',
	    array(
	      'description' => __( 'Change the sites primary link color', 'hyd' ),
	        'label'       => __( 'Primary Link Color', 'hyd' ),
	        'section'     => 'colors',
	        'settings'    => 'hyd_primarylink_color',
	    )
	  )
	);
	$wp_customize->add_control(
	  new WP_Customize_Color_Control(
	    $wp_customize,
	    'hyd_primaryhover_color',
	    array(
	      'description' => __( 'Change the sites primary hover and accent color', 'hyd' ),
	        'label'       => __( 'Hover and Accent Color', 'hyd' ),
	        'section'     => 'colors',
	        'settings'    => 'hyd_primaryhover_color',
	    )
	  )
	);
	$wp_customize->add_control(
	  new WP_Customize_Color_Control(
	    $wp_customize,
	    'hyd_shareicons_color',
	    array(
	      'description' => __( 'Change the color of the Share Icons on blog posts', 'hyd' ),
	        'label'       => __( 'Share Icons on Posts', 'hyd' ),
	        'section'     => 'colors',
	        'settings'    => 'hyd_shareicons_color',
	    )
	  )
	);
  $wp_customize->add_control(
	  new WP_Customize_Color_Control(
	    $wp_customize,
	    'hyd_button_color',
	    array(
	      'description' => __( 'Change the button color', 'hyd' ),
	        'label'       => __( 'Button Color', 'hyd' ),
	        'section'     => 'colors',
	        'settings'    => 'hyd_button_color',
	    )
	  )
	);
  $wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'hyd_buttonfont_color',
			array(
				'description' => __( 'Change the font color on the button.', 'hyd' ),
			    'label'       => __( 'Button Font Color', 'hyd' ),
			    'section'     => 'colors',
			    'settings'    => 'hyd_buttonfont_color',
			)
		)
	);
  $wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'hyd_buttonhover_color',
			array(
				'description' => __( 'Change the hover color on the button.', 'hyd' ),
			    'label'       => __( 'Button Hover', 'hyd' ),
			    'section'     => 'colors',
			    'settings'    => 'hyd_buttonhover_color',
			)
		)
	);
  $wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'hyd_buttonfonthover_color',
			array(
				'description' => __( 'Change the Font color on button hover.', 'hyd' ),
			    'label'       => __( 'Font on Button Hover', 'hyd' ),
			    'section'     => 'colors',
			    'settings'    => 'hyd_buttonfonthover_color',
			)
		)
	);



    //* Add front page setting to the Customizer
    $wp_customize->add_section( 'hyd_blog_section', array(
        'title'    => __( 'Front Page Content Settings', 'hyd' ),
        'description' => __( 'Choose if you would like to display the content section below widget sections on the front page.', 'hyd' ),
        'priority' => 75.01,
    ));

    //* Add front page setting to the Customizer
    $wp_customize->add_setting( 'hyd_blog_setting', array(
        'default'           => 'true',
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize, 'hyd_blog_control', array(
			'label'       => __( 'Front Page Content Section Display', 'hyd' ),
			'description' => __( 'Show or Hide the content section. The section will display on the front page by default.', 'hyd' ),
			'section'     => 'hyd_blog_section',
			'settings'    => 'hyd_blog_setting',
			'type'        => 'select',
			'choices'     => array(
				'false'   => __( 'Hide content section', 'hyd' ),
				'true'    => __( 'Show content section', 'hyd' ),
			),
        ))
	);

    $wp_customize->add_setting( 'hyd_blog_text', array(
		'default'           => __( 'New on the Blog', 'hyd' ),
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_kses_post',
		'type'              => 'option',
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize, 'hyd_blog_text_control', array(
			'label'      => __( 'Blog Section Heading Text', 'hyd' ),
			'description' => __( 'Choose the heading text you would like to display above posts on the front page.<br /><br />This text will show when displaying posts and using widgets on the front page.', 'hyd' ),
			'section'    => 'hyd_blog_section',
			'settings'   => 'hyd_blog_text',
			'type'       => 'text',
		))
	);

}
