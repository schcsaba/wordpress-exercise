<?php

// Setup
const CR_DEV_MODE = true;

// Includes
include get_theme_file_path( '/includes/setup.php' );
include get_theme_file_path( '/includes/carbonfields.php' );
include get_theme_file_path( '/includes/front/enqueue.php' );
include get_theme_file_path( '/includes/front/pagination.php' );

// Hooks
add_action( 'after_setup_theme', 'cr_setup_theme' );
add_action( 'wp_enqueue_scripts', 'cr_enqueue' );
add_filter( 'nav_menu_link_attributes', 'add_link_atts');
add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );