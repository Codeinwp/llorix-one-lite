<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package llorix-one-lite
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function llorix_one_lite_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'llorix_one_lite_body_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function llorix_one_lite_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			/* translators: %s is the page title */
			$title .= " $sep " . sprintf( esc_html__( 'Page %s', 'llorix-one-lite' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'llorix_one_lite_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function llorix_one_lite_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'llorix_one_lite_render_title' );
endif;

/**
 * Logos section display content.
 *
 * @param array $llorix_one_lite_logos_decoded Section content.
 */
function llorix_one_lite_logos_content( $llorix_one_lite_logos_decoded ) {
?>
	<div class="container">
		<?php llorix_one_lite_home_logos_section_open_trigger(); ?>
		<ul class="client-logos">
			<?php
			foreach ( $llorix_one_lite_logos_decoded as $llorix_one_lite_logo ) {
				$image = ! empty( $llorix_one_lite_logo->image_url ) ? apply_filters( 'llorix_one_lite_translate_single_string', $llorix_one_lite_logo->image_url, 'Logos Section' ) : '';
				$link  = ! empty( $llorix_one_lite_logo->link ) ? apply_filters( 'llorix_one_lite_translate_single_string', $llorix_one_lite_logo->link, 'Logos Section' ) : '';
				if ( ! empty( $image ) ) {
				?>
					<li>
						<?php
						if ( ! empty( $link ) ) {
						?>
							<a href="<?php echo esc_url( $link ); ?>" title="">
								<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_html__( 'Logo', 'llorix-one-lite' ); ?>">
							</a>
							<?php
						} else {
						?>
							<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_html__( 'Logo', 'llorix-one-lite' ); ?>">
							<?php
						}
						?>
					</li>
					<?php
				}
			}
			?>
		</ul>
		<?php llorix_one_lite_home_logos_section_close_trigger(); ?>
	</div>
<?php
}


/**
 * Contact section display content.
 *
 * @param  array $llorix_one_lite_contact_info_item_decoded Section content.
 */
function llorix_one_lite_contact_content( $llorix_one_lite_contact_info_item_decoded ) {
	?>
	<div class="section-overlay-layer">
		<div class="container">
			<!-- CONTACT INFO -->
			<div class="row contact-links">
				<?php
				if ( ! empty( $llorix_one_lite_contact_info_item_decoded ) ) {
					foreach ( $llorix_one_lite_contact_info_item_decoded as $llorix_one_contact_item ) {
						$link = ( ! empty( $llorix_one_contact_item->link ) ? apply_filters( 'llorix_one_lite_translate_single_string', $llorix_one_contact_item->link, 'Contact section' ) : '' );
						$icon = ( ! empty( $llorix_one_contact_item->icon_value ) ? apply_filters( 'llorix_one_lite_translate_single_string', $llorix_one_contact_item->icon_value, 'Contact section' ) : '' );
						$text = ( ! empty( $llorix_one_contact_item->text ) ? apply_filters( 'llorix_one_lite_translate_single_string', $llorix_one_contact_item->text, 'Contact section' ) : '' );
						if ( ! empty( $icon ) || ! empty( $text ) ) {
						?>
							<div class="col-sm-4 contact-link-box col-xs-12">
								<?php
								if ( ! empty( $icon ) ) {
								?>
									<div class="icon-container">
										<i class="fa <?php echo esc_attr( $icon ); ?> colored-text"></i>
									</div>
									<?php
								}
								if ( ! empty( $text ) ) {
								?>
									<a <?php echo ( ! empty( $link ) ? 'href="' . esc_url( $link ) . '"' : '' ); ?> class="strong">
										<?php echo html_entity_decode( $text ); ?>
									</a>
									<?php
								}
								?>
							</div>
							<?php
						}
					}
				}
				?>
			</div><!-- .contact-links -->
		</div><!-- .container -->
	</div>
	<?php
}
