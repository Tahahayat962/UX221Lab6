<?php
/**
 * Legacy Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Legacy Blog
 */

add_theme_support( 'title-tag' );

add_theme_support( 'automatic-feed-links' );

add_theme_support( 'register_block_style' );

add_theme_support( 'register_block_pattern' );

add_theme_support( 'responsive-embeds' );

add_theme_support( 'wp-block-styles' );

add_theme_support( 'align-wide' );

add_theme_support(
	'html5',
	array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	)
);

add_theme_support(
	'custom-logo',
	array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	)
);

if ( ! function_exists( 'legacy_blog_setup' ) ) :
	function legacy_blog_setup() {
		/*
		* Make child theme available for translation.
		* Translations can be filed in the /languages/ directory.
		*/
		load_child_theme_textdomain( 'legacy-blog', get_stylesheet_directory() . '/languages' );
	}
endif;
add_action( 'after_setup_theme', 'legacy_blog_setup' );

if ( ! function_exists( 'legacy_blog_enqueue_styles' ) ) :
	/**
	 * Enqueue scripts and styles.
	 */
	function legacy_blog_enqueue_styles() {
		$parenthandle = 'terminal-blog-style';
		$theme        = wp_get_theme();

		wp_enqueue_style(
			$parenthandle,
			get_template_directory_uri() . '/style.css',
			array(
				'terminal-blog-fonts',
				'terminal-blog-slick-style',
				'terminal-blog-endless-river-style',
				'terminal-blog-fontawesome-style',
				'terminal-blog-blocks-style',
			),
			$theme->parent()->get( 'Version' )
		);

		wp_enqueue_style(
			'legacy-blog-style',
			get_stylesheet_uri(),
			array( $parenthandle ),
			$theme->get( 'Version' )
		);

	}

endif;

add_action( 'wp_enqueue_scripts', 'legacy_blog_enqueue_styles' );

/**
 * Image sanitization callback example.
 *
 * Checks the image's file extension and mime type against a whitelist. If they're allowed,
 * send back the filename, otherwise, return the setting default.
 *
 * - Sanitization: image file extension
 * - Control: text, WP_Customize_Image_Control
 */
function legacy_blog_sanitize_image( $image, $setting ) {
	/*
	 * Array of valid image file types.
	 *
	 * The array includes image mime types that are included in wp_get_mime_types()
	 */
	$mimes = array(
		'jpg|jpeg|jpe' => 'image/jpeg',
		'gif'          => 'image/gif',
		'png'          => 'image/png',
		'bmp'          => 'image/bmp',
		'tif|tiff'     => 'image/tiff',
		'ico'          => 'image/x-icon',
		'svg'          => 'image/svg+xml',
	);
	// Return an array with file extension and mime_type.
	$file = wp_check_filetype( $image, $mimes );
	// If $image has a valid mime_type, return it; otherwise, return the default.
	return ( $file['ext'] ? $image : $setting->default );
}

// Style for ocdi admin panel.
function legacy_blog_admin_panel_demo_data_download_link() {

	wp_enqueue_style( 'legacy-blog-admin-css', get_theme_file_uri() . '/assets/css/admin.min.css' );

}
add_action( 'admin_enqueue_scripts', 'legacy_blog_admin_panel_demo_data_download_link' );

function legacy_blog_custom_header_setup() {
	
	add_theme_support(
		'custom-header',
		apply_filters(
			'legacy_blog_custom_header_args',
			array(
				'default-image'      => '',
				'default-text-color' => '404040',
				'width'              => 1000,
				'height'             => 250,
				'flex-height'        => true,
				'wp-head-callback'   => 'terminal_blog_header_style',
			)
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'terminal_blog_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);
}
add_action( 'after_setup_theme', 'legacy_blog_custom_header_setup' );

require get_theme_file_path() . '/inc/customizer/customizer.php';

// One Click Demo Import after import setup.
if ( class_exists( 'OCDI_Plugin' ) ) {
	require get_theme_file_path() . '/inc/demo-import.php';
}
