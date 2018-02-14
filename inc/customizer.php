<?php
/**
 * Llorix One Lite Theme Customizer
 *
 * @package llorix-one-lite
 */

/* Include customizer repeater */
require_once get_template_directory() . '/inc/customizer-repeater/functions.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function llorix_one_lite_customize_register( $wp_customize ) {

	require_once( 'class/llorix-one-lite-text-control.php' );
	require_once( 'class/llorix-one-lite-alpha-control.php' );
	require_once( trailingslashit( get_template_directory() ) . 'inc/customizer-page-editor/customizer-page-editor.php' );

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/* ADVANCED OPTIONS */

	$wp_customize->add_section(
		'llorix_one_lite_general_section', array(
			'title'       => esc_html__( 'Advanced options', 'llorix-one-lite' ),
			'priority'    => 10,
			'description' => esc_html__( 'Llorix One Lite theme general options', 'llorix-one-lite' ),
		)
	);

	$blogname        = $wp_customize->get_control( 'blogname' );
	$blogdescription = $wp_customize->get_control( 'blogdescription' );
	$blogicon        = $wp_customize->get_control( 'site_icon' );

	if ( ! empty( $blogname ) ) {
		$blogname->section  = 'llorix_one_lite_general_section';
		$blogname->priority = 1;
	}
	if ( ! empty( $blogdescription ) ) {
		$blogdescription->section  = 'llorix_one_lite_general_section';
		$blogdescription->priority = 2;
	}
	if ( ! empty( $blogicon ) ) {
		$blogicon->section  = 'llorix_one_lite_general_section';
		$blogicon->priority = 3;
	}
	$wp_customize->remove_section( 'title_tagline' );

	$nav_menu_locations_primary = $wp_customize->get_control( 'nav_menu_locations[primary]' );
	if ( ! empty( $nav_menu_locations_primary ) ) {
		$nav_menu_locations_primary->section  = 'llorix_one_lite_general_section';
		$nav_menu_locations_primary->priority = 6;
	}

	/**
	 * Option to get the frontpage settings to the old default template if a static frontpage is selected
	 */
	$wp_customize->add_setting(
		'llorix_one_lite_keep_old_fp_template', array(
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'llorix_one_lite_keep_old_fp_template', array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Keep the old static frontpage template?', 'llorix-one-lite' ),
			'section'  => 'llorix_one_lite_general_section',
			'priority' => 6,
		)
	);

	/* Disable preloader */
	$wp_customize->add_setting(
		'llorix_one_lite_disable_preloader', array(
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'llorix_one_lite_disable_preloader', array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Disable preloader?', 'llorix-one-lite' ),
			'description' => esc_html__( 'If this box is checked, the preloader will be disabled from homepage.', 'llorix-one-lite' ),
			'section'     => 'llorix_one_lite_general_section',
			'priority'    => 7,
		)
	);

	/* Change the template to full width for page.php */
	$wp_customize->add_setting(
		'llorix_one_lite_change_to_full_width', array(
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'llorix_one_lite_change_to_full_width', array(
			'type'     => 'checkbox',
			'label'    => __( 'Change the template to Full width for all the pages?', 'llorix-one-lite' ),
			'section'  => 'llorix_one_lite_general_section',
			'priority' => 8,
		)
	);

	/* APPEARANCE */

	$wp_customize->add_panel(
		'panel_2', array(
			'priority'       => 30,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Appearance', 'llorix-one-lite' ),
		)
	);

	/* Colors */
	$wp_customize->add_setting(
		'llorix_one_lite_text_color', array(
			'default'           => '#313131',
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'llorix_one_lite_text_color',
			array(
				'label'    => esc_html__( 'Text color', 'llorix-one-lite' ),
				'section'  => 'colors',
				'priority' => 5,
			)
		)
	);

	$wp_customize->add_setting(
		'llorix_one_lite_title_color', array(
			'default'           => '#454545',
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'llorix_one_lite_title_color',
			array(
				'label'    => esc_html__( 'Title color', 'llorix-one-lite' ),
				'section'  => 'colors',
				'priority' => 6,
			)
		)
	);

	/* General options */
	$wp_customize->add_section(
		'llorix_one_lite_appearance_general', array(
			'title'       => esc_html__( 'General options', 'llorix-one-lite' ),
			'priority'    => 3,
			'description' => esc_html__( 'Llorix One Lite theme general appearance options', 'llorix-one-lite' ),
			'panel'       => 'panel_2',
		)
	);

	$wp_customize->add_setting(
		'llorix_one_lite_logo', array(
			'sanitize_callback' => 'esc_url',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'llorix_one_lite_logo', array(
				'label'    => esc_html__( 'Logo', 'llorix-one-lite' ),
				'section'  => 'llorix_one_lite_appearance_general',
				'priority' => 1,
			)
		)
	);

	$wp_customize->add_setting(
		'llorix_one_lite_sticky_header', array(
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'llorix_one_lite_sticky_header',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Header visibility', 'llorix-one-lite' ),
			'description' => esc_html__( 'If this box is checked, the header will toggle on frontpage.', 'llorix-one-lite' ),
			'section'     => 'llorix_one_lite_appearance_general',
			'priority'    => 2,
		)
	);

	/* Background image */
	$wp_customize->remove_control( 'background_color' );
	$wp_customize->get_section( 'background_image' )->panel = 'panel_2';
	$wp_customize->get_section( 'colors' )->panel           = 'panel_2';

	/* HEADER */

	$wp_customize->add_panel(
		'panel_1', array(
			'priority'       => 50,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Header', 'llorix-one-lite' ),
		)
	);

	/* VERY TOP HEADER */
	$wp_customize->add_section(
		'llorix_one_lite_very_top_header_content', array(
			'title'    => esc_html__( 'Very top header', 'llorix-one-lite' ),
			'priority' => 10,
			'panel'    => 'panel_1',
		)
	);

	/* Very top header show/hide */
	$wp_customize->add_setting(
		'llorix_one_lite_very_top_header_show', array(
			'default'           => apply_filters( 'llorix_one_lite_very_top_header_show_filter', 0 ),
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'llorix_one_lite_very_top_header_show', array(
			'type'     => 'checkbox',
			'label'    => __( 'Disable the Very top header?', 'llorix-one-lite' ),
			'section'  => 'llorix_one_lite_very_top_header_content',
			'priority' => 1,
		)
	);

	/* Phone number - text */
	$wp_customize->add_setting(
		'llorix_one_lite_very_top_header_phone_text', array(
			'default'           => esc_html__( 'Call us: ', 'llorix-one-lite' ),
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'llorix_one_lite_very_top_header_phone_text', array(
			'label'    => esc_html__( 'Text before the phone number', 'llorix-one-lite' ),
			'section'  => 'llorix_one_lite_very_top_header_content',
			'priority' => 2,
		)
	);

	/* Phone number */
	$wp_customize->add_setting(
		'llorix_one_lite_very_top_header_phone', array(
			'default'           => esc_html__( '(+9) 0999.500.400', 'llorix-one-lite' ),
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'llorix_one_lite_very_top_header_phone', array(
			'label'    => esc_html__( 'Phone number', 'llorix-one-lite' ),
			'section'  => 'llorix_one_lite_very_top_header_content',
			'priority' => 3,
		)
	);

	/* social icons header */
	$default = llorix_one_lite_header_social_icons_get_default_content();
	$wp_customize->add_setting(
		'llorix_one_lite_very_top_social_icons', array(
			'sanitize_callback' => 'llorix_one_lite_sanitize_repeater',
			'default'           => $default,
		)
	);

	$wp_customize->add_control(
		new Llorix_One_Lite_General_Repeater(
			$wp_customize, 'llorix_one_lite_very_top_social_icons', array(
				'label'                         => esc_html__( 'Add new social icon', 'llorix-one-lite' ),
				'section'                       => 'llorix_one_lite_very_top_header_content',
				'priority'                      => 4,
				'llorix_one_lite_image_control' => false,
				'llorix_one_lite_icon_control'  => true,
				'llorix_one_lite_text_control'  => false,
				'llorix_one_lite_link_control'  => true,
			)
		)
	);

	/* BLOG HEADER */

	$wp_customize->add_section(
		'llorix_one_lite_blog_header_section', array(
			'title'    => esc_html__( 'Blog header', 'llorix-one-lite' ),
			'priority' => 20,
			'panel'    => 'panel_1',
		)
	);

	/* Blog Header title */
	$wp_customize->add_setting(
		'llorix_one_lite_blog_header_title', array(
			'default'           => apply_filters( 'llorix_one_lite_blog_header_title_default_filter', 'This Theme Supports a Custom FrontPage' ),
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'llorix_one_lite_blog_header_title', array(
			'label'    => esc_html__( 'Title', 'llorix-one-lite' ),
			'section'  => 'llorix_one_lite_blog_header_section',
			'priority' => 1,
		)
	);

	/* Blog Header subtitle */
	$wp_customize->add_setting(
		'llorix_one_lite_blog_header_subtitle', array(
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'llorix_one_lite_blog_header_subtitle', array(
			'label'    => esc_html__( 'Subtitle', 'llorix-one-lite' ),
			'section'  => 'llorix_one_lite_blog_header_section',
			'priority' => 2,
		)
	);

	/* Blog Header image	*/
	$wp_customize->add_setting(
		'llorix_one_lite_blog_header_image', array(
			'default'           => apply_filters( 'llorix_one_lite_blog_header_image_filter', llorix_one_lite_get_file( '/images/background-images/background-blog.jpg' ) ),
			'sanitize_callback' => 'esc_url',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'llorix_one_lite_blog_header_image', array(
				'label'    => esc_html__( 'Image', 'llorix-one-lite' ),
				'section'  => 'llorix_one_lite_blog_header_section',
				'priority' => 3,
			)
		)
	);

	$wp_customize->add_setting(
		'llorix_one_lite_blog_opacity', array(
			'default'           => apply_filters( 'llorix_one_lite_blog_opacity_filter', 'rgba(13, 60, 85, 0.6)' ),
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Llorix_One_Lite_Customize_Alpha_Color_Control(
			$wp_customize, 'llorix_one_lite_blog_opacity', array(
				'label'    => __( 'Overlay color and transparency', 'llorix-one-lite' ),
				'palette'  => true,
				'section'  => 'llorix_one_lite_blog_header_section',
				'priority' => 4,
			)
		)
	);

	/* FRONTPAGE SECTIONS */

	$wp_customize->add_panel(
		'llorix_one_lite_front_page_sections', array(
			'title'    => __( 'Frontpage sections', 'llorix-one-lite' ),
			'priority' => 90,
		)
	);

	/* BIG TITLE SECTION */

	$wp_customize->add_section(
		'llorix_one_lite_header_content', array(
			'title'           => esc_html__( 'Big title section', 'llorix-one-lite' ),
			'priority'        => 10,
			'panel'           => 'llorix_one_lite_front_page_sections',
			'active_callback' => 'llorix_one_lite_show_on_front',
		)
	);

	/* Header Logo	*/
	$wp_customize->add_setting(
		'llorix_one_lite_header_logo', array(
			'default'           => apply_filters( 'llorix_one_lite_header_logo_filter', llorix_one_lite_get_file( '/images/logo-2.png' ) ),
			'sanitize_callback' => 'esc_url',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'llorix_one_lite_header_logo', array(
				'label'    => esc_html__( 'Header Logo', 'llorix-one-lite' ),
				'section'  => 'llorix_one_lite_header_content',
				'priority' => 10,
			)
		)
	);

	/* Header title */
	$wp_customize->add_setting(
		'llorix_one_lite_header_title', array(
			'default'           => apply_filters( 'llorix_one_lite_header_title_filter', esc_html__( 'Simple, Reliable and Awesome.', 'llorix-one-lite' ) ),
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'llorix_one_lite_header_title', array(
			'label'    => esc_html__( 'Main title', 'llorix-one-lite' ),
			'section'  => 'llorix_one_lite_header_content',
			'priority' => 20,
		)
	);

	/* Header subtitle */
	$llorix_one_lite_header_subtitle_default = '';
	if ( current_user_can( 'edit_theme_options' ) ) {
		/* translators: %1$s is the customize link %2$s the customize link label */
		$llorix_one_lite_header_subtitle_default = sprintf( __( 'Change this text in %s', 'llorix-one-lite' ), sprintf( '<a href="%1$s" class="llorix-one-lite-default-links">%2$s</a>', esc_url( admin_url( 'customize.php?autofocus&#91;control&#93;=llorix_one_lite_header_subtitle' ) ), __( 'Big title section', 'llorix-one-lite' ) ) );
	}
	$wp_customize->add_setting(
		'llorix_one_lite_header_subtitle', array(
			'default'           => $llorix_one_lite_header_subtitle_default,
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'llorix_one_lite_header_subtitle', array(
			'label'    => esc_html__( 'Subtitle', 'llorix-one-lite' ),
			'section'  => 'llorix_one_lite_header_content',
			'priority' => 30,
		)
	);

	/*Header Button text*/
	$wp_customize->add_setting(
		'llorix_one_lite_header_button_text', array(
			'default'           => esc_html__( 'GET STARTED', 'llorix-one-lite' ),
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'llorix_one_lite_header_button_text', array(
			'label'    => esc_html__( 'Button label', 'llorix-one-lite' ),
			'section'  => 'llorix_one_lite_header_content',
			'priority' => 40,
		)
	);

	$wp_customize->add_setting(
		'llorix_one_lite_header_button_link', array(
			'default'           => esc_html__( '#', 'llorix-one-lite' ),
			'sanitize_callback' => 'esc_url',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'llorix_one_lite_header_button_link', array(
			'label'    => esc_html__( 'Button link', 'llorix-one-lite' ),
			'section'  => 'llorix_one_lite_header_content',
			'priority' => 50,
		)
	);

	/* BIG TITLE SECTION BACKGROUND */

	$wp_customize->get_section( 'header_image' )->panel           = 'llorix_one_lite_front_page_sections';
	$wp_customize->get_section( 'header_image' )->title           = esc_html__( 'Big title section background', 'llorix-one-lite' );
	$wp_customize->get_section( 'header_image' )->priority        = 20;
	$wp_customize->get_section( 'header_image' )->active_callback = 'llorix_one_lite_show_on_front';

	/* Enable parallax effect*/
	$wp_customize->add_setting(
		'llorix_one_lite_enable_move', array(
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'llorix_one_lite_enable_move', array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Parallax effect', 'llorix-one-lite' ),
			'description' => esc_html__( 'If this box is checked, the parallax effect is enabled.', 'llorix-one-lite' ),
			'section'     => 'header_image',
			'priority'    => 3,
		)
	);

	/* Layer one */
	$wp_customize->add_setting(
		'llorix_one_lite_first_layer', array(
			'default'           => llorix_one_lite_get_file( '/images/background1.png' ),
			'sanitize_callback' => 'esc_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'llorix_one_lite_first_layer', array(
				'label'    => esc_html__( 'First layer', 'llorix-one-lite' ),
				'section'  => 'header_image',
				'priority' => 4,
			)
		)
	);

	/* Layer two */
	$wp_customize->add_setting(
		'llorix_one_lite_second_layer', array(
			'default'           => llorix_one_lite_get_file( '/images/background2.png' ),
			'sanitize_callback' => 'esc_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'llorix_one_lite_second_layer', array(
				'label'    => esc_html__( 'Second layer', 'llorix-one-lite' ),
				'section'  => 'header_image',
				'priority' => 5,
			)
		)
	);

	$wp_customize->add_setting(
		'llorix_one_lite_frontpage_opacity', array(
			'default'           => apply_filters( 'llorix_one_lite_frontpage_opacity_filter', 'rgba(13, 60, 85, 0.5)' ),
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Llorix_One_Lite_Customize_Alpha_Color_Control(
			$wp_customize, 'llorix_one_lite_frontpage_opacity', array(
				'label'    => __( 'Overlay color and transparency', 'llorix-one-lite' ),
				'palette'  => true,
				'section'  => 'header_image',
				'priority' => 20,
			)
		)
	);

	/* LOGOS BAR SECTION */

	$wp_customize->add_section(
		'llorix_one_lite_logos_settings_section', array(
			'title'           => esc_html__( 'Logos Bar section', 'llorix-one-lite' ),
			'priority'        => 30,
			'panel'           => 'llorix_one_lite_front_page_sections',
			'active_callback' => 'llorix_one_lite_show_on_front',
		)
	);

	/* Logos bar show/hide */
	$wp_customize->add_setting(
		'llorix_one_lite_logos_show', array(
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'llorix_one_lite_logos_show', array(
			'type'     => 'checkbox',
			'label'    => __( 'Disable the Logos bar sections?', 'llorix-one-lite' ),
			'section'  => 'llorix_one_lite_logos_settings_section',
			'priority' => 1,
		)
	);

	$default = llorix_one_lite_logos_get_default_content();
	$wp_customize->add_setting(
		'llorix_one_lite_logos_content', array(
			'sanitize_callback' => 'llorix_one_lite_sanitize_repeater',
			'default'           => $default,
		)
	);

	$wp_customize->add_control(
		new Llorix_One_Lite_General_Repeater(
			$wp_customize, 'llorix_one_lite_logos_content', array(
				'label'                         => esc_html__( 'Add new logo', 'llorix-one-lite' ),
				'section'                       => 'llorix_one_lite_logos_settings_section',
				'priority'                      => 10,
				'llorix_one_lite_image_control' => true,
				'llorix_one_lite_icon_control'  => false,
				'llorix_one_lite_text_control'  => false,
				'llorix_one_lite_link_control'  => true,
			)
		)
	);

	/* ABOUT SECTION */

	$wp_customize->add_section(
		'llorix_one_lite_about_section', array(
			'title'           => esc_html__( 'About section', 'llorix-one-lite' ),
			'priority'        => 50,
			'panel'           => 'llorix_one_lite_front_page_sections',
			'active_callback' => 'llorix_one_lite_show_on_front',
		)
	);

	/* About show/hide */
	$wp_customize->add_setting(
		'llorix_one_lite_our_story_show', array(
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'llorix_one_lite_our_story_show', array(
			'type'     => 'checkbox',
			'label'    => __( 'Disable the About section?', 'llorix-one-lite' ),
			'section'  => 'llorix_one_lite_about_section',
			'priority' => 1,
		)
	);

	/* About title */
	$wp_customize->add_setting(
		'llorix_one_lite_our_story_title', array(
			'default'           => esc_html__( 'Our Story', 'llorix-one-lite' ),
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'llorix_one_lite_our_story_title', array(
			'label'    => esc_html__( 'Main title', 'llorix-one-lite' ),
			'section'  => 'llorix_one_lite_about_section',
			'priority' => 10,
		)
	);

	/* About Content */
	$llorix_one_lite_our_story_text_default = '';
	if ( current_user_can( 'edit_theme_options' ) ) {
		/* translators: %1$s is the customize link %2$s the customize link label */
		$llorix_one_lite_our_story_text_default = sprintf( __( 'Change this text in %s', 'llorix-one-lite' ), sprintf( '<a href="%1$s" class="llorix-one-lite-default-links">%2$s</a>', esc_url( admin_url( 'customize.php?autofocus&#91;control&#93;=llorix_one_lite_our_story_text' ) ), __( 'About section', 'llorix-one-lite' ) ) );
	}
	$wp_customize->add_setting(
		'llorix_one_lite_our_story_text', array(
			'default'           => $llorix_one_lite_our_story_text_default,
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'llorix_one_lite_our_story_text', array(
			'type'     => 'textarea',
			'label'    => esc_html__( 'Content', 'llorix-one-lite' ),
			'section'  => 'llorix_one_lite_about_section',
			'priority' => 20,
		)
	);

	/* About Image	*/
	$wp_customize->add_setting(
		'llorix_one_lite_our_story_image', array(
			'default'           => apply_filters( 'llorix_one_lite_our_story_image_filter', llorix_one_lite_get_file( '/images/about-us.png' ) ),
			'sanitize_callback' => 'esc_url',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'llorix_one_lite_our_story_image', array(
				'label'    => esc_html__( 'Image', 'llorix-one-lite' ),
				'section'  => 'llorix_one_lite_about_section',
				'priority' => 30,
			)
		)
	);

	/* RIBBON SECTION */

	$wp_customize->add_section(
		'llorix_one_lite_ribbon_section', array(
			'title'           => esc_html__( 'Ribbon section', 'llorix-one-lite' ),
			'priority'        => 80,
			'panel'           => 'llorix_one_lite_front_page_sections',
			'active_callback' => 'llorix_one_lite_show_on_front',
		)
	);

	/* Ribbon show/hide */
	$wp_customize->add_setting(
		'llorix_one_lite_ribbon_show', array(
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'llorix_one_lite_ribbon_show', array(
			'type'     => 'checkbox',
			'label'    => __( 'Disable the Ribbon section?', 'llorix-one-lite' ),
			'section'  => 'llorix_one_lite_ribbon_section',
			'priority' => 1,
		)
	);

	/* Ribbon Background */
	$wp_customize->add_setting(
		'llorix_one_lite_ribbon_background', array(
			'default'           => apply_filters( 'llorix_one_lite_ribbon_background_filter', llorix_one_lite_get_file( '/images/background-images/parallax-img/parallax-img1.jpg' ) ),
			'sanitize_callback' => 'esc_url',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'llorix_one_lite_ribbon_background', array(
				'label'    => esc_html__( 'Ribbon Background', 'llorix-one-lite' ),
				'section'  => 'llorix_one_lite_ribbon_section',
				'priority' => 10,
			)
		)
	);

	/* Ribbon Title */
	$llorix_one_lite_ribbon_title_default = '';
	if ( current_user_can( 'edit_theme_options' ) ) {
		/* translators: %1$s is the customize link %2$s the customize link label */
		$llorix_one_lite_ribbon_title_default = sprintf( __( 'Change this text in %s', 'llorix-one-lite' ), sprintf( '<a href="%1$s">%2$s</a>', esc_url( admin_url( 'customize.php?autofocus&#91;control&#93;=llorix_one_lite_ribbon_title' ) ), __( 'Ribbon section', 'llorix-one-lite' ) ) );
	}

	$wp_customize->add_setting(
		'llorix_one_lite_ribbon_title', array(
			'default'           => $llorix_one_lite_ribbon_title_default,
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'llorix_one_lite_ribbon_title', array(
			'label'    => esc_html__( 'Main title', 'llorix-one-lite' ),
			'section'  => 'llorix_one_lite_ribbon_section',
			'priority' => 20,
		)
	);

	/* Ribbon button label */
	$wp_customize->add_setting(
		'llorix_one_lite_button_text', array(
			'default'           => esc_html__( 'GET STARTED', 'llorix-one-lite' ),
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'llorix_one_lite_button_text', array(
			'label'    => esc_html__( 'Button label', 'llorix-one-lite' ),
			'section'  => 'llorix_one_lite_ribbon_section',
			'priority' => 30,
		)
	);

	/* Ribbon button link */
	$wp_customize->add_setting(
		'llorix_one_lite_button_link', array(
			'default'           => esc_html__( '#', 'llorix-one-lite' ),
			'sanitize_callback' => 'esc_url',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'llorix_one_lite_button_link', array(
			'label'    => esc_html__( 'Button link', 'llorix-one-lite' ),
			'section'  => 'llorix_one_lite_ribbon_section',
			'priority' => 40,
		)
	);

	/* LATEST NEWS SECTION */

	$wp_customize->add_section(
		'llorix_one_lite_latest_news_section', array(
			'title'           => esc_html__( 'Latest news section', 'llorix-one-lite' ),
			'priority'        => 90,
			'panel'           => 'llorix_one_lite_front_page_sections',
			'active_callback' => 'llorix_one_lite_show_on_front',
		)
	);

	/* Latest news show/hide */
	$wp_customize->add_setting(
		'llorix_one_lite_latest_news_show', array(
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'llorix_one_lite_latest_news_show', array(
			'type'     => 'checkbox',
			'label'    => __( 'Disable the Latest news section?', 'llorix-one-lite' ),
			'section'  => 'llorix_one_lite_latest_news_section',
			'priority' => 1,
		)
	);

	/* Latest news title */
	$wp_customize->add_setting(
		'llorix_one_lite_latest_news_title', array(
			'default'           => esc_html__( 'Latest news', 'llorix-one-lite' ),
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'llorix_one_lite_latest_news_title', array(
			'label'    => esc_html__( 'Main title', 'llorix-one-lite' ),
			'section'  => 'llorix_one_lite_latest_news_section',
			'priority' => 10,
		)
	);

	/* FRONTPAGE CONTENT SECTION */

	$wp_customize->add_section(
		'llorix_one_lite_frontpage_content_section', array(
			'title'           => esc_html__( 'Frontpage content section', 'llorix-one-lite' ),
			'priority'        => 150,
			'panel'           => 'llorix_one_lite_front_page_sections',
			'active_callback' => 'llorix_one_lite_show_on_front',
		)
	);

	/* Frontpage content show/hide */
	$wp_customize->add_setting(
		'llorix_one_lite_frontpage_content_show', array(
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
			'default'           => 1,
		)
	);

	$wp_customize->add_control(
		'llorix_one_lite_frontpage_content_show', array(
			'type'     => 'checkbox',
			'label'    => __( 'Disable the Frontpage Content section?', 'llorix-one-lite' ),
			'section'  => 'llorix_one_lite_frontpage_content_section',
			'priority' => 1,
		)
	);

	/* Frontpage content editor control */
	$frontpage_id = get_option( 'page_on_front' );
	$default      = '';

	if ( ! empty( $frontpage_id ) ) {
		$default = get_post_field( 'post_content', $frontpage_id );
	}

	$wp_customize->add_setting(
		'llorix_one_lite_page_editor', array(
			'default'           => $default,
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control(
		new Llorix_One_Lite_Page_Editor(
			$wp_customize, 'llorix_one_lite_page_editor', array(
				'label'                      => __( 'Content', 'llorix-one-lite' ),
				'section'                    => 'llorix_one_lite_frontpage_content_section',
				'priority'                   => 10,
				'active_callback'            => 'llorix_one_lite_show_on_front',
				'include_admin_print_footer' => true,
				'needsync'                   => true,
			)
		)
	);

	$default = '';
	if ( has_post_thumbnail( $frontpage_id ) ) {
		$default = get_the_post_thumbnail_url( $frontpage_id );
	}
	$wp_customize->add_setting(
		'llorix_one_lite_feature_thumbnail', array(
			'sanitize_callback' => 'esc_url',
			'default'           => $default,
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'llorix_one_lite_feature_thumbnail', array(
				'label'           => esc_html__( 'Background', 'llorix-one-lite' ),
				'section'         => 'llorix_one_lite_frontpage_content_section',
				'priority'        => 15,
				'active_callback' => 'llorix_one_lite_show_on_front',
			)
		)
	);

	/* CONTACT INFO SECTION */

	$wp_customize->add_section(
		'llorix_one_lite_contact_section', array(
			'title'           => esc_html__( 'Contact info section', 'llorix-one-lite' ),
			'priority'        => 100,
			'panel'           => 'llorix_one_lite_front_page_sections',
			'active_callback' => 'llorix_one_lite_show_on_front',
		)
	);

	/* Contact info show/hide */
	$wp_customize->add_setting(
		'llorix_one_lite_contact_info_show', array(
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'llorix_one_lite_contact_info_show', array(
			'type'     => 'checkbox',
			'label'    => __( 'Disable the Contact info section?', 'llorix-one-lite' ),
			'section'  => 'llorix_one_lite_contact_section',
			'priority' => 1,
		)
	);

	/* Contact info content */
	$default = llorix_one_lite_contact_get_default_content();
	$wp_customize->add_setting(
		'llorix_one_lite_contact_info_content', array(
			'sanitize_callback' => 'llorix_one_lite_sanitize_repeater',
			'default'           => $default,
		)
	);
	$wp_customize->add_control(
		new Llorix_One_Lite_General_Repeater(
			$wp_customize, 'llorix_one_lite_contact_info_content', array(
				'label'                         => esc_html__( 'Add new contact field', 'llorix-one-lite' ),
				'section'                       => 'llorix_one_lite_contact_section',
				'priority'                      => 10,
				'llorix_one_lite_image_control' => false,
				'llorix_one_lite_icon_control'  => true,
				'llorix_one_lite_text_control'  => true,
				'llorix_one_lite_link_control'  => true,
			)
		)
	);

	/* Contact info Map ShortCode */
	$wp_customize->add_setting(
		'llorix_one_lite_frontpage_map_shortcode', array(
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'llorix_one_lite_frontpage_map_shortcode', array(
			'label'       => esc_html__( 'Map shortcode', 'llorix-one-lite' ),
			'description' => __( 'To use this section please install ', 'llorix-one-lite' ) . '<a href="https://wordpress.org/plugins/intergeo-maps/">' . __( 'Intergeo Maps', 'llorix-one-lite' ) . '</a>' . __( ' plugin then use it to create a map and paste here the shortcode generated', 'llorix-one-lite' ),
			'section'     => 'llorix_one_lite_contact_section',
			'priority'    => 20,
		)
	);

	/* CONTACT PAGE OPTIONS */

	$wp_customize->add_section(
		'llorix_one_lite_contact_page', array(
			'title'       => esc_html__( 'Contact page', 'llorix-one-lite' ),
			'priority'    => 110,
			'description' => __( 'To customize the Contact Page you need to first select the template "Contact page" for the page you want to use for this purpose. Then open that page in the browser and press "Customize" in the top bar.', 'llorix-one-lite' ),
		)
	);

	/* Contact Form  */
	$wp_customize->add_setting(
		'llorix_one_lite_contact_form_shortcode', array(
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'llorix_one_lite_contact_form_shortcode', array(
			'label'       => esc_html__( 'Contact form shortcode', 'llorix-one-lite' ),
			'description' => __( 'Create a form, copy the shortcode generated and paste it here. We recommend ', 'llorix-one-lite' ) . '<a href="' . admin_url( 'plugin-install.php?tab=plugin-information&plugin=pirate-forms' ) . '">' . __( 'Pirate Forms', 'llorix-one-lite' ) . '</a>' . __( ' but you can use any plugin you like.', 'llorix-one-lite' ),
			'section'     => 'llorix_one_lite_contact_page',
			'priority'    => 1,
		)
	);

	/* Map ShortCode  */
	$wp_customize->add_setting(
		'llorix_one_lite_contact_map_shortcode', array(
			'default'           => '',
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'llorix_one_lite_contact_map_shortcode', array(
			'label'       => esc_html__( 'Map shortcode', 'llorix-one-lite' ),
			'description' => __( 'To use this section please install ', 'llorix-one-lite' ) . '<a href="' . admin_url( 'plugin-install.php?tab=plugin-information&plugin=intergeo-maps' ) . '">' . __( 'Intergeo Maps', 'llorix-one-lite' ) . '</a>' . __( ' plugin then use it to create a map and paste here the shortcode generated', 'llorix-one-lite' ),
			'section'     => 'llorix_one_lite_contact_page',
			'priority'    => 2,
		)
	);

	/* FOOTER OPTIONS */

	$wp_customize->add_section(
		'llorix_one_lite_footer_section', array(
			'title'       => esc_html__( 'Footer options', 'llorix-one-lite' ),
			'priority'    => 130,
			'description' => esc_html__( 'The main content of this section is customizable in: Customize -> Widgets -> Footer area. ', 'llorix-one-lite' ),
		)
	);

	/* Footer Menu */
	$nav_menu_locations_footer = $wp_customize->get_control( 'nav_menu_locations[llorix_one_lite_footer_menu]' );
	if ( ! empty( $nav_menu_locations_footer ) ) {
		$nav_menu_locations_footer->section  = 'llorix_one_lite_footer_section';
		$nav_menu_locations_footer->priority = 1;
	}
	/* Copyright */
	$wp_customize->add_setting(
		'llorix_one_lite_copyright', array(
			'default'           => apply_filters( 'llorix_one_lite_copyright_default_filter', 'Themeisle' ),
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'llorix_one_lite_copyright', array(
			'label'    => esc_html__( 'Copyright', 'llorix-one-lite' ),
			'section'  => 'llorix_one_lite_footer_section',
			'priority' => 2,
		)
	);

	/* Socials icons */
	$wp_customize->add_setting(
		'llorix_one_lite_social_icons', array(
			'sanitize_callback' => 'llorix_one_lite_sanitize_repeater',
		)
	);
	$wp_customize->add_control(
		new Llorix_One_Lite_General_Repeater(
			$wp_customize, 'llorix_one_lite_social_icons', array(
				'label'                         => esc_html__( 'Add new social icon', 'llorix-one-lite' ),
				'section'                       => 'llorix_one_lite_footer_section',
				'priority'                      => 3,
				'llorix_one_lite_image_control' => false,
				'llorix_one_lite_icon_control'  => true,
				'llorix_one_lite_text_control'  => false,
				'llorix_one_lite_link_control'  => true,
			)
		)
	);

	/* Selective refresh */
	if ( isset( $wp_customize->selective_refresh ) ) {

		$wp_customize->selective_refresh->add_partial(
			'llorix_one_lite_ribbon_title', array(
				'selector'        => '.call-to-action h2',
				'settings'        => 'llorix_one_lite_ribbon_title',
				'render_callback' => 'llorix_one_lite_ribbon_title_render_callback',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'llorix_one_lite_our_story_text', array(
				'selector'        => '.brief .brief-content-text',
				'settings'        => 'llorix_one_lite_our_story_text',
				'render_callback' => 'llorix_one_lite_our_story_text_render_callback',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'llorix_one_lite_header_subtitle', array(
				'selector'        => '.intro-section #intro_section_text_2',
				'settings'        => 'llorix_one_lite_header_subtitle',
				'render_callback' => 'llorix_one_lite_header_subtitle_render_callback',
			)
		);
	}
}
add_action( 'customize_register', 'llorix_one_lite_customize_register' );

/**
 * Render callback for llorix_one_lite_ribbon_title
 *
 * @return mixed
 */
function llorix_one_lite_ribbon_title_render_callback() {
	return wp_kses_post( get_theme_mod( 'llorix_one_lite_ribbon_title' ) );
}

/**
 * Render callback for llorix_one_lite_our_story_text
 *
 * @return mixed
 */
function llorix_one_lite_our_story_text_render_callback() {
	return wp_kses_post( get_theme_mod( 'llorix_one_lite_our_story_text' ) );
}

/**
 * Render callback for llorix_one_lite_header_subtitle
 *
 * @return mixed
 */
function llorix_one_lite_header_subtitle_render_callback() {
	return wp_kses_post( get_theme_mod( 'llorix_one_lite_header_subtitle' ) );
}


/**
 * Registed Upsells
 */
function llorix_one_lite_customize_upsells_register( $wp_customize ) {

	if ( ! class_exists( 'Llorix_One_Plus' ) ) {

		$wp_customize->add_section(
			'llorix_one_lite_theme_info_main_section', array(
				'title'    => __( 'View PRO version', 'llorix-one-lite' ),
				'priority' => 1,
			)
		);

		$wp_customize->add_setting(
			'llorix_one_lite_theme_info_main_control', array(
				'sanitize_callback' => 'esc_html',
			)
		);

		$wp_customize->add_control(
			new Llorix_One_Lite_Control_Upsell_Theme_Info(
				$wp_customize, 'llorix_one_lite_theme_info_main_control', array(
					'section'     => 'llorix_one_lite_theme_info_main_section',
					'priority'    => 100,
					'options'     => array(
						esc_html__( 'Unlimited Color Options', 'llorix-one-lite' ),
						esc_html__( 'Shop Section', 'llorix-one-lite' ),
						esc_html__( 'Portfolio Section', 'llorix-one-lite' ),
						esc_html__( 'Shortcodes Section', 'llorix-one-lite' ),
						esc_html__( 'Section Reordering', 'llorix-one-lite' ),
						esc_html__( 'Alternative Header Layout', 'llorix-one-lite' ),
						esc_html__( 'Support', 'llorix-one-lite' ),
					),
					'button_url'  => esc_url( 'https://themeisle.com/plugins/llorix-one-plus/' ),
					'button_text' => esc_html__( 'View PRO version', 'llorix-one-lite' ),
				)
			)
		);

	}
}
add_action( 'customize_register', 'llorix_one_lite_customize_upsells_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function llorix_one_lite_customize_preview_js() {
	wp_enqueue_script( 'llorix_one_lite_customizer', llorix_one_lite_get_file( '/js/customizer.js' ), array( 'customize-preview' ), '1.0.4', true );
}
add_action( 'customize_preview_init', 'llorix_one_lite_customize_preview_js', 10 );

/**
 * Sanitization function.
 *
 * @param string $input Input of controls.
 *
 * @return mixed
 */
function llorix_one_lite_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Sanitization function for repeater.
 *
 * @param json $input Repeater input.
 *
 * @return string
 */
function llorix_one_lite_sanitize_repeater( $input ) {

	$input_decoded = json_decode( $input, true );
	$allowed_html  = array(
		'br'     => array(),
		'em'     => array(),
		'strong' => array(),
		'a'      => array(
			'href'   => array(),
			'class'  => array(),
			'id'     => array(),
			'target' => array(),
		),
		'button' => array(
			'class' => array(),
			'id'    => array(),
		),
	);

	if ( ! empty( $input_decoded ) ) {
		foreach ( $input_decoded as $boxk => $box ) {
			foreach ( $box as $key => $value ) {
				if ( $key == 'text' ) {
					$value                          = html_entity_decode( $value );
					$input_decoded[ $boxk ][ $key ] = wp_kses( $value, $allowed_html );
				} else {
					$input_decoded[ $boxk ][ $key ] = wp_kses_post( force_balance_tags( $value ) );
				}
			}
		}

		return json_encode( $input_decoded );
	}

	return $input;
}

/**
 * Sanitization function for html content.
 *
 * @param json $input Customizer control input.
 *
 * @return string
 */
function llorix_one_lite_sanitize_html( $input ) {

	$allowed_html = array(
		'p'      => array(
			'class' => array(),
			'id'    => array(),
		),
		'br'     => array(),
		'em'     => array(),
		'strong' => array(),
		'ul'     => array(
			'class' => array(),
			'id'    => array(),
		),
		'li'     => array(
			'class' => array(),
			'id'    => array(),
		),
		'a'      => array(
			'href'   => array(),
			'class'  => array(),
			'id'     => array(),
			'target' => array(),
		),
		'button' => array(
			'class' => array(),
			'id'    => array(),
		),
	);

	$string = force_balance_tags( $input );
	return wp_kses( $string, $allowed_html );
}

/**
 * Active callback function
 *
 * @return mixed
 */
function llorix_one_lite_show_on_front() {
	return is_front_page() && 'posts' !== get_option( 'show_on_front' );
}

/**
 * Active callback to check if Llorix Plus is installed
 *
 * @return bool
 */
function llorix_one_lite_check_pro() {
	return ! class_exists( 'Llorix_One_Plus' );
}
