<?php
/**
 * Display the footer widget area
 *
 * @package leadcon
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>

<aside class="widget-area footer-widget-area" role="complementary">
	<div class="container">
		<div class="footer-widgets">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div><!-- .footer-widget -->
	</div><!-- .leadcon-container -->
</aside><!-- .footer-widget-area -->
