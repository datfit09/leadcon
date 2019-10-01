<?php
/**
 * Layout Customizer
 *
 * @package leadcon
 */

Leadcon_Kirki::add_section(
	'leadcon_layout_section',
	array(
		'title' => esc_html__( 'Layout', 'leadcon' ),
		'panel' => 'leadcon_panel',
	)
);

Leadcon_Kirki::add_field(
	'leadcon',
	array(
		'type'     => 'radio-image',
		'settings' => 'leadcon_default_layout',
		'label'    => esc_html__( 'Blog Layout', 'leadcon' ),
		'section'  => 'leadcon_layout_section',
		'default'  => 'right-sidebar',
		'choices'  => array(
			'left-sidebar'  => get_template_directory_uri() . '/assets/images/sidebar/left-sidebar.png',
			'no-sidebar'    => get_template_directory_uri() . '/assets/images/sidebar/no-sidebar.png',
			'right-sidebar' => get_template_directory_uri() . '/assets/images/sidebar/right-sidebar.png',
		),
	)
);

Leadcon_Kirki::add_field(
	'leadcon',
	array(
		'type'     => 'radio-image',
		'settings' => 'leadcon_shop_layout',
		'label'    => esc_html__( 'Shop Layout', 'leadcon' ),
		'section'  => 'leadcon_layout_section',
		'default'  => 'right-sidebar',
		'choices'  => array(
			'left-sidebar'  => get_template_directory_uri() . '/assets/images/sidebar/left-sidebar.png',
			'no-sidebar'    => get_template_directory_uri() . '/assets/images/sidebar/no-sidebar.png',
			'right-sidebar' => get_template_directory_uri() . '/assets/images/sidebar/right-sidebar.png',
		),
	)
);
