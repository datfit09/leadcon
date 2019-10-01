<?php
/**
 * Display header layout 3
 *
 * @package Ht leadcon
 */
$class = leadcon_site_header_container_class();
leadcon_site_search();
?>
<div class="header-top">
    <div class="<?php echo esc_attr( $class ); ?>">
        <div class="top-bar-content">
            <div class="wellcome">
                <span class="wellcome-text">
                    <ul class="list-contact">
                        <li class="item-contact icon-mail-black-envelope-symbol">
                            <span class="email">
                                <?php if ( ! get_theme_mod( 'email' ) ): ?>
                                    <?php echo esc_html__( 'leadcon@support.com', 'leadcon' ) ?>
                                <?php endif ?>

                                <?php if ( get_theme_mod( 'email' ) ): ?>
                                    <?php echo get_theme_mod( 'email' ); ?>
                                <?php endif ?>

                            </span>
                        </li>
                        
                        <li class="item-contact icon-telephone">
                            <span class="phone">
                                <?php 
                                if ( ! get_theme_mod( 'phone' ) ){
                                    echo esc_html__( '+053 569 7810', 'leadcon' );
                                }

                                if ( get_theme_mod( 'phone' ) ){
                                    echo get_theme_mod( 'phone' );
                                }
                                ?>                                
                            </span>
                        </li>
                    </ul>
                </span>
            </div>

            <div class="menu-topbar">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'social',
                        'menu_id'        => 'social-menu',
                    )
                );
                ?>
            </div>

            <div class="text-language">
                <?php
                    if ( ! get_theme_mod( 'language' ) ) {
                        echo esc_html__( 'English', 'leadcon' );
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<header id="masthead" class="site-header header-3">
    <!-- <div class="container"> -->
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
            </nav>

            <div class="site-header-minor">
                <div>
                    <a href="<?php echo esc_url( home_url( '/my-account' ) ); ?>" class='icon-header-user'></a>
                </div>
                <?php
                leadcon_site_search_toggle();
                ?>
            </div><!-- .site-header-minor -->
        </div>
    </div>

    <!-- </div>.leadcon-container -->
</header><!-- #masthead -->
