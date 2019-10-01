<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * ht leadcon Hello World
 *
 * Elementor widget for hello world.
 */
class leadcon_Team_Member extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'leadcon-team-member';
    }

    /**
     * Retrieve the widget title.
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Team Member', 'leadcon' );
    }

    /**
     * Retrieve the widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-testimonial-carousel';
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
        return array( 'leadcon-team-member' );
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     */
    protected function _register_controls(){
        $this->start_controls_section(
            'section_team_member',
            [
                'label' => esc_html__( 'Team Member', 'leadcon' ),
            ]
        );


        $this->add_control(
            'image',
            [
                'label'   => esc_html__( 'Choose Image', 'leadcon' ),
                'type'    => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'full', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'separator' => 'none',
                'default'   => 'full'
            ]
        );

        $this->add_control(
            'name',
            [
                'label'       => esc_html__( 'Name', 'leadcon' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Name', 'leadcon' ),
                'placeholder' => esc_attr__( 'Member Name', 'leadcon' ),
                'label_block' => true
            ]
        );

        $this->add_control(
            'heading',
            [
                'label'   => esc_html__( 'Heading', 'leadcon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'h4',
                'options' => [
                    'h1' => esc_html__( 'H1', 'leadcon' ),
                    'h2' => esc_html__( 'H2', 'leadcon' ),
                    'h3' => esc_html__( 'H3', 'leadcon' ),
                    'h4' => esc_html__( 'H4', 'leadcon' ),
                    'h5' => esc_html__( 'H5', 'leadcon' ),
                    'h6' => esc_html__( 'H6', 'leadcon' )
                ]
            ]
        );

        $this->add_control(
            'description',
            [
                'label'       => esc_html__( 'Member Position', 'leadcon' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Ceo', 'leadcon' ),
                'label_block' => true
            ]
        );

        $this->add_control(
            'content_align',
            [
                'label'     => esc_html__( 'Align', 'leadcon' ),
                'type'      => Controls_Manager::CHOOSE,
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
                    '{{WRAPPER}} .leadcon-team-member' => 'text-align: {{VALUE}};',
                ]
            ]
        );

        $repeater = new Elementor\Repeater();
        $repeater->add_control(
            'member_contact',
            [
                'label' => esc_html__( 'Icon', 'leadcon' ),
                'type' => Controls_Manager::ICON,
                'label_block' => true,
                'default' => 'fa fa-star',
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label'       => esc_html__( 'Link', 'leadcon' ),
                'type'        => Controls_Manager::URL,
                'label_block' => true,
                'default'     => [
                    'is_external' => 'true',
                ],
                'placeholder' => esc_attr( 'https://member-link.com' ),
            ]
        );

        $this->add_control(
            'contact_icon_list',
            [
                'label'          => esc_html__( 'Social Icons', 'leadcon' ),
                'type'           => Controls_Manager::REPEATER,
                'fields'         => $repeater->get_controls(),
                'default'        => [
                    [
                        'member_contact' => 'fa fa-twitter',
                    ],
                
                ],
                'title_field'    => '<i class="{{ member_contact }}"></i>',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'style',
            [
                'label' => esc_html__( 'Avatar','leadcon' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'image_space',
            [
                'label'     => esc_html__( 'Space', 'leadcon' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'default'   => [
                    'size' => 15
                ],
                'selectors' => [
                    '{{WRAPPER}} .leadcon-team-member .leadcon-member-avatar' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'hover_heading',
            [
                'label' => esc_html__( 'Hover', 'leadcon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'hover_animation',
            [
                'label'        => esc_html__( 'Hover Animation', 'leadcon' ),
                'type'         => Controls_Manager::HOVER_ANIMATION,
                'prefix_class' => 'elementor-animation-',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Background Hover', 'leadcon' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'sheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1
                ],
                'selector' => '{{WRAPPER}} .leadcon-team-member .leadcon-member-avatar .leadcon-member-contact' ,

            ]
        );



        $this->end_controls_section();

        $this->start_controls_section(
            'name_style',
            [
                'label' => esc_html__( 'Member Name', 'leadcon' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'name_color',
            [
                'label'     => esc_html__( 'Color', 'leadcon' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#222',
                'scheme'    => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .leadcon-team-member .leadcon-member-info .leadcon-member-name .name' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .leadcon-team-member .leadcon-member-info .leadcon-member-name:after' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'selector' => '{{WRAPPER}} .leadcon-team-member .leadcon-member-info .leadcon-member-name .name',
                'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_control(
            'name_space',
            [
                'label'     => esc_html__( 'Space', 'leadcon' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'default'   => [
                    'size' => 15
                ],
                'selectors' => [
                    '{{WRAPPER}} .leadcon-team-member .leadcon-member-info .leadcon-member-name .name' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'description_style',
            [
                'label' => esc_html__( 'Member Description', 'leadcon' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'description_color',
            [
                'label'     => esc_html__( 'Color', 'leadcon' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#666',
                'scheme'    => [
                    'type'      => \Elementor\Scheme_Color::get_type(),
                    'value'     => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .leadcon-team-member .leadcon-member-info .leadcon-member-description' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'description_typography',
                'selector' => '{{WRAPPER}} .leadcon-team-member .leadcon-member-info .leadcon-member-description',
                'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'style_icon_contact',
            [
                'label' => esc_html__( 'Icon Contact', 'leadcon' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'icon_primary_color',
            [
                'label'     => esc_html__( 'Color', 'leadcon' ),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default'   => '#9d9d9d',
                'selectors' => [
                    '{{WRAPPER}} .leadcon-team-member .leadcon-member-contact ul>li>a ' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .leadcon-team-member .leadcon-member-info ul>li>a ' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'icon_background_color',
            [
                'label'     => esc_html__( 'Background Color', 'leadcon' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'Yes', 'leadcon' ),
                'label_off' => esc_html__( 'No', 'leadcon' ),
                'default'   => 'no'
            ]
        );

        $this->add_control(
            'icon_border',
            [
                'label'     => esc_html__( 'Border', 'leadcon' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'unit' => 'px',
                    'size' => 0
                ],
                'range'     => [
                    'min' => 0,
                    'max' => 10
                ],
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .leadcon-team-member .leadcon-member-contact .leadcon-contact-icon li>a' => 'border:{{SIZE}}{{UNIT}} solid;',
                    '{{WRAPPER}} .leadcon-team-member .leadcon-member-info .leadcon-contact-icon li>a' => 'border:{{SIZE}}{{UNIT}} solid;'
                ]

            ]
        );


        $this->add_control(
            'icon_align',
            [
                'label'     => esc_html__( 'Align', 'leadcon' ),
                'type'      => Controls_Manager::CHOOSE,
                'default'   => 'flex-start',
                'options'   => [
                    'flex-start'  => [
                        'title' => esc_html__( 'Left', 'leadcon' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Top', 'leadcon' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'leadcon' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .leadcon-team-member .leadcon-member-contact ul.leadcon-contact-icon ' => 'justify-content: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'leadcon' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ '%' ],
                'default'    => [
                    'top'    => 50,
                    'right'  => 50,
                    'bottom' => 50,
                    'left'   => 50,
                    'unit'   => '%'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .leadcon-team-member .leadcon-member-contact ul li>a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .leadcon-team-member .leadcon-member-info ul li>a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
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
        $settings        = $this->get_settings_for_display();
        $background_icon = $settings[ 'icon_background_color' ] === 'yes' ? 'background' : '';
        ?>
        <div class="leadcon-team-member">
            <div class="leadcon-member-avatar">
                <div class="avatar with-content<?php echo ' elementor-animation-'.$settings['hover_animation'] ?>">
                    <?php 
                    if ( empty( $settings['image']['id'] ) ) {
                        echo $image_html = \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'full', 'image' );
                    }
                    else{
                        $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src( $settings['image']['id'], 'full', $settings );

                        $image_html = '<img  src="' . esc_url( $image_url ) . '" alt="' . esc_attr( \Elementor\Control_Media::get_image_alt( $settings['image'] ) ) . '" />';
                        echo $image_html;
                    }
                    ?>
                    <div class="leadcon-member-contact <?php echo $settings['icon_align']; ?>">

                        <div class="leadcon-member-info">
                            <div class="leadcon-member-name">
                                <?php echo '<'.$settings['heading'].' class= "name">'.esc_html( $settings['name'] ).'</'.$settings['heading'].'>' ?>
                            </div>
                            <div class="leadcon-member-description">
                                - <?php echo esc_html( $settings['description'] ); ?> -
                            </div>
                        </div>

                        <ul class="leadcon-contact-icon">
                            <?php foreach ($settings['contact_icon_list'] as $key => $value) { ?>
                                <li><a href="<?php echo esc_url( $value['link']['url'] ) ?>" class="<?php echo esc_attr( $value['member_contact'].' '.$background_icon ) ?>"></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
}
