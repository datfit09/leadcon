<?php
/**
 * Preload Effect
 *
 * @package leadcon
 */

Leadcon_Kirki::add_section(
    'leadcon_general',
    array(
        'title' => esc_html__( 'General Settings', 'leadcon' ),
        'panel' => 'leadcon_panel',
    )
);


/**
 * Header
 */
Leadcon_Kirki::add_field(
	'leadcon',
	array(
		'type'      => 'select',
		'settings'  => 'leadcon_header',
		'label'     => esc_html__( 'Default Header', 'leadcon' ),
		'section'   => 'leadcon_general',
		'default'   => 'header-1',
		'multiple'    => 1,
		'choices'     => [
			'header-transparent' => esc_html__( 'Header Tranparent', 'leadcon' ),
			'header-1' => esc_html__( 'Header Layout 1', 'leadcon' ),
			'header-2' => esc_html__( 'Header Layout 2', 'leadcon' ),
			'header-3' => esc_html__( 'Header Layout 3', 'leadcon' ),
			'header-4' => esc_html__( 'Header Layout 4', 'leadcon' ),
			'header-5' => esc_html__( 'Header Layout 5', 'leadcon' ),
			'header-6' => esc_html__( 'Header Layout 6', 'leadcon' ),
			'header-7' => esc_html__( 'Header Layout 7', 'leadcon' ),
		],
	)
);

/**
 * Sticky menu
 */

Leadcon_Kirki::add_field(
    'leadcon',
    array(
        'type'        => 'switch',
        'settings'    => 'stickymenu',
        'label'       => esc_html__( 'Sticky Menu', 'leadcon' ),
        'section'     => 'leadcon_general',
        'default'     => '0',
        'priority'    => 10,
        'choices'     => [
            'on'  => esc_html__( 'Enable', 'leadcon' ),
            'off' => esc_html__( 'Disable', 'leadcon' ),
        ],
    )
);

/**
 * Pre Load
 */
Leadcon_Kirki::add_field(
    'leadcon',
    array(
        'type'        => 'switch',
        'settings'    => 'preload',
        'label'       => esc_html__( 'Preload Effect', 'leadcon' ),
        'section'     => 'leadcon_general',
        'default'     => '1',
        'priority'    => 10,
        'choices'     => [
            'on'  => esc_html__( 'Enable', 'leadcon' ),
            'off' => esc_html__( 'Disable', 'leadcon' ),
        ],
    )
);

/**
 * Image preload
 */
Leadcon_Kirki::add_field( 
    'leadcon', [
    'type'        => 'image',
    'settings'    => 'image_preload_setting_url',
    'label'       => esc_html__( 'Image Control (URL)', 'leadcon' ),
    'description' => esc_html__( 'Description Here.', 'leadcon' ),
    'section'     => 'leadcon_general',
    'default'     => '',
    'transport'   => 'auto',
] );



