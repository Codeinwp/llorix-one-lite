<?php
/**
 * Sync functions for control.
 *
 * @package WordPress
 * @subpackage Llorix One Lite
 */

// Load Customizer page editor.
require_once( trailingslashit( get_template_directory() ) . '/inc/customizer-page-editor/class/customizer-page-editor-control.php' );

/**
 * Sync frontpage content with customizer control
 *
 * @param string $value New value.
 * @param string $old_value Old value.
 *
 * @return mixed
 */
function llorix_one_lite_sync_content_from_control( $value = '', $old_value = '' ) {
	$frontpage_id = get_option( 'page_on_front' );
	if ( ! wp_is_post_revision( $frontpage_id ) ) {

		// unhook this function so it doesn't loop infinitely
		remove_action( 'save_post', 'llorix_one_lite_sync_control_from_page' );

		// update the post, which calls save_post again
		$post = array(
			'ID'           => $frontpage_id,
			'post_content' => wp_kses_post( $value ),
		);

		wp_update_post( $post );

		// re-hook this function
		add_action( 'save_post', 'llorix_one_lite_sync_control_from_page' );
	}

	return $value;
}
add_filter( 'pre_set_theme_mod_llorix_one_lite_page_editor', 'llorix_one_lite_sync_content_from_control', 10, 2 );


/**
 * Sync frontpage thumbnail with customizer control
 *
 * @param string $value New value.
 * @param string $old_value Old value.
 *
 * @return mixed
 */
function llorix_one_lite_sync_thumbnail_from_control( $value, $old_value ) {

	$frontpage_id = get_option( 'page_on_front' );
	if ( ! empty( $frontpage_id ) ) {
		$thumbnail_id = attachment_url_to_postid( $value );
		update_post_meta( $frontpage_id, '_thumbnail_id', $thumbnail_id );
	}
	return $value;
}
add_filter( 'pre_set_theme_mod_llorix_one_lite_feature_thumbnail', 'llorix_one_lite_sync_thumbnail_from_control', 10, 2 );

/**
 * Sync page thumbnail and content with customizer control
 *
 * @param int $post_id Page id.
 */
function llorix_one_lite_sync_control_from_page( $post_id, $ajax_call = false ) {
	if ( ! wp_is_post_revision( $post_id ) ) {
		$return_value = array();

		remove_action( 'save_post', 'llorix_one_lite_sync_control_from_page' );
		remove_filter( 'pre_set_theme_mod_llorix_one_lite_feature_thumbnail', 'llorix_one_lite_sync_thumbnail_from_control', 10 );
		remove_filter( 'pre_set_theme_mod_llorix_one_lite_page_editor', 'llorix_one_lite_sync_content_from_control', 10 );

		$frontpage_id = get_option( 'page_on_front' );
		if ( (int) $frontpage_id !== (int) $post_id ) {
			return;
		}

		$content = '';
		if ( ! empty( $frontpage_id ) ) {
			$content = get_post_field( 'post_content', $frontpage_id );
		}
		set_theme_mod( 'llorix_one_lite_page_editor', $content );

		$llorix_one_lite_frontpage_featured = '';
		if ( has_post_thumbnail( $frontpage_id ) ) {
			$llorix_one_lite_frontpage_featured = get_the_post_thumbnail_url( $frontpage_id );
		}
		set_theme_mod( 'llorix_one_lite_feature_thumbnail', $llorix_one_lite_frontpage_featured );

		add_action( 'save_post', 'llorix_one_lite_sync_control_from_thumbnail' );
		add_filter( 'pre_set_theme_mod_llorix_one_lite_feature_thumbnail', 'llorix_one_lite_sync_thumbnail_from_control', 10, 2 );
		add_filter( 'pre_set_theme_mod_llorix_one_lite_page_editor', 'llorix_one_lite_sync_content_from_control', 10, 2 );

		if ( $ajax_call === true ) {
			$return_value['post_content']   = $content;
			$return_value['post_thumbnail'] = $llorix_one_lite_frontpage_featured;
			echo json_encode( $return_value );
		}
	}
	echo '';
}
add_action( 'save_post', 'llorix_one_lite_sync_control_from_page' );

/**
 * Ajax call to sync page content and thumbnail when you switch to static frontpage
 */
function llorix_one_lite_ajax_call() {
	$pid = $_POST['pid'];
	llorix_one_lite_sync_control_from_page( $pid, true );
	die();
}
add_action( 'wp_ajax_llorix_one_lite_ajax_call', 'llorix_one_lite_ajax_call' );

/**
 * Change the default editor to html when using the tinyMce editor in customizer.
 *
 * @param string $r The current value of the default editor.
 *
 * @return string The new value of the editor, if we are in the customizer page.
 */
function llorix_one_lite_set_default_editor( $r ) {
	if ( is_customize_preview() && function_exists( 'get_current_screen' ) ) {
		$screen = get_current_screen();
		if ( isset( $screen->id ) ) {
			if ( $screen->id === 'customize' ) {
				return 'tmce';
			}
		}
	}
	return $r;
}
add_filter( 'wp_default_editor', 'llorix_one_lite_set_default_editor' );

/**
 * Filters for text format
 */
add_filter( 'llorix_one_lite_text', 'wptexturize' );
add_filter( 'llorix_one_lite_text', 'convert_smilies' );
add_filter( 'llorix_one_lite_text', 'convert_chars' );
add_filter( 'llorix_one_lite_text', 'wpautop' );
add_filter( 'llorix_one_lite_text', 'shortcode_unautop' );
add_filter( 'llorix_one_lite_text', 'do_shortcode' );
