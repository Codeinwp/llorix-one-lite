<?php
/**
 * llorix-one-lite functions and definitions
 *
 * @package llorix-one-lite
 */


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 730; /* pixels */
}
if ( ! function_exists( 'llorix_one_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function llorix_one_lite_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on llorix-one-lite, use a find and replace
	 * to change 'llorix-one-lite' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'llorix-one-lite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'llorix-one-lite' ),
		'llorix_one_lite_footer_menu' => esc_html__('Footer Menu', 'llorix-one-lite'),
	) );


	 /* Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support('custom-background',apply_filters( 'llorix_one_lite_custom_background_args', array(
		'default-repeat'         => 'no-repeat',
		'default-position-x'     => 'center',
		'default-attachment'     => 'fixed'
	)));

	 /*
	 * This feature enables Custom_Headers support for a theme as of Version 3.4.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Custom_Header
	 */

	add_theme_support( 'custom-header',apply_filters( 'llorix_one_lite_custom_header_args', array(
		'default-image' => llorix_one_lite_get_file('/images/background-images/background.jpg'),
		'width'         => 1000,
		'height'        => 680,
		'flex-height'   => true,
		'flex-width'    => true,
		'header-text' 	=> false
	)));

	register_default_headers( array(
		'llorix_one_lite_default_header_image' => array(
			'url'   => llorix_one_lite_get_file('/images/background-images/background.jpg'),
			'thumbnail_url' => llorix_one_lite_get_file('/images/background-images/background_thumbnail.jpg'),
		),
	));

	//Theme Support for WooCommerce
	add_theme_support( 'woocommerce' );

    /*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/* Set the image size by cropping the image */
	add_image_size( 'llorix-one-lite-post-thumbnail-big', 730, 340, true );
	add_image_size( 'llorix-one-lite-post-thumbnail-mobile', 500, 233, true );

	// Latest news Section (homepage)
	add_image_size( 'llorix-one-lite-post-thumbnail-latest-news', 150, 150, true );

	/**
	* Welcome screen
	*/
	if ( is_admin() ) {

		global $llorix_one_lite_required_actions;
        /*
         * id - unique id; required
         * title
         * description
         * check - check for plugins (if installed)
         * plugin_slug - the plugin's slug (used for installing the plugin)
         *
         */
        $llorix_one_lite_required_actions = array(
			array(
				"id" => 'llorix-one-lite-req-ac-check-front-page',
                "title" => esc_html__( 'Switch "Front page displays" to "A static page" ' ,'llorix-one-lite' ),
                "description" => esc_html__( 'In order to have the one page look for your website, please go to Customize -> Static Front Page and switch "Front page displays" to "A static page". Then select the template "Frontpage" for that selected page.','llorix-one-lite' ),
                "check" => llorix_one_lite_is_not_static_front_page()
			),
			array(
                "id" => 'llorix-one-lite-req-ac-install-intergeo-maps',
                "title" => esc_html__( 'Install Intergeo Maps - Google Maps Plugin' ,'llorix-one-lite' ),
                "description" => esc_html__( 'In order to use map section, you need to install Intergeo Maps plugin then use it to create a map and paste the generated shortcode in Customize -> Contact section -> Map shortcode','llorix-one-lite' ),
                "check" => defined('INTERGEO_PLUGIN_NAME'),
                "plugin_slug" => 'intergeo-maps'
            )
		);

		require get_template_directory() . '/inc/admin/welcome-screen/welcome-screen.php';
	}


}
endif; // llorix_one_lite_setup
add_action( 'after_setup_theme', 'llorix_one_lite_setup' );

function llorix_one_lite_is_not_static_front_page() {

	$frontpage_id = get_option('page_on_front');

	return ( ( get_option( 'show_on_front' ) == 'page' ) && !empty($frontpage_id) && (get_page_template_slug( $frontpage_id ) == 'template-frontpage.php' ) ) ? true : false;
}

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function llorix_one_lite_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'llorix-one-lite' ),
			'id'            => 'sidebar-1',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2><div class="colored-line-left"></div><div class="clearfix widget-title-margin"></div>',
		)
	);

	register_sidebars( 4,
		array(
			'name' => esc_html__('Footer area %d','llorix-one-lite'),
			'id' => 'footer-area',
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'	=> '<h3 class="widget-title">',
			'after_title'	=> '</h3><div class="colored-line-left"></div><div class="clearfix widget-title-margin"></div>'
		)
	);

}
add_action( 'widgets_init', 'llorix_one_lite_widgets_init' );




