<?php
/**
 * Maps template file
 *
 * PHP version 5.6
 *
 * @category    Sections
 * @package     Llorix_One_Lite
 * @author      Themeisle <cristian@themeisle.com>
 * @license     GNU General Public License v2 or later
 * @link        http://themeisle.com
 */

	global $wp_customize;

	$llorix_one_lite_contact_info_show = get_theme_mod( 'llorix_one_lite_contact_info_show' );

	$llorix_one_lite_frontpage_map_shortcode = get_theme_mod( 'llorix_one_lite_frontpage_map_shortcode' );
	$llorix_one_lite_frontpage_map_shortcode = apply_filters( 'llorix_one_lite_translate_single_string', $llorix_one_lite_frontpage_map_shortcode, 'Map shortcode' );

	/* If section is not disabled */
	if ( isset( $llorix_one_lite_contact_info_show ) && $llorix_one_lite_contact_info_show != 1 ) {

	if ( ! empty( $llorix_one_lite_frontpage_map_shortcode ) ) {
	?>
		<div id="container-fluid" class="contactinfo-map">
			<div class="llorix_one_lite_map_overlay"></div>
			<div id="cd-google-map">
				<?php echo do_shortcode( $llorix_one_lite_frontpage_map_shortcode ); ?>
			</div>
		</div><!-- .container-fluid -->
	<?php
	}
} elseif ( isset( $wp_customize ) ) {
	if ( ! empty( $llorix_one_lite_frontpage_map_shortcode ) ) {
	?>
		<div id="container-fluid" class="contactinfo-map llorix_one_lite_only_customizer">
			<div class="llorix_one_lite_map_overlay"></div>
			<div id="cd-google-map">
				<?php echo do_shortcode( $llorix_one_lite_frontpage_map_shortcode ); ?>
			</div>
		</div><!-- .container-fluid -->
	<?php
	}
}
?>
