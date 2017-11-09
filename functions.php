<?php
/**
 * Llorix One Lite functions and definitions
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

		/**
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
		register_nav_menus(
			array(
				'primary'                     => esc_html__( 'Primary Menu', 'llorix-one-lite' ),
				'llorix_one_lite_footer_menu' => esc_html__( 'Footer Menu', 'llorix-one-lite' ),
			)
		);

		/**
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats', array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background', apply_filters(
				'llorix_one_lite_custom_background_args', array(
					'default-repeat'     => 'no-repeat',
					'default-position-x' => 'center',
					'default-attachment' => 'fixed',
				)
			)
		);

		/*
		* This feature enables Custom_Headers support for a theme as of Version 3.4.
		*
		* @link http://codex.wordpress.org/Function_Reference/add_theme_support#Custom_Header
		*/

		add_theme_support(
			'custom-header', apply_filters(
				'llorix_one_lite_custom_header_args', array(
					'default-image' => llorix_one_lite_get_file( '/images/background-images/background.jpg' ),
					'width'         => 1000,
					'height'        => 680,
					'flex-height'   => true,
					'flex-width'    => true,
					'header-text'   => false,
				)
			)
		);

		register_default_headers(
			array(
				'llorix_one_lite_default_header_image' => array(
					'url'           => llorix_one_lite_get_file( '/images/background-images/background.jpg' ),
					'thumbnail_url' => llorix_one_lite_get_file( '/images/background-images/background_thumbnail.jpg' ),
				),
			)
		);

		// Theme Support for WooCommerce
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
		if ( is_admin() && ! is_child_theme() ) {

			global $llorix_one_lite_required_actions;

			/**
			 * Welcome screen parameters.
			 * id - unique id; required
			 * title
			 * description
			 * check - check for plugins (if installed)
			 * plugin_slug - the plugin's slug (used for installing the plugin)
			 */
			$llorix_one_lite_required_actions = array(
				array(
					'id'          => 'llorix-one-lite-req-ac-check-front-page',
					'title'       => esc_html__( 'Switch "Front page displays" to "A static page" ', 'llorix-one-lite' ),
					'description' => esc_html__( 'In order to have the one page look for your website, please go to Customize -> Static Front Page and switch "Front page displays" to "A static page". Then select the template "Frontpage" for that selected page.', 'llorix-one-lite' ),
					'check'       => llorix_one_lite_is_not_static_front_page(),
				),
				array(
					'id'          => 'llorix-one-lite-req-ac-install-intergeo-maps',
					'title'       => esc_html__( 'Install Intergeo Maps - Google Maps Plugin', 'llorix-one-lite' ),
					'description' => esc_html__( 'In order to use map section, you need to install Intergeo Maps plugin then use it to create a map and paste the generated shortcode in Customize -> Contact section -> Map shortcode', 'llorix-one-lite' ),
					'check'       => defined( 'INTERGEO_PLUGIN_NAME' ),
					'plugin_slug' => 'intergeo-maps',
				),
			);

			require get_template_directory() . '/inc/admin/welcome-screen/welcome-screen.php';
		}

		/**
		 * Add theme support for the Eventbrite API plugin.
		 * See: https://wordpress.org/plugins/eventbrite-api/
		 */
		add_theme_support( 'eventbrite' );

		/* woocommerce support */
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		/*
         * Notifications in customize
         */
		if ( ! defined( 'LLORIX_ONE_PLUS_PATH' ) ) {
			require get_template_directory() . '/ti-customizer-notify/class-ti-customizer-notify.php';

			$config_customizer = array(
				'recommended_plugins'       => array(
					'llorix-one-companion' => array(
						'recommended' => true,
						'description' => /* translators: %1$s is the name for the theme */
							sprintf( esc_html__( 'If you want to take full advantage of the options this theme has to offer, please install and activate %s', 'llorix-one-lite' ), sprintf( '<strong>%s</strong>', 'Llorix One Companion' ) ),
					),
				),
				'recommended_actions'       => array(),
				'recommended_actions_title' => '',
				'recommended_plugins_title' => esc_html__( 'Recommended Plugins', 'llorix-one-lite' ),
				'install_button_label'      => esc_html__( 'Install', 'llorix-one-lite' ),
				'activate_button_label'     => esc_html__( 'Activate', 'llorix-one-lite' ),
				'deactivate_button_label'   => esc_html__( 'Deactivate', 'llorix-one-lite' ),
			);
			Ti_Customizer_Notify::init( $config_customizer );
		}
	}
