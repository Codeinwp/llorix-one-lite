<?php
/**
 * Translation functions for footer socials
 *
 * @package llorix-one-lite
 */

if ( ! function_exists( 'llorix_one_lite_footer_socials_register_strings' ) ) {
	/**
	 * Register strings for polylang.
	 */
	function llorix_one_lite_footer_socials_register_strings() {
		if ( ! defined( 'POLYLANG_VERSION' ) ) {
			return;
		}

		$default = '';
		llorix_one_lite_pll_string_register_helper( 'llorix_one_lite_social_icons', $default, 'Footer socials' );
	}
}
add_action( 'after_setup_theme', 'llorix_one_lite_footer_socials_register_strings', 11 );
