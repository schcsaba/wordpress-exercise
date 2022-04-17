<?php

get_header(); ?>
    <main class="main-content">
        <div class="container">
            <h1><?php
				single_cat_title(); ?></h1>
			<?php
			get_template_part( '/includes/front/loop' ) ?>
        </div>
    </main>

<?php
get_footer(); ?>