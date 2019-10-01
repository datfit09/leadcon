<?php
/**
 * Footer Customizer
 *
 * @package leadcon
 */

Leadcon_Kirki::add_section(
	'leadcon_footer_section',
	array(
		'title' => esc_html__( 'Footer', 'leadcon' ),
		'panel' => 'leadcon_panel',
	)
);

Leadcon_Kirki::add_field(
	'leadcon',
	array(
		'type'        => 'textarea',
		'settings'    => 'leadcon_footer_copyright',
		'label'       => esc_html__( 'Footer Copyright', 'leadcon' ),
		'description' => esc_html__( 'Replace the default footer copyright by entering your own.', 'leadcon' ),
		'section'     => 'leadcon_footer_section',
		'default'     => '',
		'transport'   => 'postMessage',
	)
);

Leadcon_Kirki::add_field(
	'leadcon',
	array(
		'type'        => 'switch',
		'settings'    => 'scroll_top',
		'label'       => esc_html__( 'Button Back to Top', 'leadcon' ),
		'section'     => 'leadcon_footer_section',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'leadcon' ),
			'off' => esc_html__( 'Disable', 'leadcon' ),
		],
	)
);

/**
 * Background Page Header
 */
Leadcon_Kirki::add_field(
	'leadcon',
	[
		'type'        => 'background',
		'settings'    => 'leadcon_background_footer_widget',
		'label'       => esc_html__( 'Background Footer Widget', 'leadcon' ),
		'section'     => 'leadcon_footer_section',
		'default'     => [
			'background-color'      => '#1a1a1a',
			'background-image'      => '',
			'background-repeat'     => 'repeat',
			'background-position'   => 'center center',
			'background-size'       => 'cover',
			'background-attachment' => 'scroll',
		],
		'transport'   => 'refresh',
		'output'      => [
			[
				'element' => '.site-footer',
			],
	],
] );

/**
 * Background Page Header
 */
Leadcon_Kirki::add_field(
	'leadcon',
	[
		'type'        => 'background',
		'settings'    => 'leadcon_background_footer',
		'label'       => esc_html__( 'Background Footer', 'leadcon' ),
		'section'     => 'leadcon_footer_section',
		'default'     => [
			'background-color'      => '#1a1a1a',
			'background-image'      => '',
			'background-repeat'     => 'repeat',
			'background-position'   => 'center center',
			'background-size'       => 'cover',
			'background-attachment' => 'scroll',
		],
		'transport'   => 'refresh',
		'output'      => [
			[
				'element' => '.site-footer .site-info',
			],
	],
] );
