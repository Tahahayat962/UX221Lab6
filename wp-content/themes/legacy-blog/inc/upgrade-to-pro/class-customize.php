<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  Legacy Blog 1.0.0
 * @access public
 */
final class Legacy_Blog_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since Legacy Blog 1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since Legacy Blog 1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since Legacy Blog 1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since Legacy Blog 1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require trailingslashit( get_theme_file_path() ) . 'inc/upgrade-to-pro/section-pro.php' ;

		// Register custom section types.
		$manager->register_section_type( 'Legacy_Blog_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Legacy_Blog_Customize_Section_Pro(
				$manager,
				'legacy-blog',
				array(
					'title'    => esc_html__( 'Legacy Blog Pro','legacy-blog' ),
					'pro_text' => esc_html__( 'Go Pro','legacy-blog' ),
					'pro_url'  => esc_url( 'https://adorethemes.com/downloads/legacy-blog-pro/' )
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since Legacy Blog 1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'legacy-blog-go-pro-customize-controls', trailingslashit( get_stylesheet_directory_uri() ) . 'inc/upgrade-to-pro/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'legacy-blog-go-pro-customize-controls', trailingslashit( get_stylesheet_directory_uri() ) . 'inc/upgrade-to-pro/customize-controls.css' );
	}
}

// Doing this customizer thang!
Legacy_Blog_Customize::get_instance();