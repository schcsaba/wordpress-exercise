<?php

get_header(); ?>
<main class="main-content">
    <div class="container">
        <h1><?= get_the_title( get_option( 'page_for_posts', true ) ) ?></h1>
		<?php
		get_template_part( '/includes/front/loop' ) ?>
    </div>
</main>

<?php
get_footer(); ?>