endif; // llorix_one_lite_setup
add_action( 'after_setup_theme', 'llorix_one_lite_setup' );

/**
 * Setup used for upsells
 */
function llorix_one_lite_upsells_setup() {
	if ( is_customize_preview() && ! class_exists( 'Llorix_One_Plus' ) ) {
		require_once( trailingslashit( get_template_directory() ) . 'inc/customize-pro/class-customizer-theme-info-root.php' );
		require_once( trailingslashit( get_template_directory() ) . 'inc/customize-pro/class-customizer-theme-info-control.php' );
	}
}

add_action( 'after_setup_theme', 'llorix_one_lite_upsells_setup' );

/**
 * Check if theme it's set to static front page
 *
 * @return bool
 */
function llorix_one_lite_is_not_static_front_page() {

	if ( get_option( 'show_on_front' ) === 'page' ) {
		return true;
	}

	return false;
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

	register_sidebars(
		4,
		array(
			'name'          => /* translators: %d is the number of footer sidebars registered */ esc_html__( 'Footer area %d', 'llorix-one-lite' ),
			'id'            => 'footer-area',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Sidebar Shop Page', 'llorix-one-lite' ),
			'id'            => 'llorix-one-sidebar-shop-archive',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

}

add_action( 'widgets_init', 'llorix_one_lite_widgets_init' );


/**
 * Fallback Menu
 *
 * If the menu doesn't exist, the fallback function to use.
 */
function llorix_one_lite_wp_page_menu() {
	echo '<ul class="nav navbar-nav navbar-right main-navigation small-text no-menu">';
	wp_list_pages(
		array(
			'title_li' => '',
			'depth'    => 1,
		)
	);
	echo '</ul>';
}


/**
 * Enqueue scripts and styles.
 */
function llorix_one_lite_scripts() {

	wp_enqueue_style( 'llorix-one-lite-font', '//fonts.googleapis.com/css?family=Cabin:400,600|Open+Sans:400,300,600' );

	wp_enqueue_style( 'llorix-one-lite-fontawesome', llorix_one_lite_get_file( '/css/font-awesome.min.css' ), array(), '4.4.0' );

	wp_enqueue_style( 'llorix-one-lite-bootstrap-style', llorix_one_lite_get_file( '/css/bootstrap.min.css' ), array(), '3.3.1' );

	wp_enqueue_style( 'llorix-one-lite-style', get_stylesheet_uri(), array( 'llorix-one-lite-bootstrap-style' ), '1.0.0' );

	wp_enqueue_script( 'llorix-one-lite-bootstrap', llorix_one_lite_get_file( '/js/vendor/bootstrap.min.js' ), array(), '3.3.7', true );

	wp_enqueue_script( 'llorix-one-lite-custom-all', llorix_one_lite_get_file( '/js/custom.all.js' ), array( 'jquery' ), '2.0.2', true );

	wp_localize_script(
		'llorix-one-lite-custom-all', 'screenReaderText', array(
			'expand'   => '<span class="screen-reader-text">' . esc_html__( 'expand child menu', 'llorix-one-lite' ) . '</span>',
			'collapse' => '<span class="screen-reader-text">' . esc_html__( 'collapse child menu', 'llorix-one-lite' ) . '</span>',
		)
	);

	$llorix_one_lite_enable_move = get_theme_mod( 'llorix_one_lite_enable_move' );
	if ( ! empty( $llorix_one_lite_enable_move ) && $llorix_one_lite_enable_move && ( is_front_page() ) ) {

		wp_enqueue_script( 'llorix-one-lite-parallax', llorix_one_lite_get_file( '/js/vendor/parallax.min.js' ), array(), '1.0.1', true );
		wp_enqueue_script( 'llorix-one-lite-home-plugin', llorix_one_lite_get_file( '/js/plugin.home.js' ), array( 'jquery', 'llorix-one-lite-custom-all', 'llorix-one-lite-parallax' ), '1.0.1', true );

	}

	if ( is_front_page() ) {

		wp_enqueue_script( 'llorix-one-lite-custom-home', llorix_one_lite_get_file( '/js/custom.home.js' ), array( 'jquery' ), '1.0.0', true );
	}

	wp_enqueue_script( 'llorix-one-lite-skip-link-focus-fix', llorix_one_lite_get_file( '/js/skip-link-focus-fix.js' ), array(), '1.0.0', true );

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

/**
 * Translations
 */
require get_template_directory() . '/inc/translations/general.php';

/**
 * Enqueue scripts in customizer.
 */
function llorix_one_lite_admin_scripts() {
	wp_enqueue_style( 'llorix_one_lite_admin_stylesheet', llorix_one_lite_get_file( '/css/admin-style.css' ), '1.0.0' );
	wp_enqueue_script( 'llorix_one_lite_customizer_script', llorix_one_lite_get_file( '/js/llorix_one_lite_customizer.js' ), array( 'jquery', 'jquery-ui-draggable' ), '1.0.0', true );
}

add_action( 'customize_controls_enqueue_scripts', 'llorix_one_lite_admin_scripts' );

/**
 * Adding IE-only scripts to header.
 */
function llorix_one_lite_ie() {
	echo '<!--[if lt IE 9]>' . "\n";
	echo '<script src="' . llorix_one_lite_get_file( '/js/html5shiv.min.js' ) . '"></script>' . "\n";
	echo '<![endif]-->' . "\n";
}

add_action( 'wp_head', 'llorix_one_lite_ie' );


remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

add_action( 'woocommerce_before_main_content', 'llorix_one_lite_wrapper_start', 10 );

add_action( 'woocommerce_after_main_content', 'llorix_one_lite_wrapper_end', 10 );

/**
 * WooCommerce Wrapper start.
 */
function llorix_one_lite_wrapper_start() {
	echo '</div> </header>';
	echo '<div class="content-wrap"><div class="container">';
	if ( ( is_shop() || is_product_tag() || is_product_category() ) && is_active_sidebar( 'llorix-one-sidebar-shop-archive' ) ) {
		echo '<div id="sidebar-secondary" class="widget-area col-md-3 sidebar-shop" role="complementary">';
		dynamic_sidebar( 'llorix-one-sidebar-shop-archive' );
		echo '</div>';
		echo '<div id="primary" class="content-area col-md-9">';
	} else {
		echo '<div id="primary" class="content-area col-md-12">';
	}
}

/**
 * WooCommerce Wrapper end.
 */
function llorix_one_lite_wrapper_end() {
	echo '</div></div></div>';
}

// add this code directly, no action needed
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

/* tgm-plugin-activation */
require_once get_template_directory() . '/class-tgm-plugin-activation.php';

if ( current_user_can( 'install_plugins' ) ) {
	add_action( 'tgmpa_register', 'llorix_one_lite_register_required_plugins' );
}

/**
 * Required plugins.
 */
function llorix_one_lite_register_required_plugins() {

	$plugins = array(
		array(
			'name'     => 'Llorix One Companion',
			'slug'     => 'llorix-one-companion',
			'required' => false,
		),
	);

	$config = array(
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );

}

/**
 * Theme inline style.
 */
function llorix_one_lite_php_style() {

	$custom_css                        = '';
	$llorix_one_lite_title_color       = get_theme_mod( 'llorix_one_lite_title_color' );
	$llorix_one_lite_text_color        = get_theme_mod( 'llorix_one_lite_text_color' );
	$llorix_one_lite_enable_move       = get_theme_mod( 'llorix_one_lite_enable_move' );
	$llorix_one_lite_frontpage_opacity = get_theme_mod( 'llorix_one_lite_frontpage_opacity', apply_filters( 'llorix_one_lite_frontpage_opacity_filter', 'rgba(13, 60, 85, 0.5)' ) );
	$llorix_one_lite_blog_opacity      = get_theme_mod( 'llorix_one_lite_blog_opacity', apply_filters( 'llorix_one_lite_blog_opacity_filter', 'rgba(13, 60, 85, 0.6)' ) );
	$llorix_one_header_image           = get_header_image();
	$llorix_one_header_image           = apply_filters( 'llorix_one_lite_translate_single_string', $llorix_one_header_image, 'Big title section' );

	if ( ! empty( $llorix_one_lite_title_color ) ) {
		$custom_css .= '.dark-text { color: ' . $llorix_one_lite_title_color . ' }';
	}

	if ( ! empty( $llorix_one_lite_text_color ) ) {
		$custom_css .= 'body{ color: ' . $llorix_one_lite_text_color . '}';
	}

	if ( ( empty( $llorix_one_lite_enable_move ) || ! $llorix_one_lite_enable_move ) && ( is_front_page() ) ) {

		if ( ! empty( $llorix_one_header_image ) ) {
			$custom_css .= '.header{ background-image: url(' . $llorix_one_header_image . ');}';
		}
	}

	if ( ! empty( $llorix_one_lite_frontpage_opacity ) ) {
		$custom_css .= '.overlay-layer-wrap{ background:' . $llorix_one_lite_frontpage_opacity . ';}';
	}

	if ( ! empty( $llorix_one_lite_blog_opacity ) ) {
		$custom_css .= '.archive-top .section-overlay-layer{ background:' . $llorix_one_lite_blog_opacity . ';}';
	}

	wp_add_inline_style( 'llorix-one-lite-style', $custom_css );

}

add_action( 'wp_enqueue_scripts', 'llorix_one_lite_php_style', 100 );

/**
 * Search for the file firstly in child theme, then in theme.
 *
 * @param    string $file The name of file.
 *
 * @return mixed
 */
function llorix_one_lite_get_file( $file ) {
	$file_parts   = pathinfo( $file );
	$accepted_ext = array( 'jpg', 'img', 'png', 'css', 'js' );
	if ( in_array( $file_parts['extension'], $accepted_ext ) ) {
		$file_path = get_stylesheet_directory() . $file;
		if ( file_exists( $file_path ) ) {
			return esc_url( get_stylesheet_directory_uri() . $file );
		} else {
			return esc_url( get_template_directory_uri() . $file );
		}
	}

	return $file;
}

/**
 * WooCommerce - change number of related products on product page
 *
 * @param    array $args The array that needs to be modified.
 *
 * @return mixed
 */
function llorix_one_lite_related_products_args( $args ) {
	$args['posts_per_page'] = 4;
	$args['columns']        = 4;

	return $args;
}

add_filter( 'woocommerce_output_related_products_args', 'llorix_one_lite_related_products_args' );

/**
 * Wrap videos in a class.
 *
 * @param    mixed  $cache The cached HTML result, stored in post meta.
 * @param    string $url The attempted embed URL.
 * @param    array  $attr An array of shortcode attributes.
 * @param    int    $post_id Post ID.
 *
 * @return string
 */
function llorix_one_lite_responsive_embed( $cache, $url, $attr, $post_id ) {
	return '<div class="llorix-one-lite-video-container">' . $cache . '</div>';
}

add_filter( 'embed_oembed_html', 'llorix_one_lite_responsive_embed', 10, 4 );

/**
 * Comments callback function.
 *
 * @param     mixed $comment Author’s User ID, an E-mail Address (a string) or the comment object from the comment loop.
 * @param     array $args Arguments for wp_list_comments.
 * @param     int   $depth How deep (in comment replies) should the comments be fetched.
 */
function llorix_one_lite_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	switch ( $comment->comment_type ) :
		case 'pingback':
		case 'trackback':
		?>
		<li class="post pingback">
		<p><?php _e( 'Pingback:', 'llorix-one-lite' ); ?><?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'llorix-one-lite' ), ' ' ); ?></p>
		<?php
			break;

		default:
			?>
			<li itemscope itemtype="http://schema.org/UserComments" <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment-body">
				<footer>
					<div itemscope itemprop="creator" itemtype="http://schema.org/Person" class="comment-author vcard">
						<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
						<?php /* translators: %s is the author link */ printf( __( '<span itemprop="name">%s </span><span class="says">says:</span>', 'llorix-one-lite' ), sprintf( '<b class="fn">%s</b>', get_comment_author_link() ) ); ?>
					</div><!-- .comment-author .vcard -->
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em><?php _e( 'Your comment is awaiting moderation.', 'llorix-one-lite' ); ?></em>
						<br/>
					<?php endif; ?>
					<div class="comment-metadata">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="comment-permalink" itemprop="url">
							<time class="comment-published" datetime="<?php comment_time( 'Y-m-d\TH:i:sP' ); ?>" title="<?php comment_time( _x( 'l, F j, Y, g:i a', 'comment time format', 'llorix-one-lite' ) ); ?>" itemprop="commentTime">
								<?php
								/* translators: %1$s is the date of the comment and %2$s is the comment title */
								printf( __( '%1$s at %2$s', 'llorix-one-lite' ), get_comment_date(), get_comment_time() );
								?>
							</time>
						</a>
						<?php edit_comment_link( __( '(Edit)', 'llorix-one-lite' ), ' ' ); ?>
					</div><!-- .comment-meta .commentmetadata -->
				</footer>

				<div class="comment-content" itemprop="commentText"><?php comment_text(); ?></div>

				<div class="reply">
					<?php
					comment_reply_link(
						array_merge(
							$args, array(
								'depth'     => $depth,
								'max_depth' => $args['max_depth'],
							)
						)
					);
					?>
				</div><!-- .reply -->
			</article><!-- #comment-## -->
			<?php
			break;
	endswitch;
}

