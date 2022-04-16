<?php

function cr_setup_theme() {
	add_theme_support( 'title-tag' );
}

add_action( 'after_setup_theme', 'cr_setup_theme' );