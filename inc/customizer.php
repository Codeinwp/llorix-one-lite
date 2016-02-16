<?php
/**
 * llorix-one Theme Customizer
 *
 * @package llorix-one
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function llorix_one_customize_register( $wp_customize ) {
	
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

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
		'title' => esc_html__( 'Appearance', 'llorix-one' )
	) );
	
	$wp_customize->add_setting( 'llorix_one_text_color', array(
		'default' => '#313131',
		'sanitize_callback' => 'llorix_one_sanitize_text'
	));
		
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'llorix_one_text_color',
			array(
				'label'      => esc_html__( 'Text color', 'llorix-one' ),
				'section'    => 'colors',
				'priority'   => 5
			)
		)
	);
	
	
	$wp_customize->add_setting( 'llorix_one_title_color', array(
		'default' => '#454545',
		'sanitize_callback' => 'llorix_one_sanitize_text'
	));
		
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'llorix_one_title_color',
			array(
				'label'      => esc_html__( 'Title color', 'llorix-one' ),
				'section'    => 'colors',
				'priority'   => 6
			)
		)
	);
	
	$wp_customize->add_section( 'llorix_one_appearance_general' , array(
		'title'       => esc_html__( 'General options', 'llorix-one' ),
      	'priority'    => 3,
      	'description' => esc_html__('Paralax One theme general appearance options','llorix-one'),
		'panel'		  => 'panel_2'
	));
	
	/* Logo	*/
	$wp_customize->add_setting( 'llorix_one_logo', array(
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage'
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'llorix_one_logo', array(
	      	'label'    => esc_html__( 'Logo', 'llorix-one' ),
	      	'section'  => 'llorix_one_appearance_general',
			'priority'    => 1,
	)));
	
	/* Sticky header */
	$wp_customize->add_setting( 'llorix_one_sticky_header', array(
		'sanitize_callback' => 'llorix_one_sanitize_text',
	));
	$wp_customize->add_control(
			'llorix_one_sticky_header',
			array(
				'type' => 'checkbox',
				'label' => esc_html__('Header visibility','llorix-one'),
				'description' => esc_html__('If this box is checked, the header will toggle on frontpage.','llorix-one'),
				'section' => 'llorix_one_appearance_general',
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
		'title' => esc_html__( 'Header section', 'llorix-one' )
	) );
	
	/* HEADER CONTENT */
	
	$wp_customize->add_section( 'llorix_one_header_content' , array(
			'title'       => esc_html__( 'Content', 'llorix-one' ),
			'priority'    => 1,
			'panel' => 'panel_1'
	));
	
	/* Header Logo	*/
	$wp_customize->add_setting( 'llorix_one_header_logo', array(
		'default' => llorix_one_get_file('/images/logo-2.png'),
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'llorix_one_header_logo', array(
	      	'label'    => esc_html__( 'Header Logo', 'llorix-one' ),
	      	'section'  => 'llorix_one_header_content',
			'active_callback' => 'llorix_one_show_on_front',
			'priority'    => 10
	)));
	
	/* Header title */
	$wp_customize->add_setting( 'llorix_one_header_title', array(
		'default' => esc_html__('Simple, Reliable and Awesome.','llorix-one'),
		'sanitize_callback' => 'llorix_one_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_header_title', array(
		'label'    => esc_html__( 'Main title', 'llorix-one' ),
		'section'  => 'llorix_one_header_content',
		'active_callback' => 'llorix_one_show_on_front',
		'priority'    => 20
	));
	
	/* Header subtitle */
	$wp_customize->add_setting( 'llorix_one_header_subtitle', array(
		'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.','llorix-one'),
		'sanitize_callback' => 'llorix_one_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_header_subtitle', array(
		'label'    => esc_html__( 'Subtitle', 'llorix-one' ),
		'section'  => 'llorix_one_header_content',
		'active_callback' => 'llorix_one_show_on_front',
		'priority'    => 30
	));

	
	/*Header Button text*/
	$wp_customize->add_setting( 'llorix_one_header_button_text', array(
		'default' => esc_html__('GET STARTED','llorix-one'),
		'sanitize_callback' => 'llorix_one_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_header_button_text', array(
		'label'    => esc_html__( 'Button label', 'llorix-one' ),
		'section'  => 'llorix_one_header_content',
		'active_callback' => 'llorix_one_show_on_front',
		'priority'    => 40
	));
	
	
	$wp_customize->add_setting( 'llorix_one_header_button_link', array(
		'default' => esc_html__('#','llorix-one'),
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_header_button_link', array(
		'label'    => esc_html__( 'Button link', 'llorix-one' ),
		'section'  => 'llorix_one_header_content',
		'active_callback' => 'llorix_one_show_on_front',
		'priority'    => 50
	));
	
	
	/* LOGOS SETTINGS */
	
	$wp_customize->add_section( 'llorix_one_logos_settings_section' , array(
			'title'       => esc_html__( 'Logos Bar', 'llorix-one' ),
			'priority'    => 2,
			'panel' => 'panel_1'
	));
	
    
    require_once ( 'class/parallax-one-general-control.php');
	
	$wp_customize->add_setting( 'llorix_one_logos_content', array(
		'sanitize_callback' => 'llorix_one_sanitize_repeater',
		'default' => json_encode(
				array( 
					array("image_url" => llorix_one_get_file('/images/companies/1.png') ,"link" => "#" ),
					array("image_url" => llorix_one_get_file('/images/companies/2.png') ,"link" => "#" ),
					array("image_url" => llorix_one_get_file('/images/companies/3.png') ,"link" => "#" ),
					array("image_url" => llorix_one_get_file('/images/companies/4.png') ,"link" => "#" ),
					array("image_url" => llorix_one_get_file('/images/companies/5.png') ,"link" => "#" )
				)
		)

	));
	$wp_customize->add_control( new Llorix_One_General_Repeater( $wp_customize, 'llorix_one_logos_content', array(
		'label'   => esc_html__('Add new social icon','llorix-one'),
		'section' => 'llorix_one_logos_settings_section',
		'active_callback' => 'llorix_one_show_on_front',
		'priority' => 10,
        'parallax_image_control' => true,
        'parallax_icon_control' => false,
        'parallax_text_control' => false,
        'parallax_link_control' => true
	) ) );
	
	$wp_customize->get_section('header_image')->panel = 'panel_1';
	$wp_customize->get_section('header_image')->title = esc_html__( 'Background', 'llorix-one' );
	
	/* Enable parallax effect*/
	$wp_customize->add_setting( 'llorix_one_enable_move', array(
		'sanitize_callback' => 'llorix_one_sanitize_text',
	));
	$wp_customize->add_control( 'llorix_one_enable_move', array(
		'type' => 'checkbox',
		'label' => esc_html__('Parallax effect','llorix-one'),
		'description' => esc_html__('If this box is checked, the parallax effect is enabled.','llorix-one'),
		'section' => 'header_image',
		'priority'    => 3,
	));
	
	/* Layer one */
	$wp_customize->add_setting( 'llorix_one_first_layer', array(
		'default' => llorix_one_get_file('/images/background1.png'),
		'sanitize_callback' => 'esc_url',
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'llorix_one_first_layer', array(
		'label'    => esc_html__( 'First layer', 'llorix-one' ),
		'section'  => 'header_image',
		'priority'    => 4,
	)));
	
	/* Layer two */
	$wp_customize->add_setting( 'llorix_one_second_layer', array(
		'default' => llorix_one_get_file('/images/background2.png'),
		'sanitize_callback' => 'esc_url',
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'llorix_one_second_layer', array(
		'label'    => esc_html__( 'Second layer', 'llorix-one' ),
		'section'  => 'header_image',
		'priority'    => 5,
	)));


	/* VERY TOP HEADER */

	$wp_customize->add_section( 'llorix_one_very_top_header_content' , array(
		'title'		=> esc_html__( 'Very top header', 'llorix-one' ),
		'priority'	=> 10,
		'panel' 	=> 'panel_1'
	));
	
	/* Header title */
	$wp_customize->add_setting( 'llorix_one_very_top_header_phone', array(
		'default' 			=> esc_html__('(+9) 0999.500.400','llorix-one'),
		'sanitize_callback' => 'llorix_one_sanitize_text',
		'transport' 		=> 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_very_top_header_phone', array(
		'label'    			=> esc_html__( 'Phone number', 'llorix-one' ),
		'section'  			=> 'llorix_one_very_top_header_content',
		'priority'    		=> 1
	));

	/* social icons header */
	$wp_customize->add_setting( 'llorix_one_very_top_social_icons', array(
		'sanitize_callback' => 'llorix_one_sanitize_repeater',
		'default' => json_encode(
			array(
				array('icon_value' =>'icon-social-facebook' , 	'link' => '#'),
				array('icon_value' =>'icon-social-twitter' , 	'link' => '#'),
				array('icon_value' =>'icon-social-googleplus' , 'link' => '#')
			)
		)

	));
	$wp_customize->add_control( new Llorix_One_General_Repeater( $wp_customize, 'llorix_one_very_top_social_icons', array(
		'label'   					=> esc_html__('Add new social icon','llorix-one'),
		'section' 					=> 'llorix_one_very_top_header_content',
		'priority' 					=> 2,
        'parallax_image_control' 	=> false,
        'parallax_icon_control' 	=> true,
        'parallax_text_control' 	=> false,
        'parallax_link_control' 	=> true
	) ) );
	
	/* BLOG HEADER */

	$wp_customize->add_section( 'llorix_one_blog_header_section' , array(
		'title'		=> esc_html__( 'Blog header', 'llorix-one' ),
		'priority'	=> 50,
		'panel' 	=> 'panel_1'
	));
	
	/* Blog Header title */
	$wp_customize->add_setting( 'llorix_one_blog_header_title', array(
		'default' 			=> esc_html__('BLOG','llorix-one'),
		'sanitize_callback' => 'llorix_one_sanitize_text',
		'transport' 		=> 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_blog_header_title', array(
		'label'    			=> esc_html__( 'Title', 'llorix-one' ),
		'section'  			=> 'llorix_one_blog_header_section',
		'priority'    		=> 1
	));
	
	/* Blog Header subtitle */
	$wp_customize->add_setting( 'llorix_one_blog_header_subtitle', array(
		'sanitize_callback' => 'llorix_one_sanitize_text',
		'transport' 		=> 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_blog_header_subtitle', array(
		'label'    			=> esc_html__( 'Subtitle', 'llorix-one' ),
		'section'  			=> 'llorix_one_blog_header_section',
		'priority'    		=> 2
	));
	
	/* Blog Header image	*/
	$wp_customize->add_setting( 'llorix_one_blog_header_image', array(
		'default' => llorix_one_get_file('/images/background-images/background-blog.jpg'),
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage'
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'llorix_one_blog_header_image', array(
	      	'label'    => esc_html__( 'Image', 'llorix-one' ),
	      	'section'  => 'llorix_one_blog_header_section',
			'priority'    => 3,
	)));


	/********************************************************/
	/****************** SERVICES OPTIONS  *******************/
	/********************************************************/
	
	
	/* SERVICES SECTION */
	$wp_customize->add_section( 'llorix_one_services_section' , array(
			'title'       => esc_html__( 'Services section', 'llorix-one' ),
			'priority'    => 40,
	));
	
	/* Services title */
	$wp_customize->add_setting( 'llorix_one_our_services_title', array(
		'default' => esc_html__('Our Services','llorix-one'),
		'sanitize_callback' => 'llorix_one_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_our_services_title', array(
		'label'    => esc_html__( 'Main title', 'llorix-one' ),
		'section'  => 'llorix_one_services_section',
		'active_callback' => 'llorix_one_show_on_front',
		'priority'    => 10
	));
	
	/* Services subtitle */
	$wp_customize->add_setting( 'llorix_one_our_services_subtitle', array(
		'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.','llorix-one'),
		'sanitize_callback' => 'llorix_one_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_our_services_subtitle', array(
		'label'    => esc_html__( 'Subtitle', 'llorix-one' ),
		'section'  => 'llorix_one_services_section',
		'active_callback' => 'llorix_one_show_on_front',
		'priority'    => 20
	));
    
    
    /* Services content */
	$wp_customize->add_setting( 'llorix_one_services_content', array(
		'sanitize_callback' => 'llorix_one_sanitize_repeater',
		'default' => json_encode(
							array(
									array('choice'=>'parallax_icon','icon_value' => 'icon-basic-webpage-multiple','title' => esc_html__('Lorem Ipsum','llorix-one'),'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo.','llorix-one')),
									array('choice'=>'parallax_icon','icon_value' => 'icon-ecommerce-graph3','title' => esc_html__('Lorem Ipsum','llorix-one'),'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo.','llorix-one')),
									array('choice'=>'parallax_icon','icon_value' => 'icon-basic-geolocalize-05','title' => esc_html__('Lorem Ipsum','llorix-one'),'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo.','llorix-one'))
							)
						)
	));
	$wp_customize->add_control( new Llorix_One_General_Repeater( $wp_customize, 'llorix_one_services_content', array(
		'label'   => esc_html__('Add new service box','llorix-one'),
		'section' => 'llorix_one_services_section',
		'active_callback' => 'llorix_one_show_on_front',
		'priority' => 30,
        'parallax_image_control' => true,
        'parallax_icon_control' => true,
		'parallax_title_control' => true,
        'parallax_text_control' => true,
		'parallax_link_control' => true
	) ) );
	/********************************************************/
	/******************** ABOUT OPTIONS  ********************/
	/********************************************************/

	
	$wp_customize->add_section( 'llorix_one_about_section' , array(
			'title'       => esc_html__( 'About section', 'llorix-one' ),
			'priority'    => 45,
	));
	
	/* About title */
	$wp_customize->add_setting( 'llorix_one_our_story_title', array(
		'default' => esc_html__('Our Story','llorix-one'),
		'sanitize_callback' => 'llorix_one_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_our_story_title', array(
		'label'    => esc_html__( 'Main title', 'llorix-one' ),
		'section'  => 'llorix_one_about_section',
		'active_callback' => 'llorix_one_show_on_front',
		'priority'    => 10,
	));

	/* About Content */
	
	$wp_customize->add_setting( 'llorix_one_our_story_text', array(
		'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','llorix-one'),
		'sanitize_callback' => 'llorix_one_sanitize_html',
		'transport' => 'postMessage'
		
	));
	
	$wp_customize->add_control( 'llorix_one_our_story_text', array(
		'type' => 'textarea',
		'label'   => esc_html__( 'Content', 'llorix-one' ),
		'section' => 'llorix_one_about_section',
		'active_callback' => 'llorix_one_show_on_front',
		'priority'    => 20,
	));
	
	/* About Image	*/
	$wp_customize->add_setting( 'llorix_one_our_story_image', array(
		'default' => llorix_one_get_file('/images/about-us.png'),
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'llorix_one_our_story_image', array(
	      	'label'    => esc_html__( 'Image', 'llorix-one' ),
	      	'section'  => 'llorix_one_about_section',
			'active_callback' => 'llorix_one_show_on_front',
			'priority'    => 30,
	)));

	/********************************************************/
	/*******************  TEAM OPTIONS  *********************/
	/********************************************************/

	
	$wp_customize->add_section( 'llorix_one_team_section' , array(
			'title'       => esc_html__( 'Team section', 'llorix-one' ),
			'priority'    => 50,
	));
	
	/* Team title */
	$wp_customize->add_setting( 'llorix_one_our_team_title', array(
		'default' => esc_html__('Our Team','llorix-one'),
		'sanitize_callback' => 'llorix_one_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_our_team_title', array(
		'label'    => esc_html__( 'Main title', 'llorix-one' ),
		'section'  => 'llorix_one_team_section',
		'active_callback' => 'llorix_one_show_on_front',
		'priority'    => 10,
	));
	
	/* Team subtitle */
	$wp_customize->add_setting( 'llorix_one_our_team_subtitle', array(
		'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.','llorix-one'),
		'sanitize_callback' => 'llorix_one_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_our_team_subtitle', array(
		'label'    => esc_html__( 'Subtitle', 'llorix-one' ),
		'section'  => 'llorix_one_team_section',
		'active_callback' => 'llorix_one_show_on_front',
		'priority'    => 20,
	));
	
	
    /* Team content */
	$wp_customize->add_setting( 'llorix_one_team_content', array(
		'sanitize_callback' => 'llorix_one_sanitize_repeater',
		'default' => json_encode(
							array(
									array('image_url' => llorix_one_get_file('/images/team/1.jpg'),'title' => esc_html__('Albert Jacobs','llorix-one'),'subtitle' => esc_html__('Founder & CEO','llorix-one')),
									array('image_url' => llorix_one_get_file('/images/team/2.jpg'),'title' => esc_html__('Tonya Garcia','llorix-one'),'subtitle' => esc_html__('Account Manager','llorix-one')),
									array('image_url' => llorix_one_get_file('/images/team/3.jpg'),'title' => esc_html__('Linda Guthrie','llorix-one'),'subtitle' => esc_html__('Business Development','llorix-one'))
							)
						)
	));
	$wp_customize->add_control( new Llorix_One_General_Repeater( $wp_customize, 'llorix_one_team_content', array(
		'label'   => esc_html__('Add new team member','llorix-one'),
		'section' => 'llorix_one_team_section',
		'active_callback' => 'llorix_one_show_on_front',
		'priority' => 3,
        'parallax_image_control' => true,
		'parallax_title_control' => true,
		'parallax_subtitle_control' => true
	) ) );
	
	/* Team Background	*/
	$wp_customize->add_setting( 'llorix_one_team_background', array(
		'default' 				=> llorix_one_get_file('/images/background-images/parallax-img/team-img.jpg'),
		'sanitize_callback'		=> 'esc_url',
		'transport' 			=> 'postMessage'
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'llorix_one_team_background', array(
	      	'label'    			=> esc_html__( 'Team Background', 'llorix-one' ),
	      	'section'  			=> 'llorix_one_team_section',
			'active_callback' 	=> 'llorix_one_show_on_front',
			'priority'    		=> 10
	)));
	
	/********************************************************/
	/********** TESTIMONIALS OPTIONS  ***********************/
	/********************************************************/
	
	
	$wp_customize->add_section( 'llorix_one_testimonials_section' , array(
			'title'       => esc_html__( 'Testimonial section', 'llorix-one' ),
			'priority'    => 55,
	));
	
	
	/* Testimonials title */
	$wp_customize->add_setting( 'llorix_one_happy_customers_title', array(
		'default' => esc_html__('Happy Customers','llorix-one'),
		'sanitize_callback' => 'llorix_one_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_happy_customers_title', array(
		'label'    => esc_html__( 'Main title', 'llorix-one' ),
		'section'  => 'llorix_one_testimonials_section',
		'active_callback' => 'llorix_one_show_on_front',
		'priority'    => 10,
	));
	
	/* Testimonials subtitle */
	$wp_customize->add_setting( 'llorix_one_happy_customers_subtitle', array(
		'default' => esc_html__('Cloud computing subscription model out of the box proactive solution.','llorix-one'),
		'sanitize_callback' => 'llorix_one_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_happy_customers_subtitle', array(
		'label'    => esc_html__( 'Subtitle', 'llorix-one' ),
		'section'  => 'llorix_one_testimonials_section',
		'active_callback' => 'llorix_one_show_on_front',
		'priority'    => 20,
	));
	
	
    /* Testimonials content */
	$wp_customize->add_setting( 'llorix_one_testimonials_content', array(
		'sanitize_callback' => 'llorix_one_sanitize_repeater',
		'default' => json_encode(
							array(
									array('image_url' => llorix_one_get_file('/images/clients/1.jpg'),'title' => esc_html__('Happy Customer','llorix-one'),'subtitle' => esc_html__('Lorem ipsum','llorix-one'),'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo. Fusce malesuada vulputate faucibus. Integer in hendrerit nisi. Praesent a hendrerit urna. In non imperdiet elit, sed molestie odio. Fusce ac metus non purus sollicitudin laoreet.','llorix-one')),
									array('image_url' => llorix_one_get_file('/images/clients/2.jpg'),'title' => esc_html__('Happy Customer','llorix-one'),'subtitle' => esc_html__('Lorem ipsum','llorix-one'),'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo. Fusce malesuada vulputate faucibus. Integer in hendrerit nisi. Praesent a hendrerit urna. In non imperdiet elit, sed molestie odio. Fusce ac metus non purus sollicitudin laoreet.','llorix-one')),
									array('image_url' => llorix_one_get_file('/images/clients/3.jpg'),'title' => esc_html__('Happy Customer','llorix-one'),'subtitle' => esc_html__('Lorem ipsum','llorix-one'),'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo. Fusce malesuada vulputate faucibus. Integer in hendrerit nisi. Praesent a hendrerit urna. In non imperdiet elit, sed molestie odio. Fusce ac metus non purus sollicitudin laoreet.','llorix-one'))
							)
						)
	));
	$wp_customize->add_control( new Llorix_One_General_Repeater( $wp_customize, 'llorix_one_testimonials_content', array(
		'label'   => esc_html__('Add new testimonial','llorix-one'),
		'section' => 'llorix_one_testimonials_section',
		'active_callback' => 'llorix_one_show_on_front',
		'priority' => 30,
        'parallax_image_control' => true,
		'parallax_title_control' => true,
		'parallax_subtitle_control' => true,
		'parallax_text_control' => true
	) ) );


	/********************************************************/
	/***************** RIBBON OPTIONS  *****************/
	/********************************************************/
	
    
	/* RIBBON SETTINGS */
	$wp_customize->add_section( 'llorix_one_ribbon_section' , array(
		'title'       => esc_html__( 'Ribbon section', 'llorix-one' ),
		'priority'    => 60,
	));
	

	/* Ribbon Background	*/
	$wp_customize->add_setting( 'llorix_one_ribbon_background', array(
		'default' => llorix_one_get_file('/images/background-images/parallax-img/parallax-img1.jpg'),
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'llorix_one_ribbon_background', array(
	      	'label'    => esc_html__( 'Ribbon Background', 'llorix-one' ),
	      	'section'  => 'llorix_one_ribbon_section',
			'active_callback' => 'llorix_one_show_on_front',
			'priority'    => 10
	)));
	
	$wp_customize->add_setting( 'llorix_one_ribbon_title', array(
		'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.','llorix-one'),
		'sanitize_callback' => 'llorix_one_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_ribbon_title', array(
		'label'    => esc_html__( 'Main title', 'llorix-one' ),
		'section'  => 'llorix_one_ribbon_section',
		'active_callback' => 'llorix_one_show_on_front',
		'priority'    => 20
	));
	

	$wp_customize->add_setting( 'llorix_one_button_text', array(
		'default' => esc_html__('GET STARTED','llorix-one'),
		'sanitize_callback' => 'llorix_one_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_button_text', array(
		'label'    => esc_html__( 'Button label', 'llorix-one' ),
		'section'  => 'llorix_one_ribbon_section',
		'active_callback' => 'llorix_one_show_on_front',
		'priority'    => 30
	));
	
	
	$wp_customize->add_setting( 'llorix_one_button_link', array(
		'default' => esc_html__('#','llorix-one'),
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_button_link', array(
		'label'    => esc_html__( 'Button link', 'llorix-one' ),
		'section'  => 'llorix_one_ribbon_section',
		'active_callback' => 'llorix_one_show_on_front',
		'priority'    => 40
	));

	/********************************************************/
	/************ LATEST NEWS OPTIONS  **************/
	/********************************************************/
	
    
	$wp_customize->add_section( 'llorix_one_latest_news_section' , array(
			'title'       => esc_html__( 'Latest news section', 'llorix-one' ),
			'priority'    => 65
	));
	
	$wp_customize->add_setting( 'llorix_one_latest_news_title', array(
		'default' => esc_html__('Latest news','llorix-one'),
		'sanitize_callback' => 'llorix_one_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_latest_news_title', array(
		'label'    => esc_html__( 'Main title', 'llorix-one' ),
		'section'  => 'llorix_one_latest_news_section',
		'active_callback' => 'llorix_one_show_on_front',
		'priority'    => 10
	));
	
	/********************************************************/
	/****************** CONTACT OPTIONS  ********************/
	/********************************************************/
	
	
	/* CONTACT SETTINGS */
	$wp_customize->add_section( 'llorix_one_contact_section' , array(
		'title'       => esc_html__( 'Contact section', 'llorix-one' ),
		'priority'    => 70,
	));


	$wp_customize->add_setting( 'llorix_one_contact_info_content', array(
		'sanitize_callback' => 'llorix_one_sanitize_repeater',
		'default' => json_encode(
			array( 
					array("icon_value" => "icon-basic-mail" ,"text" => "contact@site.com", "link" => "#" ), 
					array("icon_value" => "icon-basic-geolocalize-01" ,"text" => "Company address", "link" => "#" ), 
					array("icon_value" => "icon-basic-tablet" ,"text" => "0 332 548 954", "link" => "#" ) 
			)
		)
	));
	$wp_customize->add_control( new Llorix_One_General_Repeater( $wp_customize, 'llorix_one_contact_info_content', array(
		'label'   => esc_html__('Add new contact field','llorix-one'),
		'section' => 'llorix_one_contact_section',
		'active_callback' => 'llorix_one_show_on_front',
		'priority' => 10,
        'parallax_image_control' => false,
        'parallax_icon_control' => true,
        'parallax_text_control' => true,
        'parallax_link_control' => true
	) ) );
	
    
	/* Map ShortCode  */
	$wp_customize->add_setting( 'llorix_one_frontpage_map_shortcode', array(
		'default' => '',
		'sanitize_callback' => 'llorix_one_sanitize_text'
	));
	$wp_customize->add_control( 'llorix_one_frontpage_map_shortcode', array(
		'label'    => esc_html__( 'Map shortcode', 'llorix-one' ),
		'description' => __('To use this section please install <a href="https://wordpress.org/plugins/intergeo-maps/">Intergeo Maps</a> plugin then use it to create a map and paste here the shortcode generated','llorix-one'),
		'section'  => 'llorix_one_contact_section',
		'active_callback' => 'llorix_one_show_on_front',
		'priority'    => 20
	));
	
    
	/********************************************************/
	/*************** CONTACT PAGE OPTIONS  ******************/
	/********************************************************/
	
	
	$wp_customize->add_section( 'llorix_one_contact_page' , array(
		'title'       => esc_html__( 'Contact page', 'llorix-one' ),
      	'priority'    => 75,
	));

	/* Contact Form  */
	$wp_customize->add_setting( 'llorix_one_contact_form_shortcode', array(
		'default' => '',
		'sanitize_callback' => 'llorix_one_sanitize_text'
	));
	$wp_customize->add_control( 'llorix_one_contact_form_shortcode', array(
		'label'    => esc_html__( 'Contact form shortcode', 'llorix-one' ),
		'description' => __('Create a form, copy the shortcode generated and paste it here. We recommend <a href="https://wordpress.org/plugins/contact-form-7/">Contact Form 7</a> but you can use any plugin you like.','llorix-one'),
		'section'  => 'llorix_one_contact_page',
		'active_callback' => 'llorix_one_is_contact_page',
		'priority'    => 1
	));
	
	/* Map ShortCode  */
	$wp_customize->add_setting( 'llorix_one_contact_map_shortcode', array(
		'default' => '',
		'sanitize_callback' => 'llorix_one_sanitize_text'
	));
	$wp_customize->add_control( 'llorix_one_contact_map_shortcode', array(
		'label'    => esc_html__( 'Map shortcode', 'llorix-one' ),
		'description' => __('To use this section please install <a href="https://wordpress.org/plugins/intergeo-maps/">Intergeo Maps</a> plugin then use it to create a map and paste here the shortcode generated','llorix-one'),
		'section'  => 'llorix_one_contact_page',
		'active_callback' => 'llorix_one_is_contact_page',
		'priority'    => 2
	));
	
	/********************************************************/
	/****************** FOOTER OPTIONS  *********************/
	/********************************************************/	
	
	$wp_customize->add_section( 'llorix_one_footer_section' , array(
		'title'       => esc_html__( 'Footer options', 'llorix-one' ),
      	'priority'    => 80,
      	'description' => esc_html__('The main content of this section is customizable in: Customize -> Widgets -> Footer area. ','llorix-one'),
	));	
	
	/* Footer Menu */
	$nav_menu_locations_footer = $wp_customize->get_control('nav_menu_locations[parallax_footer_menu]');
	if(!empty($nav_menu_locations_footer)){
		$nav_menu_locations_footer->section = 'llorix_one_footer_section';
		$nav_menu_locations_footer->priority = 1;
	}
	/* Copyright */
	$wp_customize->add_setting( 'llorix_one_copyright', array(
		'default' => 'Themeisle',
		'sanitize_callback' => 'llorix_one_sanitize_text',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( 'llorix_one_copyright', array(
		'label'    => esc_html__( 'Copyright', 'llorix-one' ),
		'section'  => 'llorix_one_footer_section',
		'priority'    => 2
	));
	
	
	/* Socials icons */
	
	
	$wp_customize->add_setting( 'llorix_one_social_icons', array(
		'sanitize_callback' => 'llorix_one_sanitize_repeater',
		'default' => json_encode(
			array(
				array('icon_value' =>'icon-social-facebook' , 'link' => '#'),
				array('icon_value' =>'icon-social-twitter' , 'link' => '#'),
				array('icon_value' =>'icon-social-googleplus' , 'link' => '#')
			)
		)

	));
	$wp_customize->add_control( new Llorix_One_General_Repeater( $wp_customize, 'llorix_one_social_icons', array(
		'label'   => esc_html__('Add new social icon','llorix-one'),
		'section' => 'llorix_one_footer_section',
		'priority' => 3,
        'parallax_image_control' => false,
        'parallax_icon_control' => true,
        'parallax_text_control' => false,
        'parallax_link_control' => true
	) ) );
	
	/********************************************************/
	/************** ADVANCED OPTIONS  ***********************/
	/********************************************************/
	
	$wp_customize->add_section( 'llorix_one_general_section' , array(
		'title'       => esc_html__( 'Advanced options', 'llorix-one' ),
      	'priority'    => 85,
      	'description' => esc_html__('Paralax One theme general options','llorix-one'),
	));
	
	$blogname = $wp_customize->get_control('blogname');
	$blogdescription = $wp_customize->get_control('blogdescription');
	$blogicon = $wp_customize->get_control('site_icon');
	
	if(!empty($blogname)){
		$blogname->section = 'llorix_one_general_section';
		$blogname->priority = 1;
	}
	if(!empty($blogdescription)){
		$blogdescription->section = 'llorix_one_general_section';
		$blogdescription->priority = 2;
	}
	if(!empty($blogicon)){
		$blogicon->section = 'llorix_one_general_section';
		$blogicon->priority = 3;
	}
	$wp_customize->remove_section('title_tagline');
	
	$nav_menu_locations_primary = $wp_customize->get_control('nav_menu_locations[primary]');
	if(!empty($nav_menu_locations_primary)){
		$nav_menu_locations_primary->section = 'llorix_one_general_section';
		$nav_menu_locations_primary->priority = 6;
	}
	
	/* Disable preloader */
	$wp_customize->add_setting( 'llorix_one_disable_preloader', array(
		'sanitize_callback' => 'llorix_one_sanitize_text'
	));
	$wp_customize->add_control( 'llorix_one_disable_preloader', array(
		'type' => 'checkbox',
		'label' => esc_html__('Disable preloader?','llorix-one'),
		'description' => esc_html__('If this box is checked, the preloader will be disabled from homepage.','llorix-one'),
		'section' => 'llorix_one_general_section',
		'priority'    => 7,
	));
	
	
	
	
	/*********************************/
	/******* PLUS SECTIONS ***********/
	/*********************************/
	require_once ( 'class/parallax-one-text-control.php');
	
	
	/*****************************************************************/
    /**********	Control for choosing a template for the frontpage ****/
	/*****************************************************************/
	
	$wp_customize->remove_control('page_on_front');
	
	$wp_customize->add_control(new Llorix_One_Frontpage_Templates($wp_customize, 'page_on_front',array(
			'label'    => __( 'Front page', 'llorix-one' ),
			'section' => 'static_front_page',
			'priority' => 10
	)));
	
	$llorix_one_page_for_posts = $wp_customize->get_control('page_for_posts');
	if(!empty($llorix_one_page_for_posts)):
		$llorix_one_page_for_posts->priority = 11;
	endif;
	
	$llorix_one_templates = get_page_templates();
	
	if( !empty($llorix_one_templates) ):
	
		$llorix_one_templates_reversed = array_flip($llorix_one_templates);
		$llorix_one_templates_reversed['default'] = 'Default';
	
		$wp_customize->add_setting( 'llorix_one_frontpage_template_static', array(
			'default' => esc_html__('Frontpage template','llorix-one'),
			'sanitize_callback' => 'llorix_one_sanitize_text',
		));
		$wp_customize->add_control( 'llorix_one_frontpage_template_static', array(
			'type' => 'select',
			'label'    => esc_html__( 'Frontpage template', 'llorix-one' ),
			'section'  => 'static_front_page',
			'choices' => $llorix_one_templates_reversed,
			'priority'    => 12
		));
	endif;	
	
}
add_action( 'customize_register', 'llorix_one_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function llorix_one_customize_preview_js() {
	wp_enqueue_script( 'llorix_one_customizer', llorix_one_get_file('/js/customizer.js'), array( 'customize-preview' ), '1.0.2', true );
}
add_action( 'customize_preview_init', 'llorix_one_customize_preview_js', 10);


function llorix_one_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function llorix_one_sanitize_repeater($input){
	  
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


function llorix_one_sanitize_html( $input){
	
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


function llorix_one_customizer_script() {
	wp_enqueue_script( 'llorix_one_customizer_script', llorix_one_get_file('/js/parallax_one_customizer.js'), array("jquery","jquery-ui-draggable"),'1.0.0', true  );
	
	wp_localize_script( 'llorix_one_customizer_script', 'llorixOneCustomizerObject', array(
	
		'pro' => __('Upgrade to PRO','llorix-one'),
		
	) );
}
add_action( 'customize_controls_enqueue_scripts', 'llorix_one_customizer_script' );

function llorix_one_is_contact_page() { 
		return is_page_template('template-contact.php');
};

function llorix_one_show_on_front(){
	return is_page_template('template-frontpage.php');
}
