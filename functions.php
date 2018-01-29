<?php
/**
 * Sassy Underscores functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Sassy_Underscores
 */

if ( ! function_exists( 'underscores_sass_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function underscores_sass_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Sassy Underscores, use a find and replace
		 * to change 'underscores_sass' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'underscores_sass', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'underscores_sass' ),
			'social' => esc_html__( 'Social', 'underscores_sass' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'underscores_sass_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'underscores_sass_setup' );


/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function underscores_sass_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'underscores_sass-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'underscores_sass_resource_hints', 10, 2 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function underscores_sass_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'underscores_sass_content_width', 640 );
}
add_action( 'after_setup_theme', 'underscores_sass_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function underscores_sass_widgets_init() {
	
	function create_post_type() {
  		register_post_type( 'u_sass_story',
    		array(
      			'labels' => array(
        		'name' => __( 'Story' ),
        		'singular_name' => __( 'Story' ),
        		'menu_name' => 'Stories',
        		'edit_item' => 'Edit Story',
        		'view_item' => 'View Story',
        		'all_items' => 'All Stories',
        		'search_items' => 'All Stories',
        		'parent_item_colon' => 'Parent Stories',
        		'not_found' => 'No stories found.',
        		'not_found_in_trash' => 'No stories found in Trash.',
      		),
      		'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions'),
      		'public' => true,
      		'has_archive' => false,
      		'rewrite' => array('slug' => 'stories'),
      		'menu_position' => 20,
      		'menu_icon' => 'dashicons-book',
    	)
  	);
}
add_action( 'init', 'create_post_type' );

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'underscores_sass' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'underscores_sass' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'underscores_sass_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function underscores_sass_scripts() {
	// Enqueue Google fonts.

	wp_enqueue_style ( 'underscores_sass_fonts', 'https://fonts.googleapis.com/css?family=Lusitana:400,700|Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' );

	wp_enqueue_script ( 'font-awesome', 'https://use.fontawesome.com/ab7d73311e.js');

	wp_enqueue_style( 'underscores_sass-style', get_stylesheet_uri() );

	wp_enqueue_script( 'underscores_sass-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'underscores_sass-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'underscores_sass-functions', get_template_directory_uri() . '/js/typed.js', array(), '20171203', true );

	wp_enqueue_script( 'underscores_sass-functions', get_template_directory_uri() . '/js/functions.js', array(), '20171130', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'underscores_sass_scripts', 'font-awesome' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

