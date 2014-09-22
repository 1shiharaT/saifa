<?php
/**
 * Output file theme customizer.
 * =====================================================
 * @package  Saifa
 * @license  GPLv2 or later
 * @since 1.2.0
 * =====================================================''
 */


/**
 * Clean up output of stylesheet <link> tags
 * @since 1.2.0
 */
function saifa_clean_style_tag( $input ) {

	preg_match_all( "!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!", $input, $matches );
	// Only display media if it is meaningful
	$media = $matches[3][0] !== '' && $matches[3][0] !== 'all' ? ' media="' . $matches[3][0] . '"' : '';
	return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";

}

add_filter( 'style_loader_tag', 'saifa_clean_style_tag' );

/**
 * Set of theme customizer.
 * @since 1.2.0
 */

add_filter( 'saifa_theme_customizer_settings', 'saifa_customizer_settings', 1 );

function saifa_customizer_settings(){
		/**
		 * 0. General
		 */
		$settings['saifa_general'] = array(
			'title' => __( 'General', 'saifa' ), // Panel title
			'description' => __( 'Please have a set of general setting.', 'saifa' ),
			'section' => array(
				'saifa_google_analytics' => array(
					'title' => __( 'Google Analytics - Tracking code', 'saifa' ),
					'setting' => array(
						'tracking_code' => array(
							'label' => __( 'Tracking Code', 'saifa' ),
							'default' => '',
							'type' => 'textarea',
							'sanitaize_call_back' => '',
						),
					),
				),
				'saifa_meta_description' => array(
					'title' => __( 'Meta Description', 'saifa' ),
					'setting' => array(
						'meta_description' => array(
							'label' => __( 'Meta Description', 'saifa' ),
							'default' => get_bloginfo( 'description' ),
							'type' => 'textarea',
							'sanitaize_call_back' => '',
						),
					),
				),
				'saifa_meta_keyword' => array(
					'title' => __( 'Meta Keyword', 'saifa' ),
					'setting' => array(
						'meta_keyword' => array(
							'label' => __( 'Meta Keyword', 'saifa' ),
							'default' => '',
							'type' => 'text',
							'sanitaize_call_back' => '',
						),
					),
				),
				'saifa_favicon' => array(
					'title' => __( 'Favicon', 'saifa' ),
					'description' => __( '16  16 px .ico file or .png', 'saifa' ),
					'setting' => array(
						'meta_favicon' => array(
							'label' => __( 'Favicon', 'saifa' ),
							'default' => '',
							'type' => 'multi-image',
							'sanitaize_call_back' => '',
						),
					),
				),
			),
		);
		/**
		 * 01. Header
		 */
		$settings['saifa_header'] = array(
			'title' => __( 'Header', 'saifa' ), // Panel title
			'description' => __( 'Please have a set of headers.', 'saifa' ),
			'section' => array(
				'saifa_header_style' => array(
					'title' => __( 'Header Style', 'saifa' ),
					'setting' => array(
						'header_style' => array(
							'label' => __( 'Header Style', 'saifa' ),
							'default' => 'normal',
							'type' => 'radio',
							'sanitaize_call_back' => '',
							'choices' => array(
								'normal' => __( 'Normal', 'saifa' ),
								'minimal' => __( 'Minimal', 'saifa' ),
							),
						),
					),
				),
				'saifa_logo' => array(
					'title' => __( 'Logo', 'saifa' ),
					'setting' => array(
						'logo_font_size' => array(
							'label' => __( 'Font Size', 'saifa' ),
							'default' => 1.0,
							'type' => 'select',
							'sanitaize_call_back' => '',
							'choices' => array(
								'1.0' => '0',
								'1.1' => '1',
								'1.2' => '2',
								'1.3' => '3',
								'1.4' => '4',
								'1.5' => '5',
								'1.6' => '6',
								'1.7' => '7',
								'1.8' => '8',
								'1.9' => '9',
								'2.0' => '10',
							),
							'output' => array(
								'.header-logo a' => 'font-size',
							),
							'output_unit' => 'em',
						),
						'logo_color' => array(
							'label' => __( 'Color', 'saifa' ),
							'default' => '#FFFFFF',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'.header-logo a' => 'color',
							)
						),
					)
				),

				'saifa_header' => array(
					'title' => __( 'Background', 'saifa' ),
					'setting' => array(
						'header_background_image' => array(
							'label' => __( 'Background Image', 'saifa' ),
							'default' => get_template_directory_uri() . '/assets/images/header-bg.png',
							'type' => 'multi-image',
							'sanitaize_call_back' => '',
							'output' => array(
								'#masthead' => 'background-image',
							)
						),
						'header_background_attachment' => array(
							'label' => __( 'Background Attachment', 'saifa' ),
							'default' => 'fixed',
							'type' => 'radio',
							'sanitaize_call_back' => '',
							'choices' => array(
								'fixed' => __( 'Fixed', 'saifa' ),
								'scroll' => __( 'Scroll', 'saifa' ),
							),
							'output' => array(
								'#masthead' => 'background-attachment',
							)
						),
						'header_background_color' => array(
							'label' => __( 'Background Color', 'saifa' ),
							'default' => '#666666',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'#masthead' => 'background-color',
							),
						),
					),
				),
				// navigation section
				'saifa_navigation_color' => array(
					'title' => __( 'Navigation Color ', 'saifa' ),
					'description' => __( 'Setting for Theme color.', 'saifa' ),
					'setting' => array(
						'nav_background_color' => array(
							'label' => __( 'Normal Background', 'saifa' ),
							'default' => '#3695b5',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'.navbar-collapse>ul>li>a'                   => 'background-color',
								'.navbar-collapse>ul>li .dropdown-menu>li>a' => 'background-color',
							),
						),
						'nav_background_hover_color' => array(
							'label' => __( 'Hover Background', 'saifa' ),
							'default' => '#3695b5',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'.navbar-collapse>ul>li>a:hover'                   => 'background-color',
								'.navbar-collapse>ul>li .dropdown-menu>li>a:hover'                   => 'color',
							),
						),
						'nav_background_active_color' => array(
							'label' => __( 'Active Background', 'saifa' ),
							'default' => '#3695b5',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'.navbar-collapse>ul>li>a:active,.navbar-collapse>ul>li.current-menu-item a'                   => 'background-color',
							),
						),
						'nav_font_size' => array(
							'label' => __( 'Navigation Font Size', 'saifa' ),
							'default' => '1.0',
							'type' => 'select',
							'sanitaize_call_back' => '',
							'choices' => array(
								'0.7' => '0.7 em',
								'0.8' => '0.8 em',
								'0.9' => '0.9 em',
								'1.0' => '1.0 em',
								'1.1' => '1.1 em',
								'1.2' => '1.2 em',
								'1.3' => '1.3 em',
								'1.4' => '1.4 em',
								'1.5' => '1.5 em',
								'1.6' => '1.6 em',
								'1.7' => '1.7 em',
								'1.8' => '1.8 em',
								'1.9' => '1.9 em',
								'2.0' => '2.1 em',
							),
							'output' => array(
								'.navbar-collapse ul li a ' => 'font-size',
								'.navbar-collapse ul li a' => 'line-height',
								'.navbar-collapse ul.dropdown-menu a' => 'font-size',
								'.navbar-collapse ul.dropdown-menu a ' => 'line-height',
							),
							'output_unit' => 'em',
						),
					),
				),
			)
		);

		/**
		 * 02. Theme Color
		 */
		$settings['saifa_theme_color'] = array(
			'title' => __( 'Theme Color', 'saifa' ), // Panel title
			'section' => array(
				// theme color section
				'saifa_theme_color' => array(
					'title' => __( 'Theme Color ', 'saifa' ),
					'description' => __( 'Setting for Theme color.', 'saifa' ),
					'setting' => array(
						'theme_color' => array(
							'label' => __( 'Theme Color', 'saifa' ),
							'default' => '#3695b5',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'a,#reply-title,.breadcrumbs ul:before' => 'color',
								'.pagination .prev,.pagination .next,.comment-title,.entry-meta .byline,.posted-on'=> 'background-color',
								'.pagination .prev,.pagination .next,.nav-links div,input[type=text],input[type=search],textarea,.widget_search .input-group .form-control' => 'border-color',
								'.widget-sidebar li:nth-child(even):hover,.widget-sidebar li:hover,.nav-links div:hover' => 'background-color',
								'.pagination .page-numbers.current,.widget-title:after,th,.footer-copyright'                                 => 'background-color',
								'.archive .hentry.post:before, .search .hentry.post:before, .home .hentry.post:before' => 'background-color',
							),
						),
					),
				),
				'saifa_button_color' => array(
					'title' => __( 'Button Color ', 'saifa' ),
					'description' => __( 'Setting for button color.', 'saifa' ),
					'setting' => array(
						'button_color' => array(
							'label' => __( 'Button Color', 'saifa' ),
							'default' => '#3695b5',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'.btn, #submit,input[type=submit]'          => 'background-color',
								'.btn, #submit,input[type=submit] '          => 'border-color',
							),
						),
					),
				),
			),
		);

		$font_size_choices = array(
								'0.8' => '0.8 em',
								'0.9' => '0.9 em',
								'1.0' => '1.0 em',
								'1.1' => '1.1 em',
								'1.2' => '1.2 em',
								'1.3' => '1.3 em',
								'1.4' => '1.4 em',
								'1.5' => '1.5 em',
								'1.6' => '1.6 em',
								'1.7' => '1.7 em',
								'1.8' => '1.8 em',
								'1.9' => '1.9 em',
								'2.0' => '2.1 em',
		);

		/**
		 * 03. body
		 */
		$settings['saifa_body'] = array(
			'title' => __( 'Body Settings', 'saifa' ), // Panel title
			'description' => __( 'Please have a set of body.', 'saifa' ),
			'section' => array(
				'saifa_body' => array(
					'title' => __( 'Body ', 'saifa' ),
					'setting' => array(
						'body_background_color' => array(
							'label' => __( 'Background Color', 'saifa' ),
							'default' => '#FFFFFF',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'body' => 'background-color',
							),
						),
						'body_background_image' => array(
							'label' => __( 'Background Image', 'saifa' ),
							'default' => 'transparent',
							'type' => 'multi-image',
							'sanitaize_call_back' => '',
							'output' => array(
								'body' => 'background-image',
							)
						),
						'body_background_attachment' => array(
							'label' => __( 'Background Attachment', 'saifa' ),
							'default' => 'fixed',
							'type' => 'radio',
							'sanitaize_call_back' => '',
							'choices' => array(
								'fixed' => __( 'Fixed', 'saifa' ),
								'initial' => __( 'Initial', 'saifa' ),
							),
							'output' => array(
								'body' => 'background-attachment',
							)
						),
						'body_background_size' => array(
							'label' => __( 'Background Size', 'saifa' ),
							'default' => '100% auto',
							'type' => 'radio',
							'sanitaize_call_back' => '',
							'choices' => array(
								'auto auto' => __( 'Horizontal : auto Vertical : auto', 'saifa' ),
								'100% auto' => __( 'Horizontal : 100%, Vertical : auto', 'saifa' ),
								'auto 100%' => __( 'Horizontal : auto, Vertical : 100%', 'saifa' ),
								'100% 100%' => __( 'Horizontal : 100%, Vertical : 100%', 'saifa' ),
							),
							'output' => array(
								'body' => 'background-size',
							)
						),
					)
				),
				'saifa_heading' => array(
					'title' => __( 'Headings', 'saifa' ),
					'setting' => array(
						'heading_color' => array(
							'label' => __( 'Heading Color', 'saifa' ),
							'default' => '#3695b5',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'.entry-title,.entry-title a,.page-header .page-title,h1,h2,h3,h4,h5,h6,.widget-title' => 'color',
							),
						),
						'heading_1_font_size' => array(
							'label' => __( 'H1 Font Size', 'saifa' ),
							'default' => '2.0',
							'type' => 'select',
							'sanitaize_call_back' => '',
							'choices' => $font_size_choices,
							'output' => array(
								// 'h1' => 'font-size',
								// 'h1' => 'line-height',
							),
							'output_unit' => 'em',
						),
						'heading_2_font_size' => array(
							'label' => __( 'H2 Font Size', 'saifa' ),
							'default' => '1.8',
							'type' => 'select',
							'sanitaize_call_back' => '',
							'choices' => $font_size_choices,
							'output' => array(
								// 'h2' => 'font-size',
								// 'h2' => 'line-height',
							),
							'output_unit' => 'em',
						),
						'heading_3_font_size' => array(
							'label' => __( 'H3 Font Size', 'saifa' ),
							'default' => '1.6',
							'type' => 'select',
							'sanitaize_call_back' => '',
							'choices' => $font_size_choices,
							'output' => array(
								// 'h3' => 'font-size',
								// 'h3' => 'line-height',
							),
							'output_unit' => 'em',
						),
						'heading_4_font_size' => array(
							'label' => __( 'H4 Font Size', 'saifa' ),
							'default' => '1.6',
							'type' => 'select',
							'sanitaize_call_back' => '',
							'choices' => $font_size_choices,
							'output' => array(
								// 'h4' => 'font-size',
								// 'h4' => 'line-height',
							),
							'output_unit' => 'em',
						),
						'heading_5_font_size' => array(
							'label' => __( 'H5 Font Size', 'saifa' ),
							'default' => '1.6',
							'type' => 'select',
							'sanitaize_call_back' => '',
							'choices' => $font_size_choices,
							'output' => array(
								// 'h5' => 'font-size',
								// 'h5' => 'line-height',
							),
							'output_unit' => 'em',
						),
						'heading_6_font_size' => array(
							'label' => __( 'H6 Font Size', 'saifa' ),
							'default' => '1.6',
							'type' => 'select',
							'sanitaize_call_back' => '',
							'choices' => $font_size_choices,
							'output' => array(
								// 'h6' => 'font-size',
								// 'h6' => 'line-height',
							),
							'output_unit' => 'em',
						),
					)
				),
				'saifa_text' => array(
					'title' => __( 'Text', 'saifa' ),
					'setting' => array(
						'text_color' => array(
							'label' => __( 'Text Color', 'saifa' ),
							'default' => '#333',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'body' => 'color',
								'p'    => 'color',
							),
						),
						'text_font_size' => array(
							'label' => __( 'Base Font Size', 'saifa' ),
							'default' => 1.0,
							'type' => 'select',
							'sanitaize_call_back' => '',
							'choices' => array(
								'0.8' => '0.8',
								'0.9' => '0.9',
								'1.0' => '1.0',
								'1.1' => '1.1',
								'1.2' => '1.2',
								'1.3' => '1.3',
								'1.4' => '1.4',
								'1.5' => '1.5',
								'1.6' => '1.6',
								'1.7' => '1.7',
								'1.8' => '1.8',
								'1.9' => '1.9',
								'2.0' => '2.1',
							),
							'output' => array(
								'body' => 'font-size',
								// 'ul li' => 'font-size',
							),
							'output_unit' => 'em',
						),
					),
				),
			)
		);

		/**
		 * 03. Social
		 */
		$settings['saifa_social'] = array(
			'title' => __( 'Social Settings', 'saifa' ), // Panel title
			'description' => __( 'Please have a set of social.', 'saifa' ),
			'section' => array(
				'saifa_social' => array(
					'title' => __( 'Social link', 'saifa' ),
					'description' => __( 'Please enter the link of social services.', 'saifa' ),
					'setting' => array(
						'socal_facebook' => array(
							'label' => __( 'Facebook URL', 'saifa' ),
							'default' => '',
							'type' => 'text',
							'sanitaize_call_back' => '',
						),
						'socal_twitter' => array(
							'label' => __( 'Twitter URL', 'saifa' ),
							'default' => '',
							'type' => 'text',
							'sanitaize_call_back' => '',
						),
						'socal_github' => array(
							'label' => __( 'Github URL', 'saifa' ),
							'default' => '',
							'type' => 'text',
							'sanitaize_call_back' => '',
						),
						'socal_google_plus' => array(
							'label' => __( 'Google+ URL', 'saifa' ),
							'default' => '',
							'type' => 'text',
							'sanitaize_call_back' => '',
						),
					),
				),
			),
		);
		/**
		 * 04. Footer
		 */
		$settings['saifa_footer'] = array(
			'title' => __( 'Footer', 'saifa' ), // Panel title
			'description' => __( 'Please have a set of footer.', 'saifa' ),
			'section' => array(

				'saifa_footer' => array(
					'title' => __( 'Background', 'saifa' ),
					'setting' => array(
						'footer_background_image' => array(
							'label' => __( 'Background Image', 'saifa' ),
							'default' => get_template_directory_uri() . '/assets/images/footer-bg.png',
							'type' => 'multi-image',
							'sanitaize_call_back' => '',
							'output' => array(
								'#colophon' => 'background-image',
							)
						),
						'footer_background_attachment' => array(
							'label' => __( 'Background Attachment', 'saifa' ),
							'default' => 'fixed',
							'type' => 'radio',
							'sanitaize_call_back' => '',
							'choices' => array(
								'fixed' => __( 'Fixed', 'saifa' ),
								'scroll' => __( 'Scroll', 'saifa' ),
							),
							'output' => array(
								'#colophon' => 'background-attachment',
							)
						),
						'footer_background_color' => array(
							'label' => __( 'Background Color', 'saifa' ),
							'default' => '#666666',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'#colophon' => 'background-color',
							),
						),
					),
				),

				// navigation section
				'saifa_scrolltop' => array(
					'title' => __( 'Scroll Top', 'saifa' ),
					'description' => __( 'Setting for Scroll top.', 'saifa' ),
					'setting' => array(
						'scroll_display' => array(
							'label' => __( 'Display', 'saifa' ),
							'default' => 'true',
							'type' => 'radio',
							'sanitaize_call_back' => '',
							'choices' => array(
								'true' => __( 'Yes', 'saifa' ),
								'false' => __( 'None', 'saifa' ),
							)
						),
						'scroll_background_color' => array(
							'label' => __( 'Page Top Background', 'saifa' ),
							'default' => '#3695b5',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'#scroll-top a' => 'background-color',
							),
						),
					),
				),
				// navigation section
				'saifa_copyright' => array(
					'title' => __( 'Copyright', 'saifa' ),
					'description' => __( 'Setting for Copyright.', 'saifa' ),
					'setting' => array(
						'copyright_text' => array(
							'label' => __( 'Copyright text', 'saifa' ),
							'default' =>  'copyright © ' . get_the_date( 'Y' ) . get_bloginfo( 'name' ),
							'type' => 'text',
							'sanitaize_call_back' => '',
						),
						'copyright_background' => array(
							'label' => __( 'Copyright Background', 'saifa' ),
							'default' => '#3695b5',
							'type' => 'color',
							'sanitaize_call_back' => '',
							'output' => array(
								'.footer-copyright'                   => 'background-color',
							),
						),
					),
				),
			)
		);

	return $settings;
}

