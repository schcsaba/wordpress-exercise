<?php

get_header(); ?>

    <main class="main-content">
        <section class="about">
            <div class="container">
                <h1>
					<?php
					$title = carbon_get_theme_option( 'cr_fp_title' );
					if ( isset( $title ) && $title !== '' ) {
						echo $title;
					} else {
						echo 'Un blog de recettes';
					}
					?>
                </h1>
                <p>
					<?php
					$message = carbon_get_theme_option( 'cr_fp_message' );
					if ( isset( $message ) && $message !== '' ) {
						echo $message;
					} else {
						echo 'Bon appétit';
					}
					?>
                </p>
                <a href="
                    <?php
				$link = carbon_get_theme_option( 'cr_fp_btn_link' );
				if ( isset( $link ) && $link !== '' ) {
					echo $link;
				} else {
					echo get_post_type_archive_link( 'post' );
				}
				?>
                    " class="btn">
					<?php
					$btn_text = carbon_get_theme_option( 'cr_fp_button_text' );
					if ( isset( $btn_text ) && $btn_text !== '' ) {
						echo $btn_text;
					} else {
						echo 'Les recettes';
					}
					?>
                </a>
            </div>
        </section>
        <section class="latest-news">
            <div class="container">
				<?php
				$latest_posts = get_posts( [ 'numberposts' => 3 ] );
				if ( $latest_posts ) {
					foreach ( $latest_posts as $post ) {
						setup_postdata( $post ); ?>
                        <article class="card">
							<?php
							echo wp_get_attachment_image( carbon_get_the_post_meta( 'cr_featured_image' ),
								'card-illustration',
								false,
								[ 'class' => 'card-illustration' ] );
							the_category(); ?>
                            <h2 class="card-title"><?php
								the_title(); ?></h2>
                            <p class="card-excerpt"><?php
								the_advanced_excerpt( 'length=20&length_type=words&no_custom=1&ellipsis= [%26hellip;]&exclude_tags=img,p,strong' ); ?></p>
                            <a href="<?php
							the_permalink(); ?>" class="card-link">Lire l'article</a>
                        </article>
						<?php
					}
					wp_reset_postdata();
				}
				?>
            </div>
        </section>
        <section class="popular-recipes" id="popular-recipes">
            <div class="container">
                <h2>Recettes populaires</h2>
                <a href="<?php
				echo get_post_type_archive_link( 'recette' ) ?>" class="see-more">Toutes les recettes</a>
				<?php
				$recipe1         = carbon_get_theme_option( 'cr_fp_recette_pop1' );
				$recipe2         = carbon_get_theme_option( 'cr_fp_recette_pop2' );
				$recipe3         = carbon_get_theme_option( 'cr_fp_recette_pop3' );
				$recipe4         = carbon_get_theme_option( 'cr_fp_recette_pop4' );
				$recipe5         = carbon_get_theme_option( 'cr_fp_recette_pop5' );
				$recipe6         = carbon_get_theme_option( 'cr_fp_recette_pop6' );
				$popular_recipes = [ $recipe1, $recipe2, $recipe3, $recipe4, $recipe5, $recipe6 ];
				function get_random_recipe( $popular_recipes_array ) {
					$recipe_id = 0;
					$args      = [
						'post_type'      => 'recette',
						'orderby'        => 'rand',
						'posts_per_page' => '1',
						'post__not_in'   => $popular_recipes_array
					];
					$recipes   = new WP_Query( $args );
					if ( $recipes->have_posts() ) {
						while ( $recipes->have_posts() ) {
							$recipes->the_post();
							$recipe_id = get_the_ID();
						}
						wp_reset_postdata();
					}

					return $recipe_id;
				}

				foreach ( $popular_recipes as $key => $popular_recipe ) {
					if ( empty( $popular_recipe ) ) {
						$random_recipe           = get_random_recipe( $popular_recipes );
						$popular_recipes[ $key ] = $random_recipe;
					}
				}
				foreach ( $popular_recipes as $popular_recipe ) {
					$recipe = get_post( $popular_recipe ); ?>
                    <article class="card">
						<?= wp_get_attachment_image( carbon_get_post_meta( $recipe->ID, 'cr_recipe_featured_image1' ),
							'card-illustration',
							false,
							[ 'class' => 'card-illustration' ] ) ?>
                        <ul class="card-terms-list">
							<?php
							$terms = get_the_terms( $recipe->ID, 'characteristic' );
							if ( $terms ) {
								foreach ( $terms as $term ) {
									$term_link = get_term_link( $term, 'characteristic' );
									if ( is_wp_error( $term_link ) ) {
										continue;
									}
									echo '<li class="card-terms-item"><a href="' . $term_link . '" class="card-terms-link">' . $term->name . '</a></li>';
								}
							}
							?>
                        </ul>
                        <h3 class="card-title"><?=
							$recipe->post_title ?></h3>
                        <ul class="card-meta-list">
                            <li class="card-meta-item"><?php
								if ( intval( date_format( date_create( carbon_get_post_meta( $recipe->ID,
										'cr_preparation_time' ) ),
										'H' ) ) === 0 ) {
									$format = 'i \m\i\n';
								} else {
									$format = 'G\hi';
								}
								echo date_format( date_create( carbon_get_post_meta( $recipe->ID,
									'cr_preparation_time' ) ),
									$format ); ?></li>
                            <li class="card-meta-item"><?= carbon_get_post_meta( $recipe->ID,
									'cr_number_of_portions' ) ?> portion<?php
								echo carbon_get_post_meta( $recipe->ID,
									'cr_number_of_portions' ) < 2 ? '' : 's' ?></li>
                        </ul>
                        <a href="<?php
						get_the_permalink( $recipe->ID ) ?>" class="card-link">Voir la recette</a>
                    </article>
				<?php
				}
				?>
            </div>
        </section>
        <section class="subscribe">
            <div class="container">
                <div class="subscribe-content">
                    <h2>
						<?php
						$nl_title = carbon_get_theme_option( 'cr_fp_newsletter_title' );
						if ( isset( $nl_title ) && $nl_title !== '' ) {
							echo $nl_title;
						} else {
							echo 'Abonnez-vous à notre newsletter';
						}
						?>
                    </h2>
                    <p>
						<?php
						$nl_message = carbon_get_theme_option( 'cr_fp_newsletter_message' );
						if ( isset( $nl_message ) && $nl_message !== '' ) {
							echo $nl_message;
						} else {
							echo 'Notre lettre d\'information hebdomadaire vous donne de bonnes idées pour créer des menus sains et délicieux.';
						}
						?>
                    </p>
                </div>
                <div class="subscribe-link">
                    <a href="
                            <?php
					$nl_url = carbon_get_theme_option( 'cr_fp_newsletter_url' );
					if ( isset( $nl_url ) && $nl_url !== '' ) {
						echo $nl_url;
					} else {
						echo '#';
					}
					?>
                            " target="_blank" class="btn btn-secondary">
						<?php
						$nl_btn_text = carbon_get_theme_option( 'cr_fp_newsletter_button_text' );
						if ( isset( $nl_btn_text ) && $nl_btn_text !== '' ) {
							echo $nl_btn_text;
						} else {
							echo 'Ajouter mon email à la liste';
						}
						?>
                    </a>
                </div>
            </div>
        </section>
        <section class="who-am-i">
            <div class="container">
                <figure class="who-am-i-illustration">
					<?= wp_get_attachment_image( carbon_get_theme_option( 'cr_fp_whoami_image' ),
						'who-am-i-illustration',
						false ) ?>
                </figure>
                <div class="who-am-i-content">
                    <h2>
						<?php
						$wai_title = carbon_get_theme_option( 'cr_fp_whoami_title' );
						if ( isset( $wai_title ) && $wai_title !== '' ) {
							echo $wai_title;
						} else {
							echo 'Salut !';
						}
						?>
                    </h2>
                    <p>
						<?php
						$wai_description = carbon_get_theme_option( 'cr_fp_whoami_description' );
						if ( isset( $wai_description ) && $wai_description !== '' ) {
							echo $wai_description;
						} else {
							echo 'J\'aime cuisiner des plats sains et délicieux, j\'aime prendre soin des gens, j\'aime faire connaissance avec de nouvelles personnes.';
						}
						?>
                    </p>
                    <a href="
                            <?php
					$wai_page = carbon_get_theme_option( 'cr_fp_whoami_page_link' );
					if ( isset( $wai_page ) && $wai_page !== '' ) {
						echo $wai_page;
					} else {
						echo '#';
					}
					?>
                            " class="btn">
						<?php
						$wai_btn_text = carbon_get_theme_option( 'cr_fp_whoami_button_text' );
						if ( isset( $wai_btn_text ) && $wai_btn_text !== '' ) {
							echo $wai_btn_text;
						} else {
							echo 'En savoir plus';
						}
						?>
                    </a>
                </div>
            </div>
        </section>
    </main>

<?php
get_footer(); ?>