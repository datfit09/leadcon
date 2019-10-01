<?php
/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class leadcon_Elementor {
	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;
	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Register custom widget categories.
	 */
	public function add_elementor_widget_categories( $elements_manager ) {
		$elements_manager->add_category(
			'leadcon',
			array(
				'title' => esc_html__( 'Leadcon', 'leadcon' ),
			)
		);
	}
	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
        wp_register_script(
            'leadcon-countdown',
            LEADCON_URI . 'assets/js/elementor/countdown.js',
            array( 'jquery', 'countdown' ),
            LEADCON_VERSION,
            true
        );
        wp_register_script(
            'leadcon-testimonial',
            LEADCON_URI . 'assets/js/elementor/testimonial.js',
            array( 'jquery', 'slick' ),
            LEADCON_VERSION,
            true
        );

        wp_register_script(
            'leadcon-blog-slider',
            LEADCON_URI . 'assets/js/elementor/blogslider.js',
            array( 'jquery', 'slick' ),
            LEADCON_VERSION,
            true
        );

        wp_register_script(
            'leadcon-gallery-slider',
            LEADCON_URI . 'assets/js/elementor/galleryslider.js',
            array( 'jquery', 'slick' ),
            LEADCON_VERSION,
            true
        );

        wp_register_script(
            'leadcon-inner-slider',
            LEADCON_URI . 'assets/js/elementor/innerslider.js',
            array( 'jquery', 'slick' ),
            LEADCON_VERSION,
            true
        );
        
        wp_register_script(
            'leadcon-video-popup',
            LEADCON_URI . 'assets/js/elementor/videopopup.js',
            array( 'jquery', 'html5lightboxjs' ),
            LEADCON_VERSION,
            true
        );
	}    
	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {

		$widgets = glob( LEADCON_DIR . 'inc/widgets/*.php' );

		foreach ( $widgets as $key ) {
			if ( file_exists( $key ) ) {
				require_once $key;
			}
		}
	}
	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		$widgets = glob( LEADCON_DIR . 'inc/widgets/*.php' );
		// Register Widgets
		foreach ( $widgets as $key ) {
            if ( file_exists( $key ) ) {
                $paths      = pathinfo( $key );
                $prefix     = str_replace( '-', ' ', $paths['filename'] );
                $prefix     = ucwords( $prefix );
                $class_name = str_replace( ' ', '_', $prefix );
                $class_name = str_replace( 'Class_', '', $class_name );
                \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $class_name() );
            }
		}
	}
    
	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {
		// Register custom widget categories.
		add_action( 'elementor/elements/categories_registered', array( $this, 'add_elementor_widget_categories' ) );
		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );
		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}
}
// Instantiate leadcon_Elementor Class
leadcon_Elementor::instance();
