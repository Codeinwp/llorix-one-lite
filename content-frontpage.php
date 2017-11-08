<?php
/**
 * The template used for displaying page content on frontpage.
 *
 * @package llorix-one-lite
 */
echo'<div class="frontpage-content-section-inner">';

if ( is_customize_preview() ) {
	$frontpage_id = get_option( 'page_on_front' );
	$default      = '';
	if ( ! empty( $frontpage_id ) ) {
		$default = get_post_field( 'post_content', $frontpage_id );
		$content = get_theme_mod( 'llorix_one_lite_page_editor', $default );
		echo apply_filters( 'llorix_one_lite_text', html_entity_decode( wp_kses_post( $content ) ) );
	} else {
		the_content();
	}
} else {
	the_content();
}
echo'</div>';
