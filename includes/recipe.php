<?php

function cr_recipe_cpt() {
	$labels = [
		'name'                  => _x( 'Mes recettes', 'Post type general name', 'cefimrecettes' ),
		'singular_name'         => _x( 'Ma recette', 'Post type singular name', 'cefimrecettes' ),
		'menu_name'             => _x( 'Mes recettes', 'Admin Menu text', 'cefimrecettes' ),
		'name_admin_bar'        => _x( 'Ma recette', 'Add New on Toolbar', 'cefimrecettes' ),
		'add_new'               => __( 'Ajouter une nouvelle', 'cefimrecettes' ),
		'add_new_item'          => __( 'Ajouter une nouvelle recette', 'cefimrecettes' ),
		'new_item'              => __( 'Nouvelle recette', 'cefimrecettes' ),
		'edit_item'             => __( 'Modifier la recette', 'cefimrecettes' ),
		'view_item'             => __( 'Voir la recette', 'cefimrecettes' ),
		'all_items'             => __( 'Toutes les recettes', 'cefimrecettes' ),
		'search_items'          => __( 'Recherche de recettes', 'cefimrecettes' ),
		'parent_item'           => null,
		'parent_item_colon'     => null,
		'not_found'             => __( 'Aucune recette trouvée.', 'cefimrecettes' ),
		'not_found_in_trash'    => __( 'Aucune recette trouvée dans la poubelle.', 'cefimrecettes' ),
		'featured_image'        => _x( 'Image de couverture de la recette',
			'Overrides the “Featured Image” phrase for this post type. Added in 4.3',
			'cefimrecettes' ),
		'set_featured_image'    => _x( 'Définir l\'image de couverture',
			'Overrides the “Set featured image” phrase for this post type. Added in 4.3',
			'cefimrecettes' ),
		'remove_featured_image' => _x( 'Supprimer l\'image de couverture',
			'Overrides the “Remove featured image” phrase for this post type. Added in 4.3',
			'cefimrecettes' ),
		'use_featured_image'    => _x( 'Utiliser comme image de couverture',
			'Overrides the “Use as featured image” phrase for this post type. Added in 4.3',
			'cefimrecettes' ),
		'archives'              => _x( 'Recettes archivées',
			'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4',
			'cefimrecettes' ),
		'insert_into_item'      => _x( 'Insérer dans les recettes',
			'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4',
			'cefimrecettes' ),
		'uploaded_to_this_item' => _x( 'Téléchargé dans cette recette',
			'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4',
			'cefimrecettes' ),
		'filter_items_list'     => _x( 'Filtrer la liste des recettes',
			'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4',
			'cefimrecettes' ),
		'items_list_navigation' => _x( 'Navigation dans la liste des recettes',
			'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4',
			'cefimrecettes' ),
		'items_list'            => _x( 'Liste des recettes',
			'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4',
			'cefimrecettes' )
	];

	$args = [
		'labels'             => $labels,
		'description'        => 'Un type d\'article personnalisé pour les recettes',
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => [ 'slug' => 'recette' ],
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-carrot',
		'supports'           => [ 'title' ]
	];

	register_post_type( 'recette', $args );

	unset( $args );
	unset( $labels );

	$labels = [
		'name'                       => _x( 'Caractéristiques', 'taxonomy general name', 'cefimrecettes' ),
		'singular_name'              => _x( 'Caractéristique', 'taxonomy singular name', 'cefimrecettes' ),
		'search_items'               => __( 'Rechercher des caractéristiques', 'cefimrecettes' ),
		'popular_items'              => __( 'Caractéristiques populaires', 'cefimrecettes' ),
		'all_items'                  => __( 'Toutes les caractéristiques', 'cefimrecettes' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Modifier la caractéristique', 'cefimrecettes' ),
		'update_item'                => __( 'Mettre à jour la caractéristique', 'cefimrecettes' ),
		'add_new_item'               => __( 'Ajouter une nouvelle caractéristiquer', 'cefimrecettes' ),
		'new_item_name'              => __( 'Nouveau nom de la caractéristique', 'cefimrecettes' ),
		'separate_items_with_commas' => __( 'Séparez les caractéristiques par des virgules', 'cefimrecettes' ),
		'add_or_remove_items'        => __( 'Ajouter ou supprimer des caractéristiques', 'cefimrecettes' ),
		'choose_from_most_used'      => __( 'Choisir parmi les caractéristiques les plus utilisées', 'cefimrecettes' ),
		'not_found'                  => __( 'Aucune caractéristique trouvée.', 'cefimrecettes' ),
		'menu_name'                  => __( 'Caractéristiques', 'cefimrecettes' )
	];

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'show_in_rest'          => true,
		'public'                => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => [ 'slug' => 'caracteristique' ]
	);

	register_taxonomy( 'characteristic', 'recette', $args );
}