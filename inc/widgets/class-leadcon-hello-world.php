<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * ht leadcon Hello World
 *
 * Elementor widget for hello world.
 */
class leadcon_Hello_World extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'leadcon-hello-world';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'WD Headding', 'leadcon' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-t-letter';
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
		return array( 'leadcon-hello-world' );
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
    protected function _register_controls() {
        $this->start_controls_section(
            'post_content',
            array(
                'label' =>  esc_html__( 'General', 'leadcon' ),
            )
        );

        // Title Heading.
        $this->add_control(
            'widget_title',
            [
                'label' => esc_html__( 'Title', 'leadcon' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Top [Destination]', 'leadcon' ),
            ]
        );

        // Hidden Sub title.
        $this->add_control(
            'show_title_sub',
            [
                'label' => __( 'Show Title Sub', 'leadcon' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'leadcon' ),
                'label_off' => esc_html__( 'Hide', 'leadcon' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        // Title Sub Heading.
        $this->add_control(
            'widget_title_sub',
            [
                'label' => esc_html__( 'Title Sub', 'leadcon' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Top Destination', 'leadcon' ),
            ]
        );

        // Hidden title line.
        $this->add_control(
            'show_title_line',
            [
                'label' => __( 'Show Title Line', 'leadcon' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'leadcon' ),
                'label_off' => esc_html__( 'Hide', 'leadcon' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        // Alignment.
        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'leadcon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'leadcon' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'leadcon' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'leadcon' ),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justified', 'leadcon' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'default' => 'left',
            ]
        );

        $this->add_control(
            'view',
            [
                'label' => esc_html__( 'View', 'leadcon' ),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );

        $this->end_controls_section();

        /*
        Tab style intro.
         */
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Style intro', 'leadcon' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Color & typography title sub.
        $this->add_control(
            'title_sub_color',
            [
                'label' => esc_html__( 'Title Sub Color', 'leadcon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f2f2f2',
                'selectors' => [
                    '{{WRAPPER}} .sub-title-heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography_1',
                'label' => esc_html__( 'Typography Title Sub', 'leadcon' ),
                'selector' => '{{WRAPPER}} .sub-title-heading',
            ]
        );

        // Color & typography title.
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'leadcon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .leadcon-section-heading h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography_2',
                'label' => esc_html__( 'Typography Title', 'leadcon' ),
                'selector' => '{{WRAPPER}} .leadcon-section-heading h2',
            ]
        );

        // Color title line.
        $this->add_control(
            'bg_bottom_color',
            [
                'label' => esc_html__( 'Background Bottom Color', 'leadcon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#3fd0d4',
                'selectors' => [
                    '{{WRAPPER}} .leadcon-section-heading:after' => 'background-color: {{VALUE}}',
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
	protected function render() {
		$settings = $this->get_settings_for_display();
        $a = str_replace( '[', '<strong>', $settings['widget_title'] );
        $a = str_replace( ']', '</strong>', $a );

        $after = '';
        if( 'yes' == $settings['show_title_line'] ){
            $after = 'leadcon-section-heading';
        }
		?>
        <div class="<?php echo $after ?> leadcon-heading <?php echo $settings['align'] ?>">
            <?php if ( 'yes' === $settings['show_title_sub'] ) { ?>
                <p class="sub-title-heading"><?php echo $settings['widget_title_sub'] ?></p>
            <?php } ?>
            <h2 class="leadcon-title"><?php echo wp_kses_post( $a ); ?></h2>
        </div>
        <?php
	}
}
