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

/**
 * Post date box - on content-search
 */
function llorix_one_lite_post_date_search_box_trigger() {
	do_action( 'llorix_one_lite_post_date_box','' );
}

/**
 * Post date box - on index
 */
function llorix_one_lite_post_date_index_box_trigger() {
	do_action( 'llorix_one_lite_post_date_box','post-date entry-published updated' );
}

/**
 * Before entry meta div on content
 */
function llorix_one_lite_before_entry_meta_content_trigger() {
	do_action( 'llorix_one_lite_before_entry_meta_content' );
}

/**
 * After the author in the entry meta div
 */
function llorix_one_lite_after_author_in_entry_meta_trigger() {
	do_action( 'llorix_one_lite_after_author_in_entry_meta' );
}

/**
 * After the date in the entry meta div
 */
function llorix_one_lite_after_date_in_entry_meta_trigger() {
	do_action( 'llorix_one_lite_after_date_in_entry_meta' );
}

/**
 * After the categories in the entry meta div
 */
function llorix_one_lite_after_categories_in_entry_meta_trigger() {
	do_action( 'llorix_one_lite_after_categories_in_entry_meta' );
}

/**
 * After the title in the Latest news section
 */
function llorix_one_lite_latest_news_section_after_title_trigger() {
	do_action( 'llorix_one_lite_latest_news_section_after_title' );
}
