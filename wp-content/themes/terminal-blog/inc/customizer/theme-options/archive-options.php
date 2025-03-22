<?php
/**
 * Blog / Archive Options
 */

$wp_customize->add_section(
	'terminal_blog_archive_page_options',
	array(
		'title' => esc_html__( 'Blog / Archive Pages Options', 'terminal-blog' ),
		'panel' => 'terminal_blog_theme_options_panel',
	)
);

// Excerpt - Excerpt Length.
$wp_customize->add_setting(
	'terminal_blog_excerpt_length',
	array(
		'default'           => 20,
		'sanitize_callback' => 'terminal_blog_sanitize_number_range',
	)
);

$wp_customize->add_control(
	'terminal_blog_excerpt_length',
	array(
		'label'       => esc_html__( 'Excerpt Length (no. of words)', 'terminal-blog' ),
		'section'     => 'terminal_blog_archive_page_options',
		'settings'    => 'terminal_blog_excerpt_length',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 5,
			'max'  => 200,
			'step' => 1,
		),
	)
);

// Enable archive page category setting.
$wp_customize->add_setting(
	'terminal_blog_enable_archive_category',
	array(
		'default'           => true,
		'sanitize_callback' => 'terminal_blog_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Terminal_Blog_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'terminal_blog_enable_archive_category',
		array(
			'label'    => esc_html__( 'Enable Category', 'terminal-blog' ),
			'settings' => 'terminal_blog_enable_archive_category',
			'section'  => 'terminal_blog_archive_page_options',
			'type'     => 'checkbox',
		)
	)
);

// Enable archive page author setting.
$wp_customize->add_setting(
	'terminal_blog_enable_archive_author',
	array(
		'default'           => true,
		'sanitize_callback' => 'terminal_blog_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Terminal_Blog_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'terminal_blog_enable_archive_author',
		array(
			'label'    => esc_html__( 'Enable Author', 'terminal-blog' ),
			'settings' => 'terminal_blog_enable_archive_author',
			'section'  => 'terminal_blog_archive_page_options',
			'type'     => 'checkbox',
		)
	)
);

// Enable archive page date setting.
$wp_customize->add_setting(
	'terminal_blog_enable_archive_date',
	array(
		'default'           => true,
		'sanitize_callback' => 'terminal_blog_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Terminal_Blog_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'terminal_blog_enable_archive_date',
		array(
			'label'    => esc_html__( 'Enable Date', 'terminal-blog' ),
			'settings' => 'terminal_blog_enable_archive_date',
			'section'  => 'terminal_blog_archive_page_options',
			'type'     => 'checkbox',
		)
	)
);
