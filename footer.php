<footer class="main-footer">
    <div class="container">
        <div class="copyright">Copyright &copy; <?php
			bloginfo( 'name' ); ?> <?= date("Y") ?>

        </div>
		<?php
		if ( has_nav_menu( 'footer-nav' ) ) {
			wp_nav_menu( [
				'theme_location'  => 'footer-nav',
				'container'       => 'nav',
				'container_class' => 'footer-nav',
				'depth'           => 1
			] );
		}
		?>
		<?php
		if ( has_nav_menu( 'social-nav' ) ) {
			wp_nav_menu( [
				'theme_location'  => 'social-nav',
				'container'       => 'nav',
				'container_class' => 'social-nav',
				'depth'           => 1
			] );
		}
		?>
    </div>
</footer>
<?php
wp_footer(); ?>
</body>
</html>