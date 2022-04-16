<form role="search" method="get" class="search-form" action="<?php
echo esc_url(home_url( '/' )); ?>">
    <label for="search" class="sr-only">
        <?php echo _x( 'Rechercher', 'label', 'cefimrecettes' ) ?>
    </label>
    <input
            type="search"
            id="search"
            placeholder="<?php echo esc_attr_x( 'Recherche ...', 'placeholder', 'cefimrecettes' ) ?>"
            value="<?php the_search_query() ?>"
            name="s"
    />
    <button type="submit">
	    <?php echo esc_attr_x( 'Ok', 'submit button', 'cefimrecettes' ) ?>
    </button>
</form>