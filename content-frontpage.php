<?php
/**
 * The template used for displaying page content on frontpage.
 *
 * @package llorix-one-lite
 */
echo'<div class="frontpage-content-section-inner">';

if ( is_customize_preview() ) {
	$frontpage_id = get_option( 'page_on_front' );
	$default = '';
	if ( ! empty( $frontpage_id ) ) {
		$content_post = get_post( $frontpage_id );
		$default = $content_post->post_content;
		$default = apply_filters( 'the_content', $default );
		$default = str_replace( ']]>', ']]&gt;', $default );
		$content = get_theme_mod( 'llorix_one_lite_page_editor', $default );
		echo wp_kses_post( $content );
	} else {
		the_content();
	}
} else {
	the_content();
}
echo'</div>';
