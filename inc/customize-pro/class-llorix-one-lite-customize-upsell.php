<?php
/**
 * Singleton class file.
 *
 * @package llorix-one-lite
 */

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Llorix_One_Lite_Customizer_Upsell {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
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
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
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
	 * @since  1.0.0
	 * @access public
	 * @param  object $manager Customizer manager.
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once( trailingslashit( get_template_directory() ) . 'inc/customize-pro/class-llorix-one-lite-customize-upsell-frontpage-sections.php' );

		// Register custom section types.
		$manager->register_section_type( 'Llorix_One_Lite_Customizer_Upsell_Frontpage_Sections' );

		// Register sections.
		$manager->add_section( new Llorix_One_Lite_Customizer_Upsell_Frontpage_Sections( $manager, 'llorix-one-lite-upsell-frontpage-sections', array(
			'upsell_text'               => __( 'Check out the <a href="http://themeisle.com/plugins/llorix-one-plus/">PRO version</a> for full control over the frontpage SECTIONS ORDER!', 'llorix-one-lite' ),
			'panel'                     => 'llorix_one_lite_front_page_sections',
			'priority'                  => 500,
			'active_callback'   => 'llorix_one_lite_show_on_front',
		) ) );

		if ( 'posts' === get_option( 'show_on_front' ) ) {
			$manager->add_section( new Llorix_One_Lite_Customizer_Upsell_Frontpage_Sections( $manager, 'llorix-one-lite-frontpage-instrucctions',
					array(
						'upsell_text'               => __( 'To customize the Frontpage sections please create a page and select the template "Frontpage" for that page. After that, go to Appearance -> Customize -> Static Front Page and under "Static Front Page" select "A static page". Finally, for "Front page" choose the page you previously created.','llorix-one-lite' ) . '<br><br>' . __( 'Need further informations? Check this','llorix-one-lite' ) . ' <a href="http://docs.themeisle.com/article/236-how-to-set-up-the-home-page-for-llorix-one">' . __( 'doc','llorix-one-lite' ) . '</a>',
						'panel'                     => 'llorix_one_lite_front_page_sections',
						'priority'                  => 1,
						'active_callback'   => 'llorix_one_lite_show_on_front',
					)
				)
			);
		}

	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'llorix-one-lite-upsell-js', trailingslashit( get_template_directory_uri() ) . 'inc/customize-pro/llorix-one-lite-upsell-customize-controls.js', array( 'customize-controls' ) );

	}
}

Llorix_One_Lite_Customizer_Upsell::get_instance();
