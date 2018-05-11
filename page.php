<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package llorix-one-lite
 */

	get_header();
?>

	</div>
	<!-- /END COLOR OVER IMAGE -->
</header>
<!-- /END HOME / HEADER  -->

<div id="content" class="content-wrap">
	<div class="container">

		<div id="primary" class="content-area <?php echo esc_attr( llorix_one_lite_content_area_class() ); ?>">

		<?php

		echo '<main itemscope itemtype="http://schema.org/WebPageElement" itemprop="mainContentOfPage" id="main" class="site-main" role="main">';
		while ( have_posts() ) {
			the_post();
			get_template_part( 'content', 'page' );
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		}
		echo '</main>';
		echo '</div>';

		llorix_one_lite_display_sidebar();
		?>
	</div>
</div><!-- .content-wrap -->

<?php get_footer(); ?>
