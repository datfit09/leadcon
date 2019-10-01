<?php
/**
 * LEADCON functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package LEADCON
 */

define( 'LEADCON_VERSION', '1.0' );
define( 'LEADCON_DIR' , get_template_directory().'/' );
define( 'LEADCON_URI' , get_template_directory_uri().'/' );


/**
 * Setup theme default and add theme support
 */
require LEADCON_DIR . 'inc/init.php';

/**
 * Custom template tags for this theme.
 */
require LEADCON_DIR . 'inc/template-functions.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require LEADCON_DIR . 'inc/template-hook.php';

/**
 * Customizer additions.
 */
require LEADCON_DIR . 'inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load TGMPA.
 */
require LEADCON_DIR . 'inc/tgmpa/plugins.php';


/**
 * Load Elementor compatibility file.
 */
if( LEADCON_is_elementor() ) {
	require LEADCON_DIR . '/inc/class-leadcon-elementor.php';
}

/**
 * Load style end script .
 */
require LEADCON_DIR . 'inc/static.php';

/**
 * WooCommerce.
 */
require LEADCON_DIR . 'inc/woocommerce/woocommerce-template-functions.php';
require LEADCON_DIR . 'inc/woocommerce/woocommerce-template-tags.php';