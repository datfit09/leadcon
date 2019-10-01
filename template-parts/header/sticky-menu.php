<header id="sticky-menu" class="header-sticky">
	<div class="container">
		<div class="sticky-menu-container">
			<?php get_template_part( 'template-parts/header/site-branding' ); ?>

			<nav id="sticky-navigation" class="header-navigation main-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'leadcon' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'sticky-menu-wrapper',
					)
				);
				?>
			</nav><!-- #site-navigation -->
            <div class="site-header-minor">
                <?php leadcon_site_search_toggle(); ?>
            </div><!-- .site-header-minor -->
		</div><!-- .site-header-container -->
	</div><!-- .leadcon-container -->
</header><!-- #masthead -->
