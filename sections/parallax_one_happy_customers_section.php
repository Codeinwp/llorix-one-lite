<!-- =========================
 SECTION: CUSTOMERS   
============================== -->
<?php
	global $wp_customize;
	$llorix_one_happy_customers_title = get_theme_mod('llorix_one_happy_customers_title',esc_html__('Happy Customers','llorix-one-lite'));
	$llorix_one_happy_customers_subtitle = get_theme_mod('llorix_one_happy_customers_subtitle',esc_html__('Cloud computing subscription model out of the box proactive solution.','llorix-one-lite'));
	$llorix_one_testimonials_content = get_theme_mod('llorix_one_testimonials_content',
		json_encode(
			array(
					array('image_url' => llorix_one_lite_get_file('/images/clients/1.jpg'),'title' => esc_html__('Happy Customer','llorix-one-lite'),'subtitle' => esc_html__('Lorem ipsum','llorix-one-lite'),'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo. Fusce malesuada vulputate faucibus. Integer in hendrerit nisi. Praesent a hendrerit urna. In non imperdiet elit, sed molestie odio. Fusce ac metus non purus sollicitudin laoreet.','llorix-one-lite')),
					array('image_url' => llorix_one_lite_get_file('/images/clients/2.jpg'),'title' => esc_html__('Happy Customer','llorix-one-lite'),'subtitle' => esc_html__('Lorem ipsum','llorix-one-lite'),'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo. Fusce malesuada vulputate faucibus. Integer in hendrerit nisi. Praesent a hendrerit urna. In non imperdiet elit, sed molestie odio. Fusce ac metus non purus sollicitudin laoreet.','llorix-one-lite')),
					array('image_url' => llorix_one_lite_get_file('/images/clients/3.jpg'),'title' => esc_html__('Happy Customer','llorix-one-lite'),'subtitle' => esc_html__('Lorem ipsum','llorix-one-lite'),'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo. Fusce malesuada vulputate faucibus. Integer in hendrerit nisi. Praesent a hendrerit urna. In non imperdiet elit, sed molestie odio. Fusce ac metus non purus sollicitudin laoreet.','llorix-one-lite'))
			)
		)
	);

	if( !empty($llorix_one_happy_customers_title) || !empty($llorix_one_happy_customers_subtitle) || !llorix_one_general_repeater_is_empty($llorix_one_testimonials_content) ){
?>
	<section class="testimonials" id="customers" role="region" aria-label="<?php esc_html_e('Testimonials','llorix-one-lite') ?>">
		<div class="section-overlay-layer">
			<div class="container">

				<!-- SECTION HEADER -->
				<?php
				if(!empty($llorix_one_happy_customers_title) || !empty($llorix_one_happy_customers_subtitle)){
				?>
					<div class="section-header">
						<?php
							if( !empty($llorix_one_happy_customers_title) ){
								echo '<h2 class="dark-text">'.esc_attr($llorix_one_happy_customers_title).'</h2><div class="colored-line"></div>';
							} elseif ( isset( $wp_customize )   ) {
								echo '<h2 class="dark-text llorix_one_lite_only_customizer"></h2><div class="colored-line llorix_one_lite_only_customizer"></div>';
							}

							if( !empty($llorix_one_happy_customers_subtitle) ){
								echo '<div class="sub-heading">'.esc_attr($llorix_one_happy_customers_subtitle).'</div>';
							} elseif ( isset( $wp_customize )   ) {
								echo '<div class="sub-heading llorix_one_lite_only_customizer"></div>';
							}
						?>
					</div>
				<?php
				}


				if(!empty($llorix_one_testimonials_content)) {
					echo '<div id="happy_customers_wrap" class="testimonials-wrap">';
					$llorix_one_testimonials_content_decoded = json_decode($llorix_one_testimonials_content);
					foreach($llorix_one_testimonials_content_decoded as $llorix_one_testimonial){
						if( !empty($llorix_one_testimonial->image_url) || !empty($llorix_one_testimonial->title) || !empty($llorix_one_testimonial->subtitle) || !empty($llorix_one_testimonial->text) ){
			?>
							<!-- SINGLE FEEDBACK -->
							<div class="testimonials-box">
								<div class="feedback border-bottom-hover">
									<div class="pic-container">
										<div class="pic-container-inner">
											<?php

												if( !empty($llorix_one_testimonial->image_url) ){
													if(!empty($llorix_one_testimonial->title)){
														echo '<img src="'.esc_url($llorix_one_testimonial->image_url).'" alt="'.$llorix_one_testimonial->title.'">';
													} else {
														echo '<img src="'.esc_url($llorix_one_testimonial->image_url).'" alt="'.esc_html('Avatar','llorix-one-lite').'">';
													}
												} else {
													$default_image = llorix_one_lite_get_file('/images/clients/client-no-image.jpg');
													echo '<img src="'.esc_url($default_image).'" alt="'.esc_html('Avatar','llorix-one-lite').'">';
												}	
											?>
										</div>
									</div>
									<?php
									if(!empty($llorix_one_testimonial->title) || !empty($llorix_one_testimonial->subtitle) || !empty($llorix_one_testimonial->text)) {
									?>
										<div class="feedback-text-wrap">
										<?php
											if(!empty($llorix_one_testimonial->title)){
										?>
												<h5 class="colored-text">
													<?php
														if(function_exists('icl_t')){
															echo icl_t('Testimonials',$llorix_one_testimonial->id.'_testimonials_title',esc_attr($llorix_one_testimonial->title));
														} else {
															echo esc_attr($llorix_one_testimonial->title);
														}
													?>
												</h5>
										<?php
											}

											if(!empty($llorix_one_testimonial->subtitle)){
										?>
												<div class="small-text">
													<?php 
														if(function_exists('icl_t')){
															echo icl_t('Testimonials',$llorix_one_testimonial->id.'_testimonials_subtitle',esc_attr($llorix_one_testimonial->subtitle));
														} else {
															echo esc_attr($llorix_one_testimonial->subtitle);
														}
													?>	
												</div>
										<?php
											}

											if(!empty($llorix_one_testimonial->text)){
										?>
												<p>
													<?php 
														if(function_exists('icl_t')){
															echo icl_t('Testimonials',$llorix_one_testimonial->id.'_testimonials_text',html_entity_decode($llorix_one_testimonial->text));
														} else {
															echo html_entity_decode($llorix_one_testimonial->text); 
														}
													?>
												</p>
										<?php
											}
										?>
										</div>
									<?php
									}
									?>
								</div>
							</div><!-- .testimonials-box -->
				<?php
					}
				}
				echo '</div>';
			}
				?>
			</div>
		</div>
	</section><!-- customers -->
<?php
	} else {
		if( isset( $wp_customize ) ) {
?>
			<section class="testimonials llorix_one_lite_only_customizer" id="customers" role="region" aria-label="<?php esc_html_e('Testimonials','llorix-one-lite') ?>">
				<div class="section-overlay-layer">
					<div class="container">
						<div class="section-header">
							<h2 class="dark-text llorix_one_lite_only_customizer"></h2><div class="colored-line llorix_one_lite_only_customizer"></div>
							<div class="sub-heading llorix_one_lite_only_customizer"></div>
						</div>				
					</div>
				</div>
			</section><!-- customers -->
<?php
		}
	}