/**
 * Theme Scroll top
 * @since 1.2.0
 */

function saifa_scroll_top(){
	if ( 'true' === get_theme_mod( 'scroll_display', false ) ) {
		echo '<div id="scroll-top"><a href="#"><i class="fa fa-angle-up"></i></a></div>';
	}
}

add_action( 'get_footer', 'saifa_scroll_top' );

/**
 * Google Analytics - Tracking
 * @since 1.2.0
 */

function saifa_tracking_code(){
	$traking_code = get_theme_mod( 'tracking_code', false );
	if ( $traking_code ) {
		echo '<!-- Google Analytics -->
' . $traking_code .
'
';
	}
}

add_action( 'wp_footer', 'saifa_tracking_code' );

/**
 * output meta tag to wp_head
 * @since 1.2.0
 */

function saifa_meta_tag(){

	$meta_tag         = '';
	$meta_description = get_theme_mod( 'meta_description', false );
	$meta_keyword     = get_theme_mod( 'meta_keyword', false );

	if ( $meta_description ) {
		$meta_tag .= '<meta name="description" content="' . esc_html( $meta_description ) . '">' . "\n";
	}

	if ( $meta_keyword ) {
		$meta_tag .=  '<meta name="keywords" content="' . esc_html( $meta_keyword ) . '">' . "\n";
	}

	echo $meta_tag;

}

add_action( 'wp_head', 'saifa_meta_tag', 10 );

/**
 * output favicon tag to wp_head
 * @since 1.2.0
 */

function saifa_favicon(){

	$favicon_tag         = '';
	$favicon = get_theme_mod( 'meta_favicon', false );


	if ( $favicon ) {
		$favicon_tag .= '<link rel="shortcut icon" href="' . esc_url( $favicon ) . '">' . "\n";
	}

	echo $favicon_tag;

}

add_action( 'wp_head', 'saifa_favicon', 10 );