/**
 * Fallback Menu
 *
 * If the menu doesn't exist, the fallback function to use.
 */
function llorix_one_lite_wp_page_menu()
{
    echo '<ul class="nav navbar-nav navbar-right main-navigation small-text no-menu">';
    wp_list_pages(array('title_li' => '', 'depth' => 1));
    echo '</ul>';
}


/**
 * Enqueue scripts and styles.
 */
function llorix_one_lite_scripts() {

	wp_enqueue_style( 'llorix-one-lite-font', '//fonts.googleapis.com/css?family=Cabin:400,600|Open+Sans:400,300,600');

	wp_enqueue_style( 'llorix-one-lite-fontawesome', llorix_one_lite_get_file( '/css/font-awesome.min.css' ),array(), '4.4.0');

	wp_enqueue_style( 'llorix-one-lite-bootstrap-style', llorix_one_lite_get_file( '/css/bootstrap.min.css'),array(), '3.3.1');

	wp_enqueue_style( 'llorix-one-lite-style', get_stylesheet_uri(), array('llorix-one-lite-bootstrap-style'),'1.0.0');

	wp_enqueue_script( 'llorix-one-lite-bootstrap', llorix_one_lite_get_file('/js/bootstrap.min.js'), array(), '3.3.5', true );

	wp_enqueue_script( 'llorix-one-lite-custom-all', llorix_one_lite_get_file('/js/custom.all.js'), array('jquery'), '2.0.2', true );

	wp_localize_script( 'llorix-one-lite-custom-all', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . esc_html__( 'expand child menu', 'llorix-one-lite' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . esc_html__( 'collapse child menu', 'llorix-one-lite' ) . '</span>',
	) );


	$llorix_one_lite_enable_move = get_theme_mod('llorix_one_lite_enable_move');
	if ( !empty($llorix_one_lite_enable_move) && $llorix_one_lite_enable_move && ( is_front_page() || is_page_template('template-frontpage.php') ) ) {

		wp_enqueue_script( 'llorix-one-lite-home-plugin', llorix_one_lite_get_file('/js/plugin.home.js'), array('jquery','llorix-one-lite-custom-all'), '1.0.1', true );

	}

	if ( is_front_page() || is_page_template('template-frontpage.php') ) {

		wp_enqueue_script( 'llorix-one-lite-custom-home', llorix_one_lite_get_file('/js/custom.home.js'), array('jquery'), '1.0.0', true );
	}

	wp_enqueue_script( 'llorix-one-lite-skip-link-focus-fix', llorix_one_lite_get_file('/js/skip-link-focus-fix.js'), array(), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'llorix_one_lite_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

function llorix_one_lite_admin_styles() {
	wp_enqueue_style( 'llorix_one_lite_admin_stylesheet', llorix_one_lite_get_file('/css/admin-style.css'),'1.0.0' );
}
add_action( 'customize_controls_enqueue_scripts', 'llorix_one_lite_admin_styles', 10 );

// Adding IE-only scripts to header.
function llorix_one_lite_ie () {
    echo '<!--[if lt IE 9]>' . "\n";
    echo '<script src="'. llorix_one_lite_get_file('/js/html5shiv.min.js').'"></script>' . "\n";
    echo '<![endif]-->' . "\n";
}
add_action('wp_head', 'llorix_one_lite_ie');


remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'llorix_one_lite_wrapper_start', 10);

add_action('woocommerce_after_main_content', 'llorix_one_lite_wrapper_end', 10);

function llorix_one_lite_wrapper_start() {
	echo '</div> </header>';
	echo '<div class="content-wrap">
		<div class="container">
			<div id="primary" class="content-area col-md-12">';
}

function llorix_one_lite_wrapper_end() {
	echo '</div></div></div>';
}

// add this code directly, no action needed
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

/* tgm-plugin-activation */
require_once get_template_directory() . '/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'llorix_one_lite_register_required_plugins' );
function llorix_one_lite_register_required_plugins() {

		$plugins = array(
			array(
				'name'      => 'Llorix One Companion',
				'slug'      => 'llorix-one-companion',
				'required'  => false
			)
		);

	$config = array(
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
        'strings'      => array(
            'page_title'                      => esc_html__( 'Install Required Plugins', 'llorix-one-lite' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'llorix-one-lite' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'llorix-one-lite' ),
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'llorix-one-lite' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'llorix-one-lite' ),
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'llorix-one-lite' ),
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'llorix-one-lite' ),
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'llorix-one-lite' ),
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'llorix-one-lite' ),
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'llorix-one-lite' ),
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'llorix-one-lite' ),
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'llorix-one-lite' ),
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'llorix-one-lite' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'llorix-one-lite' ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'llorix-one-lite' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'llorix-one-lite' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'llorix-one-lite' ),
            'nag_type'                        => 'updated'
        )
    );

	tgmpa( $plugins, $config );

}

