<?php
/**
 * Enqueue scripts and styles.
 */
function leadcon_scripts() {
	wp_enqueue_style(
		'leadcon-style',
		get_stylesheet_uri(),
        array(),
        LEADCON_VERSION
	);

	wp_enqueue_script(
		'leadcon-custom-js',
		LEADCON_URI . 'assets/js/custom.js',
		array( 'jquery' ),
		LEADCON_VERSION,
		true
	);

    wp_enqueue_script(
        'leadcon-js',
        LEADCON_URI . 'assets/js/leadcon.js',
        array('jquery', 'slick'),
        LEADCON_VERSION,
        true
    );

	wp_enqueue_script(
		'leadcon-navigation',
		LEADCON_URI . 'assets/js/navigation.js',
		array( 'jquery' ),
		LEADCON_VERSION,
		true
	);

    // SLICK LIBRARY
    wp_enqueue_script(
        'slick',
        LEADCON_URI . 'assets/js/slick.min.js',
        array( 'jquery' ),
        LEADCON_VERSION,
        true
    );

    wp_enqueue_script(
        'leadcon-skip-link-focus-fix',
        LEADCON_URI . 'assets/js/skip-link-focus-fix.js',
        array( 'jquery' ),
        LEADCON_VERSION,
        true
    );

    // COUNTDOWN LIBRARY
    wp_register_script(
        'countdown',
        LEADCON_URI . 'assets/js/countdown.js',
        array( 'jquery' ),
        NULL,
        true
    );

    // html5lightbox Library
    wp_register_script(
        'html5lightboxjs',
        LEADCON_URI . 'assets/js/elementor/light-box/html5lightbox.js',
        array( 'jquery' ),
        LEADCON_VERSION,
        true
    );

    // JS CUSTOM AJAX WOOCOMMERCE
    wp_enqueue_script(
        'leadcon-ajax-add-to-cart',
        LEADCON_URI . 'assets/js/ajax.js',
        array('jquery','slick','wc-add-to-cart-variation'),
        LEADCON_VERSION,
        true
    );

    /*GLOBAL WC CART VARIATION*/
    if ( wp_script_is( 'wc-add-to-cart-variation', 'registered' ) && ! wp_script_is( 'wc-add-to-cart-variation', 'enqueued' ) ) {
        wp_enqueue_script( 'wc-add-to-cart-variation' );
    }

    if ( class_exists( 'WooCommerce' ) ) {
        if ( is_product() ) {
            // HTML5LIGHTBOX LIBRARY
            wp_enqueue_script(
                'html5lightbox',
                LEADCON_URI . 'assets/js/html5lightbox.js',
                array('jquery'),
                LEADCON_VERSION,
                true
            );
            wp_enqueue_script(
                'leadcon-product-lightbox',
                LEADCON_URI . 'assets/js/product-lightbox.js',
                array('jquery', 'html5lightbox'),
                LEADCON_VERSION,
                true
            );
        }
    }

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'leadcon_scripts' );
