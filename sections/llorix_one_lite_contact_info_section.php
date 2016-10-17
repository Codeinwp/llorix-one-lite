<?php
/**
 * Contact info template file
 *
 * PHP version 5.6
 *
 * @category    Sections
 * @package     Llorix_One_Lite
 * @author      Themeisle <cristian@themeisle.com>
 * @license     GNU General Public License v2 or later
 * @link        http://themeisle.com
 */

$llorix_one_lite_contact_info_show = get_theme_mod( 'llorix_one_lite_contact_info_show' );
$llorix_one_lite_contact_info_item = get_theme_mod('llorix_one_lite_contact_info_content', json_encode( array(
	array(
		'icon_value' => 'fa-envelope',
		'text' => 'contact@site.com',
		'link' => '#',
		'id' => 'llorix_one_lite_56d450a72cb3a',
	),
	array(
		'icon_value' => 'fa-map-marker',
		'text' => 'Company address',
		'link' => '#',
		'id' => 'llorix_one_lite_56d069b88cb6f',
	),
	array(
		'icon_value' => 'fa-tablet',
		'text' => '0 332 548 954',
		'link' => '#',
		'id' => 'llorix_one_lite_56d069b98cb70',
	),
) )
);

/* If section is not disabled */
if ( isset( $llorix_one_lite_contact_info_show ) && $llorix_one_lite_contact_info_show != 1 ) {
	if ( ! llorix_one_lite_general_repeater_is_empty( $llorix_one_lite_contact_info_item ) ) {
		$llorix_one_lite_contact_info_item_decoded = json_decode( $llorix_one_lite_contact_info_item ); ?>
		<div class="contact-info" id="contactinfo" role="region" aria-label="<?php esc_html_e( 'Contact Info','llorix-one-lite' ); ?>">
			<?php
			llorix_one_lite_contact_content( $llorix_one_lite_contact_info_item_decoded ); ?>
		</div><!-- .contact-info -->
		<?php
	}
} else {
	if ( is_customize_preview() ) {
		$llorix_one_lite_contact_info_item_decoded = json_decode( $llorix_one_lite_contact_info_item ); ?>
		<div class="contact-info llorix_one_lite_only_customizer" id="contactinfo" role="region" aria-label="<?php esc_html_e( 'Contact Info','llorix-one-lite' ); ?>">
			<?php
			llorix_one_lite_contact_content( $llorix_one_lite_contact_info_item_decoded ); ?>
		</div><!-- .contact-info -->
		<?php
	}
} ?>
