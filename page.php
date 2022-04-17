<?php

get_header(); ?>
    <main class="main-content">
        <div class="container container-narrow">
			<?php
			if ( have_posts() ) {
			while ( have_posts() ) {
				the_post(); ?>
                <h1><?php
					the_title(); ?></h1>
				<?php
				the_content();
			} ?>
		<?php
		} else { ?>
            <p>Cette page n'existe pas.</p>
			<?php
		} ?>
        </div>
    </main>
<?php
get_footer(); ?>