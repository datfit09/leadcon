<?php
/**
 * Display footer social menu
 *
 * @package leadcon
 */

if ( ! has_nav_menu( 'footer' ) ) {
	return;
}
?>
<?php if ( has_nav_menu( 'footer' ) ): ?>
	<nav class="footer-navigation" role="navigation">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'footer',
				'menu_class'     => 'footer-menu',
			)
		);
		?>
	</nav><!-- .footer-navigation -->
<?php endif ?>