add_action('wp_footer','llorix_one_lite_php_style', 100);
function llorix_one_lite_php_style() {

	echo '<style type="text/css">';

	$llorix_one_lite_title_color = get_theme_mod('llorix_one_lite_title_color');
	if(!empty($llorix_one_lite_title_color)){
		echo '.dark-text { color: '. $llorix_one_lite_title_color .' }';
	}
	$llorix_one_lite_text_color = get_theme_mod('llorix_one_lite_text_color');
	if(!empty($llorix_one_lite_text_color)){
		echo 'body{ color: '.$llorix_one_lite_text_color.'}';
	}

	$llorix_one_lite_enable_move = get_theme_mod('llorix_one_lite_enable_move');
	$llorix_one_lite_first_layer = get_theme_mod('llorix_one_lite_first_layer', llorix_one_lite_get_file('/images/background1.png'));
	$llorix_one_lite_second_layer = get_theme_mod('llorix_one_lite_second_layer',llorix_one_lite_get_file('/images/background2.png'));

	if( ( empty($llorix_one_lite_enable_move) || !$llorix_one_lite_enable_move) && ( is_front_page() || is_page_template('template-frontpage.php') ) ) {
		$llorix_one_header_image = get_header_image();
		if(!empty($llorix_one_header_image)){
			echo '.header{ background-image: url('.$llorix_one_header_image.');}';
		}
	}

	echo '</style>';
}

function llorix_one_lite_get_file($file){
	$file_parts = pathinfo($file);
	$accepted_ext = array('jpg','img','png','css','js');
	if( in_array($file_parts['extension'], $accepted_ext) ){
		$file_path = get_stylesheet_directory() . $file;
		if ( file_exists( $file_path ) ){
			return esc_url(get_stylesheet_directory_uri() . $file);
		} else {
			return esc_url(get_template_directory_uri() . $file);
		}
	}
}


/**
 * WooCommerce Extra Feature
 * --------------------------
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 */

add_filter( 'woocommerce_output_related_products_args', 'llorix_one_lite_related_products_args' );

function llorix_one_lite_related_products_args( $args ) {
	$args['posts_per_page'] = 4;
	$args['columns'] = 4;
	return $args;
}

function llorix_one_lite_responsive_embed($html, $url, $attr, $post_ID) {
	$return = '<div class="llorix-one-lite-video-container">'.$html.'</div>';
	return $return;
}

add_filter( 'embed_oembed_html', 'llorix_one_lite_responsive_embed', 10, 4 );

/* Comments callback function*/
function llorix_one_lite_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;

	switch ( $comment->comment_type ) :
		case 'pingback' :


		case 'trackback' :
		?>
			<li class="post pingback">
				<p><?php _e( 'Pingback:', 'llorix-one-lite' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'llorix-one-lite' ), ' ' ); ?></p>
		<?php
		break;


		default :
		?>
			<li itemscope itemtype="http://schema.org/UserComments" <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="comment-body">
					<footer>
						<div itemscope itemprop="creator" itemtype="http://schema.org/Person" class="comment-author vcard" >
							<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
							<?php printf( __( '<span itemprop="name">%s </span><span class="says">says:</span>', 'llorix-one-lite' ), sprintf( '<b class="fn">%s</b>', get_comment_author_link() ) ); ?>
						</div><!-- .comment-author .vcard -->
						<?php if ( $comment->comment_approved == '0' ) : ?>
							<em><?php _e( 'Your comment is awaiting moderation.', 'llorix-one-lite' ); ?></em>
							<br />
						<?php endif; ?>
						<div class="comment-metadata">
							<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="comment-permalink" itemprop="url">
								<time class="comment-published" datetime="<?php comment_time( 'Y-m-d\TH:i:sP' ); ?>" title="<?php comment_time( _x( 'l, F j, Y, g:i a', 'comment time format', 'llorix-one-lite' ) ); ?>" itemprop="commentTime">
									<?php printf( __( '%1$s at %2$s', 'llorix-one-lite' ), get_comment_date(), get_comment_time() ); ?>
								</time>
							</a>
							<?php edit_comment_link( __( '(Edit)', 'llorix-one-lite' ), ' ' );?>
						</div><!-- .comment-meta .commentmetadata -->
					</footer>

					<div class="comment-content" itemprop="commentText"><?php comment_text(); ?></div>

					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div><!-- .reply -->
				</article><!-- #comment-## -->

