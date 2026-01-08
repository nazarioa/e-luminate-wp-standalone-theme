<?php //phpcs:disable WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Template Name: Video Series Component
 *
 * Template Post Type: video_series
 *
 * Renders the template for a singular video_series.
 *
 * @category   Theme
 * @package eluminate-standalone
 * @author     Nazario A. Ayala <nazario@niztech.com>
 * @license    opensource.org MIT License
 * @link       https://www.niztech.com
 * @since      0.0.1
 */

if ( ! empty( $args['video'] ) ) {
	$path_generic = implode(
		DIRECTORY_SEPARATOR,
		array( get_template_directory_uri(), 'assets', 'generic-16-9.svg' )
	);

	printf(
		'
	<a href="%s">
		<img
			src="%s"
			alt="" />
	</a>
	<h3 class="title roboto-bold"><a href="%s">%s</a></h3>',
		$args['shortlink'],
		( empty( $args['video']->thumbnail_standard_url ) ? $path_generic : $args['video']->thumbnail_standard_url ),
		$args['shortlink'],
		$args['video']->title
	);
	if ( ! empty( $args['video']->description ) ) {
		printf( '<p class="line-clamp-5">%s</p>', $args['video']->description );
	}

	if ( isset( $args['video_count'] ) ) {
		echo( '<p class="video-series-count">' );
		if ( 1 === $args['video_count'] ) {
			echo( __( '1 video in series', 'eluminate-standalone' ) );
		} else {
			echo( __( $args['video_count'] . ' videos in series', 'eluminate-standalone' ) );
		}
		echo( '</p>' );
	}
}
