<?php
/**
 * Template Name: Generic page header template.
 *
 * Template Name: Generic page header template.
 *
 * @category   Theme
 * @package eluminate-standalone
 * @author     Nazario A. Ayala <nazario@niztech.com>
 * @license    opensource.org MIT License
 * @link       https://www.niztech.com
 * @since      0.0.1
 */

$logo = implode( DIRECTORY_SEPARATOR, array( get_template_directory_uri(), 'assets', 'e-luminate-logo-animated.png' ) )
?>

<h1 class="body-header">
	<a href="/">
		<img class="logo" alt="<?php echo __( 'Home', 'eluminate-standalone' ); ?> - Soroptimist International of Novato" src="<?php echo $logo; ?>"/>
	</a>
</h1>
