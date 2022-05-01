<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

function cr_attach_theme_options() {
	$cr_generate_options = function(): array {
		$options = [
			get_post_type_archive_link( 'recette' ) => 'Recettes',
			get_post_type_archive_link( 'post' )    => 'Articles'
		];
		$posts   = get_posts( [ 'numberposts' => - 1, 'fields' => 'ids' ] );
		foreach ( $posts as $post ) {
			$options += [ get_permalink( $post ) => 'Article : ' . get_the_title( $post ) ];
		}
		$pages = get_pages();
		foreach ( $pages as $page ) {
			$options += [ get_permalink( $page ) => 'Page : ' . get_the_title( $page ) ];
		}
		$categories = get_terms( 'category', [ 'fields' => 'ids' ] );
		foreach ( $categories as $category ) {
			$options += [ get_category_link( $category ) => 'Catégorie : ' . get_cat_name( $category ) ];
		}
		$characteristics = get_terms( 'characteristic', [ 'fields' => 'ids' ] );
		foreach ( $characteristics as $characteristic ) {
			$options += [ get_category_link( $characteristic ) => 'Caractéristique : ' . get_term( $characteristic )->name ];
		}

		return $options;
	};

	Container::make( 'theme_options', __( 'Options du thème', 'cefimrecettes' ) )
	         ->add_tab( __( 'Identité', 'cefimrecettes' ), [
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
	         ] )
	         ->add_tab( __( 'Page d\'accueil', 'cefimrecettes' ), [
		         Field::make( 'text',
			         'cr_fp_title',
			         __( 'Le titre de la page d\'accueil', 'cefimrecettes' ) ),
		         Field::make( 'textarea',
			         'cr_fp_message',
			         __( 'Message court sur la page d\'accueil', 'cefimrecettes' ) ),
		         Field::make( 'select',
			         'cr_fp_btn_link',
			         __( 'Cible du bouton de la page d\'accueil', 'cefimrecettes' ) )
		              ->set_options( $cr_generate_options ),
		         Field::make( 'text',
			         'cr_fp_button_text',
			         __( 'Le texte du bouton', 'cefimrecettes' ) )
	         ] )
	         ->add_tab( __( 'Liste des recettes', 'cefimrecettes' ), [
		         Field::make( 'text',
			         'cr_recipes_title',
			         __( 'Le titre de la page de la liste des recettes', 'cefimrecettes' ) )
	         ] )
	         ->add_tab( __( 'Page 404', 'cefimrecettes' ), [
		         Field::make( 'text',
			         'cr_404_title',
			         __( 'Le titre de la page 404', 'cefimrecettes' ) ),
		         Field::make( 'textarea',
			         'cr_404_content',
			         __( 'Le contenu de la page 404', 'cefimrecettes' ) )
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
