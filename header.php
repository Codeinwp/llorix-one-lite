<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package llorix-one-lite
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<?php
echo '<body itemscope itemtype="http://schema.org/WebPage" ' . 'class="' . join( ' ', get_body_class() ) . '"' . ' dir="';
if ( is_rtl() ) {
	echo 'rtl';
} else {
	echo 'ltr';
}
echo '">';
?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'llorix-one-lite' ); ?></a>
<!-- =========================
	PRE LOADER
============================== -->
<?php

global $wp_customize;

if ( is_front_page() && ! isset( $wp_customize ) && get_option( 'show_on_front' ) != 'page' ) :

	$llorix_one_lite_disable_preloader = get_theme_mod( 'llorix_one_lite_disable_preloader' );

	if ( isset( $llorix_one_lite_disable_preloader ) && ( $llorix_one_lite_disable_preloader != 1 ) ) :

		echo '<div class="preloader">';
		echo '<div class="status">&nbsp;</div>';
		echo '</div>';

	endif;

endif;
?>


<!-- =========================
	SECTION: HOME / HEADER
============================== -->
<!--header-->
<?php
	$parallax_effect             = '';
	$llorix_one_lite_enable_move = get_theme_mod( 'llorix_one_lite_enable_move' );
	if ( ! empty( $llorix_one_lite_enable_move ) && $llorix_one_lite_enable_move ) {
	$parallax_effect = ' headr-parallax-effect';
	}

?>

