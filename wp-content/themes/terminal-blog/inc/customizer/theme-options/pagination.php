<?php
/**
 * Pagination setting
 */

// Pagination setting.
$wp_customize->add_section(
	'terminal_blog_pagination',
	array(
		'title' => esc_html__( 'Pagination', 'terminal-blog' ),
		'panel' => 'terminal_blog_theme_options_panel',
	)
);

// Pagination enable setting.
$wp_customize->add_setting(
	'terminal_blog_pagination_enable',
	array(
		'default'           => true,
		'sanitize_callback' => 'terminal_blog_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Terminal_Blog_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'terminal_blog_pagination_enable',
		array(
			'label'    => esc_html__( 'Enable Pagination.', 'terminal-blog' ),
			'settings' => 'terminal_blog_pagination_enable',
			'section'  => 'terminal_blog_pagination',
			'type'     => 'checkbox',
		)
	)
);

// Pagination - Pagination Style.
$wp_customize->add_setting(
	'terminal_blog_pagination_type',
	array(
		'default'           => 'numeric',
		'sanitize_callback' => 'terminal_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'terminal_blog_pagination_type',
	array(
		'label'           => esc_html__( 'Pagination Style', 'terminal-blog' ),
		'section'         => 'terminal_blog_pagination',
		'type'            => 'select',
		'choices'         => array(
			'default' => __( 'Default (Older/Newer)', 'terminal-blog' ),
			'numeric' => __( 'Numeric', 'terminal-blog' ),
		),
		'active_callback' => function( $control ) {
			return ( $control->manager->get_setting( 'terminal_blog_pagination_enable' )->value() );
		},
	)
);
