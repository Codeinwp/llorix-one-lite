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

$llorix_one_lite_frontpage_content_show = get_theme_mod( 'llorix_one_lite_frontpage_content_show' );

if ( isset( $llorix_one_lite_frontpage_content_show ) && $llorix_one_lite_frontpage_content_show != 1 ) {
	$class_to_add = '';

	if ( has_post_thumbnail() ) {
		$class_to_add                  = 'overlay-layer-wrap white-text';
		$llorix_one_frontpage_featured = get_the_post_thumbnail_url();
	} else {
		$class_to_add = 'brief entry-content';
	}

	?>

	<section class="frontpage-content <?php if ( ! empty( $class_to_add ) ) {
		echo esc_attr( $class_to_add );
	} ?> " <?php if ( ! empty( $llorix_one_frontpage_featured ) ) {
	echo 'style="background-image: url(\'' . esc_url( $llorix_one_frontpage_featured ) . '\')"';
	} ?>>
		<div class="container">
			<div class="row">
				<?php
				// Show the selected frontpage content
				if ( have_posts() ) :
					while ( have_posts() ) : the_post();
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
}
