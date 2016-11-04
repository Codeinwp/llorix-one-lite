<?php
/**
 * Llorix One Lite hooks
 *
 * @package llorix-one-lite
 */

/**
 * Very top header
 * HTML context: within `.very-top-right`
 */
function llorix_one_lite_header_top_right_open_trigger() {
	do_action( 'llorix_one_lite_header_top_right_open' );
}

/**
 * Very top header
 * HTML context: within `.very-top-right`
 */
function llorix_one_lite_header_top_right_close_trigger() {
	do_action( 'llorix_one_lite_header_top_right_close' );
}

/**
 * Logos section on homepage
 * HTML context: within `.clients`
 */
function llorix_one_lite_home_logos_section_open_trigger() {
	do_action( 'llorix_one_lite_home_logos_section_open' );
}

/**
 * Logos section on homepage
 * HTML context: within `.clients`
 */
function llorix_one_lite_home_logos_section_close_trigger() {
	do_action( 'llorix_one_lite_home_logos_section_close' );
}

/**
 * About us after content
 * HTML context: within `.brief-content-one`
 */
function llorix_one_lite_home_about_section_content_one_after_trigger() {
	do_action( 'llorix_one_lite_home_about_section_content_one_after' );
}

/**
 * Ribbon subtitle
 * HTML context: within `.`
 */
function llorix_one_lite_home_ribbon_section_subtitle_trigger() {
	do_action( 'llorix_one_lite_home_ribbon_section_subtitle' );
}

/**
 * Ribbon before content
 * HTML context: within `.`
 */
function llorix_one_lite_home_ribbon_section_open_trigger() {
	do_action( 'llorix_one_lite_home_ribbon_section_open' );
}

/**
 * Ribbon after content
 * HTML context: within `.`
 */
function llorix_one_lite_home_ribbon_section_close_trigger() {
	do_action( 'llorix_one_lite_home_ribbon_section_close' );
}
