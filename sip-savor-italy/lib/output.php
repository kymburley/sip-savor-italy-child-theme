<?php

add_action( 'wp_enqueue_scripts', 'hyd_css' );
/**
* Checks the settings for the link color color, primary color, and header
* If any of these value are set the appropriate CSS is output
*
* @since 1.0.0
*/
function hyd_css() {

	$handle  = defined( 'CHILD_THEME_NAME' ) && CHILD_THEME_NAME ? sanitize_title_with_dashes( CHILD_THEME_NAME ) : 'child-theme';


	$color_navigation = get_theme_mod( 'hyd_navigation_color', hyd_customizer_get_default_navigation_color() );
	$color_navlink = get_theme_mod( 'hyd_navlink_color', hyd_customizer_get_default_navlink_color() );
	$color_navhover = get_theme_mod( 'hyd_navhover_color', hyd_customizer_get_default_navhover_color() );
	$color_imagesection2 = get_theme_mod( 'hyd_imagesection2_color', hyd_customizer_get_default_imagesection2_color() );
	$color_accenttext = get_theme_mod( 'hyd_accenttext_color', hyd_customizer_get_default_accenttext_color() );
	$color_primarylink = get_theme_mod( 'hyd_primarylink_color', hyd_customizer_get_default_primarylink_color() );
	$color_primaryhover = get_theme_mod( 'hyd_primaryhover_color', hyd_customizer_get_default_primaryhover_color() );
	$color_portfolio = get_theme_mod( 'hyd_portfolio_color', hyd_customizer_get_default_portfolio_color() );
	$color_footer = get_theme_mod( 'hyd_footer_color', hyd_customizer_get_default_footer_color() );
	$color_footerfont = get_theme_mod( 'hyd_footerfont_color', hyd_customizer_get_default_footerfont_color() );
	$color_shareicons = get_theme_mod( 'hyd_shareicons_color', hyd_customizer_get_default_shareicons_color() );
	$color_button = get_theme_mod( 'hyd_button_color', hyd_customizer_get_default_button_color() );
	$color_buttonfont = get_theme_mod( 'hyd_buttonfont_color', hyd_customizer_get_default_buttonfont_color() );
	$color_buttonhover = get_theme_mod( 'hyd_buttonhover_color', hyd_customizer_get_default_buttonhover_color() );
	$color_buttonfonthover = get_theme_mod( 'hyd_buttonfonthover_color', hyd_customizer_get_default_buttonfonthover_color() );

  $opts = apply_filters( 'hyd_images', array( '1', '2', '3' ) );

	$settings = array();

	foreach( $opts as $opt ){
		$settings[$opt]['image'] = preg_replace( '/^https?:/', '', get_option( $opt .'-hyd-image', sprintf( '%s/images/bg-%s.jpg', get_stylesheet_directory_uri(), $opt ) ) );
	}

	$css = '';

	foreach ( $settings as $section => $value ) {

		$background = $value['image'] ? sprintf( 'background-image: url(%s);', $value['image'] ) : '';

		if( is_front_page() ) {
			$css .= ( ! empty( $section ) && ! empty( $background ) ) ? sprintf( '.front-page .image-section-%s { %s }', $section, $background ) : '';
		}

	}

	$css .= ( hyd_customizer_get_default_navigation_color() !== $color_navigation ) ? sprintf( '

	.nav-primary {
	    background-color: %1$s;
}

.nav-primary .genesis-nav-menu.responsive-menu,
.nav-secondary .genesis-nav-menu a:hover {
  background: %1$s;
}

@media only screen and (max-width: 960px) {
.responsive-menu-icon {
	color: %1$s;
}
}


		', $color_navigation ) : '';

		$css .= ( hyd_customizer_get_default_navlink_color() !== $color_navlink ) ? sprintf( '

		.nav-primary .genesis-nav-menu a,
		.genesis-nav-menu.responsive-menu > .menu-item-has-children:before,
		.nav-primary .responsive-menu-icon::before,
		.nav-secondary .genesis-nav-menu a:hover   {
		    color: %1$s;
		  }

		.nav-primary .simple-social-icons ul li a {
		  color: %1$s !important;
		  }

@media only screen and (max-width: 960px) {
			.nav-primary .genesis-nav-menu .sub-menu a {
				color: %1$s;
			}
		}


		  ', $color_navlink ) : '';

			$css .= ( hyd_customizer_get_default_navhover_color() !== $color_navhover ) ? sprintf( '

			.nav-primary .genesis-nav-menu a:hover {
			  color: %1$s;
			}

			.nav-primary .simple-social-icons ul li a:hover {
			  color: %1$s !important;
			  }
				@media only screen and (max-width: 960px) {
							.nav-primary .genesis-nav-menu .sub-menu a:hover {
								color: %1$s;
							}
						}

			  ', $color_navhover ) : '';


					$css .= ( hyd_customizer_get_default_imagesection2_color() !== $color_imagesection2 ) ? sprintf( '

					.image-section-2,
					.image-section-2 a,
					.image-section-2 p {
						color: %1$s;
					}

					  ', $color_imagesection2 ) : '';

						$css .= ( hyd_customizer_get_default_accenttext_color() !== $color_accenttext ) ? sprintf( '

						.accent-text h1,
						.front-page .accent-text h1 {
                color: %1$s;
						 }

 						.sidebar .enews {
                 background: %1$s;
 						 }

						  ', $color_accenttext ) : '';


											$css .= ( hyd_customizer_get_default_primarylink_color() !== $color_primarylink ) ? sprintf( '

											a,
											.name {
												color: %1$s;
											}

											.woocommerce span.onsale {
												background-color: %1$s !important;
											}

											  ', $color_primarylink ) : '';


												$css .= ( hyd_customizer_get_default_primaryhover_color() !== $color_primaryhover ) ? sprintf( '

												a:hover,
												.description,
												ul.checkmark li::before {
													color: %1$s;
												}
												.footer-widgets .simple-social-icons ul li a:hover {
													color: %1$s !important;
												}
												.woocommerce .woocommerce-message::before,
												.woocommerce .woocommerce-info::before,
												.woocommerce div.product p.price,
												.woocommerce div.product span.price,
												.woocommerce ul.products li.product .price,
												.woocommerce form .form-row .required {
													color: %1$s !important;
												}
												.woocommerce ul.products li.product a img:hover {
													background: %1$s;
												}

												  ', $color_primaryhover ) : '';

													$css .= ( hyd_customizer_get_default_portfolio_color() !== $color_portfolio ) ? sprintf( '


													ul.filter a.active,
													ul.filter a:hover {
														background-color: %1$s;
														}

													  ', $color_portfolio ) : '';

														$css .= ( hyd_customizer_get_default_footer_color() !== $color_footer ) ? sprintf( '


														.footer-widgets,
														.site-footer,
														.social-bar {
														  background: %1$s;
													}

														  ', $color_footer ) : '';

															$css .= ( hyd_customizer_get_default_footerfont_color() !== $color_footerfont ) ? sprintf( '


															.footer-widgets,
															 .footer-widgets a,
															 .footer-widgets p,
															 .front-page .footer-widgets .widget-title,
															 .footer-widgets .widget-title,
															 .footer-widgets .enews-widget .widget-title,
															 .site-footer,
															 .site-footer a,
															 .footer-widgets .enews p, .front-page .footer-widgets .enews p {
															    color: %1$s;
															  }
																.footer-widgets .simple-social-icons ul li a {
 															    color: %1$s !important;
 															  }


															  ', $color_footerfont ) : '';

							$css .= ( hyd_customizer_get_default_shareicons_color() !== $color_shareicons ) ? sprintf( '

							.share-after::before,
							.sharrre .share,
							.sharrre:hover .share {
							    color: %1$s;
							  }

							  .content .share-filled .facebook .count,
							  .content .share-filled .facebook .count:hover,
							  .content .share-filled .googlePlus .count,
							  .content .share-filled .googlePlus .count:hover,
							  .content .share-filled .linkedin .count,
							  .content .share-filled .linkedin .count:hover,
							  .content .share-filled .pinterest .count,
							  .content .share-filled .pinterest .count:hover,
							  .content .share-filled .stumbleupon .count,
							  .content .share-filled .stumbleupon .count:hover,
							  .content .share-filled .twitter .count,
							  .content .share-filled .twitter .count:hover {
							    color: %1$s;
							    border: 1px solid %1$s;
							  }

							  ', $color_shareicons ) : '';

								$css .= ( hyd_customizer_get_default_button_color() !== $color_button ) ? sprintf( '

.front-page .soliloquy-container .soliloquy-caption a.soliloquy-button,
.pricing-table a.button,
a.more-link,
.more-from-category a,
button,
input[type="button"],
input[type="reset"],
input[type="submit"],
.button  {
	background: %1$s;
}
.footer-widgets .enews-widget input[type="submit"] {
			background: %1$s !important;
		}

div#sb_instagram #sbi_load .sbi_load_btn,
div#sb_instagram .sbi_follow_btn a {
	border: 1px solid %1$s;
	background: %1$s !important;
}

.woocommerce #respond input#submit,
.woocommerce a.button,
.woocommerce button.home-grid,
.woocommerce input.button,
.woocommerce #respond input#submit.alt,
.woocommerce a.button.alt,
.woocommerce button.button.alt,
.woocommerce input.button.alt {
    background-color: %1$s !important;
}

.woocommerce .woocommerce-message,
.woocommerce .woocommerce-info {
	border-top-color: %1$s !important;
}

.front-page .image-section button,
.front-page .image-section input[type="button"],
.front-page .image-section input[type="reset"],
.front-page .image-section input[type="submit"],
.front-page .image-section .textwidget a.button,
.archive-pagination .active a,
.archive-pagination li a:hover {
	background: %1$s;
}


									', $color_button ) : '';


									$css .= ( hyd_customizer_get_default_buttonfont_color() !== $color_buttonfont ) ? sprintf( '

									.front-page .soliloquy-container .soliloquy-caption a.soliloquy-button,
									.pricing-table a.button,
									a.more-link,
									.more-from-category a,
									button,
									input[type="button"],
									input[type="reset"],
									input[type="submit"],
									.button  {
											color: %1$s;
									}
									.footer-widgets .enews-widget input[type="submit"] {
												color: %1$s !important;
											}

									div#sb_instagram #sbi_load .sbi_load_btn,
									div#sb_instagram .sbi_follow_btn a {
										color: %1$s !important;
									}

									.woocommerce #respond input#submit,
									.woocommerce a.button,
									.woocommerce button.home-grid,
									.woocommerce input.button,
									.woocommerce #respond input#submit.alt,
									.woocommerce a.button.alt,
									.woocommerce button.button.alt,
									.woocommerce input.button.alt {
									    color: %1$s !important;
									}

									.front-page .image-section button,
									.front-page .image-section input[type="button"],
									.front-page .image-section input[type="reset"],
									.front-page .image-section input[type="submit"],
									.front-page .image-section .textwidget a.button,
									.archive-pagination .active a,
									.archive-pagination li a:hover {
										color: %1$s;
									}

									  ', $color_buttonfont ) : '';


									$css .= ( hyd_customizer_get_default_buttonhover_color() !== $color_buttonhover ) ? sprintf( '

									.front-page  .soliloquy-container .soliloquy-caption a.soliloquy-button:hover,
									.pricing-table a.button:hover,
									a.more-link:hover,
									.more-from-category a:hover,
									button:hover,
									input:hover[type="button"],
									input:hover[type="reset"],
									input:hover[type="submit"],
									.button:hover {
										background: %1$s !important;
									}
									.footer-widgets .enews-widget input:hover[type="submit"] {
												background: %1$s !important;
											}
									.front-page .image-section button:focus,
									.front-page .image-section button:hover,
									.front-page .image-section input:focus[type="button"],
									.front-page .image-section input:hover[type="button"],
									.front-page .image-section input:focus[type="reset"],
									.front-page .image-section input:hover[type="reset"],
									.front-page .image-section input:focus[type="submit"],
									.front-page .image-section input:hover[type="submit"],
									.front-page .image-section .textwidget a.button:focus,
									.front-page .image-section .textwidget a.button:hover {
										background: %1$s;
									}
									.woocommerce #respond input#submit:hover,
									.woocommerce a.button:hover,
									.woocommerce button.button:hover,
									.woocommerce input.button:hover,
									.woocommerce #respond input#submit.alt:hover,
									.woocommerce a.button.alt:hover,
									.woocommerce button.button.alt:hover,
									.woocommerce input.button.alt:hover   {
									  background: %1$s !important;
									}
									div#sb_instagram #sbi_load .sbi_load_btn:hover,
									div#sb_instagram .sbi_follow_btn a:hover {
										background: %1$s !important;
										border: 1px solid %1$s;
									}

										', $color_buttonhover ) : '';

										$css .= ( hyd_customizer_get_default_buttonfonthover_color() !== $color_buttonfonthover ) ? sprintf( '

										.front-page  .soliloquy-container .soliloquy-caption a.soliloquy-button:hover,
										.pricing-table a.button:hover,
										a.more-link:hover,
										.more-from-category a:hover,
										button:hover,
										input:hover[type="button"],
										input:hover[type="reset"],
										input:hover[type="submit"],
										.button:hover {
											color: %1$s !important;
										}
										.footer-widgets .enews-widget input:hover[type="submit"] {
													color: %1$s !important;
												}
										.front-page .image-section button:focus,
										.front-page .image-section button:hover,
										.front-page .image-section input:focus[type="button"],
										.front-page .image-section input:hover[type="button"],
										.front-page .image-section input:focus[type="reset"],
										.front-page .image-section input:hover[type="reset"],
										.front-page .image-section input:focus[type="submit"],
										.front-page .image-section input:hover[type="submit"],
										.front-page .image-section .textwidget a.button:focus,
										.front-page .image-section .textwidget a.button:hover {
											color: %1$s;
										}
										.woocommerce #respond input#submit:hover,
										.woocommerce a.button:hover,
										.woocommerce button.button:hover,
										.woocommerce input.button:hover,
										.woocommerce #respond input#submit.alt:hover,
										.woocommerce a.button.alt:hover,
										.woocommerce button.button.alt:hover,
										.woocommerce input.button.alt:hover   {
										  color: %1$s !important;
										}
										div#sb_instagram #sbi_load .sbi_load_btn:hover,
										div#sb_instagram .sbi_follow_btn a:hover {
											color: %1$s !important;
										}

										 .footer-widgets .enews-widget input:hover[type="submit"] {
													 color: %1$s !important;
												 }

											', $color_buttonfonthover ) : '';

							if( $css ){
							  wp_add_inline_style( $handle, $css );
}
}
