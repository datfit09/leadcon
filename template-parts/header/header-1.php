<?php
/**
 * Display header layout 1 (default)
 *
 * @package leadcon
 */

$class = leadcon_site_header_container_class();
$transparent = leadcon_header_transparent_class();
leadcon_site_search();
?>

<header id="masthead" class="<?php echo esc_attr( $transparent ); ?> header-1">
	<div class="<?php echo esc_attr( $class ); ?>">
		<div class="site-header-container">
			<?php get_template_part( 'template-parts/header/site-branding' ); ?>

            <div class="menu-toggle-container">
                <a href="#" class="menu-toggle js-canvas-toggle" aria-controls="primary-menu" aria-expanded="false">
                        <span class="menu-toggle-wrapper"></span><!-- .menu-toggle-wrapper -->

                    <span class="screen-reader-text menu-toggle-text"><?php esc_html_e( 'Menu', 'leadcon' ); ?></span>
                </a><!-- .menu-toggle -->
            </div><!-- .menu-toggle-container -->

			<nav id="site-navigation" class="header-navigation main-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'leadcon' ); ?>">
				<?php
				if ( has_nav_menu('primary') ) {
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
						)
					);
				}
				?>
			</nav><!-- #site-navigation -->

            <?php if ( get_theme_mod( 'site_header_icon', true ) === true ) { ?>
                <div class="site-header-minor">
                    <?php leadcon_site_search_toggle(); ?>
                    <div class="site-user-icon">
                        <a href="<?php echo esc_url( home_url( '/my-account' ) ); ?>" class='icon-user'></a>
                    </div>
                    <?php leadcon_header_cart(); ?>
                </div><!-- .site-header-minor -->
            <?php } ?>

            <?php if ( get_theme_mod('button_download',true) === true ) { ?>
                <button class="button-download">
                    <a 
                    href="<?php
                        if ( get_theme_mod( 'link_download' ) ){
                            echo get_theme_mod( 'link_download' );
                        }
                    ?>" target="_blank">
                        <?php echo esc_html__( 'Free Download', 'leadcon' ) ?>
                    </a>                    
                </button>
            <?php } ?>

		</div><!-- .site-header-container -->
	</div><!-- .leadcon-container -->
</header><!-- #masthead -->
