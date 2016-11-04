<?php
/**
 * Logos template file
 *
 * PHP version 5.6
 *
 * @category    Sections
 * @package     Llorix_One_Lite
 * @author      Themeisle <cristian@themeisle.com>
 * @license     GNU General Public License v2 or later
 * @link        http://themeisle.com
 */
$llorix_one_lite_logos_show = get_theme_mod( 'llorix_one_lite_logos_show' );
$llorix_one_lite_logos = get_theme_mod('llorix_one_lite_logos_content', json_encode( array(
		array(
			'image_url' => llorix_one_lite_get_file( '/images/companies/1.png' ),
			'link' => '#',
			'id' => 'llorix_one_lite_56d069bb8cb71',
		),
		array(
			'image_url' => llorix_one_lite_get_file( '/images/companies/2.png' ),
			'link' => '#',
			'id' => 'llorix_one_lite_56d069bc8cb72',
		),
		array(
			'image_url' => llorix_one_lite_get_file( '/images/companies/3.png' ),
			'link' => '#',
			'id' => 'llorix_one_lite_56d069bd8cb73',
		),
		array(
			'image_url' => llorix_one_lite_get_file( '/images/companies/4.png' ),
			'link' => '#',
			'id' => 'llorix_one_lite_56d06d128cb74',
		),
		array(
			'image_url' => llorix_one_lite_get_file( '/images/companies/5.png' ),
			'link' => '#',
			'id' => 'llorix_one_lite_56d06d3d8cb75',
		),
	) )
);
/* If section is not disabled */
if ( isset( $llorix_one_lite_logos_show ) && $llorix_one_lite_logos_show != 1 ) {
	if ( ! empty( $llorix_one_lite_logos ) ) {
		$llorix_one_lite_logos_decoded = json_decode( $llorix_one_lite_logos );
		if ( ! empty( $llorix_one_lite_logos_decoded ) ) { ?>
			<div class="clients white-bg" id="clients" role="region" aria-label="<?php echo __( 'Affiliates Logos','llorix-one-lite' ); ?>">
				<?php
				llorix_one_lite_logos_content( $llorix_one_lite_logos_decoded ); ?>
			</div>
			<?php
		}
	}
} else {
	if ( is_customize_preview() ) {
		if ( ! empty( $llorix_one_lite_logos ) ) {
			$llorix_one_lite_logos_decoded = json_decode( $llorix_one_lite_logos );
			if ( ! empty( $llorix_one_lite_logos_decoded ) ) { ?>
				<div class="clients white-bg llorix_one_lite_only_customizer" id="clients" role="region" aria-label="<?php echo __( 'Affiliates Logos','llorix-one-lite' ); ?>">
					<?php
					llorix_one_lite_logos_content( $llorix_one_lite_logos_decoded ); ?>
				</div>
				<?php
			}
		}
	}
}
