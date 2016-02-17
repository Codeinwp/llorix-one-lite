<!-- =========================
 SECTION: CLIENTS LOGOs
============================== -->
<?php 
	$llorix_one_logos = get_theme_mod('llorix_one_logos_content',
		json_encode(
			array( 
				array("image_url" => llorix_one_lite_get_file('/images/companies/1.png') ,"link" => "#" ),
				array("image_url" => llorix_one_lite_get_file('/images/companies/2.png') ,"link" => "#" ),
				array("image_url" => llorix_one_lite_get_file('/images/companies/3.png') ,"link" => "#" ),
				array("image_url" => llorix_one_lite_get_file('/images/companies/4.png') ,"link" => "#" ),
				array("image_url" => llorix_one_lite_get_file('/images/companies/5.png') ,"link" => "#" )
			)
		)
	);
	if(!empty($llorix_one_logos)){
		$llorix_one_logos_decoded = json_decode($llorix_one_logos);
		echo '<div class="clients white-bg" id="clients" role="region" aria-label="'.__('Affiliates Logos','llorix-one-lite').'"><div class="container">';
			echo '<ul class="client-logos">';					
			foreach($llorix_one_logos_decoded as $llorix_one_logo){
				if(!empty($llorix_one_logo->image_url)){
			
					echo '<li>';
					if(!empty($llorix_one_logo->link)){
						echo '<a href="'.$llorix_one_logo->link.'" title="">';
							echo '<img src="'.$llorix_one_logo->image_url.'" alt="'. esc_html__('Logo','llorix-one-lite') .'">';
						echo '</a>';
					} else {
						echo '<img src="'.esc_url($llorix_one_logo->image_url).'" alt="'.esc_html__('Logo','llorix-one-lite').'">';
					}
					echo '</li>';

	
				}
			}
			echo '</ul>';
		echo '</div></div>';
	}
?>
	