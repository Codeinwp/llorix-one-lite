<?php
/**
 * Template name: Frontpage
 *
 * @package llorix-one-lite
 */


	get_header(); 

?>

<!-- =========================
 PRE LOADER       
============================== -->
<?php
	
	global $wp_customize;

	if( !isset( $wp_customize ) ): 

		$llorix_one_disable_preloader = get_theme_mod('llorix_one_disable_preloader');

		if( isset($llorix_one_disable_preloader) && ($llorix_one_disable_preloader != 1)):
			 
			echo '<div class="preloader">';
				echo '<div class="status">&nbsp;</div>';
			echo '</div>';
			
		endif;	

	endif; 

	llorix_one_get_template_part( apply_filters("parallax_one_plus_header_layout","/sections/parallax_one_header_section"));

?>
	</div>
	<!-- /END COLOR OVER IMAGE -->
</header>
<!-- /END HOME / HEADER  -->

<div itemprop id="content" class="content-warp" role="main">

<?php

	$sections_array = apply_filters(
		"parallax_one_plus_sections_filter",
		array(
			'sections/parallax_one_logos_section',
			'sections/parallax_one_our_services_section',
			'sections/parallax_one_our_story_section',
			'sections/parallax_one_our_team_section',
			'sections/parallax_one_happy_customers_section',
			'sections/parallax_one_ribbon_section',
			'sections/parallax_one_latest_news_section',
			'sections/parallax_one_contact_info_section',
			'sections/parallax_one_map_section'
			)
		);

	if(!empty($sections_array)){
		foreach($sections_array as $section){
			llorix_one_get_template_part($section);
		}
	}
?>

</div><!-- .content-wrap -->

<?php 

	get_footer();

?>