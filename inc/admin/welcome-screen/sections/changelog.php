<?php
/**
 * Changelog
 */

$llorix_one = wp_get_theme( 'llorix-one' );

?>
<div class="parallax-one-tab-pane" id="changelog">

	<div class="prallax-one-tab-pane-center">
	
		<h1>Llorix One <?php if( !empty($llorix_one['Version']) ): ?> <sup id="parallax-one-theme-version"><?php echo esc_attr( $llorix_one['Version'] ); ?> </sup><?php endif; ?></h1>

	</div>

	<?php
	WP_Filesystem();
	global $wp_filesystem;
	$llorix_one_changelog = $wp_filesystem->get_contents( get_template_directory().'/CHANGELOG.md' );
	$llorix_one_changelog_lines = explode(PHP_EOL, $llorix_one_changelog);
	foreach($llorix_one_changelog_lines as $llorix_one_changelog_line){
		if(substr( $llorix_one_changelog_line, 0, 3 ) === "###"){
			echo '<hr /><h1>'.substr($llorix_one_changelog_line,3).'</h1>';
		} else {
			echo $llorix_one_changelog_line,'<br/>';
		}
	}

?>
	
</div>