<?php
// @codingStandardsIgnoreStart
defined( 'ABSPATH' ) || exit;


if ( ! function_exists( 'leadcon_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function leadcon_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on leadcon, use a find and replace
		 * to change 'leadcon' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'leadcon', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary'   => esc_html__( 'Primary Menu (Header)', 'leadcon' ),
                'secondary' => esc_html__( 'Primary Left Menu (Header)', 'leadcon' ),
                'tertiary'  => esc_html__( 'Primary Right Menu (Header)', 'leadcon' ),
                'social'    => esc_html__( 'Social Links Menu', 'leadcon' ),
                'topbar'    => esc_html__( 'Top Bar', 'leadcon' ),
                'footer'    => esc_html__( 'Footer Menu (Footer)', 'leadcon' )
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);


		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 110,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_image_size( 'leadcon-product-thumb', 300, 300, array( 'center', 'center' ) ); // 300 pixels wide (and unlimited height)
		add_image_size( 'leadcon-single-product', 445, 495, true ); // (cropped)

	}
endif;
add_action( 'after_setup_theme', 'leadcon_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */

if (function_exists('leadcon_content_width')) {
	function leadcon_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'leadcon_content_width', 1170 );
	}
	add_action( 'after_setup_theme', 'leadcon_content_width', 0 );
}


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function leadcon_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'leadcon' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'leadcon' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widgets Row 1', 'leadcon' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here to appear in your footer row 1.', 'leadcon' ),
			'before_widget' => '<section id="%1$s" class="widget footer-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Shop Widgets', 'leadcon' ),
			'id'            => 'sidebar-3',
			'description'   => esc_html__( 'Add widgets product.', 'leadcon' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer Widgets Row 2', 'leadcon' ),
            'id'            => 'sidebar-4',
            'description'   => esc_html__( 'Add widgets here to appear in your footer row 2.', 'leadcon' ),
            'before_widget' => '<section id="%1$s" class="widget footer-widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'leadcon_widgets_init' );

if ( ! function_exists( 'leadcon_excerpt_more' ) ) {
	/**
	 * Replace "[...]" (appended to automatically generated excerpts) with ... and
	 * a 'Read More' link.
	 *
	 * @param string $link Link to single post
	 * @return string 'Read More' link prepended with an ellipsis.
	 */
	function leadcon_excerpt_more( $link ) {
		if ( is_admin() ) {
			return $link;
		}

		$link = sprintf(
			'<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
			esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of the current post */
			sprintf( __( 'Read More<span class="screen-reader-text">"%s"</span>', 'leadcon' ), get_the_title( get_the_ID() ) )
		);

		return ' &hellip; ' . $link;
	}

	add_filter( 'excerpt_more', 'leadcon_excerpt_more' );
}

/**
 * Get unique ID.
 *
 * This is a PHP implementation of Underscore's uniqueId method. A static variable
 * contains an integer that is incremented with each call. This number is returned
 * with the optional prefix. As such the returned value is not universally unique,
 * but it is unique across the life of the PHP process.
 *
 * @see wp_unique_id() Themes requiring WordPress 5.0.3 and greater should use this instead.
 *
 * @param string $prefix Prefix for the returned ID.
 * @return string Unique ID.
 */
function leadcon_unique_id( $prefix = '' ) {
    static $id_counter = 0;

    if ( function_exists( 'wp_unique_id' ) ) {
        return wp_unique_id( $prefix );
    }

    return $prefix . (string) ++$id_counter;
}

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function leadcon_javascript_detection() {
    echo "<script>document.documentElement.classList.add('js');</script>";
}
add_action( 'wp_head', 'leadcon_javascript_detection', 0 );

/**
 * Query WooCommerce activation.
 */
function leadcon_is_woocommerce_activated() {
    return class_exists( 'WooCommerce' ) ? true : false;
}

add_filter( 'request', 'leadcon_unset_query_vars');

function leadcon_unset_query_vars($query_vars) {
    global $wp_query, $wp;

    if ( ! $wp_query->is_main_query() ) {
        return $query_vars;
    }

    $qv_keys = array_keys( $wp->query_vars );

    if ( ! ( in_array( 'pagename', $qv_keys, true )) ) {
        unset( $query_vars['header_layout'] );
    }

    return $query_vars;
}