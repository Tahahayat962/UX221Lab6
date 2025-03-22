<?php
/**
 * Adore Themes Customizer
 *
 * @package Terminal Blog
 *
 * Banner Section
 */

$wp_customize->add_section(
	'terminal_blog_banner_section',
	array(
		'title'    => esc_html__( 'Banner Section', 'terminal-blog' ),
		'panel'    => 'terminal_blog_frontpage_panel',
		'priority' => 20,
	)
);

// Banner section enable settings.
$wp_customize->add_setting(
	'terminal_blog_banner_section_enable',
	array(
		'default'           => false,
		'sanitize_callback' => 'terminal_blog_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Terminal_Blog_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'terminal_blog_banner_section_enable',
		array(
			'label'    => esc_html__( 'Enable Banner Section', 'terminal-blog' ),
			'type'     => 'checkbox',
			'settings' => 'terminal_blog_banner_section_enable',
			'section'  => 'terminal_blog_banner_section',
		)
	)
);


// Banner title settings.
$wp_customize->add_setting(
	'terminal_blog_banner_section_title',
	array(
		'default'           => __( 'Banner Posts', 'terminal-blog' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'terminal_blog_banner_section_title',
	array(
		'label'           => esc_html__( 'Section Title', 'terminal-blog' ),
		'section'         => 'terminal_blog_banner_section',
		'active_callback' => 'terminal_blog_if_banner_section_enabled',
	)
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'terminal_blog_banner_section_title',
		array(
			'selector'            => '.banner-section h3.section-title',
			'settings'            => 'terminal_blog_banner_section_title',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'terminal_blog_banner_section_title_text_partial',
		)
	);
}

// Banner Section content type settings.
$wp_customize->add_setting(
	'terminal_blog_banner_section_content_type',
	array(
		'default'           => 'post',
		'sanitize_callback' => 'terminal_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'terminal_blog_banner_section_content_type',
	array(
		'label'           => esc_html__( 'Content type:', 'terminal-blog' ),
		'description'     => esc_html__( 'Choose where you want to render the content from.', 'terminal-blog' ),
		'section'         => 'terminal_blog_banner_section',
		'type'            => 'select',
		'active_callback' => 'terminal_blog_if_banner_section_enabled',
		'choices'         => array(
			'post'     => esc_html__( 'Post', 'terminal-blog' ),
			'category' => esc_html__( 'Category', 'terminal-blog' ),
		),
	)
);

for ( $i = 1; $i <= 3; $i++ ) {
	// Banner Section post setting.
	$wp_customize->add_setting(
		'terminal_blog_banner_section_post_' . $i,
		array(
			'sanitize_callback' => 'terminal_blog_sanitize_dropdown_pages',
		)
	);

	$wp_customize->add_control(
		'terminal_blog_banner_section_post_' . $i,
		array(
			'label'           => sprintf( esc_html__( 'Post %d', 'terminal-blog' ), $i ),
			'section'         => 'terminal_blog_banner_section',
			'type'            => 'select',
			'choices'         => terminal_blog_get_post_choices(),
			'active_callback' => 'terminal_blog_banner_section_content_type_post_enabled',
		)
	);

}

// Banner Section category setting.
$wp_customize->add_setting(
	'terminal_blog_banner_section_category',
	array(
		'sanitize_callback' => 'terminal_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'terminal_blog_banner_section_category',
	array(
		'label'           => esc_html__( 'Category', 'terminal-blog' ),
		'section'         => 'terminal_blog_banner_section',
		'type'            => 'select',
		'choices'         => terminal_blog_get_post_cat_choices(),
		'active_callback' => 'terminal_blog_banner_section_content_type_category_enabled',
	)
);

// Banner Section button label setting.
$wp_customize->add_setting(
	'terminal_blog_banner_section_button_label',
	array(
		'default'           => __( 'Read More', 'terminal-blog' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'terminal_blog_banner_section_button_label',
	array(
		'label'           => esc_html__( 'Button Label', 'terminal-blog' ),
		'section'         => 'terminal_blog_banner_section',
		'type'            => 'text',
		'active_callback' => 'terminal_blog_if_banner_section_enabled',
	)
);

/*========================Active Callback==============================*/
function terminal_blog_if_banner_section_enabled( $control ) {
	return $control->manager->get_setting( 'terminal_blog_banner_section_enable' )->value();
}
function terminal_blog_banner_section_content_type_post_enabled( $control ) {
	$content_type = $control->manager->get_setting( 'terminal_blog_banner_section_content_type' )->value();
	return terminal_blog_if_banner_section_enabled( $control ) && ( 'post' === $content_type );
}
function terminal_blog_banner_section_content_type_category_enabled( $control ) {
	$content_type = $control->manager->get_setting( 'terminal_blog_banner_section_content_type' )->value();
	return terminal_blog_if_banner_section_enabled( $control ) && ( 'category' === $content_type );
}
