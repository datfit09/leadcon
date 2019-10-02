<?php
/**
 * Header Contact Customizer
 *
 * @package leadcon
 */

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
	[
		'type'        => 'editor',
		'settings'    => 'social_menu',
		'label'       => esc_html__( 'Menu Social', 'leadcon' ),
		'section'     => 'leadcon_header_layout2',
		'default'     => '',
	]
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

Leadcon_Kirki::add_field(
    'leadcon',
    array(
        'type'        => 'textarea',
        'settings'    => 'language',
        'label'       => esc_html__( 'Language', 'leadcon' ),
        'description' => esc_html__( 'Enter Language.', 'leadcon' ),
        'section'     => 'leadcon_header_layout3',
        'default'     => '',
        'transport'   => 'postMessage',
    )
);
