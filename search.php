<?php

get_header();

$search_term = get_search_query();
$search_query = [ 'posts_per_page' => 12, 's' => $search_term ];

$search = new WP_Query( $search_query );

?>
    <main class="main-content">
        <div class="container">
			<?php
			if ( $search->have_posts() ) {
				?>
                <h1>Résultats de la recherche "<?php
					echo $search_term; ?>"</h1>
                <p>Votre recherche a retourné <?= $search->found_posts ?> résultat<?php
					echo $search->found_posts < 2 ? '' : 's' ?></p>
                <ul class="search-results-list">
					<?php
					while ( $search->have_posts() ) {
						$search->the_post(); ?>
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
				cr_number_pagination($search); ?>
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