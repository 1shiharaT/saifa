<?php
/**
 * Setup script for this theme
 * =====================================================
 * @package  Saifa
 * @license  GPLv2 or later
 * @since 1.0.0
 * =====================================================''
 */

/**
 * Setup support for theme.
 * @return void
 */

if ( ! function_exists( 'saifa_setup' ) ) {

	function saifa_setup(){

		load_theme_textdomain( 'saifa', get_template_directory() . '/languages' );

		// Supports automatic feed.
		add_theme_support( 'automatic-feed-links' );

		// Supports for Breadcrumbs.
		add_theme_support( 'saifa-breadcrumbs' );

		// Supports for pagination.
		add_theme_support( 'saifa-pagination' );

		// Support for eye-catching image.
		add_theme_support( 'post-thumbnails' );

		// support for menus
		add_theme_support( 'menus' );

		// supports for responsive navigation
		add_theme_support( 'responsive-nav' );

		// Add HTML5 markup structure
		add_theme_support(
			'html5',
			array(
				'comment-list',
				'search-form',
				'comment-form',
				'gallery',
				'caption',
			)
		);

		// registration header navigation
		register_nav_menus( array( 'primary' => __( 'Header Primary Navigation', 'saifa' ) ) );

		// editor-style
		add_editor_style( 'assets/css/editor-style.css' );

	}

	add_action( 'after_setup_theme', 'saifa_setup' );

}

/**
 * Clean up head
 *
 */

function saifa_head_cleanup(){

	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

	global $wp_widget_factory;

	remove_action( 'wp_head',
		array(
			$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
			'recent_comments_style',
		)
	);
}

add_filter( 'init', 'saifa_head_cleanup', 10 );

/**
 * Print browserSync client script tag.
 *
 * @return void
 */

add_action( 'wp_footer', 'saifa_print_browser_sync', 99 );

function saifa_print_browser_sync(){

	$output = '';
	if ( defined( 'BROWSERSYNC_MODE' )
			 && true === BROWSERSYNC_MODE ) {

		$output = <<<EOF
<script type='text/javascript'>//<![CDATA[
document.write("<script async src='//HOST:3000/browser-sync/browser-sync-client.1.5.0.js'><\/script>".replace(/HOST/g, location.hostname));
//]]></script>
EOF;
		echo $output;
	}

}

/**
 * Get an avatar
 * @param  string $avatar
 * @param  string $type
 * @return string
 */

function saifa_get_avatar( $avatar, $type ){

	if ( ! is_object( $type ) ) {
		return $avatar;
	}

	$avatar = str_replace( "class='avatar", "class='avatar left media-object", $avatar );

	return $avatar;

}
// filter hook for "get_avater"
add_filter( 'get_avatar', 'saifa_get_avatar', 10, 2 );


/**
 * Change Search form template
 */
add_filter( 'get_search_form', 'epinoge_search_form' );

function epinoge_search_form( $form ) {

	ob_start();
	get_template_part( 'modules/searchform' );
	$form = ob_get_clean();
	return $form;

}

/**
 * Function to include the breadcrumb navigation
 * @return void
 * @since 1.1.0
 */
function saifa_include_breadcrumbs(){

	if ( current_theme_supports( 'saifa-breadcrumbs' ) ) {
		get_template_part( 'modules/breadcrumbs' );
	}

}

add_action( 'get_main_template_before', 'saifa_include_breadcrumbs' );

/**
 * Function to include the pagination.
 * @since 1.1.0
 * @return void
 */
function saifa_include_pagination(){

	if ( current_theme_supports( 'saifa-pagination' ) ) {
		get_template_part( 'modules/pagination' );
	}

}

add_action( 'get_main_template_after', 'saifa_include_pagination' );


add_action( 'tgmpa_register', 'saifa_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function saifa_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // This is an example of how to include a plugin pre-packaged with a theme.
        array(
            'name'               => 'Meta Slider',
            'slug'               => 'ml-slider',
            'required'           => true,
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => '',
        ),

        // This is an example of how to include a plugin pre-packaged with a theme.
        array(
            'name'               => 'Black Studio TinyMCE Widget',
            'slug'               => 'black-studio-tinymce-widget',
            'required'           => true,
            'force_activation'   => true,
            'force_deactivation' => false,
            'external_url'       => '',
        ),

    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'saifa' ),
            'menu_title'                      => __( 'Install Plugins', 'saifa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'saifa' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'saifa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'saifa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'saifa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'saifa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}
