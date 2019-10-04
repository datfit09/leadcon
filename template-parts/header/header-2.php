<?php
/**
 * Display header layout 2
 *
 * @package leadcon
 */
$class = leadcon_site_header_container_class();
$transparent = leadcon_header_transparent_class();
$menu_layout = get_theme_mod( 'leadcon_menu_layout', 'center-menu' );  
leadcon_site_search();
?>

<header id="masthead" class="<?php echo esc_attr( $transparent ); ?> header-2 <?php echo $menu_layout; ?>">
	<div class="<?php echo esc_attr( $class ); ?>">
		<div class="site-header-container">
            <?php get_template_part( 'template-parts/header/site-branding' ); ?>

			<div id="pull" class="menu-toggle-container">
				<a href="#off-canvas" id="toggle" class="menu-toggle js-canvas-toggle" aria-expanded="false">
						<span class="menu-toggle-wrapper">
						</span><!-- .menu-toggle-wrapper -->

					<span class="screen-reader-text menu-toggle-text"><?php esc_html_e( 'Menu', 'leadcon' ); ?></span>
				</a><!-- .menu-toggle -->
			</div><!-- .menu-toggle-container -->
			
		</div><!-- .site-header-container -->
	</div><!-- .leadcon-container -->
</header><!-- #masthead -->
