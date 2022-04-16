<?php

get_header(); ?>
    <main class="main-content">
        <div class="container">
			<?php
			if ( have_posts() ) {
				global $wp_query;
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
                <nav class="pagination">
					<?php
					cr_number_pagination(); ?>
                </nav>
                <!--                <nav class="pagination">
									<span class="page-numbers current">1</span>
									<a href="#" class="page-numbers">2</a>
									<a href="#" class="page-numbers">3</a>
									<a href="#" class="page-numbers">4</a>
									<a href="#" class="next page-numbers">Page suivante</a>
								</nav>-->
				<?php
			} else { ?>
                <p>Pas de résultats trouvés.</p>
				<?php
			} ?>
        </div>
    </main>
<?php
get_footer(); ?>