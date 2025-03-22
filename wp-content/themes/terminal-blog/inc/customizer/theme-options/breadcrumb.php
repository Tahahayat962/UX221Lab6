<?php
/**
 * Breadcrumb settings
 */

$wp_customize->add_section(
	'terminal_blog_breadcrumb_section',
	array(
		'title' => esc_html__( 'Breadcrumb Options', 'terminal-blog' ),
		'panel' => 'terminal_blog_theme_options_panel',
	)
);

// Breadcrumb enable setting.
$wp_customize->add_setting(
	'terminal_blog_breadcrumb_enable',
	array(
		'default'           => true,
		'sanitize_callback' => 'terminal_blog_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Terminal_Blog_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'terminal_blog_breadcrumb_enable',
		array(
			'label'    => esc_html__( 'Enable breadcrumb.', 'terminal-blog' ),
			'type'     => 'checkbox',
			'settings' => 'terminal_blog_breadcrumb_enable',
			'section'  => 'terminal_blog_breadcrumb_section',
		)
	)
);

// Breadcrumb - Separator.
$wp_customize->add_setting(
	'terminal_blog_breadcrumb_separator',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => '/',
	)
);

$wp_customize->add_control(
	'terminal_blog_breadcrumb_separator',
	array(
		'label'           => esc_html__( 'Separator', 'terminal-blog' ),
		'section'         => 'terminal_blog_breadcrumb_section',
		'active_callback' => function( $control ) {
			return ( $control->manager->get_setting( 'terminal_blog_breadcrumb_enable' )->value() );
		},
	)
);
