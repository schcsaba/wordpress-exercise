<?php

get_header(); ?>

    <main class="main-content">
        <div class="container">
            <h1>
				<?php
				$title = carbon_get_theme_option( 'cr_contact_title' );
				if ( isset( $title ) && $title !== '' ) {
					echo $title;
				} else {
					echo 'Contact';
				}
				?>
            </h1>
			<?php
			$content = carbon_get_theme_option( 'cr_contact_content' );
			if ( isset( $content ) && $content !== '' ) {
				echo apply_filters( 'the_content', $content );
			} else {
				echo '<p>Vous pouvez m\'envoyer un message en utilisant le formulaire ci-dessous.</p>';
			}
			echo do_shortcode( '[contact-form-7 id="246" title="contact" html_class="contact-form"]' );
			?>
            <h2>Les ateliers cuisine "Mes recettes"</h2>
            <div class="map">
				<?php
				$markers = carbon_get_theme_option( 'cr_workshop_markers' );
				if ( ! empty( $markers ) ) {
					echo do_shortcode( '[leaflet-map scrollwheel doubleClickZoom zoomcontrol detect-retina zoom=6 lat=46.9 lng=2.8]' );
					echo do_shortcode( '[leaflet-scale]' );
					foreach ( $markers as $marker ) {
						echo do_shortcode( '[leaflet-marker address="' .
						                   $marker['cr_workshop_address'] .
						                   '"]' .
						                   $marker['cr_workshop_name'] .
						                   '<br>' .
						                   $marker['cr_workshop_address'] .
						                   '<br><a href="tel:' .
                                           $marker['cr_workshop_tel'] .
                                           '">' .
						                   $marker['cr_workshop_tel'] .
						                   '</a><br><a href="mailto:' .
						                   $marker['cr_workshop_email'] .
						                   '">' .
						                   $marker['cr_workshop_email'] .
						                   '</a><br><a target="_blank" href="' .
						                   $marker['cr_workshop_url'] .
						                   '">' .
						                   $marker['cr_workshop_url'] .
						                   '</a>[/leaflet-marker]' );
					}
				}
				?>
            </div>
        </div>
    </main>

<?php
get_footer(); ?>