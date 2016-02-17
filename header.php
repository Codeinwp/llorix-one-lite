<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package llorix-one-lite
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body itemscope itemtype="http://schema.org/WebPage" <?php body_class(); ?> dir="<?php if (is_rtl()) echo "rtl"; else echo "ltr"; ?>">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'llorix-one-lite' ); ?></a>
	<!-- =========================
     PRE LOADER       
    ============================== -->
	<?php
		
	 global $wp_customize;

	 if((is_front_page() || is_page_template('template-frontpage.php')) && !isset( $wp_customize ) && get_option( 'show_on_front' ) != 'page' ): 
	 
		$parallax_one_disable_preloader = get_theme_mod('llorix_one_disable_preloader');
		
		if( isset($parallax_one_disable_preloader) && ($parallax_one_disable_preloader != 1)):
			 
			echo '<div class="preloader">';
				echo '<div class="status">&nbsp;</div>';
			echo '</div>';
			
		endif;	

	endif; ?>


	<!-- =========================
     SECTION: HOME / HEADER  
    ============================== -->
	<!--header-->
	<header itemscope itemtype="http://schema.org/WPHeader" id="masthead" role="banner" data-stellar-background-ratio="0.5" class="header header-style-one site-header">

        <!-- COLOR OVER IMAGE -->
        <?php
			$llorix_one_sticky_header = get_theme_mod('llorix_one_sticky_header','llorix-one-lite');
			if( isset($llorix_one_sticky_header) && ($llorix_one_sticky_header != 1)){
				$fixedheader = 'sticky-navigation-open';
			} else {
				if( !is_front_page() || is_page_template('template-frontpage.php') ){
					$fixedheader = 'sticky-navigation-open';
				}else{
					$fixedheader = '';
					if ( 'posts' != get_option( 'show_on_front' ) ) {
						if( isset($llorix_one_sticky_header) && ($llorix_one_sticky_header != 1)){
							$fixedheader = 'sticky-navigation-open';
						} else {
							$fixedheader = '';
						}
					}
				}
			}
        ?>
		<div class="overlay-layer-nav <?php if(!empty($fixedheader)) {echo esc_attr($fixedheader);} ?>">

            <!-- STICKY NAVIGATION -->
            <div class="navbar navbar-inverse bs-docs-nav navbar-fixed-top sticky-navigation appear-on-scroll">

		    	<div class="very-top-header">
		        	<div class="container">
		        		<?php
		        			$llorix_one_very_top_header_phone = get_theme_mod('llorix_one_very_top_header_phone','(+9) 0999.500.400');

							if( !empty($llorix_one_very_top_header_phone) ){
				        		echo '<div class="very-top-left">';
				        		echo esc_html_e('Call us:', 'llorix-one-lite') . ' ';
				        		echo '<span>' . esc_attr($llorix_one_very_top_header_phone) . '</span>';
				        		echo '</div>';
							} elseif ( isset( $wp_customize )   ) {
								echo '<div class="very-top-left llorix_one_lite_only_customizer">' . esc_html_e('Call us:', 'llorix-one-lite') . '<span></span></div>';
							}
						?>
		        		<div class="very-top-right">
							<?php 
								/* SOCIAL ICONS */
								$llorix_one_lite_social_icons = get_theme_mod('llorix_one_very_top_social_icons',json_encode(
																array(
																	array('icon_value' =>'icon-social-facebook' , 'link' => '#'),
																	array('icon_value' =>'icon-social-twitter' , 'link' => '#'),
																	array('icon_value' =>'icon-social-googleplus' , 'link' => '#')
																	)
																));
								
								if( !empty( $llorix_one_lite_social_icons ) ){
									$llorix_one_lite_social_icons_decoded = json_decode($llorix_one_lite_social_icons);

									if( !empty($llorix_one_lite_social_icons_decoded) ){
										echo '<ul class="social-icons">';
											foreach($llorix_one_lite_social_icons_decoded as $llorix_one_social_icon){

												echo '<li><a href="'.esc_url($llorix_one_social_icon->link).'"><span class="'.esc_attr($llorix_one_social_icon->icon_value).' transparent-text-dark" aria-hidden="true"></span><span class="screen-reader-text">'.esc_attr(explode("-",$llorix_one_social_icon->icon_value)[2]).'</span></a></li>';
											}
										echo '</ul>';
									}
								}
							?>            
		        		</div>
		        	</div>
		        </div>

				<!-- CONTAINER -->
                <div class="container">
				
                    <div class="navbar-header">
                     
                        <!-- LOGO -->
						
                        <button title='<?php _e( 'Toggle Menu', 'llorix-one-lite' ); ?>' aria-controls='menu-main-menu' aria-expanded='false' type="button" class="navbar-toggle menu-toggle" id="menu-toggle" data-toggle="collapse" data-target="#menu-primary">
                            <span class="screen-reader-text"><?php esc_html_e('Toggle navigation','llorix-one-lite'); ?></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
						
						<?php
							
							$parallax_one = get_theme_mod( 'llorix_one_logo' );

							
							
							if(!empty($parallax_one)):

								echo '<a href="'.esc_url( home_url( '/' ) ).'" class="navbar-brand" title="'.get_bloginfo('title').'">';

									echo '<img src="'.esc_url($parallax_one).'" alt="'.get_bloginfo('title').'">';

								echo '</a>';

								echo '<div class="header-logo-wrap text-header llorix_one_lite_only_customizer">';

									echo '<h1 itemprop="headline" id="site-title" class="site-title"><a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">'.get_bloginfo( 'name' ).'</a></h1>';
								
									echo '<p itemprop="description" id="site-description" class="site-description">'.get_bloginfo( 'description' ).'</p>';

								echo '</div>';	
							
							else:
							
								if( isset( $wp_customize ) ):
								
									echo '<a href="'.esc_url( home_url( '/' ) ).'" class="navbar-brand llorix_one_lite_only_customizer" title="'.get_bloginfo('title').'">';

										echo '<img src="" alt="'.get_bloginfo('title').'">';

									echo '</a>';
								
								endif;
							
								echo '<div class="header-logo-wrap text-header">';
									
									echo '<h1 itemprop="headline" id="site-title" class="site-title"><a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">'.get_bloginfo( 'name' ).'</a></h1>';

									echo '<p itemprop="description" id="site-description" class="site-description">'.get_bloginfo( 'description' ).'</p>';

								echo '</div>';							
							endif;	

						?>

                    </div>
                    
                    <!-- MENU -->
					<div itemscope itemtype="http://schema.org/SiteNavigationElement" aria-label="<?php esc_html_e('Primary Menu','llorix-one-lite') ?>" id="menu-primary" class="navbar-collapse collapse">
						<!-- LOGO ON STICKY NAV BAR -->
						<div id="site-header-menu" class="site-header-menu">
							<nav id="site-navigation" class="main-navigation" role="navigation">
							<?php 
								wp_nav_menu( 
									array( 
										'theme_location'    => 'primary',
										'menu_class'        => 'primary-menu small-text',
										'depth'           	=> 4,
										'fallback_cb'       => 'llorix_one_lite_wp_page_menu'
										 ) 
								);
							?>
							</nav>
						</div>
                    </div>
					
					
                </div>
                <!-- /END CONTAINER -->
            </div>
            <!-- /END STICKY NAVIGATION -->