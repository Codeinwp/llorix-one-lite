<?php
/**
 * About template file
 *
 * PHP version 5.6
 *
 * @category    Sections
 * @package     Llorix_One_Lite
 * @author      Themeisle <cristian@themeisle.com>
 * @license     GNU General Public License v2 or later
 * @link        http://themeisle.com
 */

$llorix_one_lite_our_story_image = get_theme_mod( 'llorix_one_lite_our_story_image', apply_filters( 'llorix_one_lite_our_story_image_filter', llorix_one_lite_get_file( '/images/about-us.png' ) ) );
$llorix_one_lite_our_story_image = apply_filters( 'llorix_one_lite_translate_single_string', $llorix_one_lite_our_story_image, 'Our story section' );
$llorix_one_lite_our_story_title = get_theme_mod( 'llorix_one_lite_our_story_title', esc_html__( 'Our Story', 'llorix-one-lite' ) );
$llorix_one_lite_our_story_title = apply_filters( 'llorix_one_lite_translate_single_string', $llorix_one_lite_our_story_title, 'Our story section' );

if ( current_user_can( 'edit_theme_options' ) ) {
	/* translators: %1$s is the customize link %2$s the customize link label */
	$llorix_one_lite_our_story_text = get_theme_mod( 'llorix_one_lite_our_story_text', sprintf( __( 'Change this text in %s', 'llorix-one-lite' ), sprintf( '<a href="%1$s" class="llorix-one-lite-default-links">%2$s</a>', esc_url( admin_url( 'customize.php?autofocus&#91;control&#93;=llorix_one_lite_our_story_text' ) ), __( 'About section', 'llorix-one-lite' ) ) ) );
} else {
	$llorix_one_lite_our_story_text = get_theme_mod( 'llorix_one_lite_our_story_text' );
}
$llorix_one_lite_our_story_text = apply_filters( 'llorix_one_lite_translate_single_string', $llorix_one_lite_our_story_text, 'Our story section' );
$llorix_one_lite_our_story_show = get_theme_mod( 'llorix_one_lite_our_story_show' );

/* If section is not disabled */
if ( isset( $llorix_one_lite_our_story_show ) && $llorix_one_lite_our_story_show != 1 ) { ?>
	<section class="brief text-left brief-design-one brief-left" id="story" role="region" aria-label="<?php esc_html_e( 'About', 'llorix-one-lite' ); ?>">
	<?php
} else {
	if ( is_customize_preview() ) {
	?>
		<section class="brief text-left brief-design-one brief-left llorix_one_lite_only_customizer" id="story" role="region" aria-label="<?php esc_html_e( 'About', 'llorix-one-lite' ); ?>">
		<?php
	}
}
if ( ( isset( $llorix_one_lite_our_story_show ) && $llorix_one_lite_our_story_show != 1 ) || is_customize_preview() ) {
?>
		<div class="section-overlay-layer">
			<div class="container">
				<div class="row">
					<?php
					if ( ! empty( $llorix_one_lite_our_story_image ) ) {
					?>
						<div class="col-md-6 brief-content-two">
						<?php
					} else {
						if ( is_customize_preview() ) {
						?>
							<div class="col-md-6 brief-content-two llorix_one_lite_only_customizer">
						<?php
						}
					}
					if ( ! empty( $llorix_one_lite_our_story_image ) || is_customize_preview() ) {
						echo '<div class="brief-image-right">';
							echo '<img src="' . esc_url( $llorix_one_lite_our_story_image ) . '" ';
								if ( ! empty( $llorix_one_lite_our_story_title ) ) {
							echo ' alt="' . esc_attr( $llorix_one_lite_our_story_title ) . '" ';
								}
								echo '">';
							echo '</div>';
						echo '</div>';
					}

					echo '<div class="';
					if ( ! empty( $llorix_one_lite_our_story_image ) ) {
						echo 'col-md-6';
					} else {
						echo 'col-md-12';
					}
					echo ' content-section brief-content-one">';

						if ( ! empty( $llorix_one_lite_our_story_title ) ) {
						?>
						<h2 class="text-left dark-text">
						<?php echo wp_kses_post( $llorix_one_lite_our_story_title ); ?>
						</h2>
						<div class="colored-line-left"></div>
						<?php
						} else {
						if ( is_customize_preview() ) {
							?>
							<h2 class="text-left dark-text llorix_one_lite_only_customizer"></h2>
							<div class="colored-line-left llorix_one_lite_only_customizer"></div>
							<?php
							}
						}

						if ( ! empty( $llorix_one_lite_our_story_text ) ) {
						?>
						<div class="brief-content-text">
						<?php
						echo wp_kses_post( $llorix_one_lite_our_story_text );
						?>
						</div>
						<?php
						} else {
						if ( is_customize_preview() ) {
							?>
							<div class="brief-content-text llorix_one_lite_only_customizer"></div>
							<?php
							}
						}
						llorix_one_lite_home_about_section_content_one_after_trigger();
						?>
					</div>
				</div>
			</div>
		</div>
	</section><!-- .brief-design-one -->
	<?php
}// End if().
