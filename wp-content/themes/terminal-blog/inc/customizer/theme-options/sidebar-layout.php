<?php
/**
 * Sidebar settings
 */

$wp_customize->add_section(
	'terminal_blog_sidebar_option',
	array(
		'title' => esc_html__( 'Sidebar Options', 'terminal-blog' ),
		'panel' => 'terminal_blog_theme_options_panel',
	)
);

// Sidebar Option - Global Sidebar Position.
$wp_customize->add_setting(
	'terminal_blog_sidebar_position',
	array(
		'sanitize_callback' => 'terminal_blog_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'terminal_blog_sidebar_position',
	array(
		'label'   => esc_html__( 'Global Sidebar Position', 'terminal-blog' ),
		'section' => 'terminal_blog_sidebar_option',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'terminal-blog' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'terminal-blog' ),
		),
	)
);

// Sidebar Option - Post Sidebar Position.
$wp_customize->add_setting(
	'terminal_blog_post_sidebar_position',
	array(
		'sanitize_callback' => 'terminal_blog_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'terminal_blog_post_sidebar_position',
	array(
		'label'   => esc_html__( 'Post Sidebar Position', 'terminal-blog' ),
		'section' => 'terminal_blog_sidebar_option',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'terminal-blog' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'terminal-blog' ),
		),
	)
);

// Sidebar Option - Page Sidebar Position.
$wp_customize->add_setting(
	'terminal_blog_page_sidebar_position',
	array(
		'sanitize_callback' => 'terminal_blog_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'terminal_blog_page_sidebar_position',
	array(
		'label'   => esc_html__( 'Page Sidebar Position', 'terminal-blog' ),
		'section' => 'terminal_blog_sidebar_option',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'terminal-blog' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'terminal-blog' ),
		),
	)
);
