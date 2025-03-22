<?php
/**
 * Loader setting
 */

// Page Loader setting.
$wp_customize->add_section(
	'terminal_blog_page_loader',
	array(
		'title' => esc_html__( 'Page Loader', 'terminal-blog' ),
		'panel' => 'terminal_blog_theme_options_panel',
	)
);

// Loader Text Label settings.
$wp_customize->add_setting(
	'terminal_blog_loader_text',
	array(
		'default'           => __( 'Loading', 'terminal-blog' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'terminal_blog_loader_text',
	array(
		'label'   => esc_html__( 'Loader Text Label', 'terminal-blog' ),
		'section' => 'terminal_blog_page_loader',
	)
);
