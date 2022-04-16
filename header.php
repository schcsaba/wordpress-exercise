<!DOCTYPE html>
<html <?php
language_attributes(); ?>>
<head>
    <meta charset="<?php
	bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
	wp_head(); ?>
</head>
<body <?php
body_class(); ?>>
<?php
wp_body_open(); ?>
<header class="main-header">
    <div class="container">
        <div class="logo">
			<?php
			$choice = carbon_get_theme_option( 'cr_show_logo' );
			$logo   = carbon_get_theme_option( 'cr_logo' );
			if ( $choice && $logo ) {
				echo wp_get_attachment_image( $logo, 'logo' );
			} else {
				bloginfo( 'name' );
			} ?>
        </div>
		<?php
		if ( has_nav_menu( 'main-nav' ) ) {
			wp_nav_menu( [
				'theme_location'  => 'main-nav',
				'container'       => 'nav',
				'container_class' => 'main-nav',
				'depth'           => 1
			] );
		}
        get_search_form();
		?>
    </div>
</header>