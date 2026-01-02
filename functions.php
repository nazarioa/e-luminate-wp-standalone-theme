<?php
/**
 * Created by PhpStorm.
 * User: nazario
 * Date: 5/28/18
 * Time: 4:00 PM
 */

define( 'THEME_TEXT_DOMAIN', 'eluminate-child' );

if ( class_exists( 'Niztech_Youtube' ) ) {
	$path_to_plugins = join( DIRECTORY_SEPARATOR, array( WP_PLUGIN_DIR, 'niztech-youtube', 'class-niztech-youtube-client.php' ) );
	include_once $path_to_plugins;
}

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! isset( $content_width ) ) {
	$content_width = 1024;
}

/**
 * Register Post types used by this theme.
 * Register video_series Post Type
 */
add_action(
	'init',
	function () {
		register_taxonomy(
			'list_in',
			array( 'video_series' ),
			array(
				'hierarchical'       => false,
				'label'              => __( 'List in in section', THEME_TEXT_DOMAIN ),
				'public'             => true,
				'rewrite'            => array(
					'slug'       => 'listing',
					'with_front' => false,
				),
				'show_admin_column'  => true,
				'show_in_menu'       => true,
				'show_in_nav_menus'  => true,
				'show_in_quick_edit' => true,
				'show_in_rest'       => true,
				'show_ui'            => true,
			)
		);

		$labels = array(
			'name'                  => _x( 'Video Series', 'Post Type General Name', THEME_TEXT_DOMAIN ),
			'singular_name'         => _x( 'Video Series', 'Post Type Singular Name', THEME_TEXT_DOMAIN ),
			'menu_name'             => __( 'Video Series', THEME_TEXT_DOMAIN ),
			'name_admin_bar'        => __( 'Video Series', THEME_TEXT_DOMAIN ),
			'archives'              => __( 'Video Series Archives', THEME_TEXT_DOMAIN ),
			'attributes'            => __( 'Video Series Attributes', THEME_TEXT_DOMAIN ),
			'parent_item_colon'     => __( 'Parent Item:', THEME_TEXT_DOMAIN ),
			'all_items'             => __( 'All Video Series', THEME_TEXT_DOMAIN ),
			'add_new_item'          => __( 'Add New Video Series', THEME_TEXT_DOMAIN ),
			'add_new'               => __( 'Add New', THEME_TEXT_DOMAIN ),
			'new_item'              => __( 'New Video Series', THEME_TEXT_DOMAIN ),
			'edit_item'             => __( 'Edit Video Series', THEME_TEXT_DOMAIN ),
			'update_item'           => __( 'Update Video Series', THEME_TEXT_DOMAIN ),
			'view_item'             => __( 'View Video Series', THEME_TEXT_DOMAIN ),
			'view_items'            => __( 'View Items', THEME_TEXT_DOMAIN ),
			'search_items'          => __( 'Search Video Series', THEME_TEXT_DOMAIN ),
			'not_found'             => __( 'Not found', THEME_TEXT_DOMAIN ),
			'not_found_in_trash'    => __( 'Not found in Trash', THEME_TEXT_DOMAIN ),
			'featured_image'        => __( 'Featured Image', THEME_TEXT_DOMAIN ),
			'set_featured_image'    => __( 'Set featured image', THEME_TEXT_DOMAIN ),
			'remove_featured_image' => __( 'Remove featured image', THEME_TEXT_DOMAIN ),
			'use_featured_image'    => __( 'Use as featured image', THEME_TEXT_DOMAIN ),
			'insert_into_item'      => __( 'Insert into item', THEME_TEXT_DOMAIN ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', THEME_TEXT_DOMAIN ),
			'items_list'            => __( 'Video Series list', THEME_TEXT_DOMAIN ),
			'items_list_navigation' => __( 'Items list navigation', THEME_TEXT_DOMAIN ),
			'filter_items_list'     => __( 'Filter Video Series list', THEME_TEXT_DOMAIN ),
		);
		$args   = array(
			'label'               => __( 'Video Series', THEME_TEXT_DOMAIN ),
			'description'         => __( 'Posts that show a series of videos', THEME_TEXT_DOMAIN ),
			'labels'              => $labels,
			'supports'            => array(
				'title',
				'editor',
				'revisions',
				'excerpt',
				'thumbnail',
			),
			'taxonomies'          => array( 'video_category', 'list_in' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_icon'           => 'dashicons-video-alt',
			'menu_position'       => 5,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
			'show_in_rest'        => false,
		);
		register_post_type( 'video_series', $args );

		/*
		 * Add custom taxonomy terms
		 */
		$terms = array(
			array(
				'term'     => __( 'Popular shows', THEME_TEXT_DOMAIN ),
				'taxonomy' => 'list_in',
				'args'     => array(
					'description' => __( 'Shows that we may want to highlight', THEME_TEXT_DOMAIN ),
					'slug'        => 'popular',
				),
			),
			array(
				'term'     => __( 'Health', THEME_TEXT_DOMAIN ),
				'taxonomy' => 'list_in',
				'args'     => array(
					'description' => __( 'Relate with health', THEME_TEXT_DOMAIN ),
					'slug'        => 'health',
				),
			),
			array(
				'term'     => __( 'Business', THEME_TEXT_DOMAIN ),
				'taxonomy' => 'list_in',
				'args'     => array(
					'description' => __( 'Relate with business', THEME_TEXT_DOMAIN ),
					'slug'        => 'business',
				),
			),
			array(
				'term'     => __( 'Science / Technology', THEME_TEXT_DOMAIN ),
				'taxonomy' => 'list_in',
				'args'     => array(
					'description' => __( 'Relate with science and technology', THEME_TEXT_DOMAIN ),
					'slug'        => 'science-technology',
				),
			),
			array(
				'term'     => __( 'PSA / Promo', THEME_TEXT_DOMAIN ),
				'taxonomy' => 'list_in',
				'args'     => array(
					'description' => __( 'Promoting or providing public service announcements', THEME_TEXT_DOMAIN ),
					'slug'        => 'psa-promo',
				),
			),
			array(
				'term'     => __( 'Housing / Community', THEME_TEXT_DOMAIN ),
				'taxonomy' => 'list_in',
				'args'     => array(
					'description' => __( 'Relate with housing and community', THEME_TEXT_DOMAIN ),
					'slug'        => 'community',
				),
			),
			array(
				'term'     => __( 'History / Culture', THEME_TEXT_DOMAIN ),
				'taxonomy' => 'list_in',
				'args'     => array(
					'description' => __( 'Relate with history and culture', THEME_TEXT_DOMAIN ),
					'slug'        => 'history-culture',
				),
			),
			array(
				'term'     => __( 'Law / Politics / Policy', THEME_TEXT_DOMAIN ),
				'taxonomy' => 'list_in',
				'args'     => array(
					'description' => __( 'Relate with law politics and policy', THEME_TEXT_DOMAIN ),
					'slug'        => 'politics-policy',
				),
			),
			array(
				'term'     => __( 'Family / Youth', THEME_TEXT_DOMAIN ),
				'taxonomy' => 'list_in',
				'args'     => array(
					'description' => __( 'Relate with families and young adults', THEME_TEXT_DOMAIN ),
					'slug'        => 'family-youth',
				),
			),
		);

		foreach ( $terms as $term_data ) {
			wp_insert_term( $term_data['term'], $term_data['taxonomy'], $term_data['args'] );
		}

		/**
		 * Removes comments from the post types we created.
		 */
		remove_post_type_support( 'video_series', 'comments' );

		hestia_child_eliminate_online_list_in_menu();
	},
	0
);


if ( ! function_exists( 'hestia_child_eluminate_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since Hestia Child Eluminate 1.0
	 */
	function hestia_child_eluminate_setup() {

		/*
		* Make theme available for translation.
		* Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyfifteen
		* If you're building a theme based on twentyfifteen, use a find and replace
		* to change 'twentyfifteen' to the name of your theme in all the template files
		*/
		load_theme_textdomain( THEME_TEXT_DOMAIN );

		/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/

		add_theme_support( 'title-tag' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'html5', array( 'style', 'script' ) );
		add_theme_support( 'editor-styles' );
	}
}

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style(
			'hestia_child_parent',
			trailingslashit( get_template_directory_uri() ) . 'style.css',
			array( 'bootstrap' )
		);
		if ( is_rtl() ) {
			wp_enqueue_style(
				'hestia_child_parent_rtl',
				trailingslashit( get_template_directory_uri() ) . 'style-rtl.css',
				array( 'bootstrap' )
			);
		}
	},
	2
);

/**
 * Import options from the parent theme
 *
 * @since 1.0.0
 */
add_action(
	'after_switch_theme',
	function () {
		$hestia_mods = get_option( 'theme_mods_hestia-pro' );
		if ( ! empty( $hestia_mods ) ) {
			foreach ( $hestia_mods as $hestia_mod_k => $hestia_mod_v ) {
				set_theme_mod( $hestia_mod_k, $hestia_mod_v );
			}
		}
	}
);


/**
 * This forces `video_series` pages to use the video_series-template-fullwidth
 *
 * @param $single_template
 *
 * @return string
 */
add_filter(
	'single_template',
	function ( $single_template ) {
		global $post;
		// use a custom template only when needed
		if ( 'video_series' === $post->post_type ) {
			return join( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'video_series-template-fullwidth.php' ) );
		}

		return $single_template;
	}
);

