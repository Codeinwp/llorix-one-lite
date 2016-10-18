<?php

/* Header *********************/

/**
 * Very top header
 * HTML context: within `.very-top-right`
 */
function llorix_one_lite_header_top_right_open_trigger() {
	do_action( 'llorix_one_lite_header_top_right_open' );
}

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
