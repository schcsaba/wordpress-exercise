<?php

function cr_setup_theme() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'html5', [ 'search-form' ] );

	add_image_size( 'logo', 120, 50, true );
	add_image_size( 'card-illustration', 320, 480, true );
	add_image_size( 'post-header-img', 1020, 680, true );
	add_image_size( 'recipe-illustration', 485, 600, true );
	add_image_size( 'recipe-illustration-small', 485, 485, true );
	add_image_size( 'who-am-i-illustration', 310, 440, true );

	register_nav_menus( [
		'main-nav'   => __( 'Navigation principale', 'cefimrecettes' ),
		'footer-nav' => __( 'Navigation pied de page', 'cefimrecettes' ),
		'social-nav' => __( 'Réseaux sociaux', 'cefimrecettes' )
	] );
}

function cr_add_link_atts( $atts, $item ) {
	$atts['class'] = 'menu-link';
	if ( in_array( 'current_page_item', $item->classes ) || in_array( 'current-menu-item', $item->classes ) ) {
		$atts['class'] = 'menu-link active';
	}

	return $atts;
}

function cr_change_category_list_classes( $thelist ) {
	if ( is_home() || is_category() || is_front_page() ) {
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

function cr_set_posts_per_page( $query ) {
	global $wp_the_query;

	if ( ( ! is_admin() ) && ( $query === $wp_the_query ) && ( $query->is_search() || $query->is_post_type_archive( 'recette' ) ) ) {
		$query->set( 'posts_per_page', 12 );
	}

	return $query;
}

function cr_cf7_filter( $output, $tag, $atts, $m ) {
	if ( $tag === 'contact-form-7' ) {
		$output = str_replace(
			[
				'<p>',
				'</span></p>',
				'wpcf7-submit" /></p>',
				'<br />',
				'<div class="form-group"><label for="msg">',
				'<div class="form-group"><span class="wpcf7-form-control-wrap accept">',
				'<div class="form-group"><input type="submit"',
				'</small></label></p>',
				'<input type="submit" value="Envoyer" class="wpcf7-form-control has-spinner wpcf7-submit" />',
				'<div class="form-group"><small><em>'
			],
			[
				'<div class="form-group">',
				'</span></div>',
				'wpcf7-submit" /></div>',
				'',
				'<div class="form-group full-width"><label for="msg">',
				'<div class="form-group full-width accept"><span class="wpcf7-form-control-wrap acceptance">',
				'<div class="form-group full-width submit"><input type="submit"',
				'</small></label></div>',
				'<button type="submit" class="wpcf7-form-control wpcf7-submit btn btn-secondary">Envoyer</button>',
				'<p><small><em>'
			],
			$output
		);
	}

	return $output;
}