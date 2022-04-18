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
}

function cr_add_post_featured_image() {
	Container::make( 'post_meta', __( 'Autres données', 'cefimrecettes' ) )
	         ->where( 'post_type', '=', 'post' )
	         ->add_fields( [
		         Field::make( 'image',
			         'cr_featured_image',
			         __( 'Image mis en avant', 'cefimrecettes' ) )
		              ->set_required( true )
	         ] );
}

function cr_add_recipe_data_fields() {
	Container::make( 'post_meta', __( 'Autres données', 'cefimrecettes' ) )
	         ->where( 'post_type', '=', 'recette' )
	         ->add_tab( __( 'Images mises en avant', 'cefimrecettes' ), [
		         Field::make( 'image',
			         'cr_recipe_featured_image1',
			         __( 'Image #1 mis en avant', 'cefimrecettes' ) )
		              ->set_required( true )
		              ->set_width( 50 ),
		         Field::make( 'image',
			         'cr_recipe_featured_image2',
			         __( 'Image #2 mis en avant', 'cefimrecettes' ) )
		              ->set_width( 50 )
	         ] )
	         ->add_tab( __( 'Données numériques', 'cefimrecettes' ), [
		         Field::make( 'text', 'cr_number_of_portions', __( 'Nombre de portions', 'cefimrecettes' ) )
		              ->set_attribute( 'type', 'number' )
		              ->set_required( true )
		              ->set_width( 50 ),
		         Field::make( 'time', 'cr_preparation_time', __( 'Temps de préparation', 'cefimrecettes' ) )
		              ->set_input_format( 'H:i', 'H:i' )
		              ->set_picker_options( [
			              'enableSeconds' => false,
			              'time_24hr'     => true,
			              'defaultHour'   => 0,
			              'defaultMinute' => 30
		              ] )
		              ->set_required( true )
		              ->set_width( 50 )
	         ] )
	         ->add_tab( __( 'Ingrédients', 'cefimrecettes' ), [
		         Field::make( 'complex', 'cr_ingredients', __( 'Ingrédients', 'cefimrecettes' ) )
		              ->add_fields( [
			              Field::make( 'text', 'cr_ingredient', __( 'Ingrédient', 'cefimrecettes' ) )
		              ] )
		              ->set_min( 1 )
		              ->setup_labels( [ 'plural_name' => 'Ingrédients', 'singular_name' => 'Ingrédient' ] )
		              ->set_required( true )
	         ] )
	         ->add_tab( __( 'Étapes de préparation', 'cefimrecettes' ), [
		         Field::make( 'complex', 'cr_etapes', __( 'Étapes de préparation', 'cefimrecettes' ) )
		              ->add_fields( [
			              Field::make( 'text', 'cr_etape', __( 'Étape de préparation', 'cefimrecettes' ) )
		              ] )
		              ->set_min( 1 )
		              ->setup_labels( [
			              'plural_name'   => 'Étapes de préparation',
			              'singular_name' => 'Étape de préparation'
		              ] )
		              ->set_required( true )
	         ] )
	         ->add_tab( __( 'Recettes liées', 'cefimrecettes' ), [
		         Field::make( 'complex', 'cr_recettes_liees', __( 'Recettes liées', 'cefimrecettes' ) )
		              ->add_fields( [
			              Field::make( 'association', 'cr_recette_liee', __( 'Recette liée', 'cefimrecettes' ) )
			                   ->set_types( [ [ 'type' => 'post', 'post_type' => 'recette' ] ] )
		              ] )
		              ->set_max( 3 )
		              ->setup_labels( [ 'plural_name' => 'Recettes liées', 'singular_name' => 'Recette liée' ] )
	         ] );
}
