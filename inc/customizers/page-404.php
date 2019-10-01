<?php
/**
 * Page 404 Customizer
 *
 * @package leadcon
 */

Leadcon_Kirki::add_section(
    'leadcon_404_section',
    array(
        'title' => esc_html__( 'Page 404', 'leadcon' ),
        'panel' => 'leadcon_panel',
    )
);

Leadcon_Kirki::add_field(
    'leadcon',
    array(
        'type'        => 'textarea',
        'settings'    => 'leadcon_page_404_text',
        'label'       => esc_html__( 'Page 404 Text', 'leadcon' ),
        'description' => esc_html__( 'Replace the default page 404 text by entering your own.', 'leadcon' ),
        'section'     => 'leadcon_404_section',
        'default'     => '',
        'transport'   => 'auto',
    )
);
