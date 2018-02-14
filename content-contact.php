<?php
/**
 *
 * The template for contact template content.
 *
 * @package llorix-one-lite
 */?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'contact-page' ); ?>>

	<div class="container">

		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title single-title">', '</h1>' ); ?>
			<div class="colored-line-left"></div>
			<div class="clearfix"></div>
		</header><!-- .entry-header -->

		<div class="entry-content content-page llorix_one_lite_contact_form">

			<?php
				$llorix_one_lite_contact_form_shortcode = get_theme_mod( 'llorix_one_lite_contact_form_shortcode' );
				$llorix_one_lite_contact_form_shortcode = apply_filters( 'llorix_one_lite_translate_single_string', $llorix_one_lite_contact_form_shortcode, 'Contact form shortcode' );
			?>
			<div class="col-md-6">
				<?php the_content(); ?>
			</div>
				<?php
					if ( ! empty( $llorix_one_lite_contact_form_shortcode ) ) {
					echo '<div class="col-md-6">';
					echo do_shortcode( $llorix_one_lite_contact_form_shortcode );
					echo '</div>';
					}
				?>

			<footer class="entry-footer">
				<?php edit_post_link( esc_html__( 'Edit', 'llorix-one-lite' ), '<span class="edit-link">', '</span>' ); ?>
			</footer><!-- .fentry-footer -->

		</div><!-- .entry-content -->

	</div>

		<?php
			$llorix_one_lite_contact_map_shortcode = get_theme_mod( 'llorix_one_lite_contact_map_shortcode' );
			$llorix_one_lite_contact_map_shortcode = apply_filters( 'llorix_one_lite_translate_single_string', $llorix_one_lite_contact_map_shortcode, 'Map shortcode' );
			if ( ! empty( $llorix_one_lite_contact_map_shortcode ) ) {
			echo '<div class="contact-page-map-wrap">';
			echo do_shortcode( $llorix_one_lite_contact_map_shortcode );
			echo '</div>';
			}
		?>

</article><!-- #post-## -->
