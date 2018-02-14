<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package llorix-one-lite
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content content-page" itemprop="text">
		<?php
		the_content();
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'llorix-one-lite' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( esc_html__( 'Edit', 'llorix-one-lite' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .fentry-footer -->
</article><!-- #post-## -->
