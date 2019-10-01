<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * ht leadcon Hello World
 *
 * Elementor widget for hello world.
 */
class leadcon_Blog extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'leadcon-blog';
    }

    /**
     * Retrieve the widget title.
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Blog', 'leadcon' );
    }

    /**
     * Retrieve the widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-post-list';
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
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     */
    protected function _register_controls() {
        $this->start_controls_section(
            'section_blog',
            array(
                'label' => esc_html__( 'Blog', 'leadcon' ),
            )
        );


        $this->add_responsive_control(
            'columns',
            [
                'label'          => esc_html__( 'Columns', 'leadcon' ),
                'type'           => Controls_Manager::SELECT,
                'options'        => [
                    '1' => esc_html__( '1', 'leadcon' ),
                    '2' => esc_html__( '2', 'leadcon' ),
                    '3' => esc_html__( '3', 'leadcon' ),
                    '4' => esc_html__( '4', 'leadcon' ),
                    '5' => esc_html__( '5', 'leadcon' )
                ],
                'default'        => '3',
                'tablet_default' => '2',
                'mobile_default' => '1',

            ]
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

        $columns  = 'blog-widget-wrapper ht-grid ht-grid-'.$settings['columns'].' ht-grid-tablet-'.$settings['columns_tablet'].' ht-grid-mobile-'.$settings['columns_mobile'];
        ?>

        <div class="leadcon-blog-widget">
            <div class="<?php echo esc_attr( $columns ); ?>">
            <?php
                while ( $posts->have_posts() ) :
                    $posts->the_post();

                    ?>
                    <article id="post-<?php the_ID(); ?>" class="ht-grid-item post post-item">

                        <div class="blog-entry-thumbnail">
                            <a href="<?php echo esc_url( the_permalink() ); ?>">
                                <?php if ( has_post_thumbnail() ): ?>
                                    <?php the_post_thumbnail(); ?>
                                <?php endif ?>
                            </a>
                        </div>

                        <div class="blog-entry-header">
                            <div class="blog-post-on">
                                <?php
                                leadcon_posted_on();
                                leadcon_posted_by();
                                leadcon_comment_count(); 
                                ?>
                            </div>

                            <div class="blog-post-title">
                                <a href="<?php echo esc_url( the_permalink() ); ?>"><h2 class="post-title"><?php echo get_the_title(); ?></h2></a>
                            </div>
                            <div class="blog-post-excerpt">
                                <?php echo esc_html( wp_trim_words( get_the_content( get_the_ID() ) , 15, null ) ) ?>
                            </div>
                        </div><!-- .entry-header -->


                    </article><!-- #post-<?php the_ID(); ?> -->
            <?php endwhile; ?>

            </div>
        </div>

        <?php

        wp_reset_postdata();
    }
}