<?php
		break;

	endswitch;
}

/*Polylang repeater translate*/

if(function_exists('icl_unregister_string') && function_exists('icl_register_string')){

	/*Contact*/
	$llorix_one_contact_pl = get_theme_mod('llorix_one_lite_contact_info_content');
	if(!empty($llorix_one_contact_pl)){
		$llorix_one_contact_pl_decoded = json_decode($llorix_one_contact_pl);
		foreach($llorix_one_contact_pl_decoded as $llorix_one_contact_box){
			$text = $llorix_one_contact_box->text;
			$link = $llorix_one_contact_box->link;
			$icon = $llorix_one_contact_box->icon_value;
			$id = $llorix_one_contact_box->id;
			if(!empty($id)) {
				if(!empty($text)){
					icl_unregister_string ('Contact' , $id.'_contact' );
					icl_register_string( 'Contact' , $id.'_contact' , $text );
				} else {
					icl_unregister_string ('Contact' , $id.'_contact' );
				}

				if(!empty($link)){
					icl_unregister_string ('Contact link' , $id.'_contact_link' );
					icl_register_string( 'Contact link' , $id.'_contact_link' , $link );
				} else {
					icl_unregister_string ('Contact link' , $id.'_contact_link' );
				}

				if(!empty($icon)){
					icl_unregister_string ('Contact icon' , $id.'_contact_icon' );
					icl_register_string( 'Contact icon' , $id.'_contact_icon' , $icon );
				} else {
					icl_unregister_string ('Contact icon' , $id.'_contact_icon' );
				}
			}
		}
	}

	/*Logo*/
	$llorix_one_lite_logos_pl = get_theme_mod('llorix_one_lite_logos_content');
	if(!empty($llorix_one_lite_logos_pl)){
		$llorix_one_lite_logos_pl_decoded = json_decode($llorix_one_lite_logos_pl);
		foreach($llorix_one_lite_logos_pl_decoded as $llorix_one_logo_box){
			$image = $llorix_one_logo_box->image_url;
			$link = $llorix_one_logo_box->link;
			$id = $llorix_one_logo_box->id;
			if(!empty($id)) {
				if(!empty($image)){
					icl_unregister_string ('Logo image' , $id.'_logo_image' );
					icl_register_string( 'Logo image' , $id.'_logo_image' , $image );
				} else {
					icl_unregister_string ('Logo image' , $id.'_logo_image' );
				}

				if(!empty($link)){
					icl_unregister_string ('Logo link' , $id.'_logo_link' );
					icl_register_string( 'Logo link' , $id.'_logo_link' , $link );
				} else {
					icl_unregister_string ('Logo link' , $id.'_logo_link' );
				}
			}
		}
	}

	/*Header*/
	$llorix_one_lite_very_top_social_icons_pl = get_theme_mod('llorix_one_lite_very_top_social_icons');
	if(!empty($llorix_one_lite_very_top_social_icons_pl)){
		$llorix_one_lite_very_top_social_icons_pl_decoded = json_decode($llorix_one_lite_very_top_social_icons_pl);
		foreach($llorix_one_lite_very_top_social_icons_pl_decoded as $llorix_one_lite_very_top_social_box){
			$icon = $llorix_one_lite_very_top_social_box->icon_value;
			$link = $llorix_one_lite_very_top_social_box->link;
			$id = $llorix_one_lite_very_top_social_box->id;
			if(!empty($id)) {
				if(!empty($icon)){
					icl_unregister_string ('Header Social Icon' , $id.'_header_social_icon' );
					icl_register_string( 'Header Social Icon' , $id.'_header_social_icon' , $icon );
				} else {
					icl_unregister_string ('Header Social Icon' , $id.'_header_social_icon' );
				}

				if(!empty($link)){
					icl_unregister_string ('Header Social Link' , $id.'_header_social_link' );
					icl_register_string( 'Header Social Link' , $id.'_header_social_link' , $link );
				} else {
					icl_unregister_string ('Header Social Link' , $id.'_header_social_link' );
				}
			}
		}
	}

	/*Footer*/
	$llorix_one_lite_social_icons_pl = get_theme_mod('llorix_one_lite_social_icons');
	if(!empty($llorix_one_lite_social_icons_pl)){
		$llorix_one_lite_social_icons_pl_decoded = json_decode($llorix_one_lite_social_icons_pl);
		foreach($llorix_one_lite_social_icons_pl_decoded as $llorix_one_header_social_box){
			$icon = $llorix_one_header_social_box->icon_value;
			$link = $llorix_one_header_social_box->link;
			$id = $llorix_one_header_social_box->id;
			if(!empty($id)) {
				if(!empty($icon)){
					icl_unregister_string ('Footer Social Icon' , $id.'_footer_social_icon' );
					icl_register_string( 'Footer Social Icon' , $id.'_footer_social_icon' , $icon );
				} else {
					icl_unregister_string ('Footer Social Icon' , $id.'_footer_social_icon' );
				}

				if(!empty($link)){
					icl_unregister_string ('Footer Social Link' , $id.'_footer_social_link' );
					icl_register_string( 'Footer Social Link' , $id.'_footer_social_link' , $link );
				} else {
					icl_unregister_string ('Footer Social Link' , $id.'_footer_social_link' );
				}
			}
		}
	}
}

