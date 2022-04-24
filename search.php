<?php

get_header();
global $wp_query;
?>
    <main class="main-content">
        <div class="container">
			<?php
			if ( have_posts() ) {
				?>
                <h1>Résultats de la recherche "<?php
					echo get_search_query(); ?>"</h1>
                <p>Votre recherche a retourné <?= $wp_query->found_posts ?> résultat<?php
					echo $wp_query->found_posts < 2 ? '' : 's' ?></p>
                <ul class="search-results-list">
					<?php
					while ( have_posts() ) {
						the_post(); ?>
                        <li class="search-results-item">
                            <h2><?php
								the_title(); ?></h2>
							<?php
							the_excerpt(); ?>
                            <a href="<?php
							the_permalink(); ?>">Lire la suite</a>
                        </li>
						<?php
					} ?>
                </ul>
				<?php
				cr_number_pagination( $wp_query ); ?>
				<?php
			} else { ?>
                <p>Pas de résultats trouvés.</p>
				<?php
			}
			wp_reset_postdata(); ?>
        </div>
    </main>
<?php
get_footer(); ?>