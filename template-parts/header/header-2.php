<?php
/**
 * Display header layout 2
 *
 * @package leadcon
 */
$class = leadcon_site_header_container_class();

leadcon_site_search();
?>

<header id="masthead" class="site-header header-2">
	<div class="<?php echo esc_attr( $class ); ?>">
		<div class="site-header-container">
			<div class="menu-toggle-container">
				<a href="#off-canvas" class="menu-toggle js-canvas-toggle" aria-expanded="false">
						<span class="menu-toggle-wrapper">
						</span><!-- .menu-toggle-wrapper -->

					<span class="screen-reader-text menu-toggle-text"><?php esc_html_e( 'Menu', 'leadcon' ); ?></span>
				</a><!-- .menu-toggle -->
			</div><!-- .menu-toggle-container -->
			<!-- <div class="header-container-layout header-layout-2" id="main-header"> -->

				<nav id="left-navigation" class="header-navigation left-navigation" aria-label="<?php esc_attr_e( 'Left Menu', 'leadcon' ); ?>">
					<?php
					if ( has_nav_menu('secondary') ) {
						wp_nav_menu(
							array(
								'theme_location' => 'secondary',
								'menu_id'        => 'left-menu',
							)
						);
					}

					?>
				</nav><!-- #site-navigation -->
				<?php get_template_part( 'template-parts/header/site-branding' ); ?>
				<nav id="right-navigation" class="header-navigation right-navigation" aria-label="<?php esc_attr_e( 'Left Menu', 'leadcon' ); ?>">
					<?php
					if ( has_nav_menu('tertiary') ) {
						wp_nav_menu(
							array(
								'theme_location' => 'tertiary',
								'menu_id'        => 'right-menu',
							)
						);
					}

					?>
				</nav><!-- #site-navigation -->
			<!-- </div> -->
		</div><!-- .site-header-container -->
	</div><!-- .leadcon-container -->
</header><!-- #masthead -->
