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
                <article class="card">
                    <img src="img/perfect_peach_card.jpg" alt="Des abricots et de la menthe" class="card-illustration">
                    <ul class="card-terms-list">
                        <li class="card-terms-item">
                            <a href="category.html" class="card-terms-link">Tips</a>
                        </li>
                    </ul>
                    <h2 class="card-title">Choisir les abricots</h2>
                    <p class="card-excerpt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam accusantium
                        quos quae iusto totam velit [...]</p>
                    <a href="article.html" class="card-link">Lire l'article</a>
                </article>
            </div>
        </section>
        <section class="popular-recipes" id="popular-recipes">
            <div class="container">
                <h2>Recettes populaires</h2>
                <a href="recipe-list.html" class="see-more">Toutes les recettes</a>
                <article class="card">
                    <img src="img/pho_boeuf_card.jpg" alt="Pho au boeuf" class="card-illustration">
                    <ul class="card-terms-list">
                        <li class="card-terms-item">
                            <a href="recipe-list-category.html" class="card-terms-link">Soupe</a>
                        </li>
                        <li class="card-terms-item">
                            <a href="recipe-list-category.html" class="card-terms-link">Asiatique</a>
                        </li>
                    </ul>
                    <h3 class="card-title">Phô au boeuf </h3>
                    <ul class="card-meta-list">
                        <li class="card-meta-item">45 min</li>
                        <li class="card-meta-item">6-8 portions</li>
                    </ul>
                    <a href="recipe.html" class="card-link">Voir la recette</a>
                </article>
            </div>
        </section>
        <section class="subscribe">
            <div class="container">
                <div class="subscribe-content">
                    <h2>Abonnez-vous à notre newsletter</h2>
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                        ut labore et dolore</p>
                </div>
                <div class="subscribe-link">
                    <a href="#" class="btn btn-secondary">Ajouter mon email à la liste</a>
                </div>
            </div>
        </section>
        <section class="who-am-i">
            <div class="container">
                <figure class="who-am-i-illustration">
                    <img src="img/laura.jpg" alt="Hi hi hi, je suis Laura">
                </figure>
                <div class="who-am-i-content">
                    <h2>Salut, je suis Laura !</h2>
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                        ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                        dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est. ed diam nonumy
                        eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos
                        et accusam</p>
                    <a href="page.html" class="btn">En savoir plus</a>
                </div>
            </div>
        </section>
    </main>

<?php
get_footer(); ?>