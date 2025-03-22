<?php
/**
 * Footer copyright
 */

// Footer copyright
$wp_customize->add_section(
	'terminal_blog_footer_section',
	array(
		'title' => esc_html__( 'Footer Options', 'terminal-blog' ),
		'panel' => 'terminal_blog_theme_options_panel',
	)
);

$copyright_default = sprintf( esc_html_x( 'Copyright &copy; %1$s %2$s', '1: Year, 2: Site Title with home URL', 'terminal-blog' ), '[the-year]', '[site-link]' );

// Footer copyright setting.
$wp_customize->add_setting(
	'terminal_blog_copyright_txt',
	array(
		'default'           => $copyright_default,
		'sanitize_callback' => 'terminal_blog_sanitize_html',
	)
);

$wp_customize->add_control(
	'terminal_blog_copyright_txt',
	array(
		'label'   => esc_html__( 'Copyright text', 'terminal-blog' ),
		'section' => 'terminal_blog_footer_section',
		'type'    => 'textarea',
	)
);
