<?php
/**
 * Page editor control
 *
 * @package WordPress
 * @subpackage Llorix One Lite
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}
/**
 * Class to create a custom tags control
 */
class Llorix_One_Lite_Page_Editor extends WP_Customize_Control {

	/**
	 * Flag to include sync scripts if needed
	 *
	 * @var bool|mixed
	 */
	private $needsync = false;

	/**
	 * Flag to do action admin_print_footer_scripts.
	 * This needs to be true only for one instance.
	 *
	 * @var bool|mixed
	 */
	private $include_admin_print_footer = false;

	/**
	 * Flag to load teeny.
	 *
	 * @var bool|mixed
	 */
	private $teeny = false;

	/**
	 * Llorix_One_Lite_Page_Editor constructor.
	 *
	 * @param WP_Customize_Manager $manager Manager.
	 * @param string               $id Id.
	 * @param array                $args Constructor args.
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		if ( ! empty( $args['needsync'] ) ) {
			$this->needsync = $args['needsync'];
		}
		if ( ! empty( $args['include_admin_print_footer'] ) ) {
			$this->include_admin_print_footer = $args['include_admin_print_footer'];
		}
		if ( ! empty( $args['teeny'] ) ) {
			$this->teeny = $args['teeny'];
		}
	}

	/**
	 * Enqueue scripts
	 */
	public function enqueue() {
		wp_enqueue_style( 'llorix_one_lite_text_editor_css', get_template_directory_uri() . '/inc/customizer-page-editor/css/customizer-page-editor.css', array(), '1.0.0' );

		wp_enqueue_script( 'llorix_one_lite_text_editor', get_template_directory_uri() . '/inc/customizer-page-editor/js/llorix-one-lite-text-editor.js', array( 'jquery' ), false, true );
		if ( $this->needsync === true ) {
			wp_enqueue_script( 'llorix_one_lite_controls_script', get_template_directory_uri() . '/inc/customizer-page-editor/js/llorix-one-lite-update-controls.js', array( 'jquery' ), false, true );
			wp_localize_script(
				'llorix_one_lite_controls_script', 'requestpost', array(
					'ajaxurl'           => admin_url( 'admin-ajax.php' ),
					'thumbnail_control' => 'llorix_one_lite_feature_thumbnail',
					'editor_control'    => 'llorix_one_lite_page_editor',
					'thumbnail_label'   => esc_html__( 'About background', 'llorix-one-lite' ), // name of thumbnail control
				)
			);
		}
	}


	/**
	 * Render the content on the theme customizer page
	 */
	public function render_content() {
		?>

		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_textarea( $this->value() ); ?>">
		<?php
		$settings        = array(
			'textarea_name' => $this->id,
			'teeny'         => $this->teeny,
		);
		$control_content = $this->value();
		$frontpage_id    = get_option( 'page_on_front' );
		$page_content    = '';
		if ( $this->needsync === true ) {
			if ( ! empty( $frontpage_id ) ) {
				$page_content = get_post_field( 'post_content', $frontpage_id );
			}
		} else {
			$page_content = $this->value();
		}

		if ( $control_content !== $page_content ) {
			$control_content = $page_content;
		}

		wp_editor( $control_content, $this->id, $settings );

		if ( $this->include_admin_print_footer === true ) {
			do_action( 'admin_print_footer_scripts' );
		}

	}
}
