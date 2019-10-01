<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package leadcon
 */

$container = get_post_meta( get_the_ID(), 'container', true );
$customize = get_theme_mod( 'site_container');

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
    if ( get_theme_mod( 'preload', true ) === true ) {
        get_template_part( 'template-parts/header/preload-effect' );
    }
    leadcon_site_header();
?>


