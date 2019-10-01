<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * ht leadcon Hello World
 *
 * Elementor widget for hello world.
 */
class leadcon_Gallery_Slider extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'leadcon-gallery-slider';
    }

    /**
     * Retrieve the widget title.
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Gallery Slider', 'leadcon' );
    }

    /**
     * Retrieve the widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-slider-full-screen';
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
        return array( 'leadcon-gallery-slider' );
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     */
    protected function _register_controls() {
        $this->start_controls_section(
            'section_gallery',
            array(
                'label' => esc_html__( 'Gallery', 'leadcon' ),
            )
        );

        $repeater = new Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__( 'Image', 'leadcon' ),
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
            ]
        );

        
        $this->add_control(
            'gallery',
            [
                'label' => esc_html__( 'Gallery', 'leadcon' ),
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

        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'img'
            ]
        );

        $this->add_control(
            'name_gallery',
            [
                'label' => esc_html__( 'Name', 'leadcon' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter Name', 'leadcon' ),
                'default' => esc_html__( 'leadcon Photo Gallery', 'leadcon' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'name_style',
            [
                'label' => esc_html__( 'Style', 'leadcon' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label'     => esc_html__( 'Color Title', 'leadcon' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .name-gallery' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .gallery-control-counter-current' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'name_typo',
                'selector' => '{{WRAPPER}} .name-gallery'
            ]
        );

        $this->add_control(
            'counter_color',
            [
                'label'     => esc_html__( 'Counter Color', 'leadcon' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#cccccc',
                'selectors' => [
                    '{{WRAPPER}} .gallery-counter' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .fa-chevron-left:before' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .fa-chevron-right:before' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .slick-dots .slick-active ~ li' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'counter_typo',
                'selector' => '{{WRAPPER}} .gallery-counter'
            ]
        );

        $this->add_control(
            'counter_hover_color',
            [
                'label'     => esc_html__( 'Arrow Hover Color', 'leadcon' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffc600',
                'selectors' => [
                    '{{WRAPPER}} .gallery-slider-next-arrow:hover:before' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .gallery-slider-prev-arrow:hover:before' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'counter_bg_color',
            [
                'label'     => esc_html__( 'Counter Line Color', 'leadcon' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#3fd0d4',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li' => 'background-color: {{VALUE}}',
                ]
            ]
        );
        $this->end_controls_section();

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
        <div class="leadcon-gallery-slider">
            <div class="gallery-slider-wrapper">
                <div class="js-gallery-slider gallery-slider-list">
                    <?php foreach ($settings['gallery'] as $gallery ): ?>
                        <div class="gallery-slider-item">
                            <?php

                                if( ! $gallery['image']['id'] ){
                                    $image_url = $gallery['image']['url'];
                                }
                                else{
                                    $image_url = Elementor\Group_Control_Image_Size::get_attachment_image_src( $gallery['image']['id'], 'img', $settings );
                                }

                            ?>
                            <img src="<?php echo esc_url( $image_url ) ?>" class='image' alt='<?php echo $gallery['name']; ?>'>
                        </div>
                    <?php endforeach ?>
                </div>
                <div class="container box-slider">
                    <div class="gallery-slider-box">
                        <div class="name-gallery"><?php echo $settings['name_gallery'] ?></div>
                        <div class="gallery-slider-dots"></div>

                        <div class="counter-index">
                            <div class="gallery-counter">
                                <div class="gallery-control-counter-current"></div>
                                <div class="gallery-control-counter-total"></div>
                            </div>
                            <div class="gallery-arrow">
                                <div class="gallery-slider-prev-arrow fa fa-chevron-left"></div>
                                <div class="gallery-slider-next-arrow fa fa-chevron-right"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php

    }
}
