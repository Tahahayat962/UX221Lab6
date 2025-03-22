<?php
/**
 * Adore Themes Customizer
 *
 * @package Legacy Blog
 *
 * Categories Section
 */

$wp_customize->add_section(
	'legacy_blog_categories_section',
	array(
		'title'    => esc_html__( 'Categories Section', 'legacy-blog' ),
		'panel'    => 'terminal_blog_frontpage_panel',
		'priority' => 25,
	)
);

// Categories Section section enable settings.
$wp_customize->add_setting(
	'legacy_blog_categories_section_enable',
	array(
		'default'           => false,
		'sanitize_callback' => 'terminal_blog_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Legacy_Blog_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'legacy_blog_categories_section_enable',
		array(
			'label'    => esc_html__( 'Enable Categories Section', 'legacy-blog' ),
			'type'     => 'checkbox',
			'settings' => 'legacy_blog_categories_section_enable',
			'section'  => 'legacy_blog_categories_section',
		)
	)
);

// Categories Section title settings.
$wp_customize->add_setting(
	'legacy_blog_categories_title',
	array(
		'default'           => __( 'Posts Categories', 'legacy-blog' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'legacy_blog_categories_title',
	array(
		'label'           => esc_html__( 'Section Title', 'legacy-blog' ),
		'section'         => 'legacy_blog_categories_section',
		'active_callback' => 'legacy_blog_if_categories_enabled',
	)
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'legacy_blog_categories_title',
		array(
			'selector'            => '.categories-section h3.section-title',
			'settings'            => 'legacy_blog_categories_title',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'legacy_blog_categories_title_text_partial',
		)
	);
}

// View All button label setting.
$wp_customize->add_setting(
	'legacy_blog_categories_view_all_button_label',
	array(
		'default'           => __( 'View All', 'legacy-blog' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'legacy_blog_categories_view_all_button_label',
	array(
		'label'           => esc_html__( 'View All Button Label', 'legacy-blog' ),
		'section'         => 'legacy_blog_categories_section',
		'settings'        => 'legacy_blog_categories_view_all_button_label',
		'type'            => 'text',
		'active_callback' => 'legacy_blog_if_categories_enabled',
	)
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'legacy_blog_categories_view_all_button_label',
		array(
			'selector'            => '.categories-section .adore-view-all',
			'settings'            => 'legacy_blog_categories_view_all_button_label',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'legacy_blog_categories_view_all_button_label_text_partial',
		)
	);
}

// View All button URL setting.
$wp_customize->add_setting(
	'legacy_blog_categories_view_all_button_url',
	array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'legacy_blog_categories_view_all_button_url',
	array(
		'label'           => esc_html__( 'View All Button Link', 'legacy-blog' ),
		'section'         => 'legacy_blog_categories_section',
		'settings'        => 'legacy_blog_categories_view_all_button_url',
		'type'            => 'url',
		'active_callback' => 'legacy_blog_if_categories_enabled',
	)
);

for ( $i = 1; $i <= 6; $i++ ) {

	// categories category setting.
	$wp_customize->add_setting(
		'legacy_blog_categories_category_' . $i,
		array(
			'sanitize_callback' => 'terminal_blog_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'legacy_blog_categories_category_' . $i,
		array(
			'label'           => sprintf( esc_html__( 'Category %d', 'legacy-blog' ), $i ),
			'section'         => 'legacy_blog_categories_section',
			'settings'        => 'legacy_blog_categories_category_' . $i,
			'type'            => 'select',
			'choices'         => terminal_blog_get_post_cat_choices(),
			'active_callback' => 'legacy_blog_if_categories_enabled',
		)
	);

	// categories bg image.
	$wp_customize->add_setting(
		'legacy_blog_categories_image_' . $i,
		array(
			'default'           => '',
			'sanitize_callback' => 'legacy_blog_sanitize_image',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'legacy_blog_categories_image_' . $i,
			array(
				'label'           => sprintf( esc_html__( 'Category Image %d', 'legacy-blog' ), $i ),
				'section'         => 'legacy_blog_categories_section',
				'settings'        => 'legacy_blog_categories_image_' . $i,
				'active_callback' => 'legacy_blog_if_categories_enabled',
			)
		)
	);

}

/*========================Active Callback==============================*/
function legacy_blog_if_categories_enabled( $control ) {
	return $control->manager->get_setting( 'legacy_blog_categories_section_enable' )->value();
}

/*========================Partial Refresh==============================*/
if ( ! function_exists( 'legacy_blog_categories_title_text_partial' ) ) :
	// Title.
	function legacy_blog_categories_title_text_partial() {
		return esc_html( get_theme_mod( 'legacy_blog_categories_title' ) );
	}
endif;
if ( ! function_exists( 'legacy_blog_categories_view_all_button_label_text_partial' ) ) :
	// Title.
	function legacy_blog_categories_view_all_button_label_text_partial() {
		return esc_html( get_theme_mod( 'legacy_blog_categories_view_all_button_label' ) );
	}
endif;
