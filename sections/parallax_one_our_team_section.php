<!-- =========================
 SECTION: TEAM   
============================== -->
<?php
	global $wp_customize;
	$llorix_one_our_team_title = get_theme_mod('llorix_one_our_team_title',esc_html__('Our Team','llorix-one-lite'));
	$llorix_one_our_team_subtitle = get_theme_mod('llorix_one_our_team_subtitle',esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.','llorix-one-lite'));
	$llorix_one_team_content = get_theme_mod('llorix_one_team_content',
		json_encode(
			array(
					array('image_url' => llorix_one_get_file('/images/team/1.jpg'),'title' => esc_html__('Albert Jacobs','llorix-one-lite'),'subtitle' => esc_html__('Founder & CEO','llorix-one-lite')),
					array('image_url' => llorix_one_get_file('/images/team/2.jpg'),'title' => esc_html__('Tonya Garcia','llorix-one-lite'),'subtitle' => esc_html__('Account Manager','llorix-one-lite')),
					array('image_url' => llorix_one_get_file('/images/team/3.jpg'),'title' => esc_html__('Linda Guthrie','llorix-one-lite'),'subtitle' => esc_html__('Business Development','llorix-one-lite'))
			)
		)
	);

	if(!empty($llorix_one_our_team_title) || !empty($llorix_one_our_team_subtitle) || !llorix_one_general_repeater_is_empty($llorix_one_team_content) ){
?>
		<section class="team" id="team" role="region" aria-label="<?php esc_html_e('Team','llorix-one-lite') ?>">
			<div class="section-overlay-layer">
				<div class="container">

					<!-- SECTION HEADER -->
					<?php 
						if( !empty($llorix_one_our_team_title) || !empty($llorix_one_our_team_subtitle)){ ?>
							<div class="section-header">
							<?php
								if( !empty($llorix_one_our_team_title) ){
									echo '<h2 class="dark-text">'.esc_attr($llorix_one_our_team_title).'</h2><div class="colored-line"></div>';
								} elseif ( isset( $wp_customize )   ) {
									echo '<h2 class="dark-text llorix_one_only_customizer"></h2><div class="colored-line llorix_one_only_customizer"></div>';
								}

							?>

							<?php
								if( !empty($llorix_one_our_team_subtitle) ){
									echo '<div class="sub-heading">'.esc_attr($llorix_one_our_team_subtitle).'</div>';
								} elseif ( isset( $wp_customize )   ) {
									echo '<div class="sub-heading llorix_one_only_customizer"></div>';
								}
							?>
							</div>
					<?php 
						}
			

						if(!empty($llorix_one_team_content)){
							echo '<div class="row team-member-wrap">';
							$llorix_one_team_decoded = json_decode($llorix_one_team_content);
							foreach($llorix_one_team_decoded as $llorix_one_team_member){
								if( !empty($llorix_one_team_member->image_url) ||  !empty($llorix_one_team_member->title) || !empty($llorix_one_team_member->subtitle)){?>
									<div class="col-md-3 team-member-box">
										<div class="team-member border-bottom-hover">
											<div class="member-pic">
												<?php
													if( !empty($llorix_one_team_member->image_url)){
														if( !empty($llorix_one_team_member->title) ){
															echo '<img src="'.esc_url($llorix_one_team_member->image_url).'" alt="'.esc_attr($llorix_one_team_member->title).'">';
														} else {
															echo '<img src="'.esc_url($llorix_one_team_member->image_url).'" alt="'.esc_html__('Avatar','llorix-one-lite').'">';
														}
													} else {
														$default_url = llorix_one_get_file('/images/team/default.png');
														echo '<img src="'.$default_url.'" alt="'.esc_html__('Avatar','llorix-one-lite').'">';
													}
												?>
											</div><!-- .member-pic -->

											<?php if(!empty($llorix_one_team_member->title) || !empty($llorix_one_team_member->subtitle)){?>
											<div class="member-details">
												<div class="member-details-inner">
													<?php 
													if( !empty($llorix_one_team_member->title) ){
														if(function_exists('icl_t')){
															echo '<h5 class="colored-text">'.icl_t('Team',$llorix_one_team_member->id.'_team_title',esc_attr($llorix_one_team_member->title)).'</h5>';
														} else {
															echo '<h5 class="colored-text">'.esc_attr($llorix_one_team_member->title).'</h5>';
														}
													}
													if( !empty($llorix_one_team_member->subtitle) ){ ?>
														<div class="small-text">
															<?php
																if(function_exists('icl_t')){
																	echo icl_t('Team',$llorix_one_team_member->id.'_team_subtitle',esc_attr($llorix_one_team_member->subtitle));
																} else {
																	echo esc_attr($llorix_one_team_member->subtitle);
																}
															?>	
														</div>

													<?php
													}
													?>
												</div><!-- .member-details-inner -->
											</div><!-- .member-details -->
											<?php } ?>
										</div><!-- .team-member -->
									</div><!-- .team-member -->         
									<!-- MEMBER -->
						<?php
								}
							}
							echo '</div>';
						}?>
				</div>
			</div><!-- container  -->
		</section><!-- #section9 -->
		
<?php
	} else {
		if( isset( $wp_customize ) ) {
?>
			<section class="team llorix_one_only_customizer" id="team" role="region" aria-label="<?php esc_html_e('Team','llorix-one-lite') ?>">
				<div class="section-overlay-layer">
					<div class="container">
						<div class="section-header">
							<h2 class="dark-text llorix_one_only_customizer"></h2><div class="colored-line llorix_one_only_customizer"></div>
							<div class="sub-heading llorix_one_only_customizer"></div>
						</div>
					</div>
				</div>
			</section>
<?php
		}
	}
?>