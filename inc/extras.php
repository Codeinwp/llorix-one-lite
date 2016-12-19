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


if ( ! function_exists( 'llorix_one_lite_pll' ) ) {
	/**
	 * Filter to apply translations if polylang plugin is installed.
	 *
	 * @param string $input Input to translate.
	 *
	 * @return string
	 */
	function llorix_one_lite_pll( $input ) {
		if ( function_exists( 'pll__' ) ) {
			return pll__( $input );
		}
		return $input;
	}
}

if ( function_exists( 'llorix_one_lite_pll' ) ) {
	add_filter( 'llorix_one_lite_language_filter','llorix_one_lite_pll' );
}

if ( ! function_exists( 'llorix_one_companion_register_string' ) ) {
	/**
	 * Function to register repeater content in polylang.
	 *
	 * @param string $input String to register.
	 * @param string $context Field name.
	 */
	function llorix_one_companion_register_string( $input, $context ) {
		if ( function_exists( 'pll_register_string' ) ) {
			$json_decoded = json_decode( $input,true );
			foreach ( $json_decoded as $index => $value ) {
				foreach ( $value as $key => $string ) {
					if ( $key !== 'id' && $string !== 'undefined' ) {
						$text = false;
						if ( $key === 'text' ) {
							$text = true;
						}
						pll_register_string( 'llorix one ' . $context, $string, $text );
					}
				}
			}
		}
	}
}


/**
 * Register content of sections in polylang.
 */
function llorix_one_lite_translations() {
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
	llorix_one_companion_register_string( $llorix_one_lite_logos,'logos' );

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
	llorix_one_companion_register_string( $llorix_one_lite_contact_info_item,'contact' );

	$llorix_one_lite_footer_social_icons = get_theme_mod('llorix_one_lite_social_icons', json_encode( array(
		array(
			'icon_value' => 'fa-facebook',
			'link' => '#',
			'id' => 'llorix_one_lite_56d069b78cb6e',
		),
		array(
			'icon_value' => 'fa-twitter',
			'link' => '#',
			'id' => 'llorix_one_lite_56d450842cb39',
		),
		array(
			'icon_value' => 'fa-google-plus-square',
			'link' => '#',
'id' => 'llorix_one_lite_56d450512cb38',
		),
) )
	);
	llorix_one_companion_register_string( $llorix_one_lite_footer_social_icons,'footer social icons' );

	$llorix_one_lite_header_social_icons = get_theme_mod('llorix_one_lite_very_top_social_icons',json_encode( array(
			array(
				'icon_value' => 'fa-facebook',
				'link' => '#',
				'id' => 'llorix_one_lite_56d069ad8cb6b',
			),
			array(
				'icon_value' => 'fa-twitter',
				'link' => '#',
				'id' => 'llorix_one_lite_56d069b48cb6c',
			),
			array(
				'icon_value' => 'fa-google-plus-square',
				'link' => '#',
				'id' => 'llorix_one_lite_56d069b58cb6d',
			),
) )
	);
	llorix_one_companion_register_string( $llorix_one_lite_header_social_icons,'header social icons' );
}

if ( class_exists( 'Polylang' ) ) {
	add_action( 'after_setup_theme', 'llorix_one_lite_translations' );
}


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
				$image = ( ! empty( $llorix_one_lite_logo->image_url ) ? apply_filters( 'llorix_one_lite_language_filter', $llorix_one_lite_logo->image_url ) : '' );
				$link = ( ! empty( $llorix_one_lite_logo->link ) ? apply_filters( 'llorix_one_lite_language_filter', $llorix_one_lite_logo->link ) : '' );
				if ( ! empty( $image ) ) { ?>
					<li>
						<?php
						if ( ! empty( $link ) ) { ?>
							<a href="<?php echo esc_url( $link ); ?>" title="">
								<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_html__( 'Logo','llorix-one-lite' ); ?>">
							</a>
							<?php
						} else { ?>
							<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_html__( 'Logo','llorix-one-lite' ); ?>">
							<?php
						} ?>
					</li>
					<?php
				}
			} ?>
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
						$link = ( ! empty( $llorix_one_contact_item->link ) ? apply_filters( 'llorix_one_lite_language_filter',$llorix_one_contact_item->link ) : '' );
						$icon = ( ! empty( $llorix_one_contact_item->icon_value ) ? apply_filters( 'llorix_one_lite_language_filter',$llorix_one_contact_item->icon_value ) : '');
						$text = ( ! empty( $llorix_one_contact_item->text ) ? apply_filters( 'llorix_one_lite_language_filter',$llorix_one_contact_item->text ) : '' );
						if ( ! empty( $icon ) || ! empty( $text ) ) { ?>
							<div class="col-sm-4 contact-link-box col-xs-12">
								<?php
								if ( ! empty( $icon ) ) { ?>
									<div class="icon-container">
										<i class="fa <?php echo esc_attr( $icon ); ?> colored-text"></i>
									</div>
									<?php
								}
								if ( ! empty( $text ) ) { ?>
									<a <?php echo ( ! empty( $link ) ? 'href="' . esc_url( $link ) . '"' : '') ?> class="strong">
										<?php echo html_entity_decode( $llorix_one_contact_item->text ); ?>
									</a>
									<?php
								} ?>
							</div>
							<?php
						}
					}
				} ?>
			</div><!-- .contact-links -->
		</div><!-- .container -->
	</div>
	<?php
}
