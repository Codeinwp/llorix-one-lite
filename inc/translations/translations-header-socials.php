<?php
/**
 * Translation functions for header social icons
 *
 * @package llorix-one-lite
 */

if ( ! function_exists( 'llorix_one_lite_header_social_icons_get_default_content' ) ) {
	/**
	 * Get testimonials section default content.
	 */
	function llorix_one_lite_header_social_icons_get_default_content() {
		return json_encode(
			array(
				array(
					'icon_value' => 'fa-facebook',
					'link'       => '#',
					'id'         => 'llorix_one_lite_56d069ad8cb6b',
				),
				array(
					'icon_value' => 'fa-twitter',
					'link'       => '#',
					'id'         => 'llorix_one_lite_56d069b48cb6c',
				),
				array(
					'icon_value' => 'fa-google-plus-square',
					'link'       => '#',
					'id'         => 'llorix_one_lite_56d069b58cb6d',
				),
			)
		);
	}
}

if ( ! function_exists( 'llorix_one_lite_header_social_icons_register_strings' ) ) {
	/**
	 * Register strings for polylang.
	 */
	function llorix_one_lite_header_social_icons_register_strings() {
		if ( ! defined( 'POLYLANG_VERSION' ) ) {
			return;
		}

		$default = llorix_one_lite_header_social_icons_get_default_content();
		llorix_one_lite_pll_string_register_helper( 'llorix_one_lite_very_top_social_icons', $default, 'Header social icons' );
	}
}

if ( function_exists( 'llorix_one_lite_header_social_icons_register_strings' ) ) {
	add_action( 'after_setup_theme', 'llorix_one_lite_header_social_icons_register_strings', 11 );
}
