<?php
/**
 * The template for displaying all single posts.
 *
 * @package llorix-one-lite
 */

get_header(); ?>

	</div>
	<!-- /END COLOR OVER IMAGE -->
</header>
<!-- /END HOME / HEADER  -->

<div class="content-wrap">
	<div class="container">

		<div id="primary" class="content-area <?php echo esc_attr( llorix_one_lite_content_area_class() ); ?>">

			<main itemscope itemtype="http://schema.org/WebPageElement" itemprop="mainContentOfPage" id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) {
				the_post();
				get_template_part( 'content', 'single-download' );
			}
			?>

			</main><!-- #main -->

		<?php llorix_one_lite_display_sidebar(); ?>

	</div><!-- #primary -->

	</div>
</div><!-- .content-wrap -->

<?php get_footer(); ?>
