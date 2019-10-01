<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * ht leadcon Hello World
 *
 * Elementor widget for hello world.
 */
class leadcon_Blog_Slider extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'leadcon-blog-slider';
    }

    /**
     * Retrieve the widget title.
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Blog slider', 'leadcon' );
    }

    /**
     * Retrieve the widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-post-slider';
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
        return array( 'leadcon-blog-slider' );
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     */
    protected function _register_controls() {
        $this->start_controls_section(
            'section_blog_slider',
            array(
                'label' => esc_html__( 'Blog Slider', 'leadcon' ),
            )
        );

        $this->add_control(
            'limit',
            [
                'label'   => esc_html__( 'Posts Per Page', 'leadcon' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 3
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__( 'Style', 'leadcon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Color title', 'leadcon' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h2.post-title' => 'color: {{VALUE}}',
                ],
                'default' => '#000000'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} h2.post-title',
            ]
        );

        $this->add_control(
            'detail_color',
            [
                'label'     => esc_html__( 'Detail Color', 'leadcon' ),
                'type'      => Controls_Manager::COLOR,
                'default'  => '#b2b2b2',
                'selectors' => [
                    '{{WRAPPER}} .blog-post-on' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .posted-on' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .posted-on>a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .author>a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .entry-meta-item>a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'detail_typography',
                'selector' => '{{WRAPPER}} .blog-post-on',
            ]
        );

        $this->add_control(
            'except_color',
            [
                'label'     => esc_html__( 'Except Color', 'leadcon' ),
                'type'      => Controls_Manager::COLOR,
                'default'  => '#666666',
                'selectors' => [
                    '{{WRAPPER}} .blog-post-excerpt' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'except_typography',
                'selector' => '{{WRAPPER}} .blog-post-excerpt',
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label'     => esc_html__( 'Border & Dots Color', 'leadcon' ),
                'type'      => Controls_Manager::COLOR,
                'default'  => '#ffc600',
                'selectors' => [
                    '{{WRAPPER}} .blog-detail-box-slider' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .slick-active .dots-bullet:after' => 'background-color: {{VALUE}}', 
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
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $settings['limit'],
            'paged' => $paged,
            'ignore_sticky_posts' => 1
        );

        $posts = new WP_Query( $args );

        ?>

        <div class="leadcon-blog-slider-widget">
            <div class="blog-slider-wrapper">
                <div class="js-blog-slider blog-slider-list">
                    <?php
                        while ( $posts->have_posts() ) :
                            $posts->the_post();

                            ?>
                            <article id="post-<?php the_ID(); ?>" class="post-blog-slider">
                                <div class="blog-box-slider">
                                    <div class="blog-entry-thumbnail blog-thumbnail-box-slider">
                                        <a href="<?php echo esc_url( the_permalink() ); ?>">
                                            <?php if ( has_post_thumbnail() ): ?>
                                                <?php the_post_thumbnail(); ?>
                                            <?php endif ?>
                                        </a>
                                    </div>

                                    <div class="blog-entry-header blog-detail-box-slider">
                                        <div class="blog-post-title">
                                            <a href="<?php echo esc_url( the_permalink() ); ?>"><h2 class="post-title"><?php echo get_the_title(); ?></h2></a>
                                        </div>

                                        <div class="blog-post-on">
                                            <?php
                                            leadcon_posted_on();
                                            leadcon_posted_by();
                                            leadcon_comment_count(); 
                                            ?>
                                        </div>

                                        <div class="blog-post-excerpt">
                                            <?php echo esc_html( wp_trim_words( get_the_content( get_the_ID() ) , 15, null ) ) ?>
                                        </div>
                                    </div><!-- .entry-header -->
                                </div>
                            </article><!-- #post-<?php the_ID(); ?> -->
                    <?php endwhile; ?>
                </div>
                <div class="blog-slider-dots"></div>
            </div>
        </div>

        <?php

        wp_reset_postdata();
    }
}
