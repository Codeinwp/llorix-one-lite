<?php
/**
 * Include repeater files
 *
 * @package llorix-one-lite
 */

// Require customizer functions and dependencies
require get_template_directory() . '/inc/customizer-repeater/inc/customizer.php';

/**
 * Check if Repeater is empty
 *
 * @param string $llorix_one_lite_arr Repeater json array.
 *
 * @return bool
 */
function llorix_one_lite_general_repeater_is_empty( $llorix_one_lite_arr ) {
	if ( empty( $llorix_one_lite_arr ) ) {
		return true;
	}
	$llorix_one_lite_arr_decoded = json_decode( $llorix_one_lite_arr, true );
	$not_check_keys              = array( 'choice', 'id' );
	foreach ( $llorix_one_lite_arr_decoded as $item ) {
		foreach ( $item as $key => $value ) {
			if ( $key === 'icon_value' && ( ! empty( $value ) && $value !== 'No icon' ) ) {
				return false;
			}
			if ( ! in_array( $key, $not_check_keys ) ) {
				if ( ! empty( $value ) ) {
					return false;
				}
			}
		}
	}
	return true;
}