/*Check if Repeater is empty*/
function llorix_one_lite_general_repeater_is_empty($llorix_one_lite_arr){
	$llorix_one_lite_arr_decoded = json_decode($llorix_one_lite_arr);
	foreach($llorix_one_lite_arr_decoded as $llorix_one_lite_box){
		if(!empty($llorix_one_lite_box->choice) && $llorix_one_lite_box->choice == 'llorix_one_lite_none'){
			$llorix_one_lite_box->icon_value = '';
			$llorix_one_lite_box->image_url = '';
		}
		foreach ($llorix_one_lite_box as $key => $value){
			if(!empty($value) && $key!='choice' && $key!='id' && ($value!='No Icon' && $key=='icon_value') ) {
				return false;
			}
		}
	}
	return true;
}

function llorix_one_lite_get_template_part($template){

    if(locate_template($template.'.php')) {
		get_template_part($template);
    } else {
		if(defined('LLORIX_ONE_COMPANION_PATH')){
			if(file_exists ( LLORIX_ONE_COMPANION_PATH.'sections/'.$template.'.php' )){
				require_once ( LLORIX_ONE_COMPANION_PATH.'sections/'.$template.'.php' );
			}
		}
	}
}

/*
	Change the page template for frontpage
*/
function llorix_one_lite_update_static_frontpage_template( $setting ) {

	$llorix_one_page_on_front = get_option('page_on_front'); /* Static Frontpage ID */

	$llorix_one_lite_frontpage_template_static = get_theme_mod('llorix_one_lite_frontpage_template_static');

	if ( !empty($llorix_one_page_on_front) && !empty($llorix_one_lite_frontpage_template_static) ) {
		update_post_meta( $llorix_one_page_on_front, '_wp_page_template', $llorix_one_lite_frontpage_template_static );
	}
}
add_action( 'customize_save_after', 'llorix_one_lite_update_static_frontpage_template', 20, 2 );

/*
	Function to override the default template with the one selected
	For frontpage
*/
function llorix_one_lite_redirect_to_template_page( $template ) {

	$llorix_one_lite_frontpage_template_static = get_theme_mod('llorix_one_lite_frontpage_template_static');

	if( !empty($llorix_one_lite_frontpage_template_static) ):
		$new_template = locate_template( array( $llorix_one_lite_frontpage_template_static ) );
		if ( !empty($new_template) ):
			return $new_template ;
		endif;
	endif;

	return $template;
}

/*
	When in Customize, if a new template is selected for frontpage
	Redirect it to that template
*/

function llorix_one_lite_update_static_frontpage_template_customize( $setting ) {

	add_filter( 'template_include', 'llorix_one_lite_redirect_to_template_page', 99 );

}

add_action( 'customize_preview_init', 'llorix_one_lite_update_static_frontpage_template_customize', 20, 2 );

function llorix_one_lite_excerpt_more($more) {
	global $post;
	return '<a class="moretag" href="'. get_permalink($post->ID) . '"><span class="screen-reader-text">'.esc_html__('Read more about ', 'llorix-one-lite').get_the_title().'</span>[...]</a>';
}
add_filter('excerpt_more', 'llorix_one_lite_excerpt_more');
