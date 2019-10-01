<?php
/**
 * Displays off-canvas menu for mobile devices.
 *
 * @package leadcon
 */
?>

<div class="off-canvas-container js-canvas" tabindex="-1" aria-hidden="true" id="off-canvas">

	<div class="off-canvas-inner">
		<div class="navigation-inner ">
			<div class="off-canvas-tools">
				<div class="menu-logo">
					<?php get_template_part( 'template-parts/header/site-branding' ); ?>
				</div><!-- .off-canvas-logo -->
				<button class="off-canvas-close js-close-off-canvas">
					<span class="screen-reader-text"><?php esc_html_e( 'Close Off-canvas Menu', 'leadcon' ); ?></span>

				</button>
			</div><!-- .off-canvas-tools -->


			<nav id="canvas-navigation" class="navigation-left-menu" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'leadcon' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'vetical-menu-wrapper',
					)
				);
				?>
			</nav><!-- .off-canvas-menu -->

			<div id="site-header-cart" class="site-header-cart cart-vetical">
				<a class="cart-contents" href="<?php echo esc_url( home_url( '/cart' ) ); ?>" title="View your shopping cart">
					<span class="icon-bag"></span>
					<span class="count"></span>
				</a>
			</div>

			<?php
			if ( has_nav_menu( 'social' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'social',
						'menu_id'        => 'social-menu',
					)
				);
			}

			?>

			<div class="menu-copy-right">
				<span><?php echo 'Copy right &copy; '.date('Y').' '.get_bloginfo( 'name' ).' Store'; ?></span>
			</div>
		</div><!-- .off-canvas-inner -->
	</div>
</div><!-- .off-canvas-container -->

