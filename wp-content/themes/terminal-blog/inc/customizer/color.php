<?php

/**
 * Color Options
 */

// Site tagline color setting.
$wp_customize->add_setting(
	'terminal_blog_header_tagline',
	array(
		'default'           => '#ffaa3c',
		'sanitize_callback' => 'terminal_blog_sanitize_hex_color',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'terminal_blog_header_tagline',
		array(
			'label'   => esc_html__( 'Site tagline Color', 'terminal-blog' ),
			'section' => 'colors',
		)
	)
);
