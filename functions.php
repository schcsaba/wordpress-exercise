<?php

// Setup
const CR_DEV_MODE = true;

// Includes
include get_theme_file_path( '/includes/setup.php' );
include get_theme_file_path( '/includes/carbonfields.php' );
include get_theme_file_path( '/includes/front/enqueue.php' );
include get_theme_file_path( '/includes/front/pagination.php' );
include get_theme_file_path( '/includes/recipe.php' );

// Hooks
add_action( 'after_setup_theme', 'cr_setup_theme' );
add_action( 'wp_enqueue_scripts', 'cr_enqueue' );
add_action( 'carbon_fields_register_fields', 'cr_attach_theme_options' );
add_action( 'init', 'cr_recipe_cpt' );
add_action( 'carbon_fields_register_fields', 'cr_add_post_featured_image' );
add_action( 'carbon_fields_register_fields', 'cr_add_recipe_data_fields' );

add_filter( 'nav_menu_link_attributes', 'cr_add_link_atts', 10, 2 );
add_filter( 'the_category', 'cr_change_category_list_classes' );
add_filter( 'allowed_block_types', 'cr_gutenberg_blocks', 11, 2 );