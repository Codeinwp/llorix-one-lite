<?php
/**
 * Changelog
 *
 * @package llorix-one-lite
 */

$llorix_one_lite = wp_get_theme( 'llorix-one-lite' );

?>
<div class="llorix-one-lite-tab-pane" id="changelog">

	<div class="llorix-one-lite-tab-pane-center">
		<?php
		echo '<h1>Llorix One Lite';
		if ( ! empty( $llorix_one_lite['Version'] ) ) {
			echo '<sup id="llorix-one-lite-theme-version">';
			echo esc_attr( $llorix_one_lite['Version'] );
			echo '</sup>';
		}
		echo '</h1>';
		?>

	</div>

	<?php
	WP_Filesystem();
	global $wp_filesystem;
	$llorix_one_lite_changelog       = $wp_filesystem->get_contents( get_template_directory() . '/CHANGELOG.md' );
	$llorix_one_lite_changelog_lines = explode( PHP_EOL, $llorix_one_lite_changelog );
	foreach ( $llorix_one_lite_changelog_lines as $llorix_one_lite_changelog_line ) {
		if ( substr( $llorix_one_lite_changelog_line, 0, 3 ) === '###' ) {
			echo '<hr /><h1>' . substr( $llorix_one_lite_changelog_line, 3 ) . '</h1>';
		} else {
			echo $llorix_one_lite_changelog_line . '<br/>';
		}
	}

?>
</div>