<header itemscope itemtype="http://schema.org/WPHeader" id="masthead" role="banner" data-stellar-background-ratio="0.5" class="header header-style-one site-header<?php echo $parallax_effect; ?>">

	<!-- COLOR OVER IMAGE -->
	<?php

	$fixedheader = 'sticky-navigation-open';

	$llorix_one_lite_sticky_header = get_theme_mod( 'llorix_one_lite_sticky_header', 'llorix-one-lite' );

	$llorix_one_lite_keep_old_fp_template = get_theme_mod( 'llorix_one_lite_keep_old_fp_template' );

	/**
	 * Header toggle option should only be available for the custom frontpage
	 */
	if ( is_front_page() && ( 'page' == get_option( 'show_on_front' ) ) ) {
		if ( isset( $llorix_one_lite_sticky_header ) && ( $llorix_one_lite_sticky_header == 1 ) && ! $llorix_one_lite_keep_old_fp_template ) {
			$fixedheader = '';
		}
	}

	?>
	<div class="overlay-layer-nav 
	<?php
	if ( ! empty( $fixedheader ) ) {
echo esc_attr( $fixedheader ); }
?>
">

		<!-- STICKY NAVIGATION -->
		<div class="navbar navbar-inverse bs-docs-nav navbar-fixed-top sticky-navigation appear-on-scroll">
			<?php

			/* VERY TOP HEADER */
			$llorix_one_lite_very_top_header_show = get_theme_mod( 'llorix_one_lite_very_top_header_show', apply_filters( 'llorix_one_lite_very_top_header_show_filter', 0 ) );
			$allowed_protocols                    = wp_allowed_protocols();
			array_push( $allowed_protocols, 'callto' );

			/* If section is not disabled */
			if ( isset( $llorix_one_lite_very_top_header_show ) && $llorix_one_lite_very_top_header_show != 1 ) {
				?>
				<div class="very-top-header" id="very-top-header">
					<div class="container">
						<?php
						$llorix_one_lite_very_top_header_phone      = get_theme_mod( 'llorix_one_lite_very_top_header_phone', esc_html__( '(+9) 0999.500.400', 'llorix-one-lite' ) );
						$llorix_one_lite_very_top_header_phone      = apply_filters( 'llorix_one_lite_translate_single_string', $llorix_one_lite_very_top_header_phone, 'Very Top Header' );
						$llorix_one_lite_very_top_header_phone_text = get_theme_mod( 'llorix_one_lite_very_top_header_phone_text', esc_html__( 'Call us: ', 'llorix-one-lite' ) );
						$llorix_one_lite_very_top_header_phone_text = apply_filters( 'llorix_one_lite_translate_single_string', $llorix_one_lite_very_top_header_phone_text, 'Very Top Header' );


						if ( ! empty( $llorix_one_lite_very_top_header_phone ) || ! empty( $llorix_one_lite_very_top_header_phone_text ) ) {
							echo '<div class="very-top-left">';
							echo $llorix_one_lite_very_top_header_phone_text;
							echo '<span>' . wp_kses( $llorix_one_lite_very_top_header_phone, 'post', $allowed_protocols ) . '</span>';
							echo '</div>';
						} elseif ( isset( $wp_customize ) ) {
							echo '<div class="very-top-left llorix_one_lite_only_customizer"><span></span></div>';
						}
						?>
						<div class="very-top-right">
							<?php
							llorix_one_lite_header_top_right_open_trigger();
							/* SOCIAL ICONS */
							$default                      = llorix_one_lite_header_social_icons_get_default_content();
							$llorix_one_lite_social_icons = get_theme_mod( 'llorix_one_lite_very_top_social_icons', $default );
							llorix_one_lite_social_icons( $llorix_one_lite_social_icons, false );
							llorix_one_lite_header_top_right_close_trigger();
							?>
						</div>
					</div>
				</div>
				<?php
				/* If section is disabled, but we are in Customize, display section with class llorix_one_lite_only_customizer */
			} elseif ( isset( $wp_customize ) ) {
				?>
				<div class="very-top-header llorix_one_lite_only_customizer" id="very-top-header">
					<div class="container">
						<?php
						$llorix_one_lite_very_top_header_phone = get_theme_mod( 'llorix_one_lite_very_top_header_phone', '(+9) 0999.500.400' );
						$llorix_one_lite_very_top_header_phone = apply_filters( 'llorix_one_lite_translate_single_string', $llorix_one_lite_very_top_header_phone, 'Very Top Header' );

						if ( ! empty( $llorix_one_lite_very_top_header_phone ) ) {
							echo '<div class="very-top-left">';
							echo esc_html_e( 'Call us:', 'llorix-one-lite' ) . ' ';
							echo '<span>' . wp_kses( $llorix_one_lite_very_top_header_phone, 'post', $allowed_protocols ) . '</span>';
							echo '</div>';
						} elseif ( isset( $wp_customize ) ) {
							echo '<div class="very-top-left llorix_one_lite_only_customizer">' . esc_html_e( 'Call us:', 'llorix-one-lite' ) . '<span></span></div>';
						}
						?>
						<div class="very-top-right">
							<?php
							llorix_one_lite_header_top_right_open_trigger();
							/* SOCIAL ICONS */
							$default                      = llorix_one_lite_header_social_icons_get_default_content();
							$llorix_one_lite_social_icons = get_theme_mod( 'llorix_one_lite_very_top_social_icons', $default );
							llorix_one_lite_social_icons( $llorix_one_lite_social_icons, false );
							llorix_one_lite_header_top_right_close_trigger();
							?>
						</div>
					</div>
				</div>
				<?php
			}// End if().
			?>

			<!-- CONTAINER -->
			<div class="container">

				<div class="navbar-header">

					<!-- LOGO -->

					<button title='<?php _e( 'Toggle Menu', 'llorix-one-lite' ); ?>' aria-controls='menu-main-menu' aria-expanded='false' type="button" class="navbar-toggle menu-toggle" id="menu-toggle" data-toggle="collapse" data-target="#menu-primary">
						<span class="screen-reader-text"><?php esc_html_e( 'Toggle navigation', 'llorix-one-lite' ); ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<?php

					$llorix_one_lite_logo = get_theme_mod( 'llorix_one_lite_logo' );
					$llorix_one_lite_logo = apply_filters( 'llorix_one_lite_translate_single_string', $llorix_one_lite_logo, 'Header Logo' );


					if ( ! empty( $llorix_one_lite_logo ) ) :

						echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="navbar-brand" title="' . get_bloginfo( 'title' ) . '">';

						echo '<img src="' . esc_url( $llorix_one_lite_logo ) . '" alt="' . get_bloginfo( 'title' ) . '">';

						echo '</a>';

						echo '<div class="header-logo-wrap text-header llorix_one_lite_only_customizer">';

						echo '<h1 itemprop="headline" id="site-title" class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">' . get_bloginfo( 'name' ) . '</a></h1>';

						echo '<p itemprop="description" id="site-description" class="site-description">' . get_bloginfo( 'description' ) . '</p>';

						echo '</div>';

					else :

						if ( isset( $wp_customize ) ) :

							echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="navbar-brand llorix_one_lite_only_customizer" title="' . get_bloginfo( 'title' ) . '">';

							echo '<img src="" alt="' . get_bloginfo( 'title' ) . '">';

							echo '</a>';

						endif;

						echo '<div class="header-logo-wrap text-header">';

						echo '<h1 itemprop="headline" id="site-title" class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">' . get_bloginfo( 'name' ) . '</a></h1>';

						echo '<p itemprop="description" id="site-description" class="site-description">' . get_bloginfo( 'description' ) . '</p>';

						echo '</div>';
					endif;

					?>

				</div>

				<!-- MENU -->
				<div itemscope itemtype="http://schema.org/SiteNavigationElement" aria-label="<?php esc_html_e( 'Primary Menu', 'llorix-one-lite' ); ?>" id="menu-primary" class="navbar-collapse collapse">
					<!-- LOGO ON STICKY NAV BAR -->
					<div id="site-header-menu" class="site-header-menu">
						<nav id="site-navigation" class="main-navigation" role="navigation">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'primary',
									'menu_class'     => 'primary-menu small-text',
									'depth'          => 4,
									'fallback_cb'    => 'llorix_one_lite_wp_page_menu',
								)
							);
							?>
						</nav>
					</div>
				</div>


			</div>
			<!-- /END CONTAINER -->
		</div>
		<!-- /END STICKY NAVIGATION -->
