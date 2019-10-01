<?php


/**
 * General
 */

// THEME SETUP
add_action( 'after_setup_theme', 'leadcon_setup' );

// Query Var
add_filter( 'query_vars', 'leadcon_register_query_vars' );
