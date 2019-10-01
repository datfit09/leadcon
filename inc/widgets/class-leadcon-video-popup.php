<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * ht leadcon Hello World
 *
 * Elementor widget for hello world.
 */
class leadcon_Video_Popup extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'leadcon-video-popup';
    }

    /**
     * Retrieve the widget title.
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Video Popup', 'leadcon' );
    }

    /**
     * Retrieve the widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-youtube';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return array( 'leadcon' );
    }

    /**
     * Retrieve the list of scripts the widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends() {
        return array( 'leadcon-video-popup' );
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     */
    protected function _register_controls(){
        $this->start_controls_section(
            'section_video_popup',
            [
                'label' => esc_html__( 'Video', 'leadcon' )
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Image', 'leadcon' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'image_overlay',
                'default' => 'full',
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'source',
            [
                'label'   => esc_html__( 'Source', 'leadcon' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'youtube' => esc_html__( 'Youtube', 'leadcon' ),
                    'vimeo'   => esc_html__( 'Vimeo', 'leadcon' )
                ],
                'default' => 'youtube'
            ]

        );

        $this->add_control(
            'youtube_url',
            [
                'label'       => esc_html__( 'URL', 'leadcon' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'https://www.youtube.com/watch?v=9uOETcuFjbE',
                'placeholder' => esc_attr__( 'Enter URL Youtube', 'leadcon' ),
                'condition'   => [
                    'source'      => 'youtube'
                ]

            ]
        );

        $this->add_control(
            'vimeo_url',
            [
                'label'       => esc_html__( 'URL', 'leadcon' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'https://vimeo.com/235215203',
                'placeholder' => esc_attr__( 'Enter URL Vimeo', 'leadcon' ),
                'condition'   => [
                    'source' => 'vimeo'
                ]

            ]
        );

        $this->add_control(
            'icon_play',
            [
                'label' => esc_html__( 'Icon Play', 'leadcon' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'ion-ios-play-outline',
                'options' => [
                    'ion-ios-play' => esc_html__( 'Initial', 'leadcon' ),
                    'ion-ios-play-outline' => esc_html__( 'Outline', 'leadcon' ),
                    'image' => esc_html__( 'Use Image', 'leadcon' )
                ]
            ]
        );

        $this->add_control(
            'image_icon',
            [
                'label' => esc_html__( 'Icon Image', 'leadcon' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'icon_play' => 'image'
                ]
            ]
        );


        $this->add_control(
            'image_align',
            [
                'label'     => esc_html__( 'Align', 'leadcon' ),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'default'   => 'left',
                'options'   => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'leadcon' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'leadcon' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'leadcon' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .leadcon-video-popup' => 'text-align: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_image',
            [
                'label' => esc_html__( 'Image', 'leadcon' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs(
            'style_overlay_image'
        );

        $this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'leadcon' ),
            ]
        );

        $this->add_control(
            'overlay_image',
            [
                'label'     => esc_html__( 'Overlay','leadcon' ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'Show', 'leadcon' ),
                'label_off' => esc_html__( 'Hide', 'leadcon' ),
                'default'   => 'no'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'label'     => esc_html__( 'Background', 'leadcon' ),
                'name'      => 'Background_overlay_image',
                'condition' => [
                    'overlay_image' => 'yes'
                ],
                'selector'  => '{{WRAPPER}} .leadcon-box .btn-play'
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => __( 'Hover', 'leadcon' ),
            ]
        );

        $this->add_control(
            'overlay_image_hover',
            [
                'label'     => esc_html__( 'Overlay','leadcon' ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'Show', 'leadcon' ),
                'label_off' => esc_html__( 'Hide', 'leadcon' ),
                'default'   => 'no'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'label'     => esc_html__( 'Background', 'leadcon' ),
                'name'      => 'Background_overlay_image_hover',
                'condition' => [
                    'overlay_image' => 'yes'
                ],
                'selector'  => '{{WRAPPER}} .leadcon-box:hover .btn-play'
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'label' => esc_html__( 'Box Shadow', 'leadcon' ),
                'name' => 'image_box_shadow',
                'selector' => '{{WRAPPER}} .leadcon-box'
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => __( 'Border Radius', 'elementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .leadcon-box img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Lightbox', 'leadcon' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'lightbox-width',
            [
                'label' => esc_html__( 'Lightbox Width', 'leadcon' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 900,
                        'max' => 1170
                    ]
                ],
                'default' => [
                    'size' => '976'
                ]

            ]
        );

        $this->add_control(
            'aspect_ratio',
            [
                'label' => esc_html__( 'Aspect Ratio', 'leadcon' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '0.5625' => '16:9',
                    '0.42857' => '21:9',
                    '0.75'  => '4:3',
                    '0.66666'  => '3:2',
                    '1'  => '1:1'
                ],
                'default' => '0.5625',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style-icon-play',
            [
                'label' => esc_html__( 'Icon Play', 'leadcon' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'color_icon',
            [
                'label' => esc_html__( 'Color', 'leadcon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .leadcon-box .btn-play' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_responsive_control(
            'size_icon',
            [
                'label' => esc_html__( 'Size', 'leadcon' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [
                    'px',
                    'em'
                ],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 50
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 4
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => '36'
                ],
                'selectors' => [
                    '{{WRAPPER}} .leadcon-box .btn-play' => 'font-size: {{SIZE}}{{UNIT}}'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_width',
            [
                'label' => esc_html__( 'Width', 'leadcon' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [
                    'px'
                ],
                'range' => [
                    'px' => [
                        'max' => 100,
                        'min' => 60
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => '80'
                ],
                'selectors' => [
                    '{{WRAPPER}} .leadcon-box .btn-play:before' => ' width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}} '
                ]

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'label' => esc_html__( 'Border', 'leadcon' ),
                'name' => 'border',
                'selector' => '{{WRAPPER}} .leadcon-box .btn-play:before'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_icon',
                'label' => esc_html__( 'Background Icon', 'leadcon' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .leadcon-box .btn-play:before'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'leadcon' ),
                'selector' => '{{WRAPPER}} .leadcon-box .btn-play:before',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     */
    protected function render(){
        $settings = $this->get_settings_for_display();
        $url = $settings[ $settings[ 'source' ].'_url' ];
        if ( $settings[ 'source' ] === 'vimeo' ) {
            $url = str_replace( 'https://vimeo.com', 'https://player.vimeo.com/video', $settings[ 'vimeo_url' ] );
        }
        $video_html = \Elementor\Embed::get_embed_html( $url, [], [ 'lazy_load' => '' ] );
        $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src( $settings['image']['id'], 'image_overlay', $settings );
        if ( empty( $image_url ) ) {
            $image_url = $settings[ 'image' ][ 'url' ];
        }

        $image_html = '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( \Elementor\Control_Media::get_image_alt( $settings['image'] ) ) . '" />';
        $this->add_render_attribute( 'light-box', 'href', esc_url( $url ) );
        $this->add_render_attribute( 'light-box', 'class', 'html5lightbox leadcon-box' );
        $this->add_render_attribute( 'light-box', 'data-width', $settings[ 'lightbox-width' ]['size'] );
        $this->add_render_attribute( 'light-box', 'data-height', (int)$settings[ 'lightbox-width' ]['size']*(float)$settings[ 'aspect_ratio' ] );
        ?>
        <div class="leadcon-video-popup">
            <a <?php echo $this->get_render_attribute_string( 'light-box' ); ?>>
                <?php echo $image_html; ?>
                <span class="btn-play <?php echo esc_attr( $settings[ 'icon_play' ] ); ?>">
                    <?php if ( $settings[ 'icon_play' ] == 'image' ): ?>
                        <span class="image-icon-wrapper">
                            <img src="<?php echo esc_url( $settings[ 'image_icon' ][ 'url' ] ); ?>" alt="Icon Play">
                        </span>
                    <?php endif ?>
                </span>
            </a>
        </div>
        <?php

    }
}
