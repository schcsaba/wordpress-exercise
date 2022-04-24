<?php

get_header(); ?>

<main class="main-content">
	<?php
	if ( have_posts() ) {
	while ( have_posts() ) {
	the_post(); ?>
    <article class="recipe">
        <header class="recipe-header">
            <div class="container">
                <div class="recipe-header-img">
					<?= wp_get_attachment_image( carbon_get_the_post_meta( 'cr_recipe_featured_image1' ),
						'recipe-illustration',
						false,
						[ 'class' => 'recipe-illustration' ] ) ?>
                </div>
                <div class="recipe-header-img">
					<?= wp_get_attachment_image( carbon_get_the_post_meta( 'cr_recipe_featured_image2' ),
						'recipe-illustration',
						false,
						[ 'class' => 'recipe-illustration' ] ) ?>
                </div>
                <div class="recipe-header-content">
                    <h1 class="recipe-title"><?php
						the_title(); ?></h1>
                    <ul class="recipe-meta-list">

                        <li class="recipe-meta-item quantity"><?= carbon_get_post_meta( get_the_ID(),
								'cr_number_of_portions' ) ?> portion<?php
							echo carbon_get_post_meta( get_the_ID(),
								'cr_number_of_portions' ) < 2 ? '' : 's' ?></li>
                        <li class="recipe-meta-item duration"><?php
							if ( intval( date_format( date_create( carbon_get_the_post_meta( 'cr_preparation_time' ) ),
									'H' ) ) === 0 ) {
								$format = 'i \m\i\n';
							} else {
								$format = 'G\hi';
							}
							echo date_format( date_create( carbon_get_the_post_meta( 'cr_preparation_time' ) ),
								$format ); ?></li>
                    </ul>
                    <ul class="recipe-terms-list">
						<?php
						$terms = get_the_terms( get_the_ID(), 'characteristic' );
						foreach ( $terms as $term ) {
							$term_link = get_term_link( $term, 'characteristic' );
							if ( is_wp_error( $term_link ) ) {
								continue;
							}
							echo '<li class="recipe-terms-item"><a href="' . $term_link . '" class="recipe-terms-link">' . $term->name . '</a></li>';
						}
						?>
                    </ul>
                    <div class="recipe-ingredients-content">
                        <h2>Ingrédients</h2>
                        <ul class="recipe-ingredients-list">
							<?php
							$ingredients = carbon_get_post_meta( get_the_ID(), 'cr_ingredients' );
							if ( $ingredients ) {
								foreach ( $ingredients as $ingredient ) {
									echo '<li class="recipe-ingredients-item">' . $ingredient['cr_ingredient'] . '</li>';
								}
							}
							?>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <section class="recipe-steps">
            <div class="container">
                <h2>Préparation</h2>
                <ol class="recipe-steps-list">
					<?php
					$etapes = carbon_get_post_meta( get_the_ID(), 'cr_etapes' );
					if ( $etapes ) {
						foreach ( $etapes as $etape ) {
							echo '<li class="recipe-steps-item">' . $etape['cr_etape'] . '</li>';
						}
					}
					?>
                </ol>
            </div>
        </section>
		<?php
		$recettesliees = carbon_get_post_meta( get_the_ID(), 'cr_recettes_liees' );
		if ( $recettesliees ) {
			?>
            <footer class="related-recipes">
            <div class="container">
            <h2>Vous pourriez aussi aimer ...</h2>
            <div class="blog-grid">
			<?php
			foreach ( $recettesliees as $recetteliee ) {
				$terms = get_the_terms( $recetteliee['cr_recette_liee'][0]['id'], 'characteristic' ); ?>
                <article class="card">
					<?php
					echo wp_get_attachment_image( carbon_get_post_meta( $recetteliee['cr_recette_liee'][0]['id'],
						'cr_recipe_featured_image1' ),
						'card-illustration',
						false,
						[ 'class' => 'card-illustration' ] ); ?>
                    <ul class="card-terms-list">
						<?php
						foreach ( $terms as $term ) {
							$term_link = get_term_link( $term, 'characteristic' );
							if ( is_wp_error( $term_link ) ) {
								continue;
							} ?>
                            <li class="card-terms-item"><a href="<?= $term_link ?>"
                                                           class="card-terms-link"><?= $term->name ?></a></li>
							<?php
						} ?>
                    </ul>
                    <h3 class="card-title"><?= get_post( $recetteliee['cr_recette_liee'][0]['id'] )->post_title ?></h3>
                    <ul class="card-meta-list">
                        <li class="card-meta-item"><?php
							if ( intval( date_format( date_create( carbon_get_post_meta( $recetteliee['cr_recette_liee'][0]['id'],
									'cr_preparation_time' ) ),
									'H' ) ) === 0 ) {
								$format = 'i \m\i\n';
							} else {
								$format = 'G\hi';
							}
							echo date_format( date_create( carbon_get_post_meta( $recetteliee['cr_recette_liee'][0]['id'],
								'cr_preparation_time' ) ),
								$format ); ?></li>
                        <li class="card-meta-item"><?=
							carbon_get_post_meta( $recetteliee['cr_recette_liee'][0]['id'],
								'cr_number_of_portions' ); ?>
                            portion<?= carbon_get_post_meta( $recetteliee['cr_recette_liee'][0]['id'],
								'cr_number_of_portions' ) < 2 ? '' : 's'; ?>
                    </ul>
                    <a href="<?= get_permalink( $recetteliee['cr_recette_liee'][0]['id'] ) ?>" class="card-link">Voir la
                        recette</a>
                </article>
                </div>
                </div>
                </footer><?php
			}
		}
		}
		} else { ?>
            <p>Cette recette n'existe pas.</p><?php
		} ?>
</main>

<?php
get_footer(); ?>
