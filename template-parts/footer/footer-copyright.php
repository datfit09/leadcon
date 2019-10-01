<?php
/**
 * Display footer copyright
 *
 * @package leadcon
 */
?>

<div class="site-copyright">
	<?php
	// Get the footer copyright text
	$footer_copyright = get_theme_mod( 'leadcon_footer_copyright' );

	if ( $footer_copyright ) {
		// If we have custom footer text, use it
		echo wp_kses_post( $footer_copyright );
	} else {
		// Otherwise, use the default one
		echo wp_kses_post( leadcon_default_footer_copyright() );
	}
	?>
</div><!-- .site-copyright -->
