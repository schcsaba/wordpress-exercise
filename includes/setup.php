<?php

function cr_setup_theme() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'logo', 120, 50, true );

	add_theme_support( 'html5', [ 'search-form' ] );

	register_nav_menus( [
		'main-nav'   => __( 'Navigation principale', 'cefimrecettes' ),
		'footer-nav' => __( 'Navigation pied de page', 'cefimrecettes' ),
		'social-nav' => __( 'Réseaux sociaux', 'cefimrecettes' )
	] );
}

function add_link_atts( $atts ) {
	$atts['class'] = "menu-link";

	return $atts;
}