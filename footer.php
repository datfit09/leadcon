<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package leadcon
 */
if( class_exists('acf') ) {
    $lc_show_footer = get_field('lc_show_footer');
}
?>
            </div>
        </div><!-- .page-content -->
    </div><!-- #content -->
<?php if( $lc_show_footer !== ['hidden_footer']) {?>
    <footer id="colophon" class="site-footer" role="contentinfo">
        <?php get_template_part( 'template-parts/footer/footer', 'widgets' ); ?>

        <div class="site-info">
            <div class="container">
                <div class="site-info-wrapper">
                    <?php
                    get_template_part( 'template-parts/footer/footer', 'copyright' );
                    get_template_part( 'template-parts/footer/footer', 'navigation' );
                    ?>
                </div><!-- .site-info-wrapper -->
            </div>
        </div><!-- .site-info -->
    </footer><!-- #colophon -->
    <?php }

    echo leadcon_site_close_tag_container_class();
    if ( get_theme_mod('scroll_top',true) === true ) {
    ?>
        <span class="btn-back-to-top ion-chevron-up"></span>
    <?php } ?>

</div><!-- #page -->

<?php
get_template_part( 'template-parts/footer/off-canvas' );
wp_footer();
?>

</body>
</html>