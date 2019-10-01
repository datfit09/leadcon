<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme leadcon for publication on WordPress.org
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/tgmpa/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'leadcon_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function leadcon_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name'     => esc_html__( 'Elementor', 'leadcon' ),
			'slug'     => 'elementor',
			'required' => true,
		),
		array(
			'name'     => esc_html__( 'Kirki', 'leadcon' ),
			'slug'     => 'kirki',
			'required' => true,
		),
		array(
			'name'     => esc_html__( 'Woocommerce', 'leadcon' ),
			'slug'     => 'woocommerce',
			'required' => true,
		),
		array(
			'name'     => esc_html__( 'One Click Demo Import', 'leadcon' ),
			'slug'     => 'one-click-demo-import',
			'required' => true,
		),
		array(
			'name'   => esc_html__( 'Envato Market', 'leadcon' ),
			'slug'   => 'envato-market',
			'source' => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
		),
		array(
			'name' => esc_html__( 'YITH WooCommerce Wishlist', 'leadcon' ),
			'slug' => 'yith-woocommerce-wishlist',
		),
		array(
			'name' => esc_html__( 'Contact Form 7', 'leadcon' ),
			'slug' => 'contact-form-7',
		),
		array(
			'name' => esc_html__( 'Variation Swatches for WooCommerce', 'leadcon' ),
			'slug' => 'variation-swatches-for-woocommerce',
		),
        array(
            'name' => esc_html__( 'Advanced Custom Fields', 'leadcon' ),
            'slug' => 'advanced-custom-fields',
        ),
        array(
            'name'   => esc_html__( 'Leadcon Plugin', 'leadcon' ),
            'slug'   => 'leadcon-plugin',
            'source' => get_template_directory_uri() . '/inc/plugins/leadcon-plugin.zip',
        ),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'leadcon',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
