<?php

get_header(); ?>

    <main class="main-content">
        <div class="container">
            <h1>Me contacter</h1>
            <p>Vous pouvez m'envoyer un message en utilisant le formulaire ci-dessous. J'accueille volontiers les
                suggestions de recettes, vous pouvez vous inscrire à l'un de mes ateliers de cuisine ici, mais vous
                pouvez aussi écrire sur d'autres sujets. J'attends avec impatience de recevoir votre message.</p>
            <?php
            echo do_shortcode('[contact-form-7 id="246" title="contact" html_class="contact-form"]');
            ?>
            <h2>Les ateliers cuisine "Mes recettes"</h2>
            <div class="map">
                <iframe src="https://www.google.com/maps/d/embed?mid=1fnTwOQf45oRK9HtIli--aFCZ1DPu86eC"></iframe>
            </div>
        </div>
    </main>

<?php
get_footer(); ?>