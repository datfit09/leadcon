<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * ht leadcon Hello World
 *
 * Elementor widget for hello world.
 */
class leadcon_Testimonial extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'leadcon-testimonial';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Testimonial', 'leadcon' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-testimonial';
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
		return array( 'leadcon-testimonial' );
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_testimonial',
			array(
				'label' => esc_html__( 'Testimonial', 'leadcon' ),
			)
		);

		$repeater = new Elementor\Repeater();

		$repeater->add_control(
			'avatar',
			[
				'label' => esc_html__( 'Avatar', 'leadcon' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);

		$repeater->add_control(
			'name',
			[
				'label' => esc_html__( 'Name', 'leadcon' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Name', 'leadcon' ),
				'default' => esc_html__( 'Hanet Aguilar', 'leadcon' )
			]
		);

		$repeater->add_control(
			'position',
			[
				'label' => esc_html__( 'Position', 'leadcon' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Position', 'leadcon' ),
				'default' => esc_html__( 'Marketer', 'leadcon' )
			]
		);

        $repeater->add_control(
            'rate',
            [
                'label' => esc_html__( 'Rate star', 'leadcon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => 5,
            ]
        );

		$repeater->add_control(
			'content',
			[
				'label' => esc_html__( 'Content', 'leadcon' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter Content', 'leadcon' ),
				'default' => esc_html__( 'Cras eget mattis neque. Nulla tempus tortor elit, vitae pharetra risus luctus quis. Proin placerat nulla nisl, vitae consectetur felis blandit.', 'leadcon' )
			]
		);

		$this->add_control(
			'testimonial',
			[
				'label' => esc_html__( 'Testimonial', 'leadcon' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[],
					[]
				],
				'title_field' => '{{{ name }}}'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_layout',
			[
				'label' => esc_html__( 'Layout', 'leadcon' )
			]
		);

        $this->add_control(
            'type',
            [
                'label' => esc_html__( 'Type', 'leadcon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'arrow' => esc_html__( 'Arrow', 'leadcon' ),
                    'dot' => esc_html__( 'Dots', 'leadcon' )
                ],
                'default' => 'arrow'
            ]
        );

        // Slides to show.
        $this->add_responsive_control(
            'slides_to_show',
            [
                'label' =>  esc_html__( 'Slides to show', 'united-pets' ),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 3,
                'step'    => 1,
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'slides_to_show_mobile' => [
                    'default' => 1,
                ],
                'slides_to_show_tablet' => [
                    'default' => 2,
                ],
                'slides_to_show' => [
                    'default' => 3,
                ],
            ]
        );

		$this->add_group_control(
			Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'img'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'name_style',
			[
				'label' => esc_html__( 'Name', 'leadcon' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'name_color',
			[
				'label'     => esc_html__( 'Color', 'leadcon' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .testimonial--name' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'name_typo',
				'selector' => '{{WRAPPER}} .testimonial--name'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'position_style',
			[
				'label' => esc_html__( 'Position', 'leadcon' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'position_color',
			[
				'label'     => esc_html__( 'Color', 'leadcon' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#999999',
				'selectors' => [
					'{{WRAPPER}} .testimonial--position' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'position_typo',
				'selector' => '{{WRAPPER}} .testimonial--position'
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'rate_star_style',
            [
                'label' => esc_html__( 'Rate Star', 'leadcon' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'rate_star_color',
            [
                'label'     => esc_html__( 'Color', 'leadcon' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffc600',
                'selectors' => [
                    '{{WRAPPER}} .testimonial--rate .fa-star:before' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Content', 'leadcon' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     => esc_html__( 'Color', 'leadcon' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#666666',
				'selectors' => [
					'{{WRAPPER}} .tetimonial-content' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typo',
				'selector' => '{{WRAPPER}} .tetimonial-content'
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'background_style',
            [
                'label' => esc_html__( 'Background testimonial', 'leadcon' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'bg_color_testimonial',
            [
                'label'     => esc_html__( 'Background Color', 'leadcon' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-index' => 'background-color: {{VALUE}}'
                ]
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

		?>
		<div class="leadcon-testimonial-widget">
			<div class="testimonial-wrapper with-<?php echo esc_attr( $settings['type'] ); ?>" nav-type='<?php echo esc_attr( $settings['type'] ); ?>' data-show="<?php echo esc_attr( $settings['slides_to_show'] ); ?>" data-show-tablet="<?php echo esc_attr( $settings['slides_to_show_tablet'] ); ?>" data-show-mobile="<?php echo esc_attr( $settings['slides_to_show_mobile'] ); ?>" >
				<div class="js-testimonial testimonial-list">
					<?php foreach ($settings['testimonial'] as $testi ): ?>
						<div class="testimonial-item">
							<div class="testimonial-avatar">
								<?php

									if( ! $testi['avatar']['id'] ){
										$image_url = $testi['avatar']['url'];
									}
									else{
										$image_url = Elementor\Group_Control_Image_Size::get_attachment_image_src( $testi['avatar']['id'], 'img', $settings );
									}

								?>
								<img src="<?php echo esc_url( $image_url ) ?>" class='avatar' alt='avatar'>
							</div>

                            <div class="testimonial-index">
    							<h3 class="testimonial--name"><?php echo esc_html( $testi['name'] ); ?></h3>
    							<span class="testimonial--position">- <?php echo esc_html( $testi['position'] ); ?> -</span>
                                <span class="testimonial--rate">
                                    <?php

                                    $i = 0;
                                    $star = esc_attr( $testi['rate'] );
                                    for ($i; $i < $star; $i++){
                                        $str = str_word_count( $star );
                                        $str = str_replace( '0', '<span class="fa fa-star"></span> ', $str );
                                        echo $str;
                                    }

                                    ?>
                                </span>
    							<div class="tetimonial-content">
    								<span class="main-content"><?php echo esc_html( $testi['content'] ); ?></span>
    							</div>
                            </div>
                            
						</div>
					<?php endforeach ?>
				</div>
			<button class="testimonial-prev-arrow fa fa-chevron-left"></button>
			<button class="testimonial-next-arrow fa fa-chevron-right"></button>
			<div class="testimonial-slider-dots">

			</div>
			</div>

		</div>

		<?php

	}
}