/**
 * Get template from plus, companion or theme.
 *
 * @param     string $template Name of the section.
 */
function llorix_one_lite_get_template_part( $template ) {

	if ( locate_template( $template . '.php' ) ) {
		get_template_part( $template );
	} else {
		if ( defined( 'LLORIX_ONE_PLUS_PATH' ) ) {
			if ( file_exists( LLORIX_ONE_PLUS_PATH . 'public/templates/' . $template . '.php' ) ) {
				require_once( LLORIX_ONE_PLUS_PATH . 'public/templates/' . $template . '.php' );
			}
		} else {
			if ( defined( 'LLORIX_ONE_COMPANION_PATH' ) ) {
				if ( file_exists( LLORIX_ONE_COMPANION_PATH . 'sections/' . $template . '.php' ) ) {
					require_once( LLORIX_ONE_COMPANION_PATH . 'sections/' . $template . '.php' );
				}
			}
		}
	}
}

/**
 * Change the excerpt.
 *
 * @param     string $more The excerpt.
 *
 * @return string
 */
function llorix_one_lite_excerpt_more( $more ) {
	global $post;

	return '<a class="moretag" href="' . get_permalink( $post->ID ) . '"><span class="screen-reader-text">' . esc_html__( 'Read more about ', 'llorix-one-lite' ) . get_the_title() . '</span>[...]</a>';
}

