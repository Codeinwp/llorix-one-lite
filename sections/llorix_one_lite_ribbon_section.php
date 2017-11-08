<?php
/**
 * Ribbon template file
 *
 * PHP version 5.6
 *
 * @category    Sections
 * @package     Llorix_One_Lite
 * @author      Themeisle <cristian@themeisle.com>
 * @license     GNU General Public License v2 or later
 * @link        http://themeisle.com
 */

	$ribbon_background = get_theme_mod( 'llorix_one_lite_ribbon_background', apply_filters( 'llorix_one_lite_ribbon_background_filter', llorix_one_lite_get_file( '/images/background-images/parallax-img/parallax-img1.jpg' ) ) );
	$ribbon_background = apply_filters( 'llorix_one_lite_translate_single_string', $ribbon_background, 'Ribbon section' );

	if ( current_user_can( 'edit_theme_options' ) ) {
	/* translators: %1$s is the customize link %2$s the customize link label */
	$llorix_one_lite_ribbon_title = get_theme_mod( 'llorix_one_lite_ribbon_title', sprintf( __( 'Change this text in %s', 'llorix-one-lite' ), sprintf( '<a href="%1$s">%2$s</a>', esc_url( admin_url( 'customize.php?autofocus&#91;control&#93;=llorix_one_lite_ribbon_title' ) ), __( 'Ribbon section', 'llorix-one-lite' ) ) ) );
	} else {
	$llorix_one_lite_ribbon_title = get_theme_mod( 'llorix_one_lite_ribbon_title' );
	}
	$llorix_one_lite_ribbon_title = apply_filters( 'llorix_one_lite_translate_single_string', $llorix_one_lite_ribbon_title, 'Ribbon section' );

	$llorix_one_lite_button_text = get_theme_mod( 'llorix_one_lite_button_text', esc_html__( 'GET STARTED', 'llorix-one-lite' ) );
	$llorix_one_lite_button_text = apply_filters( 'llorix_one_lite_translate_single_string', $llorix_one_lite_button_text, 'Ribbon section' );
	$llorix_one_lite_button_link = get_theme_mod( 'llorix_one_lite_button_link', '#' );
	$llorix_one_lite_button_link = apply_filters( 'llorix_one_lite_translate_single_string', $llorix_one_lite_button_link, 'Ribbon section' );

	$llorix_one_lite_ribbon_show = get_theme_mod( 'llorix_one_lite_ribbon_show' );

	/* If section is not disabled */
	if ( isset( $llorix_one_lite_ribbon_show ) && $llorix_one_lite_ribbon_show != 1 ) {

	if ( ! empty( $llorix_one_lite_ribbon_title ) || ! empty( $llorix_one_lite_button_text ) ) {

		if ( ! empty( $ribbon_background ) ) {
			echo '<section class="call-to-action ribbon-wrap" id="ribbon" style="background-image:url(' . $ribbon_background . ');" role="region" aria-label="' . esc_html__( 'Ribbon', 'llorix-one-lite' ) . '">';
			} else {
			echo '<section class="call-to-action ribbon-wrap" id="ribbon" role="region" aria-label="' . esc_html__( 'Ribbon', 'llorix-one-lite' ) . '">';
			}
		?>
			<div class="section-overlay-layer">
				<div class="container">
					<div class="row">

						<?php llorix_one_lite_home_ribbon_section_open_trigger(); ?>

						<div class="col-md-8 col-md-offset-2">

							<?php
								if ( ! empty( $llorix_one_lite_ribbon_title ) ) {
								echo '<h2 class="white-text strong">' . wp_kses_post( $llorix_one_lite_ribbon_title ) . '</h2>';
								} elseif ( is_customize_preview() ) {
								echo '<h2 class="white-text strong llorix_one_lite_only_customizer"></h2>';
								}

								llorix_one_lite_home_ribbon_section_subtitle_trigger();

								if ( ! empty( $llorix_one_lite_button_text ) ) {
								if ( empty( $llorix_one_lite_button_link ) ) {
									echo '<button class="btn btn-primary standard-button llorix_one_lite_only_customizer" type="button" data-toggle="modal" data-target="#stamp-modal"><span class="screen-reader-text">' . esc_html__( 'Ribbon button label:', 'llorix-one-lite' ) . $llorix_one_lite_button_text . '</span>' . $llorix_one_lite_button_text . '</button>';
								} else {
									echo '<button onclick="window.location=\'' . esc_url( $llorix_one_lite_button_link ) . '\'" class="btn btn-primary standard-button" type="button" data-toggle="modal" data-target="#stamp-modal"><span class="screen-reader-text">' . esc_html__( 'Ribbon button label:', 'llorix-one-lite' ) . $llorix_one_lite_button_text . '</span>' . esc_attr( $llorix_one_lite_button_text ) . '</button>';
								}
								} elseif ( is_customize_preview() ) {
								echo '<button class="btn btn-primary standard-button llorix_one_lite_only_customizer" type="button" data-toggle="modal" data-target="#stamp-modal"></button>';
								}
							?>

							</div>

							<?php llorix_one_lite_home_ribbon_section_close_trigger(); ?>

						</div>
					</div>
				</div>
			</section>
		<?php
		}// End if().
} elseif ( is_customize_preview() ) {
	if ( ! empty( $ribbon_background ) ) {
		echo '<section class="call-to-action ribbon-wrap llorix_one_lite_only_customizer" id="ribbon" style="background-image:url(' . $ribbon_background . ');" role="region" aria-label="' . esc_html__( 'Ribbon', 'llorix-one-lite' ) . '">';
		} else {
		echo '<section class="call-to-action ribbon-wrap llorix_one_lite_only_customizer" id="ribbon" role="region" aria-label="' . esc_html__( 'Ribbon', 'llorix-one-lite' ) . '">';
		}
	?>

	<div class="section-overlay-layer">
	<div class="container">
	<div class="row">

	<?php llorix_one_lite_home_ribbon_section_open_trigger(); ?>

	<div class="col-md-8 col-md-offset-2">

	<?php
	if ( ! empty( $llorix_one_lite_ribbon_title ) ) {
	echo '<h2 class="white-text strong">' . esc_attr( $llorix_one_lite_ribbon_title ) . '</h2>';
		} elseif ( is_customize_preview() ) {
	echo '<h2 class="white-text strong llorix_one_lite_only_customizer"></h2>';
		}

	llorix_one_lite_home_ribbon_section_subtitle_trigger();

	if ( ! empty( $llorix_one_lite_button_text ) ) {
	if ( empty( $llorix_one_lite_button_link ) ) {
					echo '<button class="btn btn-primary standard-button llorix_one_lite_only_customizer" type="button" data-toggle="modal" data-target="#stamp-modal"><span class="screen-reader-text">' . esc_html__( 'Ribbon button label:', 'llorix-one-lite' ) . $llorix_one_lite_button_text . '</span>' . $llorix_one_lite_button_text . '</button>';
			} else {
			echo '<button onclick="window.location=\'' . esc_url( $llorix_one_lite_button_link ) . '\'" class="btn btn-primary standard-button" type="button" data-toggle="modal" data-target="#stamp-modal"><span class="screen-reader-text">' . esc_html__( 'Ribbon button label:', 'llorix-one-lite' ) . $llorix_one_lite_button_text . '</span>' . esc_attr( $llorix_one_lite_button_text ) . '</button>';
			}
		} elseif ( is_customize_preview() ) {
	echo '<button class="btn btn-primary standard-button llorix_one_lite_only_customizer" type="button" data-toggle="modal" data-target="#stamp-modal"></button>';
		}
	?>

	</div>

	<?php llorix_one_lite_home_ribbon_section_close_trigger(); ?>

	</div>
	</div>
	</div>
	</section>
	<?php
	}// End if().
?>