if ( ! function_exists( 'hestia_child_eluminate_recent_video_series_data' ) ) {
	function hestia_child_eluminate_recent_video_series_data( $postCount = 20 ) {
		global $wpdb;
		$video_series_data = wp_get_recent_posts(
			array(
				'numberposts' => $postCount,
				'orderby'     => 'post_date',
				'order'       => 'DESC',
				'post_type'   => 'video_series',
				'post_status' => 'publish',
			)
		);

		if ( class_exists( 'Niztech_Youtube_Client' ) ) {
			foreach ( $video_series_data as &$video ) {
				$video['video_data'] = Niztech_Youtube_Client::video_content( $video['ID'] );
			}
		}

		return $video_series_data;
	}
}

if ( ! function_exists( 'hestia_child_eluminate_video_series_recent_html' ) ) {
	function hestia_child_eluminate_video_series_recent_html( $video_series_data, array $options = array() ) {
		$section_attribute_html[] = isset( $options['id'] ) ? 'id="' . $options['id'] . '"' : '';
		$section_attribute_html[] = isset( $options['class'] ) ? 'class="' . $options['class'] . '"' : '';
		$html                     = '<section ' . join( ' ', $section_attribute_html ) . '>';
		foreach ( $video_series_data as $series ) {
			$videos                 = $series['video_data'] ?? array();
			$class                  = $options['class'] ?? null;
			$article_attribute_html = $class ? ' class="' . $class . '-series" ' : 'class="series"';
			$html                  .= '<article ' . $article_attribute_html . '>';
			if ( isset( $series['post_title'] ) ) {
				$html .= '<h2 class="title">' . $series['post_title'] . '</h2 >';
			}

			if ( sizeof( $videos ) > 0 ) {
				$img_url = $videos[0]->thumbnail_maxres_url ?? $videos[0]->thumbnail_standard_url ?? $videos[0]->thumbnail_default_url ?? null;
				if ( $img_url ) {
					$img_attribute_html            = array();
					$class ? $img_attribute_html[] = 'class="' . $class . '-series-image series-image"' : $img_attribute_html[] = 'class="series-img"';
					$img_attribute_html[]          = 'alt="' . $series['post_title'] . '"';
					$html                         .= '<a href="' . $series['guid'] . '"><img ' . implode(
							' ',
							$img_attribute_html
						) . ' src="' . $img_url . '"></a>';
				}
				$list_attribute_html = $class ? ' class="' . $class . '-items items" ' : 'class="items"';
				$html               .= '<ol ' . $list_attribute_html . ' > ';
				foreach ( $videos as $video ) {
					if ( isset( $video->title ) ) {
						$html .= '<li class="' . $class . '-item item">';
						$html .= '<a class="item-link" href="' . $series['guid'] . '">';
						$html .= $video->title;
						$html .= '</a>';
						$html .= '</li>';
					}
				}
				$html .= '</ol >';
			}
			$html .= '</article >';
		}

		return $html;
	}
}

