<?php
/**
 * Custom Colors Customizer
 *
 * @package leadcon
 */

Leadcon_Kirki::add_section(
	'leadcon_colors_section',
	array(
		'title' => esc_html__( 'Colors', 'leadcon' ),
	)
);

/**
 * Primary Color
 */
Leadcon_Kirki::add_field(
	'leadcon',
	array(
		'type'      => 'color',
		'settings'  => 'leadcon_primary_color',
		'label'     => esc_html__( 'Primary Color', 'leadcon' ),
		'section'   => 'leadcon_colors_section',
		'default'   => '#000000',
		'transport' => 'auto',
		'output'    => array(
			// Start color property
			array(
				'property' => 'color',
				'element'  => array(
					'h1',
					'h2',
					'h3',
					'h4',
					'h5',
					'h6',
					'a',
					'a:visited',
					'input[type="text"]:focus',
					'input[type="email"]:focus',
					'input[type="url"]:focus',
					'input[type="password"]:focus',
					'input[type="search"]:focus',
					'input[type="number"]:focus',
					'input[type="tel"]:focus',
					'input[type="range"]:focus',
					'input[type="date"]:focus',
					'input[type="month"]:focus',
					'input[type="week"]:focus',
					'input[type="time"]:focus',
					'input[type="datetime"]:focus',
					'input[type="datetime-local"]:focus',
					'input[type="color"]:focus',
					'textarea:focus',
                    '.top-bar-content',
                    '.leadcon_widget_recent_entries a',
				),
			), // End color property

			// Start border-color property
			array(
				'property' => 'border-color',
				'element'  => array(
					'input[type="text"]:focus',
					'input[type="email"]:focus',
					'input[type="url"]:focus',
					'input[type="password"]:focus',
					'input[type="search"]:focus',
					'input[type="number"]:focus',
					'input[type="tel"]:focus',
					'input[type="range"]:focus',
					'input[type="date"]:focus',
					'input[type="month"]:focus',
					'input[type="week"]:focus',
					'input[type="time"]:focus',
					'input[type="datetime"]:focus',
					'input[type="datetime-local"]:focus',
					'input[type="color"]:focus',
					'textarea:focus',

				),
			), // End border-color property

			array(
				'property' => 'background-color',
				'element'  => array(
				),
			), // End background-color property
		),
	)
);

/**
 * Secondary Color
 */
Leadcon_Kirki::add_field(
	'leadcon',
	array(
		'type'      => 'color',
		'settings'  => 'leadcon_secondary_color',
		'label'     => esc_html__( 'Secondary Color', 'leadcon' ),
		'section'   => 'leadcon_colors_section',
		'default'   => '#1850df',
		'transport' => 'auto',
		'output'    => array(
			// Start color property
			array(
				'property' => 'color',
				'element'  => array(
                    'a:hover',
                    'a:hover:before',
                    '.comment-metadata a:hover',
                    '.footer-menu li>a:hover',
                    '.widget_categories a:hover',
                    '.widget_categories li:hover',
                    '.widget_archive a:hover',
                    '.widget_archive li:hover',
                    '.widget_meta a:hover',
                    '.widget_nav_menu a:hover',
                    '.widget_pages a:hover',
                    '.widget_recent_comments a:hover',
                    '.widget_recent_entries a:hover',
                    '.widget_rss a:hover',
                    '.leadcon_widget_recent_entries a:hover',
                    '.post-navigation .meta-nav:hover',
                    '.blog-entry-meta .entry-meta-item a:hover',
                    '.posted-on>a:hover',
                    '.author>a:hover',
                    '.entry-meta-item>a:hover',
                    '.on-search .site-search-close',
                    'ul li.phone-number a',
                    '.header-2 ul.menu > li.current_page_item a',
                    '.header-2 ul.menu > li a:hover',
                    '.header-3 ul.menu > li.current_page_item a',
                    '.main-navigation ul a:hover',
                    '.main-navigation ul#sticky-menu-wrapper > li.current_page_item a',
                    '.main-navigation ul#primary-menu > li.current_page_item a',
				),
			), // End color property

			// Start border-color property
			array(
				'property' => 'border-color',
				'element'  => array(
					'.loader_boostify:after',
				),
			), // End border-color property


			// Start background-color property
			array(
				'property' => 'background-color',
				'element'  => array(
					
				),
			), // End background-color property

			// Start background-color property with media queries
			array(
				'property'    => 'background-color',
				'media_query' => '@media only screen and (min-width: 62em)',
			), // End background-color property with media queries
		),
	)
);

/**
 * Tertiary Color
 */
Leadcon_Kirki::add_field(
	'leadcon',
	array(
		'type'      => 'color',
		'settings'  => 'leadcon_tertiary_color',
		'label'     => esc_html__( 'Tertiary Color', 'leadcon' ),
		'section'   => 'leadcon_colors_section',
		'default'   => '#666666',
		'transport' => 'auto',
		'output'    => array(
			// Start color property
			array(
				'property' => 'color',
				'element'  => array(
					'body',
					'input[type="text"]',
					'input[type="email"]',
					'input[type="url"]',
					'input[type="password"]',
					'input[type="search"]',
					'input[type="number"]',
					'input[type="tel"]',
					'input[type="range"]',
					'input[type="date"]',
					'input[type="month"]',
					'input[type="week"]',
					'input[type="time"]',
					'input[type="datetime"]',
					'input[type="datetime-local"]',
					'input[type="color"]',
					'textarea',
					'.comment-metadata a',
                    '.footer-menu li>a',
				),
			), // End color property

			// Start border-color property
			array(
				'property' => 'border-color',
				'element'  => array(
					'table td',
					'table th',
				),
			), // End border-color property
		),
	)
);

/**
 * Hidden Color
 */
Leadcon_Kirki::add_field(
    'leadcon',
    array(
        'type'      => 'color',
        'settings'  => 'leadcon_hidden_color',
        'label'     => esc_html__( 'Hidden Color', 'leadcon' ),
        'section'   => 'leadcon_colors_section',
        'default'   => '#999999',
        'transport' => 'auto',
        'output'    => array(
            // Start color property
            array(
                'property' => 'color',
                'element'  => array(
                    '.widget_categories a',
                    '.widget_categories li',
                    '.widget_archive a',
                    '.widget_archive li',
                    '.widget_meta a',
                    '.widget_nav_menu a',
                    '.widget_pages a',
                    '.widget_recent_comments a',
                    '.widget_recent_entries a',
                    '.widget_rss a',
                    '.post-navigation .meta-nav',
                    '.blog-entry-meta .entry-meta-item a',
                    '.blog-entry-meta',
                    '.posted-on',
                    '.posted-on>a',
                    '.blog-post-on',
                    '.author>a',
                    '.entry-meta-item>a',
                ),
            ), // End color property
        ),
    )
);
