<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package leadcon
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
    return;
}

$default_layout = get_theme_mod( 'leadcon_default_layout', 'right-sidebar' );
?>
<?php if ( 'no-sidebar' !== $default_layout || is_single() ): ?>
    <aside id="secondary" class="main-sidebar widget-area" role="complementary">
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    </aside><!-- #secondary -->
<?php endif ?>