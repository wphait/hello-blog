<?php
/**
 * Hooks for core
 *
 * @package Hello_Blog
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @since 1.0.0
 *
 * @param array $classes An array of body class names.
 * @return array An array of additional class names added to the body.
 */
function hello_blog_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Get shop layout sidebar or no sidebar.
	$shop_layout = hello_blog_get_option( 'shop_layout' );
	if ( 'no-sidebar' === $shop_layout && class_exists( 'WooCommerce', false ) && ( is_woocommerce() || is_cart() || is_checkout() ) ) {
		$classes[] = 'full-width-shop';
	}

	$classes[] = 'global-layout-list';

	return $classes;
}

add_filter( 'body_class', 'hello_blog_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 *
 * @since 1.0.0
 */
function hello_blog_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

add_action( 'wp_head', 'hello_blog_pingback_header' );

/**
 * Add a dropdown icon to header menu.
 *
 * @since 1.0.0
 *
 * @param string   $title     The menu item's title.
 * @param WP_Post  $item The current menu item object.
 * @param stdClass $args      An object of wp_nav_menu() arguments.
 * @param int      $depth     Depth of menu item. Used for padding.
 * @return string Modified menu item's title.
 */
function hello_blog_add_dropdown_icons( $title, $item, $args, $depth ) {
	$icon = '<svg role="img" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg"><path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.5" fill="none" fill-rule="evenodd" stroke-linecap="square"/></svg>';

	if ( 'menu-1' === $args->theme_location && ( 0 === $depth || 1 === $depth ) ) {
		foreach ( $item->classes as $value ) {
			if ( 'menu-item-has-children' === $value || 'page_item_has_children' === $value ) {
				$title = $title . '<span role="presentation" class="dropdown-menu-toggle">' . $icon . '</span>';
			}
		}
	}

	return $title;
}

add_filter( 'nav_menu_item_title', 'hello_blog_add_dropdown_icons', 10, 4 );

/**
 * Implement excerpt length.
 *
 * @since 1.0.0
 *
 * @param int $length The number of words.
 * @return int Excerpt length.
 */
function hello_blog_implement_excerpt_length( $length ) {
	$excerpt_length = hello_blog_get_option( 'excerpt_length' );

	if ( absint( $excerpt_length ) > 0 ) {
		$length = absint( $excerpt_length );
	}

	return $length;
}

/**
 * Implement read more in content.
 *
 * @since 1.0.0
 *
 * @param string $more_link Read More link element.
 * @param string $more_link_text Read More text.
 * @return string Link.
 */
function hello_blog_content_more_link( $more_link, $more_link_text ) {
	$read_more_text = hello_blog_get_option( 'readmore_text' );

	if ( ! empty( $read_more_text ) ) {
		$more_link = str_replace( $more_link_text, esc_html( $read_more_text ), $more_link );
	}

	return $more_link;
}

/**
 * Implement read more in excerpt.
 *
 * @since 1.0.0
 *
 * @param string $more The string shown within the more link.
 * @return string The excerpt.
 */
function hello_blog_implement_read_more( $more ) {
	$output = $more;

	$read_more_text = hello_blog_get_option( 'readmore_text' );

	if ( ! empty( $read_more_text ) ) {
		$output = '&hellip;<p><a href="' . esc_url( get_permalink() ) . '" class="btn-more">' . esc_html( $read_more_text ) . '<span class="arrow-more">&rarr;</span></a></p>';
	} else {
		$output = '';
	}

	return $output;
}

/**
 * Hook read more and excerpt length filters.
 *
 * @since 1.0.0
 */
function hello_blog_hook_read_more_filters() {
	add_filter( 'excerpt_length', 'hello_blog_implement_excerpt_length', 999 );
	add_filter( 'the_content_more_link', 'hello_blog_content_more_link', 10, 2 );
	add_filter( 'excerpt_more', 'hello_blog_implement_read_more' );
}

add_action( 'wp', 'hello_blog_hook_read_more_filters' );


/**
 * Add admin notice.
 *
 * @since 1.0.0
 */
function hello_blog_add_admin_notice() {
	\Nilambar\AdminNotice\Notice::init(
		array(
			'slug' => HELLO_BLOG_SLUG,
			'type' => 'theme',
			'name' => esc_html__( 'Hello Blog', 'hello-blog' ),
		)
	);
}

add_action( 'admin_init', 'hello_blog_add_admin_notice' );

/**
 * Displays SVG icons in social links menu.
 *
 * @since 1.0.0
 *
 * @param string   $item_output The menu item's starting HTML output.
 * @param WP_Post  $item        Menu item data object.
 * @param int      $depth       Depth of the menu. Used for padding.
 * @param stdClass $args        An object of wp_nav_menu() arguments.
 * @return string The menu item output with social icon.
 */
function hello_blog_nav_menu_social_icons( $item_output, $item, $depth, $args ) {
	// Change SVG icon inside social links menu if there is supported URL.
	if ( 'social' === $args->theme_location ) {
		$svg = Hello_Blog_SVG_Icons::get_social_link_svg( $item->url );

		if ( empty( $svg ) ) {
			$svg = hello_blog_get_theme_svg( 'link' );
		}

		$item_output = str_replace( $args->link_after, '</span>' . $svg, $item_output );
	}

	return $item_output;
}

add_filter( 'walker_nav_menu_start_el', 'hello_blog_nav_menu_social_icons', 10, 4 );
