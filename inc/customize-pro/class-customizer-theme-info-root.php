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
		require_once( trailingslashit( get_template_directory() ) . 'inc/customize-pro/class-llorix-one-lite-customize-theme-info-main.php' );
		require_once( trailingslashit( get_template_directory() ) . 'inc/customize-pro/class-llorix-one-lite-customize-theme-info-section.php' );

		// Register custom section types.
		$manager->register_section_type( 'Llorix_One_Lite_Customizer_Upsell_Frontpage_Sections' );
		$manager->register_section_type( 'Llorix_One_Lite_Customizer_Theme_Info_Main' );
		$manager->register_section_type( 'Llorix_One_Lite_Customizer_Theme_Info_Section' );

		if ( 'posts' === get_option( 'show_on_front' ) ) {
			$manager->add_section(
				new Llorix_One_Lite_Customizer_Upsell_Frontpage_Sections(
				$manager, 'llorix-one-lite-frontpage-instructions',
				array(
					'upsell_text'     => __( 'To customize the Frontpage sections please create a page and select the template "Frontpage" for that page. After that, go to Appearance -> Customize -> Static Front Page and under "Static Front Page" select "A static page". Finally, for "Front page" choose the page you previously created.', 'llorix-one-lite' ) . '<br><br>' . __( 'Need further informations? Check this', 'llorix-one-lite' ) . ' <a href="http://docs.themeisle.com/article/236-how-to-set-up-the-home-page-for-llorix-one">' . __( 'doc', 'llorix-one-lite' ) . '</a>',
					'panel'           => 'llorix_one_lite_front_page_sections',
					'priority'        => 1,
					'active_callback' => 'llorix_one_lite_show_on_front',
				)
				)
			);
		}

		// Main Documentation Link In Customizer Root.
		$manager->add_section(
			new Llorix_One_Lite_Customizer_Theme_Info_Main(
				$manager, 'llorix-one-lite-theme-info', array(
					'theme_info_title' => __( 'Llorix One Lite', 'llorix-one-lite' ),
					'label_url'        => esc_url( 'http://docs.themeisle.com/article/186-llorix-one-documentation' ),
					'label_text'       => __( 'Documentation', 'llorix-one-lite' ),
				)
			)
		);

		// Frontpage Sections Upsell.
		$manager->add_section(
			new Llorix_One_Lite_Customizer_Theme_Info_Section(
				$manager, 'llorix-one-lite-theme-info-section', array(
					'active_callback' => 'llorix_one_lite_show_on_front',
					'panel'           => 'llorix_one_lite_front_page_sections',
					'priority'        => 500,
					'options'         => array(
						esc_html__( 'Shop Section', 'llorix-one-lite' ),
						esc_html__( 'Portfolio Section', 'llorix-one-lite' ),
						esc_html__( 'Shortcodes Section', 'llorix-one-lite' ),
						esc_html__( 'Section Reordering', 'llorix-one-lite' ),
					),
					'button_url'      => esc_url( 'https://themeisle.com/plugins/llorix-one-plus/' ),
					'button_text'     => esc_html__( 'View PRO version', 'llorix-one-lite' ),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'llorix-one-lite-upsell-js', trailingslashit( get_template_directory_uri() ) . 'inc/customize-pro/js/llorix-one-lite-upsell-customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'llorix-one-lite-theme-info-style', trailingslashit( get_template_directory_uri() ) . 'inc/customize-pro/css/style.css' );

	}
}

Llorix_One_Lite_Customizer_Upsell::get_instance();
