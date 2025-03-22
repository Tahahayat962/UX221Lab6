<?php

// upgrade to pro.
require get_theme_file_path() . '/inc/upgrade-to-pro/class-customize.php';

function legacy_blog_customize_register( $wp_customize ) {

	if ( class_exists( 'WP_Customize_Control' ) ) {

		class Legacy_Blog_Toggle_Checkbox_Custom_control extends WP_Customize_Control {
			public $type = 'toogle_checkbox';

			public function render_content() {
				?>
				<div class="checkbox_switch">
					<div class="onoffswitch">
						<input type="checkbox" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" class="onoffswitch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" 
						<?php
						$this->link();
						checked( $this->value() );
						?>
						>
						<label class="onoffswitch-label" for="<?php echo esc_attr( $this->id ); ?>"></label>
					</div>
					<span class="customize-control-title onoffswitch_label"><?php echo esc_html( $this->label ); ?></span>
					<p><?php echo wp_kses_post( $this->description ); ?></p>
				</div>
				<?php
			}
		}

	}

	// Category Section.
	require get_theme_file_path() . '/inc/customizer/category.php';

	$wp_customize->add_section(
		'legacy_blog_header_options_section',
		array(
			'title' => esc_html__( 'Header Options', 'legacy-blog' ),
			'panel' => 'terminal_blog_theme_options_panel',
		)
	);

	// Header Section Advertisement Image.
	$wp_customize->add_setting(
		'legacy_blog_advertisement_image',
		array(
			'default'           => '',
			'sanitize_callback' => 'legacy_blog_sanitize_image',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'legacy_blog_advertisement_image',
			array(
				'label'    => esc_html__( 'Advertisement Image', 'legacy-blog' ),
				'settings' => 'legacy_blog_advertisement_image',
				'section'  => 'legacy_blog_header_options_section',
			)
		)
	);

	// Header Advertisement Url.
	$wp_customize->add_setting(
		'legacy_blog_advertisement_url',
		array(
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'legacy_blog_advertisement_url',
		array(
			'label'    => esc_html__( 'Advertisement Url', 'legacy-blog' ),
			'settings' => 'legacy_blog_advertisement_url',
			'section'  => 'legacy_blog_header_options_section',
			'type'     => 'url',
		)
	);

	// Grid Column layout options.
	$wp_customize->add_setting(
		'legacy_blog_archive_grid_column_layout',
		array(
			'default'           => 'grid-column-2',
			'sanitize_callback' => 'terminal_blog_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'legacy_blog_archive_grid_column_layout',
		array(
			'label'   => esc_html__( 'Grid Column Layout', 'legacy-blog' ),
			'section' => 'terminal_blog_archive_page_options',
			'type'    => 'select',
			'choices' => array(
				'grid-column-2' => __( 'Column 2', 'legacy-blog' ),
				'grid-column-3' => __( 'Column 3', 'legacy-blog' ),
			),
		)
	);

}
add_action( 'customize_register', 'legacy_blog_customize_register' );

function legacy_blog_customize_preview_js() {

	wp_enqueue_script( 'legacy-blog-customizer', get_theme_file_uri() . '/assets/js/customizer.min.js', array( 'customize-preview', 'terminal-blog-customizer' ), true );

}
add_action( 'customize_preview_init', 'legacy_blog_customize_preview_js' );

function legacy_blog_custom_control_scripts() {

	wp_enqueue_style( 'legacy-blog-customize-controls', get_theme_file_uri() . '/assets/css/customize-controls.min.css' );

	wp_enqueue_script( 'legacy-blog-custom-controls-js', get_theme_file_uri() . '/assets/js/customize-control.min.js', array( 'terminal-blog-customize-control', 'jquery', 'jquery-ui-core' ), '1.0', true );

}
add_action( 'customize_controls_enqueue_scripts', 'legacy_blog_custom_control_scripts' );
