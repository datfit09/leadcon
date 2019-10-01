<?php
/**
 * Custom Fonts Customizer
 *
 * @package leadcon
 */

Leadcon_Kirki::add_section(
	'leadcon_fonts_section',
	array(
		'title' => esc_html__( 'Typography', 'leadcon' ),
	)
);

/**
 * Body Font
 */
Leadcon_Kirki::add_field(
	'leadcon',
	array(
		'type'        => 'typography',
		'settings'    => 'leadcon_font_body',
		'label'       => esc_html__( 'Body', 'leadcon' ),
		'description' => esc_html__( "Main font for the content. Set the font size in 'px' or 'rem'.", 'leadcon' ),
		'section'     => 'leadcon_fonts_section',
		'default'     => array(
			'font-family' => 'Source Sans Pro',
			'variant'     => 'regular',
			'font-size'   => '16px',
			'line-height' => '1.5',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => array(
					'body',
					'button',
					'input',
					'select',
					'optgroup',
					'textarea',
                    '.main-navigation',
                    '.pagination .nav-links',
				),
			),
		),
	)
);

/**
 * Headings Font
 */
Leadcon_Kirki::add_field(
	'leadcon',
	array(
		'type'        => 'typography',
		'settings'    => 'leadcon_font_heading',
		'label'       => esc_html__( 'Headings', 'leadcon' ),
		'description' => esc_html__( "Headings in the content (h1, h2, h3, h4, h5, h6). Set the font size in 'px' or 'rem'.", 'leadcon' ),
		'section'     => 'leadcon_fonts_section',
		'default'     => array(
			'font-family' => 'Source Sans Pro',
			'variant'     => '700',
			'line-height' => '1.2',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => array(
					'h1',
					'h2',
					'h3',
					'h4',
					'h5',
					'h6',
					'.link-more',
					'.tags-links-title',
					'.post-title',
					'.comment-author',
					'.comment-reply',
					'.site-title',
					'.editor-post-title__input',
					'.not-found-button',
					'.search-submit',
					'.woocommerce-product-search button',
				),
			),
		),
	)
);

/**
 * Menu Color
 */
Leadcon_Kirki::add_field(
    'leadcon',
    array(
        'type'      => 'color',
        'settings'  => 'leadcon_menu_color',
        'label'     => esc_html__( 'Menu Color', 'leadcon' ),
        'section'   => 'leadcon_fonts_section',
        'default'   => '#333333',
        'transport' => 'auto',
        'output'    => array(
            // Start color property
            array(
                'property' => 'color',
                'element'  => array(
                    '.main-navigation ul a',
                ),
            ), // End color property
        ),
    )
);

Leadcon_Kirki::add_field(
    'leadcon',
    array(
        'type'        => 'typography',
        'settings'    => 'leadcon_font_menu',
        'label'       => esc_html__( 'Font Menu', 'leadcon' ),
        'description' => esc_html__( 'Set the font size.', 'leadcon' ),
        'section'     => 'leadcon_fonts_section',
        'default'     => array(
            'font-size' => '16px',
            'font-weight' => '700',
        ),
        'transport'   => 'auto',
        'output'      => array(
            array(
                'element' => '.main-navigation ul a',
            ),
        ),
    )
);


/**
 * Heading Level 1
 */
Leadcon_Kirki::add_field(
	'leadcon',
	array(
		'type'        => 'typography',
		'settings'    => 'leadcon_font_h1',
		'label'       => esc_html__( 'H1', 'leadcon' ),
		'description' => esc_html__( 'Set the font size.', 'leadcon' ),
		'section'     => 'leadcon_fonts_section',
		'default'     => array(
			'font-size' => '30px',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => 'h1',
			),
		),
	)
);

/**
 * Heading Level 2
 */
Leadcon_Kirki::add_field(
	'leadcon',
	array(
		'type'        => 'typography',
		'settings'    => 'leadcon_font_h2',
		'label'       => esc_html__( 'H2', 'leadcon' ),
		'description' => esc_html__( 'Set the font size', 'leadcon' ),
		'section'     => 'leadcon_fonts_section',
		'default'     => array(
			'font-size' => '23px',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => 'h2',
			),
		),
	)
);

/**
 * Heading Level 3
 */
Leadcon_Kirki::add_field(
	'leadcon',
	array(
		'type'        => 'typography',
		'settings'    => 'leadcon_font_h3',
		'label'       => esc_html__( 'H3', 'leadcon' ),
		'description' => esc_html__( "Set the font size'.", 'leadcon' ),
		'section'     => 'leadcon_fonts_section',
		'default'     => array(
			'font-size' => '20px',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => 'h3',
			),
		),
	)
);

/**
 * Heading Level 4
 */
Leadcon_Kirki::add_field(
	'leadcon',
	array(
		'type'        => 'typography',
		'settings'    => 'leadcon_font_h4',
		'label'       => esc_html__( 'H4', 'leadcon' ),
		'description' => esc_html__( 'Set the font size.', 'leadcon' ),
		'section'     => 'leadcon_fonts_section',
		'default'     => array(
			'font-size' => '18px',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => 'h4',
			),
		),
	)
);

/**
 * Heading Level 5
 */
Leadcon_Kirki::add_field(
	'leadcon',
	array(
		'type'        => 'typography',
		'settings'    => 'leadcon_font_h5',
		'label'       => esc_html__( 'H5', 'leadcon' ),
		'description' => esc_html__( 'Set the font size.', 'leadcon' ),
		'section'     => 'leadcon_fonts_section',
		'default'     => array(
			'font-size' => '16px',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => 'h5',
			),
		),
	)
);

/**
 * Heading Level 6
 */
Leadcon_Kirki::add_field(
	'leadcon',
	array(
		'type'        => 'typography',
		'settings'    => 'leadcon_font_h6',
		'label'       => esc_html__( 'H6', 'leadcon' ),
		'description' => esc_html__( 'Set the font size.', 'leadcon' ),
		'section'     => 'leadcon_fonts_section',
		'default'     => array(
			'font-size' => '14px',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => 'h6',
			),
		),
	)
);
