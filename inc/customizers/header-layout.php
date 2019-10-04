<?php
/**
 * Header Contact Customizer
 *
 * @package leadcon
 */

/*
 Header Layout 1
 */
Leadcon_Kirki::add_section(
    'leadcon_header_layout',
    array(
        'title' => esc_html__( 'Header Layout', 'leadcon' ),
        'panel' => 'leadcon_header_layout',
    )
);

Leadcon_Kirki::add_field(
    'leadcon',
    array(
        'type'     => 'radio-image',
        'settings' => 'leadcon_menu_layout',
        'label'    => esc_html__( 'Menu Layout', 'leadcon' ),
        'section'  => 'leadcon_header_layout',
        'default'  => 'right-menu',
        'choices'  => array(
            'left-menu'  => get_template_directory_uri() . '/assets/images/sidebar/left-sidebar.png',
            'center-menu'    => get_template_directory_uri() . '/assets/images/sidebar/no-sidebar.png',
            'right-menu' => get_template_directory_uri() . '/assets/images/sidebar/right-sidebar.png',
        ),
    )
);

Leadcon_Kirki::add_field(
    'leadcon',
    array(
        'type'        => 'switch',
        'settings'    => 'site_header_icon',
        'label'       => esc_html__( 'Site Header Icon', 'leadcon' ),
        'section'     => 'leadcon_header_layout',
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
        'type'        => 'switch',
        'settings'    => 'button_download',
        'label'       => esc_html__( 'Show button download', 'leadcon' ),
        'section'     => 'leadcon_header_layout',
        'default'     => '0',
        'priority'    => 10,
        'choices'     => [
            'on'  => esc_html__( 'Enable', 'leadcon' ),
            'off' => esc_html__( 'Disable', 'leadcon' ),
        ],
    )
);

Leadcon_Kirki::add_field( 
    'leadcon', [
        'type'     => 'link',
        'settings' => 'link_download',
        'label'    => esc_html__( 'Link download', 'leadcon' ),
        'section'  => 'leadcon_header_layout',
        'default'  => '',
        'transport'   => 'auto',
    ] 
);

Leadcon_Kirki::add_field(
    'leadcon',
    array(
        'type'      => 'color',
        'settings'  => 'leadcon_link_color',
        'label'     => esc_html__( 'Link Color', 'leadcon' ),
        'section'   => 'leadcon_header_layout',
        'default'   => '#fff',
        'transport' => 'auto',
        'output'    => array(
            // Start color property
            array(
                'property' => 'color',
                'element'  => array(
                    '.header-4 .button-download a',
                    '.header-4 .arrow-icon',
                    '.header-4 ul#primary-menu > li a',
                ),
            ), // End color property
        ),
    )
);

Leadcon_Kirki::add_field(
    'leadcon',
    array(
        'type'      => 'color',
        'settings'  => 'leadcon_bg_color',
        'label'     => esc_html__( 'Background Color', 'leadcon' ),
        'section'   => 'leadcon_header_layout',
        'default'   => '#dc2c02',
        'transport' => 'auto',
        'output'    => array(
            // Start color property
            array(
                'property' => 'background-color',
                'element'  => array(
                    '.button-download',
                ),
            ), // End color property
            array(
                'property' => 'color',
                'element'  => array(
                    '.header-4 .main-navigation ul#sticky-menu-wrapper > li.current_page_item a',
                    '.header-4 .main-navigation ul#primary-menu > li.current_page_item a',                    
                ),
            ), // End color property
        ),
    )
);

/*
 Header Layout 2
 */

Leadcon_Kirki::add_section(
	'leadcon_header_layout2',
	array(
		'title' => esc_html__( 'Header Layout 2', 'leadcon' ),
		'panel' => 'leadcon_header_layout',
	)
);

Leadcon_Kirki::add_field(
    'leadcon',
    array(
        'type'      => 'color',
        'settings'  => 'leadcon_icon_menu_color',
        'label'     => esc_html__( 'Menu Color', 'leadcon' ),
        'section'   => 'leadcon_header_layout2',
        'default'   => '#fff',
        'transport' => 'auto',
        'output'    => array(
            array(
                'property' => 'background-color',
                'element'  => array(
                    '.header-2 #toggle span',
                    '.header-2 #toggle span:after',
                    '.header-2 #toggle span:before',
                ),
            ), 
        ),
    )
);

/*
 Header Layout 3
 */

Leadcon_Kirki::add_section(
	'leadcon_header_layout3',
	array(
		'title' => esc_html__( 'Header Layout 3', 'leadcon' ),
		'panel' => 'leadcon_header_layout',
	)
);

Leadcon_Kirki::add_field(
	'leadcon',
	array(
		'type'        => 'editor',
		'settings'    => 'menu_topbar',
		'label'       => esc_html__( 'Menu TopBar', 'leadcon' ),
		'description' => esc_html__( 'This is an editor control.', 'leadcon' ),
		'section'     => 'leadcon_header_layout3',
		'default'     => '',
		'transport'   => 'postMessage',
	)
);

Leadcon_Kirki::add_field(
	'leadcon',
	array(
		'type'        => 'text',
		'settings'    => 'email',
		'label'       => esc_html__( 'Email', 'leadcon' ),
		'description' => esc_html__( 'Enter Email.', 'leadcon' ),
        'section'     => 'leadcon_header_layout3',
		'default'     => '',
		'transport'   => 'postMessage',
	)
);


Leadcon_Kirki::add_field(
	'leadcon',
	array(
		'type'        => 'text',
		'settings'    => 'phone',
		'label'       => esc_html__( 'Mobile', 'leadcon' ),
		'description' => esc_html__( 'Enter Mobie.', 'leadcon' ),
		'section'     => 'leadcon_header_layout3',
		'default'     => '',
		'transport'   => 'postMessage',
	)
);

/*
 Header Transparent
 */

Leadcon_Kirki::add_section(
    'leadcon_header_transparent',
    array(
        'title' => esc_html__( 'Header Transparent', 'leadcon' ),
        'panel' => 'leadcon_header_layout',
    )
);

Leadcon_Kirki::add_field(
    'leadcon',
    array(
        'type'        => 'switch',
        'settings'    => 'header_tranparent',
        'label'       => esc_html__( 'Header Transparent', 'leadcon' ),
        'section'     => 'leadcon_header_transparent',
        'default'     => '0',
        'priority'    => 10,
        'choices'     => [
            'on'  => esc_html__( 'Enable', 'leadcon' ),
            'off' => esc_html__( 'Disable', 'leadcon' ),
        ],
    )
);