add_filter( 'excerpt_more', 'llorix_one_lite_excerpt_more' );



/*
 * Hooks
 * Enables user customization via WordPress plugin API.
 */
require get_template_directory() . '/inc/hooks.php';


/**
 * Function to display social icons.
 *
 * @param string $social_icons Social icons input.
 */
function llorix_one_lite_social_icons( $social_icons, $is_footer ) {
	if ( ! llorix_one_lite_general_repeater_is_empty( $social_icons ) ) {
		$llorix_one_lite_social_icons_decoded = json_decode( $social_icons );
		?>
		<ul class="social-icons">
			<?php
			foreach ( $llorix_one_lite_social_icons_decoded as $llorix_one_lite_social_icon ) {
				$language_context = $is_footer === true ? 'Social icons in footer' : 'Social icons in header';
				$icon             = ! empty( $llorix_one_lite_social_icon->icon_value ) ? apply_filters( 'llorix_one_lite_translate_single_string', $llorix_one_lite_social_icon->icon_value, $language_context ) : '';
				$link             = ! empty( $llorix_one_lite_social_icon->link ) ? apply_filters( 'llorix_one_lite_translate_single_string', $llorix_one_lite_social_icon->link, $language_context ) : '';
				if ( ! empty( $icon ) && $icon !== 'No Icon' && ! empty( $link ) ) {
					?>
					<li>
						<a href="<?php echo esc_url( $link ); ?>">
							<span class="screen-reader-text"><?php echo wp_kses_post( $icon ); ?></span>
							<?php
							echo '<i class="fa ';
							if ( $is_footer === true ) {
								echo ' llorix-one-lite-footer-icons ';
							}
							echo esc_attr( $icon );
							echo ' transparent-text-dark" aria-hidden="true"></i>';
							?>
						</a>
					</li>
					<?php
				}
			}
			?>
		</ul>
		<?php
	}
}


