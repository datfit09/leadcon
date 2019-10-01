<?php
/**
 * Displays header site branding
 */
?>

<div class="site-branding">
	<?php
	if ( has_custom_logo() ) :

		the_custom_logo();
		if ( is_front_page() && ! is_paged() ) :
			?>
			<h1 class="site-title screen-reader-text"><?php bloginfo( 'name' ); ?></h1>
			<?php
		endif;

	else :

		if ( is_front_page() && is_home() ) :
			?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php
		else :
			?>
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
		endif;

		$leadcon_description = get_bloginfo( 'description', 'display' );
		if ( $leadcon_description || is_customize_preview() ) :
			?>
			<p class="site-description"><?php echo esc_html( $leadcon_description ); /* WPCS: xss ok. */ ?></p>
		<?php endif; ?>

	<?php endif; ?><!-- end has_custom_logo() check -->
</div><!-- .site-branding -->
