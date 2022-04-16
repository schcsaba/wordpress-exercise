<?php

// Setup
const CR_DEV_MODE = true;

function cr_setup_theme() {
	add_theme_support( 'title-tag' );
}

// Includes
include get_theme_file_path( '/includes/front/enqueue.php' );

// Hooks
add_action( 'after_setup_theme', 'cr_setup_theme' );
add_action( 'wp_enqueue_scripts', 'cr_enqueue' );
