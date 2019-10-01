<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * ht leadcon Hello World
 *
 * Elementor widget for hello world.
 */
class leadcon_Countdown extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'leadcon-countdown';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Count Down', 'leadcon' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-countdown';
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
		return array( 'leadcon-countdown' );
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_countdown',
			[
				'label' => esc_html__( 'Countdown', 'leadcon' ),
			]
		);

		$this->add_control(
			'due_date',
			[
				'label'          => esc_html__( 'Due Date', 'leadcon' ),
				'type'           => \Elementor\Controls_Manager::DATE_TIME,
				'default'        => '10/20/2020',
				'picker_options' => array(
					'dateFormat' => 'd/m/Y',
					'enableTime' => true,
				),
			]
		);

		$this->add_control(
			'label_hours',
			[
				'label'   => esc_html__( 'Hours Label', 'leadcon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'hours', 'leadcon' ),
			]
		);

		$this->add_control(
			'label_minutes',
			[
				'label'   => esc_html__( 'Minutes Label', 'leadcon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'mins', 'leadcon' ),
			]
		);

		$this->add_control(
			'label_seconds',
			[
				'label'   => esc_html__( 'Seconds Label', 'leadcon' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'secs', 'leadcon' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_box_style',
			[
				'label' => esc_html__( 'Boxes', 'leadcon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'alignment',
			[
				'label'          => esc_html__( 'Alignment', 'leadcon' ),
				'type'           => Controls_Manager::CHOOSE,
				'options'        => array(
					'flex-start'   => array(
						'title' => esc_html__( 'Left', 'leadcon' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'leadcon' ),
						'icon'  => 'fa fa-align-center',
					),
					'flex-end'  => array(
						'title' => esc_html__( 'Right', 'leadcon' ),
						'icon'  => 'fa fa-align-left',
					),
				),
				'default'        => 'center',
				'tablet_default' => 'center',
				'mobile_default' => 'center',
				'selectors'      => array(
					'{{WRAPPER}} .leadcon-countdown' => 'justify-content: {{VALUE}}',
				),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__( 'Content', 'leadcon' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'space_item',
			[
				'label' => esc_html__( 'Space', 'leadcon' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
						'min' => 10
					]
				],
				'default' => [
					'size' => 30,
					'unit' => 'px'
				],
				'selectors' => [
					'{{WRAPPER}} .leadcon-countdown-wrapper .leadcon-countdown-item:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};'
				]
			]
		);

        $this->add_control(
            'heading_digits',
            [
                'label' => esc_html__( 'Digits', 'leadcon' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'digits_color',
            [
                'label'     => esc_html__( 'Color', 'leadcon' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .leadcon-countdown-digit' => 'color: {{VALUE}}',
                ],
                'default' => '#000000'
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'digits_typography',
				'selector' => '{{WRAPPER}} .leadcon-countdown-digit',
				'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->add_control(
			'heading_labels',
			[
				'label'     => esc_html__( 'Labels', 'leadcon' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'labels_color',
			[
				'label'     => esc_html__( 'Color', 'leadcon' ),
				'type'      => Controls_Manager::COLOR,
				'default'  => '#000000',
				'selectors' => [
					'{{WRAPPER}} .leadcon-countdown-label' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'labels_typography',
				'selector' => '{{WRAPPER}} .leadcon-countdown-label',
				'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_2,
			]
		);

        $this->add_control(
            'border_digits',
            [
                'label' => esc_html__( 'Border Color Top', 'leadcon' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'border_top_color',
            [
                'label'     => esc_html__( 'Border Color Top', 'leadcon' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .leadcon-countdown-item' => 'border-color: {{VALUE}}',
                ],
                'default' => '#3fd0d3'
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label'     => esc_html__( 'Background', 'leadcon' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .leadcon-countdown-item' => 'background-color: {{VALUE}}',
                ],
                'default' => '#fff'
            ]
        );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		?>
		<div class="leadcon-countdown">
			<div class="leadcon-countdown-wrapper leadcon-countdown-default has-dots" data-date="<?php echo esc_attr( $settings['due_date'] ); ?>">
				<div class="leadcon-countdown-item">
					<span id="<?php echo esc_attr( uniqid( 'hours-' ) ); ?>" class="leadcon-countdown-digit leadcon-count"></span>
					<span class="leadcon-countdown-label"><?php echo esc_html( $settings['label_hours'] ); ?></span>
				</div>

				<div class="leadcon-countdown-item">
					<span id="<?php echo esc_attr( uniqid( 'minutes-' ) ); ?>" class="leadcon-countdown-digit"></span>
					<span class="leadcon-countdown-label"><?php echo esc_html( $settings['label_minutes'] ); ?></span>
				</div>

				<div class="leadcon-countdown-item">
					<span id="<?php echo esc_attr( uniqid( 'seconds-' ) ); ?>" class="leadcon-countdown-digit"></span>
					<span class="leadcon-countdown-label"><?php echo esc_html( $settings['label_seconds'] ); ?></span>
				</div>
			</div>
		</div>
		<?php
	}


}
