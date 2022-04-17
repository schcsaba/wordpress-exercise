<?php

function cr_setup_theme() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'html5', [ 'search-form' ] );

	add_image_size( 'logo', 120, 50, true );
	add_image_size( 'card-illustration', 320, 480, true );
	add_image_size( 'post-header-img', 1020, 680, true );

	register_nav_menus( [
		'main-nav'   => __( 'Navigation principale', 'cefimrecettes' ),
		'footer-nav' => __( 'Navigation pied de page', 'cefimrecettes' ),
		'social-nav' => __( 'Réseaux sociaux', 'cefimrecettes' )
	] );
}

function cr_add_link_atts( $atts, $item ) {
	$atts['class'] = 'menu-link';
	if ( in_array( 'current_page_item', $item->classes ) ) {
		$atts['class'] = 'menu-link active';
	}

	return $atts;
}

function cr_change_category_list_classes( $thelist ) {
	if ( is_home() || is_category() ) {
		$search  = [ 'post-categories', '<li>', '<a ' ];
		$replace = [ 'card-terms-list', '<li class="card-terms-item">', '<a class="card-terms-link" ' ];
		$thelist = str_replace( $search, $replace, $thelist );
	}

	return $thelist;
}

function cr_gutenberg_blocks( $block_types, $post ) {
	$limited = [
		'core/paragraph',
		'core/heading',
		'core/list',
		'core/image'
	];
	if ( $post->post_type == 'post' ) {
		$allowed = $limited;
	} else {
		$allowed = $block_types;
	}

	return $allowed;
}