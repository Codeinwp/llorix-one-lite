<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package llorix-one
 */
?>

    <footer itemscope itemtype="http://schema.org/WPFooter" id="footer" role="contentinfo" class = "footer grey-bg">

        <div class="container">
            <div class="footer-widget-wrap">
			
				<?php
					if( is_active_sidebar( 'footer-area' ) ){
				?>
						<div itemscope itemtype="http://schema.org/WPSideBar" role="complementary" id="sidebar-widgets-area-1" class="col-md-3 col-sm-6 col-xs-12 widget-box" aria-label="<?php esc_html_e('Widgets Area 1','llorix-one'); ?>">
							<?php
								dynamic_sidebar( 'footer-area' );
							?>
						</div>
				
				<?php
					}
					if( is_active_sidebar( 'footer-area-2' ) ){
				?>
						<div itemscope itemtype="http://schema.org/WPSideBar" role="complementary" id="sidebar-widgets-area-2" class="col-md-3 col-sm-6 col-xs-12 widget-box" aria-label="<?php esc_html_e('Widgets Area 2','llorix-one'); ?>">
							<?php
								dynamic_sidebar( 'footer-area-2' );
							?>
						</div>
				<?php
					}
					if( is_active_sidebar( 'footer-area-3' ) ){
				?>
						<div itemscope itemtype="http://schema.org/WPSideBar" role="complementary" id="sidebar-widgets-area-3" class="col-md-3 col-sm-6 col-xs-12 widget-box" aria-label="<?php esc_html_e('Widgets Area 3','llorix-one'); ?>">
						   <?php
								dynamic_sidebar( 'footer-area-3' );
							?>
						</div>
				<?php
					}
					if( is_active_sidebar( 'footer-area-4' ) ){
				?>
						<div itemscope itemtype="http://schema.org/WPSideBar" role="complementary" id="sidebar-widgets-area-4" class="col-md-3 col-sm-6 col-xs-12 widget-box" aria-label="<?php esc_html_e('Widgets Area 4','llorix-one'); ?>">
							<?php
								dynamic_sidebar( 'footer-area-4' );
							?>
						</div>
				<?php
					}
				?>

            </div><!-- .footer-widget-wrap -->

	        <div class="footer-bottom-wrap">
				<?php
					global $wp_customize;
				
					/* COPYRIGHT */
					$llorix_one_copyright = get_theme_mod('llorix_one_copyright','Themeisle');
					
					if( !empty($llorix_one_copyright) ){
						echo '<span class="parallax_one_copyright_content">'.esc_attr($llorix_one_copyright).'</span>';
					} elseif ( isset( $wp_customize )   ) {
						echo '<span class="parallax_one_copyright_content llorix_one_only_customizer"></span>';
					}
				
					/* OPTIONAL FOOTER LINKS */
					
					echo '<div itemscope role="navigation" itemtype="http://schema.org/SiteNavigationElement" id="menu-secondary" aria-label="'.esc_html__('Secondary Menu','llorix-one').'">';
						echo '<h1 class="screen-reader-text">'.esc_html__( 'Secondary Menu', 'llorix-one' ).'</h1>';
						wp_nav_menu( 
							array( 
								'theme_location'    => 'parallax_footer_menu',
								'container'         => false,
								'menu_class'        => 'footer-links small-text',
								'depth' 			=> 1,
								'fallback_cb'       => false ) );
					echo '</div>';
					/* SOCIAL ICONS */
				
					$llorix_one_social_icons = get_theme_mod('llorix_one_social_icons',json_encode(array(array('icon_value' =>'icon-social-facebook' , 'link' => '#'),array('icon_value' =>'icon-social-twitter' , 'link' => '#'),array('icon_value' =>'icon-social-googleplus' , 'link' => '#'))));

					if( !empty( $llorix_one_social_icons ) ){
						
						$llorix_one_social_icons_decoded = json_decode($llorix_one_social_icons);
						
						if( !empty($llorix_one_social_icons_decoded) ){
						
							echo '<ul class="social-icons">';
							
								foreach($llorix_one_social_icons_decoded as $llorix_one_social_icon){
									
									echo '<li><a href="'.esc_url($llorix_one_social_icon->link).'"><span class="parallax-one-footer-icons '.esc_attr($llorix_one_social_icon->icon_value).' transparent-text-dark" aria-hidden="true"></span><span class="screen-reader-text">'.esc_attr(explode("-",$llorix_one_social_icon->icon_value)[2]).'</span></a></li>';

								}
						
							echo '</ul>';
						
						}
					}
				?>
	            
	        </div><!-- .footer-bottom-wrap -->

	        <div class="powered-by">
	            <a class="" href="http://themeisle.com/themes/llorix-one/" rel="nofollow">Llorix One </a> <?php esc_html_e('powered by','llorix-one'); ?> <a class="" href="http://wordpress.org/" rel="nofollow"><?php esc_html_e('WordPress','llorix-one'); ?></a>
	        </div>

	    </div><!-- container -->

    </footer>

	<?php wp_footer(); ?>

</body>
</html>
