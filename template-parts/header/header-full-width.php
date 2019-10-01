<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'leadcon' ); ?></a>
	<?php

	if ( get_theme_mod( 'stickymenu', true) === true ) {
		get_template_part( 'template-parts/header/sticky-menu' );
	}
	$header_layout = get_query_var( 'header_layout' ) ? get_query_var( 'header_layout' ) : '1';

	leadcon_get_header();
	global $wp_query;


	?>

	<div class="site-content<?php echo esc_attr( ( $header_layout === '7' ) ? ' site-right': '' ); ?>">

		<?php
		leadcon_page_header();
			$class = ( (!is_single() && !is_shop()  && ! is_home() && !is_cart() && !is_product() &&  !is_account_page() &&  !is_checkout() || $header_layout === '7' )  ) ? 'content-page': 'page-content';
		?>
		<div id="content" class="<?php echo esc_attr( $class ) ?>">
			<div class="leadcon-container container-extend">