add_shortcode(
	'eluminate-recent',
	function ( $attr ) {
		$a = shortcode_atts(
			array(
				'limit' => 20,
				'id'    => null,
				'class' => null,
			),
			$attr
		);

		// Get the data.
		$data = hestia_child_eluminate_recent_video_series_data( $a['limit'] );
		// Generate the html.
		print_r(
			hestia_child_eluminate_video_series_recent_html(
				$data,
				array(
					'id'    => $a['id'],
					'class' => $a['class'],
				)
			)
		);
	}
);

add_action(
	'upload_mimes',
	function ( $file_types ) {
		$new_filetypes        = array();
		$new_filetypes['svg'] = 'image/svg+xml';
		$file_types           = array_merge( $file_types, $new_filetypes );

		return $file_types;
	}
);

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_script( 'ga-tag', 'https://www.googletagmanager.com/gtag/js?id=UA-134160689-1', null, null, true );
		wp_enqueue_script(
			'ga-include',
			join( DIRECTORY_SEPARATOR, array( get_stylesheet_directory_uri(), 'assets', 'js', 'google-analytics.js' ) ),
			array( 'ga-tag' ),
			null,
			true
		);
	}
);

add_action(
	'wp_head',
	function () {
		print( '<meta name="google-site-verification" content="Ipj67ZzaLTCcAWzwFb_8A1GpibW34MNQxCnrJxWve6E" />' );
	}
);

