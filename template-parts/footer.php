<footer class="layout-footer">
	Soroptimist International of Novato &copy; <?php echo gmdate( 'Y' ); ?>
	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'social',
			'container'      => false,
			'menu'           => 'social',
		)
	);
	wp_nav_menu(
		array(
			'theme_location' => 'footer',
			'container'      => false,
			'menu'           => 'footer',
		)
	);
	?>
</footer>
