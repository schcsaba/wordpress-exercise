<?php

use Carbon_Fields\Container;
use Carbon_Fields\Block;
use Carbon_Fields\Field;

function cr_attach_theme_options() {
	$cr_generate_options = function (): array {
		$options = [
			get_post_type_archive_link( 'recette' ) => 'Recettes',
			get_post_type_archive_link( 'post' )    => 'Articles'
		];
		$posts   = get_posts( [ 'numberposts' => - 1, 'fields' => 'ids' ] );
		foreach ( $posts as $post ) {
			$options += [ get_permalink( $post ) => 'Article : ' . get_the_title( $post ) ];
		}
		$recipes = get_posts( [ 'numberposts' => - 1, 'fields' => 'ids', 'post_type' => 'recette' ] );
		foreach ( $recipes as $recipe ) {
			$options += [ get_permalink( $recipe ) => 'Recette : ' . get_the_title( $recipe ) ];
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

	$cr_generate_recipe_options = function (): array {
		$options = [ '' => 'Veuillez choisir une option' ];
		$recipes = get_posts( [ 'numberposts' => - 1, 'fields' => 'ids', 'post_type' => 'recette' ] );
		foreach ( $recipes as $recipe ) {
			$options += [ $recipe => get_the_title( $recipe ) ];
		}

		return $options;
	};

	$cr_generate_page_options = function (): array {
		$options = [];
		$pages   = get_pages();
		foreach ( $pages as $page ) {
			$options += [ get_permalink( $page ) => get_the_title( $page ) ];
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
			         __( 'Le texte du bouton', 'cefimrecettes' ) ),
		         Field::make( 'separator',
			         'cr_popular_recipes_separator',
			         __( 'Recettes populaires', 'cefimrecettes' ) ),
		         Field::make( 'select',
			         'cr_fp_recette_pop1',
			         __( 'Recette populaire #1', 'cefimrecettes' ) )
		              ->set_options( $cr_generate_recipe_options )
		              ->set_width( 50 ),
		         Field::make( 'select',
			         'cr_fp_recette_pop2',
			         __( 'Recette populaire #2', 'cefimrecettes' ) )
		              ->set_options( $cr_generate_recipe_options )
		              ->set_width( 50 ),
		         Field::make( 'select',
			         'cr_fp_recette_pop3',
			         __( 'Recette populaire #3', 'cefimrecettes' ) )
		              ->set_options( $cr_generate_recipe_options )
		              ->set_width( 50 ),
		         Field::make( 'select',
			         'cr_fp_recette_pop4',
			         __( 'Recette populaire #4', 'cefimrecettes' ) )
		              ->set_options( $cr_generate_recipe_options )
		              ->set_width( 50 ),
		         Field::make( 'select',
			         'cr_fp_recette_pop5',
			         __( 'Recette populaire #5', 'cefimrecettes' ) )
		              ->set_options( $cr_generate_recipe_options )
		              ->set_width( 50 ),
		         Field::make( 'select',
			         'cr_fp_recette_pop6',
			         __( 'Recette populaire #6', 'cefimrecettes' ) )
		              ->set_options( $cr_generate_recipe_options )
		              ->set_width( 50 ),
		         Field::make( 'separator', 'cr_newsletter_separator', __( 'Newsletter', 'cefimrecettes' ) ),
		         Field::make( 'text',
			         'cr_fp_newsletter_title',
			         __( 'Titre de la section de la newsletter', 'cefimrecettes' ) ),
		         Field::make( 'textarea',
			         'cr_fp_newsletter_message',
			         __( 'Message de la section de la newsletter', 'cefimrecettes' ) ),
		         Field::make( 'text',
			         'cr_fp_newsletter_button_text',
			         __( 'Le texte du bouton de la section de la newsletter', 'cefimrecettes' ) ),
		         Field::make( 'text',
			         'cr_fp_newsletter_url',
			         __( 'L\'URL du bouton de la section de la newsletter', 'cefimrecettes' ) ),
		         Field::make( 'separator', 'cr_whoami_separator', __( 'Qui je suis', 'cefimrecettes' ) ),
		         Field::make( 'image',
			         'cr_fp_whoami_image',
			         __( 'Image', 'cefimrecettes' ) )
		              ->set_required( true ),
		         Field::make( 'text',
			         'cr_fp_whoami_title',
			         __( 'Titre', 'cefimrecettes' ) ),
		         Field::make( 'textarea',
			         'cr_fp_whoami_description',
			         __( 'Description', 'cefimrecettes' ) ),
		         Field::make( 'text',
			         'cr_fp_whoami_button_text',
			         __( 'Le texte du bouton', 'cefimrecettes' ) ),
		         Field::make( 'select',
			         'cr_fp_whoami_page_link',
			         __( 'Page à propos', 'cefimrecettes' ) )
		              ->set_options( $cr_generate_page_options )
	         ] )
	         ->add_tab( __( 'Liste des recettes', 'cefimrecettes' ), [
		         Field::make( 'text',
			         'cr_recipes_title',
			         __( 'Le titre de la page de la liste des recettes', 'cefimrecettes' ) )
	         ] )
	         ->add_tab( __( 'Page contact', 'cefimrecettes' ), [
		         Field::make( 'text',
			         'cr_contact_title',
			         __( 'Le titre de la page contact', 'cefimrecettes' ) ),
		         Field::make( 'rich_text',
			         'cr_contact_content',
			         __( 'Le contenu de la page contact', 'cefimrecettes' ) ),
		         Field::make( 'complex', 'cr_workshop_markers', __( 'Marqueurs d\'ateliers', 'cefimrecettes' ) )
		              ->add_fields( [
			              Field::make( 'text', 'cr_workshop_name', __( 'Nom de l\'atelier', 'cefimrecettes' ) )
			                   ->set_required( true ),
			              Field::make( 'text', 'cr_workshop_address', __( 'Adresse de l\'atelier', 'cefimrecettes' ) )
			                   ->set_required( true ),
			              Field::make( 'text',
				              'cr_workshop_tel',
				              __( 'Numéro de téléphone de l\'atelier', 'cefimrecettes' ) )
			                   ->set_attribute( 'type', 'tel' )
			                   ->set_attribute( 'placeholder', '+33712345678' ),
			              Field::make( 'text', 'cr_workshop_email', __( 'E-mail de l\'atelier', 'cefimrecettes' ) )
			                   ->set_attribute( 'type', 'email' )
			                   ->set_attribute( 'placeholder', 'info@mesrecettes.com' ),
			              Field::make( 'text', 'cr_workshop_url', __( 'Url de l\'atelier', 'cefimrecettes' ) )
			                   ->set_attribute( 'type', 'url' )
			                   ->set_attribute( 'placeholder', 'https://www.mesrecettes.com' ),
		              ] )
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
			              'plural_name' => 'Étapes de préparation',
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

function cr_select_recipe_block() {
	Block::make( __( 'Recette', 'cefimrecettes' ) )
	     ->add_fields( [
		     Field::make( 'association', 'cr_block_recipe', __( 'Recette liée', 'cefimrecettes' ) )
		          ->set_types( [ [ 'type' => 'post', 'post_type' => 'recette' ] ] )
		          ->set_max( 1 )
	     ] )
	     ->set_icon( 'dashicons dashicons-carrot' )
	     ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
		     $recipe = get_post( $fields['cr_block_recipe'][0]['id'] );
		     ?>
             <h2>Recette liée</h2>
             <div class="blog-grid">
                 <article class="card">
				     <?= wp_get_attachment_image( carbon_get_post_meta( $recipe->ID, 'cr_recipe_featured_image1' ),
					     'card-illustration',
					     false,
					     [ 'class' => 'card-illustration' ] ) ?>
                     <h3 class="card-title"><?=
					     $recipe->post_title ?></h3>
                     <a href="<?php
				     echo get_the_permalink( $recipe->ID ) ?>" class="card-link">Voir la recette</a>
                 </article>
             </div>
		     <?php
	     } );
}