if ( ! function_exists( 'llorix_one_lite_post_date_box_function' ) ) {
	/**
	 * Function to create the box with the post date
	 */
	function llorix_one_lite_post_date_box_function( $class ) {
		?>
		<div class="post-date">
			<span class="post-date-day"><?php the_time( 'd' ); ?></span>
			<span class="post-date-month"><?php the_time( 'M' ); ?></span>
		</div>
		<?php
	}
}
add_action( 'llorix_one_lite_post_date_box', 'llorix_one_lite_post_date_box_function', 10, 1 );

/**
 * Filter the front page template so it's bypassed entirely if the user selects
 * to display blog posts on their homepage instead of a static page.
 */
function llorix_one_lite_filter_front_page_template( $template ) {
	$llorix_one_lite_keep_old_fp_template = get_theme_mod( 'llorix_one_lite_keep_old_fp_template' );
	if ( ! $llorix_one_lite_keep_old_fp_template ) {
		return is_home() ? '' : $template;
	} else {
		return '';
	}
}
add_filter( 'frontpage_template', 'llorix_one_lite_filter_front_page_template' );


/**
 * Add starter content for fresh sites
 *
 * @since 0.2.5
 */
function llorix_one_lite_starter_content() {
	/*
	 * Starter Content Support
	 */
	add_theme_support(
		'starter-content', array(
			// Twenty Seventeen
			'posts'     => array(
				'home',
				'blog',
			),

			'nav_menus' => array(
				'primary' => array(
					'name'  => __( 'Primary Menu', 'llorix-one-lite' ),
					'items' => array(
						'page_home',
						'page_blog',
					),
				),
			),

			'options'   => array(
				'show_on_front'  => 'page',
				'page_on_front'  => '{{home}}',
				'page_for_posts' => '{{blog}}',
			),
		)
	);
}
add_action( 'after_setup_theme', 'llorix_one_lite_starter_content' );

