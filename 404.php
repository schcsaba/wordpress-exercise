<?php

get_header(); ?>

    <main class="main-content">
        <div class="container">
            <h1>
				<?php
				$title = carbon_get_theme_option( 'cr_404_title' );
				if ( isset( $title ) && $title !== '' ) {
					echo $title;
				} else {
					echo 'Cette page n\'existe pas';
				}
				?>
            </h1>
            <p>
				<?php
				$content = carbon_get_theme_option( 'cr_404_content' );
				if ( isset( $content ) && $content !== '' ) {
					echo $content;
				} else {
					echo 'Veuillez cliquer sur un élément du menu.';
				}
				?>
            </p>
        </div>
    </main>

<?php
get_footer(); ?>