<?php
/**
 * Adore Themes Customizer
 *
 * @package Terminal Blog
 *
 * Posts Grid Section
 */

$wp_customize->add_section(
	'terminal_blog_posts_grid_section',
	array(
		'title'    => esc_html__( 'Posts Grid Section', 'terminal-blog' ),
		'panel'    => 'terminal_blog_frontpage_panel',
		'priority' => 30,
	)
);

// Posts Grid section enable settings.
$wp_customize->add_setting(
	'terminal_blog_posts_grid_section_enable',
	array(
		'default'           => false,
		'sanitize_callback' => 'terminal_blog_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Terminal_Blog_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'terminal_blog_posts_grid_section_enable',
		array(
			'label'    => esc_html__( 'Enable Posts Grid Section', 'terminal-blog' ),
			'type'     => 'checkbox',
			'settings' => 'terminal_blog_posts_grid_section_enable',
			'section'  => 'terminal_blog_posts_grid_section',
		)
	)
);

// Posts Grid title settings.
$wp_customize->add_setting(
	'terminal_blog_posts_grid_title',
	array(
		'default'           => __( 'Grid Posts', 'terminal-blog' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'terminal_blog_posts_grid_title',
	array(
		'label'           => esc_html__( 'Section Title', 'terminal-blog' ),
		'section'         => 'terminal_blog_posts_grid_section',
		'active_callback' => 'terminal_blog_if_posts_grid_enabled',
	)
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'terminal_blog_posts_grid_title',
		array(
			'selector'            => '.post-grid-section h3.section-title',
			'settings'            => 'terminal_blog_posts_grid_title',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'terminal_blog_posts_grid_title_text_partial',
		)
	);
}

// View All button label setting.
$wp_customize->add_setting(
	'terminal_blog_posts_grid_view_all_button_label',
	array(
		'default'           => __( 'View All', 'terminal-blog' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'terminal_blog_posts_grid_view_all_button_label',
	array(
		'label'           => esc_html__( 'View All Button Label', 'terminal-blog' ),
		'section'         => 'terminal_blog_posts_grid_section',
		'settings'        => 'terminal_blog_posts_grid_view_all_button_label',
		'type'            => 'text',
		'active_callback' => 'terminal_blog_if_posts_grid_enabled',
	)
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'terminal_blog_posts_grid_view_all_button_label',
		array(
			'selector'            => '.post-grid-section .adore-view-all',
			'settings'            => 'terminal_blog_posts_grid_view_all_button_label',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'terminal_blog_posts_grid_view_all_button_label_text_partial',
		)
	);
}

// View All button URL setting.
$wp_customize->add_setting(
	'terminal_blog_posts_grid_view_all_button_url',
	array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'terminal_blog_posts_grid_view_all_button_url',
	array(
		'label'           => esc_html__( 'View All Button Link', 'terminal-blog' ),
		'section'         => 'terminal_blog_posts_grid_section',
		'settings'        => 'terminal_blog_posts_grid_view_all_button_url',
		'type'            => 'url',
		'active_callback' => 'terminal_blog_if_posts_grid_enabled',
	)
);

// posts_grid content type settings.
$wp_customize->add_setting(
	'terminal_blog_posts_grid_content_type',
	array(
		'default'           => 'post',
		'sanitize_callback' => 'terminal_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'terminal_blog_posts_grid_content_type',
	array(
		'label'           => esc_html__( 'Content type:', 'terminal-blog' ),
		'description'     => esc_html__( 'Choose where you want to render the content from.', 'terminal-blog' ),
		'section'         => 'terminal_blog_posts_grid_section',
		'type'            => 'select',
		'active_callback' => 'terminal_blog_if_posts_grid_enabled',
		'choices'         => array(
			'post'     => esc_html__( 'Post', 'terminal-blog' ),
			'category' => esc_html__( 'Category', 'terminal-blog' ),
		),
	)
);

for ( $i = 1; $i <= 4; $i++ ) {
	// posts_grid post setting.
	$wp_customize->add_setting(
		'terminal_blog_posts_grid_post_' . $i,
		array(
			'sanitize_callback' => 'terminal_blog_sanitize_dropdown_pages',
		)
	);

	$wp_customize->add_control(
		'terminal_blog_posts_grid_post_' . $i,
		array(
			'label'           => sprintf( esc_html__( 'Post %d', 'terminal-blog' ), $i ),
			'section'         => 'terminal_blog_posts_grid_section',
			'type'            => 'select',
			'choices'         => terminal_blog_get_post_choices(),
			'active_callback' => 'terminal_blog_posts_grid_section_content_type_post_enabled',
		)
	);

}

// posts_grid category setting.
$wp_customize->add_setting(
	'terminal_blog_posts_grid_category',
	array(
		'sanitize_callback' => 'terminal_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'terminal_blog_posts_grid_category',
	array(
		'label'           => esc_html__( 'Category', 'terminal-blog' ),
		'section'         => 'terminal_blog_posts_grid_section',
		'type'            => 'select',
		'choices'         => terminal_blog_get_post_cat_choices(),
		'active_callback' => 'terminal_blog_posts_grid_section_content_type_category_enabled',
	)
);

// Posts Grid button label setting.
$wp_customize->add_setting(
	'terminal_blog_posts_grid_button_label',
	array(
		'default'           => __( 'Read More', 'terminal-blog' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'terminal_blog_posts_grid_button_label',
	array(
		'label'           => esc_html__( 'Button Label', 'terminal-blog' ),
		'section'         => 'terminal_blog_posts_grid_section',
		'type'            => 'text',
		'active_callback' => 'terminal_blog_if_posts_grid_enabled',
	)
);

/*========================Active Callback==============================*/
function terminal_blog_if_posts_grid_enabled( $control ) {
	return $control->manager->get_setting( 'terminal_blog_posts_grid_section_enable' )->value();
}
function terminal_blog_posts_grid_section_content_type_post_enabled( $control ) {
	$content_type = $control->manager->get_setting( 'terminal_blog_posts_grid_content_type' )->value();
	return terminal_blog_if_posts_grid_enabled( $control ) && ( 'post' === $content_type );
}
function terminal_blog_posts_grid_section_content_type_category_enabled( $control ) {
	$content_type = $control->manager->get_setting( 'terminal_blog_posts_grid_content_type' )->value();
	return terminal_blog_if_posts_grid_enabled( $control ) && ( 'category' === $content_type );
}

/*========================Partial Refresh==============================*/
if ( ! function_exists( 'terminal_blog_posts_grid_title_text_partial' ) ) :
	// Title.
	function terminal_blog_posts_grid_title_text_partial() {
		return esc_html( get_theme_mod( 'terminal_blog_posts_grid_title' ) );
	}
endif;
if ( ! function_exists( 'terminal_blog_posts_grid_view_all_button_label_text_partial' ) ) :
	// View All.
	function terminal_blog_posts_grid_view_all_button_label_text_partial() {
		return esc_html( get_theme_mod( 'terminal_blog_posts_grid_view_all_button_label' ) );
	}
endif;
