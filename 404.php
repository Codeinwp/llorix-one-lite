<?php
/**
 *
 * The template for displaying 404 pages (not found).
 *
 * @package llorix-one-lite
 */

	get_header();
?>

	</div>
	<!-- /END COLOR OVER IMAGE -->
</header>
<!-- /END HOME / HEADER  -->

<?php $llorix_one_lite_change_to_full_width = get_theme_mod( 'llorix_one_lite_change_to_full_width' ); ?>

<div class="content-wrap">
	<div class="container">

			<?php
			echo '<div id="primary" class="content-area ';
				if ( is_active_sidebar( 'sidebar-1' ) && empty( $llorix_one_lite_change_to_full_width ) ) {
				echo 'col-md-8';
				} else {
				echo 'col-md-12';
				}
				echo '">';
			?>

			<main id="main" class="site-main" role="main">

				<section class="error-404 not-found">
					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'llorix-one-lite' ); ?></h1>
					</header><!-- .page-header -->

					<div class="page-content">
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'llorix-one-lite' ); ?></p>

						<?php get_search_form(); ?>

					</div><!-- .page-content -->
				</section><!-- .error-404 -->

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php
		if ( empty( $llorix_one_lite_change_to_full_width ) ) {
			get_sidebar();
		}
		?>

	</div>
</div><!-- .content-wrap -->

<?php get_footer(); ?>
