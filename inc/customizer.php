<?php
/**
 * llorix-one-lite Theme Customizer
 *
 * @package llorix-one-lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function llorix_one_lite_customize_register( $wp_customize ) {
	
	class LlorixOneLite_Contact_Page_Instructions extends WP_Customize_Control {
		public function render_content() {
			echo __( 'To customize the Contact Page you need to first select the template "Contact page" for the page you want to use for this purpose. Then open that page in the browser and press "Customize" in the top bar.','llorix-one-lite' );
		}
	}
	
	class LlorixOneLite_Front_Page_Instructions extends WP_Customize_Control {
		public function render_content() {
			echo __( 'To customize the Front Page you need to first select the template "Frontpage" for the page you want to use for this purpose. Then open that page in the browser and press "Customize" in the top bar.','llorix-one-lite' );
		}
	}
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	/***********************************************************************************/
	/******  Frontpage - instructions for users when not on Frontpage template *********/
	/***********************************************************************************/
	
	$wp_customize->add_section( 'llorix_one_lite_front_page_instructions', array(
        'title'    => __( 'Landing Page Settings', 'llorix-one-lite' ),
        'priority' => 25
    ) );
	
	$wp_customize->add_setting( 'llorix_one_lite_front_page_instructions', array( 'sanitize_callback' => 'llorix_one_lite_sanitize_text' ) );
	
	$wp_customize->add_control( new LlorixOneLite_Front_Page_Instructions( $wp_customize, 'llorix_one_lite_front_page_instructions', array(
	    'section' => 'llorix_one_lite_front_page_instructions',
		'active_callback' => 'llorix_one_lite_not_show_on_front',
	)));
	

	/********************************************************/
	/************** WP DEFAULT CONTROLS  ********************/
	/********************************************************/
	
	$wp_customize->remove_control('background_color');
	$wp_customize->get_section('background_image')->panel='panel_2';
	$wp_customize->get_section('colors')->panel='panel_2';


	/********************************************************/
	/********************* APPEARANCE  **********************/
	/********************************************************/
	$wp_customize->add_panel( 'panel_2', array(
		'priority' => 30,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => esc_html__( 'Appearance', 'llorix-one-lite' )
	) );
	
	$wp_customize->add_setting( 'llorix_one_lite_text_color', array(
		'default' => '#313131',
		'sanitize_callback' => 'llorix_one_lite_sanitize_text'
	));
		
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'llorix_one_lite_text_color',
			array(
				'label'      => esc_html__( 'Text color', 'llorix-one-lite' ),
				'section'    => 'colors',
				'priority'   => 5
			)
		)
	);
	
	
	$wp_customize->add_setting( 'llorix_one_lite_title_color', array(
		'default' => '#454545',
		'sanitize_callback' => 'llorix_one_lite_sanitize_text'
	));
		
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'llorix_one_lite_title_color',
			array(
				'label'      => esc_html__( 'Title color', 'llorix-one-lite' ),
				'section'    => 'colors',
				'priority'   => 6
			)
		)
	);
	
	$wp_customize->add_section( 'llorix_one_lite_appearance_general' , array(
		'title'       => esc_html__( 'General options', 'llorix-one-lite' ),
      	'priority'    => 3,
      	'description' => esc_html__('Paralax One theme general appearance options','llorix-one-lite'),
		'panel'		  => 'panel_2'
	));
	
	/* Logo	*/
	$wp_customize->add_setting( 'llorix_one_lite_logo', array(
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage'
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'llorix_one_lite_logo', array(
	      	'label'    => esc_html__( 'Logo', 'llorix-one-lite' ),
	      	'section'  => 'llorix_one_lite_appearance_general',
			'priority'    => 1,
	)));
	
	/* Sticky header */
	$wp_customize->add_setting( 'llorix_one_lite_sticky_header', array(
		'sanitize_callback' => 'llorix_one_lite_sanitize_text',
	));
	$wp_customize->add_control(
			'llorix_one_lite_sticky_header',
			array(
				'type' => 'checkbox',
				'label' => esc_html__('Header visibility','llorix-one-lite'),
				'description' => esc_html__('If this box is checked, the header will toggle on frontpage.','llorix-one-lite'),
				'section' => 'llorix_one_lite_appearance_general',
				'priority'    => 2,
			)
	);


	/********************************************************/
	/************* HEADER OPTIONS  ********************/
	/********************************************************/	
	$wp_customize->add_panel( 'panel_1', array(
		'priority' => 35,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => esc_html__( 'Header section', 'llorix-one-lite' )
	) );
	
	/* HEADER CONTENT */
	
	$wp_customize->add_section( 'llorix_one_lite_header_content' , array(
			'title'       => esc_html__( 'Content', 'llorix-one-lite' ),
			'priority'    => 1,
			'panel' => 'panel_1'
	));
	
	/* Header Logo	*/
	$wp_customize->add_setting( 'llorix_one_lite_header_logo', array(
		'default' => llorix_one_lite_get_file('/images/logo-2.png'),
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'llorix_one_lite_header_logo', array(
	      	'label'    => esc_html__( 'Header Logo', 'llorix-one-lite' ),
	      	'section'  => 'llorix_one_lite_header_content',
			'active_callback' => 'llorix_one_lite_show_on_front',
			'priority'    => 10
	)));
	
	/* Header title */
	$wp_customize->add_setting( 'llorix_one_lite_header_title', array(
		'default' => esc_html__('Simple, Reliable and Awesome.','llorix-one-lite'),
		'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_lite_header_title', array(
		'label'    => esc_html__( 'Main title', 'llorix-one-lite' ),
		'section'  => 'llorix_one_lite_header_content',
		'active_callback' => 'llorix_one_lite_show_on_front',
		'priority'    => 20
	));
	
	/* Header subtitle */
	$wp_customize->add_setting( 'llorix_one_lite_header_subtitle', array(
		'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.','llorix-one-lite'),
		'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_lite_header_subtitle', array(
		'label'    => esc_html__( 'Subtitle', 'llorix-one-lite' ),
		'section'  => 'llorix_one_lite_header_content',
		'active_callback' => 'llorix_one_lite_show_on_front',
		'priority'    => 30
	));

	
	/*Header Button text*/
	$wp_customize->add_setting( 'llorix_one_lite_header_button_text', array(
		'default' => esc_html__('GET STARTED','llorix-one-lite'),
		'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_lite_header_button_text', array(
		'label'    => esc_html__( 'Button label', 'llorix-one-lite' ),
		'section'  => 'llorix_one_lite_header_content',
		'active_callback' => 'llorix_one_lite_show_on_front',
		'priority'    => 40
	));
	
	
	$wp_customize->add_setting( 'llorix_one_lite_header_button_link', array(
		'default' => esc_html__('#','llorix-one-lite'),
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_lite_header_button_link', array(
		'label'    => esc_html__( 'Button link', 'llorix-one-lite' ),
		'section'  => 'llorix_one_lite_header_content',
		'active_callback' => 'llorix_one_lite_show_on_front',
		'priority'    => 50
	));
	
	
	/* LOGOS SETTINGS */
	
	$wp_customize->add_section( 'llorix_one_lite_logos_settings_section' , array(
			'title'       => esc_html__( 'Logos Bar', 'llorix-one-lite' ),
			'priority'    => 2,
			'panel' => 'panel_1'
	));
	
    
    require_once ( 'class/llorix-one-lite-general-control.php');
	
	$wp_customize->add_setting( 'llorix_one_lite_logos_content', array(
		'sanitize_callback' => 'llorix_one_lite_sanitize_repeater',
		'default' => json_encode(
				array( 
					array("image_url" => llorix_one_lite_get_file('/images/companies/1.png') ,"link" => "#",'id' => 'llorix_one_lite_56d069bb8cb71' ),
					array("image_url" => llorix_one_lite_get_file('/images/companies/2.png') ,"link" => "#",'id' => 'llorix_one_lite_56d069bc8cb72' ),
					array("image_url" => llorix_one_lite_get_file('/images/companies/3.png') ,"link" => "#",'id' => 'llorix_one_lite_56d069bd8cb73' ),
					array("image_url" => llorix_one_lite_get_file('/images/companies/4.png') ,"link" => "#",'id' => 'llorix_one_lite_56d06d128cb74' ),
					array("image_url" => llorix_one_lite_get_file('/images/companies/5.png') ,"link" => "#",'id' => 'llorix_one_lite_56d06d3d8cb75' )
				)
		)

	));
	$wp_customize->add_control( new Llorix_One_Lite_General_Repeater( $wp_customize, 'llorix_one_lite_logos_content', array(
		'label'   => esc_html__('Add new social icon','llorix-one-lite'),
		'section' => 'llorix_one_lite_logos_settings_section',
		'active_callback' => 'llorix_one_lite_show_on_front',
		'priority' => 10,
        'llorix_one_lite_image_control' => true,
        'llorix_one_lite_icon_control' => false,
        'llorix_one_lite_text_control' => false,
        'llorix_one_lite_link_control' => true
	) ) );
	
	$wp_customize->get_section('header_image')->panel = 'panel_1';
	$wp_customize->get_section('header_image')->title = esc_html__( 'Background', 'llorix-one-lite' );
	
	/* Enable parallax effect*/
	$wp_customize->add_setting( 'llorix_one_lite_enable_move', array(
		'sanitize_callback' => 'llorix_one_lite_sanitize_text',
	));
	$wp_customize->add_control( 'llorix_one_lite_enable_move', array(
		'type' => 'checkbox',
		'label' => esc_html__('Parallax effect','llorix-one-lite'),
		'description' => esc_html__('If this box is checked, the parallax effect is enabled.','llorix-one-lite'),
		'section' => 'header_image',
		'priority'    => 3,
	));
	
	/* Layer one */
	$wp_customize->add_setting( 'llorix_one_lite_first_layer', array(
		'default' => llorix_one_lite_get_file('/images/background1.png'),
		'sanitize_callback' => 'esc_url',
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'llorix_one_lite_first_layer', array(
		'label'    => esc_html__( 'First layer', 'llorix-one-lite' ),
		'section'  => 'header_image',
		'priority'    => 4,
	)));
	
	/* Layer two */
	$wp_customize->add_setting( 'llorix_one_lite_second_layer', array(
		'default' => llorix_one_lite_get_file('/images/background2.png'),
		'sanitize_callback' => 'esc_url',
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'llorix_one_lite_second_layer', array(
		'label'    => esc_html__( 'Second layer', 'llorix-one-lite' ),
		'section'  => 'header_image',
		'priority'    => 5,
	)));


	/* VERY TOP HEADER */

	$wp_customize->add_section( 'llorix_one_lite_very_top_header_content' , array(
		'title'		=> esc_html__( 'Very top header', 'llorix-one-lite' ),
		'priority'	=> 10,
		'panel' 	=> 'panel_1'
	));
	
	/* Header title */
	$wp_customize->add_setting( 'llorix_one_lite_very_top_header_phone', array(
		'default' 			=> esc_html__('(+9) 0999.500.400','llorix-one-lite'),
		'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		'transport' 		=> 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_lite_very_top_header_phone', array(
		'label'    			=> esc_html__( 'Phone number', 'llorix-one-lite' ),
		'section'  			=> 'llorix_one_lite_very_top_header_content',
		'priority'    		=> 1
	));

	/* social icons header */
	$wp_customize->add_setting( 'llorix_one_lite_very_top_social_icons', array(
		'sanitize_callback' => 'llorix_one_lite_sanitize_repeater',
		'default' => json_encode(
			array(
				array('icon_value' =>'fa-facebook' , 'link' => '#', 'id' => 'llorix_one_lite_56d069ad8cb6b'),
				array('icon_value' =>'fa-twitter' , 'link' => '#', 'id' => 'llorix_one_lite_56d069b48cb6c'),
				array('icon_value' =>'fa-google-plus-square' , 'link' => '#', 'id' => 'llorix_one_lite_56d069b58cb6d')
			)
		)

	));
	$wp_customize->add_control( new Llorix_One_Lite_General_Repeater( $wp_customize, 'llorix_one_lite_very_top_social_icons', array(
		'label'   					=> esc_html__('Add new social icon','llorix-one-lite'),
		'section' 					=> 'llorix_one_lite_very_top_header_content',
		'priority' 					=> 2,
        'llorix_one_lite_image_control' 	=> false,
        'llorix_one_lite_icon_control' 	=> true,
        'llorix_one_lite_text_control' 	=> false,
        'llorix_one_lite_link_control' 	=> true
	) ) );
	
	/* BLOG HEADER */

	$wp_customize->add_section( 'llorix_one_lite_blog_header_section' , array(
		'title'		=> esc_html__( 'Blog header', 'llorix-one-lite' ),
		'priority'	=> 50,
		'panel' 	=> 'panel_1'
	));
	
	/* Blog Header title */
	$wp_customize->add_setting( 'llorix_one_lite_blog_header_title', array(
		'default' 			=> esc_html__('BLOG','llorix-one-lite'),
		'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		'transport' 		=> 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_lite_blog_header_title', array(
		'label'    			=> esc_html__( 'Title', 'llorix-one-lite' ),
		'section'  			=> 'llorix_one_lite_blog_header_section',
		'priority'    		=> 1
	));
	
	/* Blog Header subtitle */
	$wp_customize->add_setting( 'llorix_one_lite_blog_header_subtitle', array(
		'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		'transport' 		=> 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_lite_blog_header_subtitle', array(
		'label'    			=> esc_html__( 'Subtitle', 'llorix-one-lite' ),
		'section'  			=> 'llorix_one_lite_blog_header_section',
		'priority'    		=> 2
	));
	
	/* Blog Header image	*/
	$wp_customize->add_setting( 'llorix_one_lite_blog_header_image', array(
		'default' => llorix_one_lite_get_file('/images/background-images/background-blog.jpg'),
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage'
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'llorix_one_lite_blog_header_image', array(
	      	'label'    => esc_html__( 'Image', 'llorix-one-lite' ),
	      	'section'  => 'llorix_one_lite_blog_header_section',
			'priority'    => 3,
	)));

	/********************************************************/
	/******************** ABOUT OPTIONS  ********************/
	/********************************************************/

	
	$wp_customize->add_section( 'llorix_one_lite_about_section' , array(
			'title'       => esc_html__( 'About section', 'llorix-one-lite' ),
			'priority'    => 45,
	));
	
	/* About title */
	$wp_customize->add_setting( 'llorix_one_lite_our_story_title', array(
		'default' => esc_html__('Our Story','llorix-one-lite'),
		'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_lite_our_story_title', array(
		'label'    => esc_html__( 'Main title', 'llorix-one-lite' ),
		'section'  => 'llorix_one_lite_about_section',
		'active_callback' => 'llorix_one_lite_show_on_front',
		'priority'    => 10,
	));

	/* About Content */
	
	$wp_customize->add_setting( 'llorix_one_lite_our_story_text', array(
		'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','llorix-one-lite'),
		'sanitize_callback' => 'llorix_one_lite_sanitize_html',
		'transport' => 'postMessage'
		
	));
	
	$wp_customize->add_control( 'llorix_one_lite_our_story_text', array(
		'type' => 'textarea',
		'label'   => esc_html__( 'Content', 'llorix-one-lite' ),
		'section' => 'llorix_one_lite_about_section',
		'active_callback' => 'llorix_one_lite_show_on_front',
		'priority'    => 20,
	));
	
	/* About Image	*/
	$wp_customize->add_setting( 'llorix_one_lite_our_story_image', array(
		'default' => llorix_one_lite_get_file('/images/about-us.png'),
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'llorix_one_lite_our_story_image', array(
	      	'label'    => esc_html__( 'Image', 'llorix-one-lite' ),
	      	'section'  => 'llorix_one_lite_about_section',
			'active_callback' => 'llorix_one_lite_show_on_front',
			'priority'    => 30,
	)));

	/********************************************************/
	/***************** RIBBON OPTIONS  *****************/
	/********************************************************/
	
    
	/* RIBBON SETTINGS */
	$wp_customize->add_section( 'llorix_one_lite_ribbon_section' , array(
		'title'       => esc_html__( 'Ribbon section', 'llorix-one-lite' ),
		'priority'    => 60,
	));
	

	/* Ribbon Background	*/
	$wp_customize->add_setting( 'llorix_one_lite_ribbon_background', array(
		'default' => llorix_one_lite_get_file('/images/background-images/parallax-img/parallax-img1.jpg'),
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'llorix_one_lite_ribbon_background', array(
	      	'label'    => esc_html__( 'Ribbon Background', 'llorix-one-lite' ),
	      	'section'  => 'llorix_one_lite_ribbon_section',
			'active_callback' => 'llorix_one_lite_show_on_front',
			'priority'    => 10
	)));
	
	$wp_customize->add_setting( 'llorix_one_lite_ribbon_title', array(
		'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.','llorix-one-lite'),
		'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_lite_ribbon_title', array(
		'label'    => esc_html__( 'Main title', 'llorix-one-lite' ),
		'section'  => 'llorix_one_lite_ribbon_section',
		'active_callback' => 'llorix_one_lite_show_on_front',
		'priority'    => 20
	));
	

	$wp_customize->add_setting( 'llorix_one_lite_button_text', array(
		'default' => esc_html__('GET STARTED','llorix-one-lite'),
		'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_lite_button_text', array(
		'label'    => esc_html__( 'Button label', 'llorix-one-lite' ),
		'section'  => 'llorix_one_lite_ribbon_section',
		'active_callback' => 'llorix_one_lite_show_on_front',
		'priority'    => 30
	));
	
	
	$wp_customize->add_setting( 'llorix_one_lite_button_link', array(
		'default' => esc_html__('#','llorix-one-lite'),
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_lite_button_link', array(
		'label'    => esc_html__( 'Button link', 'llorix-one-lite' ),
		'section'  => 'llorix_one_lite_ribbon_section',
		'active_callback' => 'llorix_one_lite_show_on_front',
		'priority'    => 40
	));

	/********************************************************/
	/************ LATEST NEWS OPTIONS  **************/
	/********************************************************/
	
    
	$wp_customize->add_section( 'llorix_one_lite_latest_news_section' , array(
			'title'       => esc_html__( 'Latest news section', 'llorix-one-lite' ),
			'priority'    => 65
	));
	
	$wp_customize->add_setting( 'llorix_one_lite_latest_news_title', array(
		'default' => esc_html__('Latest news','llorix-one-lite'),
		'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_lite_latest_news_title', array(
		'label'    => esc_html__( 'Main title', 'llorix-one-lite' ),
		'section'  => 'llorix_one_lite_latest_news_section',
		'active_callback' => 'llorix_one_lite_show_on_front',
		'priority'    => 10
	));
	
	/********************************************************/
	/****************** CONTACT OPTIONS  ********************/
	/********************************************************/
	
	
	/* CONTACT SETTINGS */
	$wp_customize->add_section( 'llorix_one_lite_contact_section' , array(
		'title'       => esc_html__( 'Contact section', 'llorix-one-lite' ),
		'priority'    => 70,
	));


	$wp_customize->add_setting( 'llorix_one_lite_contact_info_content', array(
		'sanitize_callback' => 'llorix_one_lite_sanitize_repeater',
		'default' => json_encode(
			array( 
				array("icon_value" => "fa-envelope" ,"text" => "contact@site.com", "link" => "#",'id' => 'llorix_one_lite_56d450a72cb3a' ), 
				array("icon_value" => "fa-map-marker" ,"text" => "Company address", "link" => "#",'id' => 'llorix_one_lite_56d069b88cb6f' ), 
				array("icon_value" => "fa-tablet" ,"text" => "0 332 548 954", "link" => "#",'id' => 'llorix_one_lite_56d069b98cb70' ) 
			)
		)
	));
	$wp_customize->add_control( new Llorix_One_Lite_General_Repeater( $wp_customize, 'llorix_one_lite_contact_info_content', array(
		'label'   => esc_html__('Add new contact field','llorix-one-lite'),
		'section' => 'llorix_one_lite_contact_section',
		'active_callback' => 'llorix_one_lite_show_on_front',
		'priority' => 10,
        'llorix_one_lite_image_control' => false,
        'llorix_one_lite_icon_control' => true,
        'llorix_one_lite_text_control' => true,
        'llorix_one_lite_link_control' => true
	) ) );
	
    
	/* Map ShortCode  */
	$wp_customize->add_setting( 'llorix_one_lite_frontpage_map_shortcode', array(
		'default' => '',
		'sanitize_callback' => 'llorix_one_lite_sanitize_text'
	));
	$wp_customize->add_control( 'llorix_one_lite_frontpage_map_shortcode', array(
		'label'    => esc_html__( 'Map shortcode', 'llorix-one-lite' ),
		'description' => __('To use this section please install <a href="https://wordpress.org/plugins/intergeo-maps/">Intergeo Maps</a> plugin then use it to create a map and paste here the shortcode generated','llorix-one-lite'),
		'section'  => 'llorix_one_lite_contact_section',
		'active_callback' => 'llorix_one_lite_show_on_front',
		'priority'    => 20
	));
	
    
	/********************************************************/
	/*************** CONTACT PAGE OPTIONS  ******************/
	/********************************************************/
	
	$wp_customize->add_section( 'llorix_one_lite_contact_page' , array(
		'title'       => esc_html__( 'Contact page', 'llorix-one-lite' ),
      	'priority'    => 75,
	));

	/* Contact Form  */
	$wp_customize->add_setting( 'llorix_one_lite_contact_form_shortcode', array(
		'default' => '',
		'sanitize_callback' => 'llorix_one_lite_sanitize_text'
	));
	$wp_customize->add_control( 'llorix_one_lite_contact_form_shortcode', array(
		'label'    => esc_html__( 'Contact form shortcode', 'llorix-one-lite' ),
		'description' => __('Create a form, copy the shortcode generated and paste it here. We recommend <a href="https://wordpress.org/plugins/contact-form-7/">Contact Form 7</a> but you can use any plugin you like.','llorix-one-lite'),
		'section'  => 'llorix_one_lite_contact_page',
		'active_callback' => 'llorix_one_lite_is_contact_page',
		'priority'    => 1
	));
	
	/* Map ShortCode  */
	$wp_customize->add_setting( 'llorix_one_lite_contact_map_shortcode', array(
		'default' => '',
		'sanitize_callback' => 'llorix_one_lite_sanitize_text'
	));
	$wp_customize->add_control( 'llorix_one_lite_contact_map_shortcode', array(
		'label'    => esc_html__( 'Map shortcode', 'llorix-one-lite' ),
		'description' => __('To use this section please install <a href="https://wordpress.org/plugins/intergeo-maps/">Intergeo Maps</a> plugin then use it to create a map and paste here the shortcode generated','llorix-one-lite'),
		'section'  => 'llorix_one_lite_contact_page',
		'active_callback' => 'llorix_one_lite_is_contact_page',
		'priority'    => 2
	));
	
	/***********************************************************************************/
	/******  Contact page - instructions for users when not on Contact page  ***********/
	/***********************************************************************************/
	
	$wp_customize->add_section( 'llorix_one_lite_contact_page_instructions', array(
        'title'    => __( 'Contact page', 'llorix-one-lite' ),
        'priority' => 75
    ) );
	
	$wp_customize->add_setting( 'llorix_one_lite_contact_page_instructions', array( 'sanitize_callback' => 'llorix_one_lite_sanitize_text' ) );
	
	$wp_customize->add_control( new LlorixOneLite_Contact_Page_Instructions( $wp_customize, 'llorix_one_lite_contact_page_instructions', array(
	    'section' => 'llorix_one_lite_contact_page_instructions',
		'active_callback' => 'llorix_one_lite_is_not_contact_page',
	)));
	
	/********************************************************/
	/****************** FOOTER OPTIONS  *********************/
	/********************************************************/	
	
	$wp_customize->add_section( 'llorix_one_lite_footer_section' , array(
		'title'       => esc_html__( 'Footer options', 'llorix-one-lite' ),
      	'priority'    => 80,
      	'description' => esc_html__('The main content of this section is customizable in: Customize -> Widgets -> Footer area. ','llorix-one-lite'),
	));	
	
	/* Footer Menu */
	$nav_menu_locations_footer = $wp_customize->get_control('nav_menu_locations[llorix_one_lite_footer_menu]');
	if(!empty($nav_menu_locations_footer)){
		$nav_menu_locations_footer->section = 'llorix_one_lite_footer_section';
		$nav_menu_locations_footer->priority = 1;
	}
	/* Copyright */
	$wp_customize->add_setting( 'llorix_one_lite_copyright', array(
		'default' => 'Themeisle',
		'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_lite_copyright', array(
		'label'    => esc_html__( 'Copyright', 'llorix-one-lite' ),
		'section'  => 'llorix_one_lite_footer_section',
		'priority'    => 2
	));
	
	
	/* Socials icons */
	$wp_customize->add_setting( 'llorix_one_lite_social_icons', array(
		'sanitize_callback' => 'llorix_one_lite_sanitize_repeater',
		'default' => json_encode(
			array
			(
				array('icon_value' =>'fa-facebook' , 'link' => '#', 'id' => 'llorix_one_lite_56d069b78cb6e'),
				array('icon_value' =>'fa-twitter' , 'link' => '#', 'id' => 'llorix_one_lite_56d450842cb39'),
				array('icon_value' =>'fa-google-plus-square' , 'link' => '#', 'id' => 'llorix_one_lite_56d450512cb38')
			)
		)

	));
	$wp_customize->add_control( new Llorix_One_Lite_General_Repeater( $wp_customize, 'llorix_one_lite_social_icons', array(
		'label'   => esc_html__('Add new social icon','llorix-one-lite'),
		'section' => 'llorix_one_lite_footer_section',
		'priority' => 3,
        'llorix_one_lite_image_control' => false,
        'llorix_one_lite_icon_control' => true,
        'llorix_one_lite_text_control' => false,
        'llorix_one_lite_link_control' => true
	) ) );
	
	/********************************************************/
	/************** ADVANCED OPTIONS  ***********************/
	/********************************************************/
	
	$wp_customize->add_section( 'llorix_one_lite_general_section' , array(
		'title'       => esc_html__( 'Advanced options', 'llorix-one-lite' ),
      	'priority'    => 85,
      	'description' => esc_html__('Llorix One Lite theme general options','llorix-one-lite'),
	));
	
	$blogname = $wp_customize->get_control('blogname');
	$blogdescription = $wp_customize->get_control('blogdescription');
	$blogicon = $wp_customize->get_control('site_icon');
	
	if(!empty($blogname)){
		$blogname->section = 'llorix_one_lite_general_section';
		$blogname->priority = 1;
	}
	if(!empty($blogdescription)){
		$blogdescription->section = 'llorix_one_lite_general_section';
		$blogdescription->priority = 2;
	}
	if(!empty($blogicon)){
		$blogicon->section = 'llorix_one_lite_general_section';
		$blogicon->priority = 3;
	}
	$wp_customize->remove_section('title_tagline');
	
	$nav_menu_locations_primary = $wp_customize->get_control('nav_menu_locations[primary]');
	if(!empty($nav_menu_locations_primary)){
		$nav_menu_locations_primary->section = 'llorix_one_lite_general_section';
		$nav_menu_locations_primary->priority = 6;
	}
	
	/* Disable preloader */
	$wp_customize->add_setting( 'llorix_one_lite_disable_preloader', array(
		'sanitize_callback' => 'llorix_one_lite_sanitize_text'
	));
	$wp_customize->add_control( 'llorix_one_lite_disable_preloader', array(
		'type' => 'checkbox',
		'label' => esc_html__('Disable preloader?','llorix-one-lite'),
		'description' => esc_html__('If this box is checked, the preloader will be disabled from homepage.','llorix-one-lite'),
		'section' => 'llorix_one_lite_general_section',
		'priority'    => 7,
	));
	
	
	
	
	/*********************************/
	/******* PLUS SECTIONS ***********/
	/*********************************/
	require_once ( 'class/llorix-one-lite-text-control.php');
	
}
add_action( 'customize_register', 'llorix_one_lite_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function llorix_one_lite_customize_preview_js() {
	wp_enqueue_script( 'llorix_one_lite_customizer', llorix_one_lite_get_file('/js/customizer.js'), array( 'customize-preview' ), '1.0.2', true );
}
add_action( 'customize_preview_init', 'llorix_one_lite_customize_preview_js', 10);


function llorix_one_lite_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function llorix_one_lite_sanitize_repeater($input){
	  
	$input_decoded = json_decode($input,true);
	$allowed_html = array(
								'br' => array(),
								'em' => array(),
								'strong' => array(),
								'a' => array(
									'href' => array(),
									'class' => array(),
									'id' => array(),
									'target' => array()
								),
								'button' => array(
									'class' => array(),
									'id' => array()
								)
							);
	
	
	if(!empty($input_decoded)) {
		foreach ($input_decoded as $boxk => $box ){
			foreach ($box as $key => $value){
				if ($key == 'text'){
					$value = html_entity_decode($value);
					$input_decoded[$boxk][$key] = wp_kses( $value, $allowed_html);
				} else {
					$input_decoded[$boxk][$key] = wp_kses_post( force_balance_tags( $value ) );
				}

			}
		}

		return json_encode($input_decoded);
	}
	
	return $input;
}


function llorix_one_lite_sanitize_html( $input){
	
	$allowed_html = array(
							'p' => array(
								'class' => array(),
								'id' => array()
							),
							'br' => array(),
							'em' => array(),
							'strong' => array(),
							'ul' => array(
								'class' => array(),
								'id' => array()
							),
							'li' => array(
								'class' => array(),
								'id' => array()
							),
							'a' => array(
								'href' => array(),
								'class' => array(),
								'id' => array(),
								'target' => array()
							),
							'button' => array(
								'class' => array(),
								'id' => array()
							)
						);
	
	$string = force_balance_tags($input);
	return wp_kses($string, $allowed_html);
}


function llorix_one_lite_customizer_script() {
	wp_enqueue_script( 'llorix_one_lite_customizer_script', llorix_one_lite_get_file('/js/llorix_one_lite_customizer.js'), array("jquery","jquery-ui-draggable"),'1.0.0', true  );
}
add_action( 'customize_controls_enqueue_scripts', 'llorix_one_lite_customizer_script' );

function llorix_one_lite_is_contact_page() {
		return is_page_template('template-contact.php');
};

function llorix_one_lite_is_not_contact_page() {
		return !is_page_template('template-contact.php');
};

function llorix_one_lite_show_on_front(){
	return is_page_template('template-frontpage.php');
}

function llorix_one_lite_not_show_on_front(){
	return !is_page_template('template-frontpage.php');
}
