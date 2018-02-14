<?php
/**
 * Translation functions for logos section
 *
 * @package llorix-one-lite
 */

if ( ! function_exists( 'llorix_one_lite_logos_get_default_content' ) ) {
	/**
	 * Get logos section default content.
	 */
	function llorix_one_lite_logos_get_default_content() {
		return json_encode(
			array(
				array(
					'image_url' => llorix_one_lite_get_file( '/images/companies/1.png' ),
					'link'      => '#',
					'id'        => 'llorix_one_lite_56d069bb8cb71',
				),
				array(
					'image_url' => llorix_one_lite_get_file( '/images/companies/2.png' ),
					'link'      => '#',
					'id'        => 'llorix_one_lite_56d069bc8cb72',
				),
				array(
					'image_url' => llorix_one_lite_get_file( '/images/companies/3.png' ),
					'link'      => '#',
					'id'        => 'llorix_one_lite_56d069bd8cb73',
				),
				array(
					'image_url' => llorix_one_lite_get_file( '/images/companies/4.png' ),
					'link'      => '#',
					'id'        => 'llorix_one_lite_56d06d128cb74',
				),
				array(
					'image_url' => llorix_one_lite_get_file( '/images/companies/5.png' ),
					'link'      => '#',
					'id'        => 'llorix_one_lite_56d06d3d8cb75',
				),
			)
		);
	}
}

if ( ! function_exists( 'llorix_one_lite_logos_register_strings' ) ) {
	/**
	 * Register strings for polylang.
	 */
	function llorix_one_lite_logos_register_strings() {
		if ( ! defined( 'POLYLANG_VERSION' ) ) {
			return;
		}

		$default = llorix_one_lite_logos_get_default_content();
		llorix_one_lite_pll_string_register_helper( 'llorix_one_lite_logos_content', $default, 'Logos section' );
	}
}
add_action( 'after_setup_theme', 'llorix_one_lite_logos_register_strings', 11 );
