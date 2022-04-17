<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

function cr_attach_theme_options() {
	Container::make( 'theme_options', __( 'Options du thème', 'cefimrecettes' ) )
	         ->add_fields( [
		         Field::make( 'checkbox',
			         'cr_show_logo',
			         __( 'Afficher le logo au lieu du nom du site', 'cefimrecettes' ) )
		              ->set_option_value( 'yes' ),
		         Field::make( 'image',
			         'cr_logo',
			         __( 'Logo', 'cefimrecettes' ) )
		              ->set_conditional_logic( [
			              [
				              'field' => 'cr_show_logo',
				              'value' => true
			              ]
		              ] )
	         ] );
	Container::make( 'post_meta', __( 'Autres données', 'cefimrecettes' ) )
	         ->where( 'post_type', '=', 'post' )
	         ->add_fields( [
		         Field::make( 'image',
			         'cr_featured_image',
			         __( 'Image mis en avant', 'cefimrecettes' ) )
			         ->set_required( true )
	         ] );
}
