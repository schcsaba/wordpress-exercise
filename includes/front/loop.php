<?php

if ( have_posts() ) { ?>
    <div class="blog-grid">
		<?php
		while ( have_posts() ) {
			the_post(); ?>
            <article class="card">
	            <?php echo wp_get_attachment_image( carbon_get_the_post_meta( 'cr_featured_image' ),
		            'card-illustration',
		            false,
		            [ 'class' => 'card-illustration' ] );
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