/**
 * Load the tag templates from a subfolder.
 */
add_filter(
	'tag_template',
	function ( $template ) {

		$tag = get_queried_object();

		$tags_with_special_template = array( 'popular', 'archive' );

		if ( in_array( $tag->slug, $tags_with_special_template ) ) {
			$template_path = join( DIRECTORY_SEPARATOR, array( 'templates', 'tag', "{$tag->slug}.php" ) );

			// Change subfolder name
			$alternative_template = locate_template( $template_path );

			// If we do have "tag-{$tag->slug}.php" in a subfolder, load it
			if ( $alternative_template ) {
				return $alternative_template;
			}
		}

		// If we don't have a "tag-{$tag->slug}.php", load default templates from hierarchy
		// tag.php
		return $template;
	}
);


if ( ! function_exists( 'hestia_child_eliminate_online_list_in_menu' ) ) {
	function hestia_child_eliminate_online_list_in_menu(): void {
		// Check if the menu already exists
		$menu_name   = 'Video Series Listings';
		$menu_exists = wp_get_nav_menu_object( $menu_name );

		if ( $menu_exists ) {
			$menu_id = $menu_exists->term_id;
		} else {
			$menu_id = wp_create_nav_menu( $menu_name );
		}

		// Create the menu

		$args = array(
			'taxonomy'   => 'list_in',
			'hide_empty' => false,
		);

		$list_in_terms = get_terms( $args );

		if ( ! empty( $list_in_terms ) && ! is_wp_error( $list_in_terms ) ) {
			foreach ( $list_in_terms as $term ) {
				if ( 'popular' != $term->slug ) {
					wp_update_nav_menu_item(
						$menu_id,
						0,
						array(
							'menu-item-title'  => __( $term->name ),
							'menu-item-url'    => home_url( "/listing/{$term->slug}" ),
							'menu-item-status' => 'publish',
						)
					);
				}
			}
		}

		// Assign the newly created menu to the 'header-menu' location
		$locations             = get_theme_mod( 'nav_menu_locations' );
		$locations['nav-menu'] = $menu_id;

		set_theme_mod( 'nav_menu_locations', $locations );
	}
}
