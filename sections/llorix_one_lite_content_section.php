<?php
/**
 * Content template file
 *
 * PHP version 5.6
 *
 * @category    Sections
 * @package     Llorix_One_Lite
 * @author      Themeisle <andrei@themeisle.com>
 * @license     GNU General Public License v2 or later
 * @link        http://themeisle.com
 */

$llorix_one_lite_frontpage_content_show = get_theme_mod( 'llorix_one_lite_frontpage_content_show', 1 );

if ( isset( $llorix_one_lite_frontpage_content_show ) && $llorix_one_lite_frontpage_content_show != 1 ) {
	$class_to_add = '';
	$title_class  = '';
	if ( is_customize_preview() ) {
		$llorix_one_frontpage_featured = get_theme_mod( 'llorix_one_lite_feature_thumbnail' );
		$llorix_one_frontpage_featured = apply_filters( 'llorix_one_lite_translate_single_string', $llorix_one_frontpage_featured, 'Content section' );
		if ( ! empty( $llorix_one_frontpage_featured ) ) {
			$class_to_add = 'overlay-layer-wrap white-text';
		} else {
			$class_to_add = 'brief';
			$title_class  = 'dark-text';
		}
	} else {
		if ( has_post_thumbnail() ) {
			$class_to_add                  = 'overlay-layer-wrap white-text';
			$llorix_one_frontpage_featured = get_the_post_thumbnail_url();
		} else {
			$class_to_add = 'brief';
			$title_class  = 'dark-text';
		}
	}

	echo '<section class="frontpage-content ';

	if ( ! empty( $class_to_add ) ) {
		echo esc_attr( $class_to_add );
	}
	echo '"';
	if ( ! empty( $llorix_one_frontpage_featured ) ) {
		echo 'style="background-image: url(\'' . esc_url( $llorix_one_frontpage_featured ) . '\')"';
	}
	echo '>';
	?>
		<div class="container">
			<div class="row">
				<?php
				$llorix_frontpage_id = get_option( 'page_on_front' );
				if ( ! empty( $llorix_frontpage_id ) ) {
					$llorix_fp_title = get_the_title( $llorix_frontpage_id );
				}
				if ( ! empty( $llorix_fp_title ) ) {
					echo '<h2 class="text-left ' . esc_attr( $title_class ) . '">' . $llorix_fp_title . '</h2>';
					echo '<div class="colored-line-left"></div>';
				}

				// Show the selected frontpage content
				if ( have_posts() ) :
					while ( have_posts() ) :
the_post();
						get_template_part( 'content', 'frontpage' );
					endwhile;
				else : // I'm not sure it's possible to have no posts when this page is shown, but WTH
					get_template_part( 'content', 'none' );
				endif;
				?>
			</div>
		</div>
	</section>
	<?php
}// End if().
