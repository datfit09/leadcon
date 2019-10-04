<?php
/**
 * The template for display Page Header
 *
 * @package leadcon
 */

if ( is_front_page() || is_404() ) {
    return;
}

$lc_page_header = '';
if( class_exists('acf') ) {
    $lc_page_header = get_field('lc_page_header');
}

?>
<?php if( $lc_page_header !== ['hidden_page_header']) {?>
    <header class="page-header">
    	<div class="page-header-container container">
    		<?php
    		if ( is_home() || is_single() ) :
    			$has_post_title = (bool) single_post_title( '', false );

    			if ( $has_post_title ) :
    				if ( class_exists( 'WooCommerce' ) ) {
    					if ( ! is_product() ) {
    					?>
    						<h1 class="page-title"><?php single_post_title(); ?></h1>
    					<?php
    					}
    				}
    				else {
    					?>
    						<h1 class="page-title"><?php single_post_title(); ?></h1>
    					<?php
    				}

    			endif;
    		elseif ( is_search() ) :
    			?>

    			<h1 class="page-title">
    				<?php
    				/* translators: %s: search query. */
    				printf( esc_html__( 'Search Results for: %s', 'leadcon' ), '<span>' . get_search_query() . '</span>' );
    				?>
    			</h1>

    			<?php
    		elseif ( is_archive() ) :

    			if ( class_exists( 'WooCommerce' ) ) {
    				if ( is_shop() ) {
    					echo '<h1 class="page-title">Shop</h1>';
    				}
    				else {
    					the_archive_title( '<h1 class="page-title">', '</h1>' );
    				}
    			}
    			else {
    				the_archive_title( '<h1 class="page-title">', '</h1>' );
    			}

    		else :
    				echo '<h1 class="page-title">'.get_the_title().'</h1>';
    		endif;
    		?>

            <?php if ( is_page() ) { ?>
            <div class="container">
                <div class="description-page">
                    <?php
                    if ( get_theme_mod( 'description_page' ) ){
                        echo get_theme_mod( 'description_page' );
                    }
                    ?>
                </div>
            </div>
            <?php } ?>

            <?php /*if ( get_theme_mod( 'breadcrumb', true ) === true ) {*/ ?>
                <div class="breadcrumb"><!-- breadcrumb -->
                    <div class="container container-breadcrumb">
                    <?php
                    /*if ( leadcon_is_woocommerce_activated() ) :
                        woocommerce_breadcrumb();
                    endif;*/
                    ?>
                    </div>
                </div><!-- breadcrumb -->
            <?php /*}*/ ?>

    	</div><!-- .page-header-container -->
    </header><!-- .page-header -->
<?php } ?>

