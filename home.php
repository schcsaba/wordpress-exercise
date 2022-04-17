<?php

get_header(); ?>
<main class="main-content">
    <div class="container">
        <h1><?= get_the_title( get_option('page_for_posts', true) ) ?></h1>
		<?php
		if ( have_posts() ) { ?>
            <div class="blog-grid">
				<?php
				while ( have_posts() ) {
					the_post(); ?>
                    <article class="card">
						<?php
						the_post_thumbnail( 'card-illustration', [ 'class' => 'card-illustration' ] );
						the_category(); ?>
                        <h2 class="card-title"><?php
							the_title(); ?></h2>
                        <p class="card-excerpt"><?php
							the_excerpt(); ?></p>
                        <a href="<?php
						the_permalink(); ?>" class="card-link">Lire l'article</a>
                    </article>
					<?php
				} ?>
            </div>
			<?php
			cr_number_pagination(); ?>
			<?php
		} else { ?>
            <p>Il n'y a pas d'articles.</p>
			<?php
		} ?>
    </div>
</main>

<?php
get_footer(); ?>
