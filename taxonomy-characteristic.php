<?php

get_header(); ?>
<main class="main-content">
	<div class="container">
		<h1>
			<?php
			echo get_queried_object()->name;
			?>
		</h1>
		<?php
		if ( have_posts() ) { ?>
			<div class="blog-grid">
				<?php
				while ( have_posts() ) {
					the_post(); ?>
					<article class="card">
						<?= wp_get_attachment_image( carbon_get_the_post_meta( 'cr_recipe_featured_image1' ),
							'card-illustration',
							false,
							[ 'class' => 'card-illustration' ] ) ?>
						<ul class="card-terms-list">
							<?php
							$terms = get_the_terms( get_the_ID(), 'characteristic' );
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
						<h3 class="card-title"><?php
							the_title(); ?></h3>
						<ul class="card-meta-list">
							<li class="card-meta-item"><?php
								if ( intval( date_format( date_create( carbon_get_the_post_meta( 'cr_preparation_time' ) ),
										'H' ) ) === 0 ) {
									$format = 'i \m\i\n';
								} else {
									$format = 'G\hi';
								}
								echo date_format( date_create( carbon_get_the_post_meta( 'cr_preparation_time' ) ),
									$format ); ?></li>
							<li class="card-meta-item"><?= carbon_get_post_meta( get_the_ID(),
									'cr_number_of_portions' ) ?> portion<?php
								echo carbon_get_post_meta( get_the_ID(),
									'cr_number_of_portions' ) < 2 ? '' : 's' ?></li>
						</ul>
						<a href="<?php
						the_permalink() ?>" class="card-link">Voir la recette</a>
					</article>
					<?php
				} ?>
			</div>
			<?php
			cr_number_pagination();
		} ?>
	</div>
</main>

<?php
get_footer(); ?>