/**
 * Notice in Customize to announce the theme is not maintained anymore
 */
function llorix_one_lite_customize_register_notification( $wp_customize ) {
	require_once( 'inc/class/class-ti-notify.php' );
	$wp_customize->register_section_type( 'Ti_Notify' );
	$wp_customize->add_section(
		new Ti_Notify(
			$wp_customize,
			'ti-notify',
			array(
				/* translators: Link to the recommended theme */
				'text'     => sprintf( __( 'This theme is not maintained anymore, check-out our latest free one-page theme: %1$s.', 'llorix-one-lite' ), sprintf( '<a href="' . admin_url( 'theme-install.php?theme=hestia' ) . '">%s</a>', 'Hestia' ) ),
				'priority' => 0,
			)
		)
	);
	$wp_customize->add_setting(
		'llorix-one-lite-notify', array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'llorix-one-lite-notify', array(
			'label'    => __( 'Notification', 'llorix-one-lite' ),
			'section'  => 'ti-notify',
			'priority' => 1,
		)
	);
}
add_action( 'customize_register', 'llorix_one_lite_customize_register_notification' );
/**
 * Notice in admin dashboard to announce the theme is not maintained anymore
 */
function llorix_one_lite_admin_notice() {
	global $pagenow;
	if ( is_admin() && ( 'themes.php' == $pagenow ) && isset( $_GET['activated'] ) ) {
		echo '<div class="updated notice is-dismissible"><p>';
		printf( /* translators: link to the recommended theme */ __( 'This theme is not maintained anymore, check-out our latest free one-page theme: %1$s.', 'llorix-one-lite' ), sprintf( '<a href="' . admin_url( 'theme-install.php?theme=hestia' ) . '">%s</a>', 'Hestia' ) );
		echo '</p></div>';
	}
}
add_action( 'admin_notices', 'llorix_one_lite_admin_notice', 99 );
