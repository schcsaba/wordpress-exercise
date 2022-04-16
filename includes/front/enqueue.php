<?php

function cr_enqueue() {
	$uri = get_theme_file_uri();
	$ver = CR_DEV_MODE ? time() : false;
	wp_register_style( 'cr_reset', $uri . '/css/reset.css', [], $ver );
	wp_register_style( 'cr_style', $uri . '/css/style.css', [], $ver );
	wp_enqueue_style( 'cr_reset' );
	wp_enqueue_style( 'cr_style' );
}