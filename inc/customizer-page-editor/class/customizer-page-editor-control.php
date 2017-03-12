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
	 * Enqueue scripts
	 */
	public function enqueue() {
		wp_enqueue_script( 'llorix_one_lite_text_editor', get_template_directory_uri() . '/inc/customizer-page-editor/js/llorix-one-lite-text-editor.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'tinymce_js', includes_url( 'js/tinymce/' ) . 'wp-tinymce.php', array( 'jquery' ), false, true );
		wp_enqueue_script( 'llorix_one_lite_controls_script', get_template_directory_uri() . '/inc/customizer-page-editor/js/llorix-one-lite-update-controls.js', array( 'jquery', 'customize-preview', 'tinymce_js' ), '', true );
		wp_localize_script( 'llorix_one_lite_controls_script', 'requestpost', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'thumbnail_control' => 'llorix_one_lite_feature_thumbnail',
			'editor_control' => 'llorix_one_lite_page_editor',
		));
	}


	/**
	 * Render the content on the theme customizer page
	 */
	public function render_content() {
		?>

		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_textarea( $this->value() ); ?>">
		<?php
		$settings = array(
			'textarea_name' => $this->id,
			'drag_drop_upload' => false,
			'teeny' => true,
		);
		$control_content = $this->value();
		$frontpage_id = get_option( 'page_on_front' );
		$page_content = '';
		if ( ! empty( $frontpage_id ) ) {
			$content_post = get_post( $frontpage_id );
			$page_content = $content_post->post_content;
			$page_content = apply_filters( 'the_content', $page_content );
			$page_content = str_replace( ']]>', ']]&gt;', $page_content );
		}

		if ( $control_content !== $page_content ) {
			$control_content = $page_content;
		}

		wp_editor( $control_content, $this->id, $settings );

		do_action( 'admin_footer' );
		do_action( 'admin_print_footer_scripts' );

	}
}
