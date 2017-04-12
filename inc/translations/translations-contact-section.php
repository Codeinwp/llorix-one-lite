<?php
/**
 * Translation functions for contact section
 *
 * @package llorix-one-lite
 */

if ( ! function_exists( 'llorix_one_lite_contact_get_default_content' ) ) {
	/**
	 * Get testimonials section default content.
	 */
	function llorix_one_lite_contact_get_default_content() {
		return json_encode(
			array(
				array(
					'icon_value' => 'fa-envelope',
					'text'       => 'contact@site.com',
					'link'       => '#',
					'id'         => 'llorix_one_lite_56d450a72cb3a',
				),
				array(
					'icon_value' => 'fa-map-marker',
					'text'       => 'Company address',
					'link'       => '#',
					'id'         => 'llorix_one_lite_56d069b88cb6f',
				),
				array(
					'icon_value' => 'fa-tablet',
					'text'       => '0 332 548 954',
					'link'       => '#',
					'id'         => 'llorix_one_lite_56d069b98cb70',
				),
			)
		);
	}
}

if ( ! function_exists( 'llorix_one_lite_contact_register_strings' ) ) {
	/**
	 * Register strings for polylang.
	 */
	function llorix_one_lite_contact_register_strings() {
		if ( ! defined( 'POLYLANG_VERSION' ) ) {
			return;
		}

		$default = llorix_one_lite_contact_get_default_content();
		llorix_one_lite_pll_string_register_helper( 'llorix_one_lite_contact_info_content', $default, 'Contact section' );
	}
}
add_action( 'after_setup_theme', 'llorix_one_lite_contact_register_strings', 11 );
