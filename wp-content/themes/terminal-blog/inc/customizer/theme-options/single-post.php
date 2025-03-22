<?php
/**
 * Single Post Options
 */

$wp_customize->add_section(
	'terminal_blog_single_page_options',
	array(
		'title' => esc_html__( 'Single Post Options', 'terminal-blog' ),
		'panel' => 'terminal_blog_theme_options_panel',
	)
);

// Enable single post category setting.
$wp_customize->add_setting(
	'terminal_blog_enable_single_category',
	array(
		'default'           => true,
		'sanitize_callback' => 'terminal_blog_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Terminal_Blog_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'terminal_blog_enable_single_category',
		array(
			'label'    => esc_html__( 'Enable Category', 'terminal-blog' ),
			'settings' => 'terminal_blog_enable_single_category',
			'section'  => 'terminal_blog_single_page_options',
			'type'     => 'checkbox',
		)
	)
);

// Enable single post author setting.
$wp_customize->add_setting(
	'terminal_blog_enable_single_author',
	array(
		'default'           => true,
		'sanitize_callback' => 'terminal_blog_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Terminal_Blog_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'terminal_blog_enable_single_author',
		array(
			'label'    => esc_html__( 'Enable Author', 'terminal-blog' ),
			'settings' => 'terminal_blog_enable_single_author',
			'section'  => 'terminal_blog_single_page_options',
			'type'     => 'checkbox',
		)
	)
);

// Enable single post date setting.
$wp_customize->add_setting(
	'terminal_blog_enable_single_date',
	array(
		'default'           => true,
		'sanitize_callback' => 'terminal_blog_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Terminal_Blog_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'terminal_blog_enable_single_date',
		array(
			'label'    => esc_html__( 'Enable Date', 'terminal-blog' ),
			'settings' => 'terminal_blog_enable_single_date',
			'section'  => 'terminal_blog_single_page_options',
			'type'     => 'checkbox',
		)
	)
);

// Enable single post tag setting.
$wp_customize->add_setting(
	'terminal_blog_enable_single_tag',
	array(
		'default'           => true,
		'sanitize_callback' => 'terminal_blog_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Terminal_Blog_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'terminal_blog_enable_single_tag',
		array(
			'label'    => esc_html__( 'Enable Post Tag', 'terminal-blog' ),
			'settings' => 'terminal_blog_enable_single_tag',
			'section'  => 'terminal_blog_single_page_options',
			'type'     => 'checkbox',
		)
	)
);

// Single post related Posts title label.
$wp_customize->add_setting(
	'terminal_blog_related_posts_title',
	array(
		'default'           => __( 'Related Posts', 'terminal-blog' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'terminal_blog_related_posts_title',
	array(
		'label'    => esc_html__( 'Related Posts Title', 'terminal-blog' ),
		'section'  => 'terminal_blog_single_page_options',
		'settings' => 'terminal_blog_related_posts_title',
	)
);
