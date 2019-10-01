<?php
/**
 * Page Header Customizer
 *
 * @package leadcon
 */

Leadcon_Kirki::add_section(
	'leadcon_page_header',
	array(
		'title' => esc_html__( 'Page Header', 'leadcon' ),
	)
);

/**
 * Show/Hidden Page Header
 */
Leadcon_Kirki::add_field(
	'leadcon',
	array(
		'type'        => 'switch',
		'settings'    => 'page_header',
		'label'       => esc_html__( 'Page Header', 'leadcon' ),
		'section'     => 'leadcon_page_header',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'leadcon' ),
			'off' => esc_html__( 'Disable', 'leadcon' ),
		],
	)
);

Leadcon_Kirki::add_field(
	'leadcon',
	array(
		'type'     => 'dimensions',
		'settings' => 'c_height',
		'label'    => esc_attr__( 'Space', 'leadcon' ),
		'section'  => 'leadcon_page_header',
		'default'  => array(
            'min-height'    => '200px',
            'margin-bottom' => '0px',
		),
		'transport' => 'auto',
		'output'    => array(
			array(
				'element'  => '.page-header',
				'property' => 'min-height',
				'choice'   => 'min-height'
			),
            array(
                'element'  => '.page-header',
                'property' => 'margin-bottom',
                'choice'   => 'margin-bottom'
            ),
		),
));


/**
 * Background Page Header
 */
Leadcon_Kirki::add_field(
	'leadcon',
	[
		'type'        => 'background',
		'settings'    => 'leadcon_background_pageheader',
		'label'       => esc_html__( 'Background Page Header', 'leadcon' ),
		'section'     => 'leadcon_page_header',
		'default'     => [
			'background-color'      => '#f7f7f7',
			'background-image'      => '',
			'background-repeat'     => 'repeat',
			'background-position'   => 'center center',
			'background-size'       => 'cover',
			'background-attachment' => 'scroll',
		],
		'transport'   => 'refresh',
		'output'      => [
			[
				'element' => '.page-header',
			],
	],
] );

// Add Color Title.
Leadcon_Kirki::add_field( 
    'leadcon', 
    [
        'type'        => 'color',
        'settings'    => 'leadcon_color_page_title',
        'label'       => __( 'Color page title', 'leadcon' ),
        'section'     => 'leadcon_page_header',
        'default'     => '#1850df',
        'output'      => [
            array(
                'property' => 'color',
                'element' => array(
                    '.page-title',
                ),
            ),
        ],
    ]
);

Leadcon_Kirki::add_field(
    'leadcon',
    array(
        'type'        => 'typography',
        'settings'    => 'leadcon_font_page_title',
        'label'       => esc_html__( 'Font page title', 'leadcon' ),
        'description' => esc_html__( 'Set the font size.', 'leadcon' ),
        'section'     => 'leadcon_page_header',
        'default'     => array(
            'font-size' => '70px',
            'font-weight' => '700',
        ),
        'transport'   => 'auto',
        'output'      => array(
            array(
                'element' => '.page-title',
            ),
        ),
    )
);

// Add Position Title.
Leadcon_Kirki::add_field( 
    'leadcon', 
    [
        'type'        => 'radio-buttonset',
        'settings'    => 'leadcon_position_page_title',
        'label'       => esc_html__( 'Position page title', 'leadcon' ),
        'section'     => 'leadcon_page_header',
        'default'     => 'center',
        'priority'    => 10,
        'choices'     => [
            'left'   => esc_html__( 'Left', 'leadcon' ),
            'center' => esc_html__( 'Center', 'leadcon' ),
            'right'  => esc_html__( 'Right', 'leadcon' ),
        ],
        'transport'   => 'auto',
        'output'      => [
            [
                'element'  => '.page-header',
                'property' => 'text-align',
            ],
        ],
    ]
);


/**
 * Show/Hidden breadcrumb
 */
Leadcon_Kirki::add_field(
    'leadcon',
    array(
        'type'        => 'switch',
        'settings'    => 'breadcrumb',
        'label'       => esc_html__( 'Breadcrumb', 'leadcon' ),
        'section'     => 'leadcon_page_header',
        'default'     => '1',
        'priority'    => 10,
        'choices'     => [
            'on'  => esc_html__( 'Enable', 'leadcon' ),
            'off' => esc_html__( 'Disable', 'leadcon' ),
        ],
    )
);

Leadcon_Kirki::add_field(
    'leadcon',
    array(
        'type'     => 'dimensions',
        'settings' => 'c_height_2',
        'label'    => esc_attr__( 'Space container breadcrumb', 'leadcon' ),
        'section'  => 'leadcon_page_header',
        'default'  => array(
            'padding'       => '15px',
            'margin-bottom' => '50px',
        ),
        'transport' => 'auto',
        'output'    => array(
            array(
                'element'  => '.container-breadcrumb',
                'property' => 'padding',
                'choice'   => 'padding'
            ),
            array(
                'element'  => '.breadcrumb',
                'property' => 'margin-bottom',
                'choice'   => 'margin-bottom'
            ),
        ),
));

/**
 * Background breadcrumb
 */
Leadcon_Kirki::add_field(
    'leadcon',
    [
        'type'        => 'background',
        'settings'    => 'leadcon_background_breadcrumb',
        'label'       => esc_html__( 'Background Breadcrumb', 'leadcon' ),
        'section'     => 'leadcon_page_header',
        'default'     => [
            'background-color'      => '#ffffff',
            'background-image'      => '',
            'background-repeat'     => 'repeat',
            'background-position'   => 'center center',
            'background-size'       => 'cover',
            'background-attachment' => 'scroll',
        ],
        'transport'   => 'refresh',
        'output'      => [
            [
                'element' => '.breadcrumb',
            ],
    ],
] );

// Add Color breadcrumb.
Leadcon_Kirki::add_field( 
    'leadcon', 
    [
        'type'        => 'color',
        'settings'    => 'leadcon_color_breadcrumb',
        'label'       => __( 'Color breadcrumb', 'leadcon' ),
        'section'     => 'leadcon_page_header',
        'default'     => '#999999',
        'output'      => [
            array(
                'property' => 'color',
                'element' => array(
                    '.woocommerce-breadcrumb',
                    '.woocommerce-breadcrumb a',
                ),
            ),
        ],
    ]
);