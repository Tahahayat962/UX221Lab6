<?php

/**
 * Theme Options Customizer.
 */

$wp_customize->add_panel(
	'terminal_blog_theme_options_panel',
	array(
		'title'    => esc_html__( 'Theme Options', 'terminal-blog' ),
		'priority' => 150,
	)
);

$theme_options_customizer = array( 'font-options', 'breadcrumb', 'loader', 'archive-options', 'sidebar-layout', 'pagination', 'single-post', 'footer' );

foreach ( $theme_options_customizer as $customizer ) {
	require get_template_directory() . '/inc/customizer/theme-options/' . $customizer . '.php';

}
