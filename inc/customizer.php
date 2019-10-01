<?php
/**
 * leadcon Theme Customizer
 *
 * @package leadcon
 */

/**
 * Add additional Customizer options with Kirki.
 */
require get_template_directory() . '/inc/class-leadcon-kirki.php';


/**
 * Create theme customizer configuration.
 */
Leadcon_Kirki::add_config(
	'leadcon',
	array(
		'capability'  => 'edit_theme_options',
		'option_type' => 'theme_mod',
	)
);

/**
 * Create theme customizer panel.
 */
Leadcon_Kirki::add_panel(
    'leadcon_panel',
    array(
        'priority' => 3,
        'title'    => esc_html__( 'Theme Options', 'leadcon' ),
    )
);

/**
 * Create theme customizer panel.
 */
Leadcon_Kirki::add_panel(
    'leadcon_header_layout',
    array(
        'priority' => 4,
        'title'    => esc_html__( 'Header Layout', 'leadcon' ),
    )
);

/**
 * Create theme page header panel.
 */
Leadcon_Kirki::add_section(
    'leadcon_page_header',
    array(
        'priority' => 6,
        'title'    => esc_html__( 'Page Header', 'leadcon' ),
    )
);

/**
 * Include theme customizer sections.
 */

$files = glob( LEADCON_DIR . 'inc/customizers/*.php' );

foreach ( $files as $file ) {
	if ( file_exists( $file ) ) {
		require $file;
	}
}


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function leadcon_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => function() {
					bloginfo( 'name' );
				},
			)
		);

        $wp_customize->selective_refresh->add_partial(
            'leadcon_footer_copyright',
            array(
                'selector'        => '.site-copyright',
                'render_callback' => function() {
                    get_template_part( 'template-parts/footer/footer', 'copyright' );
                },
            )
        );

        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => function() {
                    bloginfo( 'description' );
                },
            )
        );

        $wp_customize->selective_refresh->add_partial(
            'phone',
            array(
                'selector'        => '.phone',
                'render_callback' => function() {
                    get_template_part( 'template-parts/header/header', '3' );
                },
            )
        );

        $wp_customize->selective_refresh->add_partial(
            'email',
            array(
                'selector'        => '.email',
                'render_callback' => function() {
                    get_template_part( 'template-parts/header/header', '3' );
                },
            )
        );

        $wp_customize->selective_refresh->add_partial(
            'social_menu',
            array(
                'selector'        => '.menu-social-links-menu-container',
                'render_callback' => function() {
                    get_template_part( 'template-parts/header/header', '2' );
                },
            )
        );
	}
}
add_action( 'customize_register', 'leadcon_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function leadcon_customize_preview_js() {
	wp_enqueue_script(
		'leadcon-customizer',
		LEADCON_URI . 'assets/js/customizer.js',
		array( 'customize-preview' ),
		LEADCON_VERSION,
		true
	);
}
add_action( 'customize_preview_init', 'leadcon_customize_preview_js' );
