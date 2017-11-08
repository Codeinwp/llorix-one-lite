<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package llorix-one-lite
 */

	get_header();
?>

	</div>
	<!-- /END COLOR OVER IMAGE -->
</header>
<!-- /END HOME / HEADER  -->

<?php
	$llorix_one_lite_blog_header_image    = get_theme_mod( 'llorix_one_lite_blog_header_image', apply_filters( 'llorix_one_lite_blog_header_image_filter', llorix_one_lite_get_file( '/images/background-images/background-blog.jpg' ) ) );
	$llorix_one_lite_blog_header_image    = apply_filters( 'llorix_one_lite_translate_single_string', $llorix_one_lite_blog_header_image, 'Header' );
	$llorix_one_lite_blog_header_title    = get_theme_mod( 'llorix_one_lite_blog_header_title', apply_filters( 'llorix_one_lite_blog_header_title_default_filter', 'This Theme Supports a Custom FrontPage' ) );
	$llorix_one_lite_blog_header_title    = apply_filters( 'llorix_one_lite_translate_single_string', $llorix_one_lite_blog_header_title, 'Header' );
	$llorix_one_lite_blog_header_subtitle = get_theme_mod( 'llorix_one_lite_blog_header_subtitle' );
	$llorix_one_lite_blog_header_subtitle = apply_filters( 'llorix_one_lite_translate_single_string', $llorix_one_lite_blog_header_subtitle, 'Header' );

	if ( ! empty( $llorix_one_lite_blog_header_image ) || ! empty( $llorix_one_lite_blog_header_title ) || ! empty( $llorix_one_lite_blog_header_subtitle ) ) :

	if ( ! empty( $llorix_one_lite_blog_header_image ) ) :
		echo '<div class="archive-top" style="background-image: url(' . $llorix_one_lite_blog_header_image . ');">';
		else :
			echo '<div class="archive-top">';
		endif;
		echo '<div class="section-overlay-layer">';
		echo '<div class="container">';

		if ( ! empty( $llorix_one_lite_blog_header_title ) ) :
			echo '<p class="archive-top-big-title">' . $llorix_one_lite_blog_header_title . '</p>';
			echo '<p class="colored-line"></p>';
			endif;

		if ( ! empty( $llorix_one_lite_blog_header_subtitle ) ) :
			echo '<p class="archive-top-text">' . $llorix_one_lite_blog_header_subtitle . '</p>';
			endif;

		echo '</div>';
		echo '</div>';
		echo '</div>';

	endif;

?>


<div role="main" id="content" class="content-wrap">
	<div class="container">
		<div id="primary" class="content-area col-md-8 post-list">
			<?php
			echo '<main ';
			if ( have_posts() ) {
				echo ' itemscope itemtype="http://schema.org/Blog" ';
			}
			echo ' id="main" class="site-main" role="main">';
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					/**
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				}
				the_posts_navigation();
			} else {
				get_template_part( 'content', 'none' );
			}
			?>
			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar(); ?>

	</div>
</div><!-- .content-wrap -->

<?php get_footer(); ?>
