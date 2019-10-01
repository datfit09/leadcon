<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package leadcon
 */

get_header();
?>
    <div id="primary" class="page404">
        <main id="main" class="site-main" role="main">
            <section class="error-404 not-found">
                <div class="image-404">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/404.png" alt="<?php esc_attr_e( 'Page not found', 'leadcon' ); ?>">
                </div>
                <div class="text-404">
                    <h2 class="title-404">
                        <?php
                        // Get the page 404 text
                        $page_404_text = get_theme_mod( 'leadcon_page_404_text' );

                        if ( $page_404_text ) {
                            // If we have custom page 404 text, use it
                            echo wp_kses_post( $page_404_text );
                        } else {
                            // Otherwise, use the default one
                            echo esc_html_e( "Sorry, we can't find the page that you're looking for", 'leadcon' );
                        }
                        ?> 
                    </h2>
                    <button class="btn-404">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <?php echo esc_html__( 'Back home', 'leadcon' ); ?>
                        </a>
                    </button>
                </div>
            </section><!-- .error-404 -->

        </main><!-- #main -->
    </div>

</div>
        </div><!-- .page-content -->
    </div><!-- #content -->

</div><!-- #page -->

<?php
get_template_part( 'template-parts/footer/off-canvas' );
wp_footer();
?>

</body>
</html>