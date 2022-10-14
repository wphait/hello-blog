<?php
/**
 * Helper functions
 *
 * @package Hello_Blog
 */

/**
 * Return Google fonts URL.
 *
 * @since 1.0.0
 *
 * @return string Fonts URL.
 */
function hello_blog_get_google_fonts_url() {
	$fonts_url = '';

	$fonts = apply_filters( 'hello_blog_google_fonts', array() );

	if ( empty( $fonts ) ) {
		return $fonts_url;
	}

	$families = array();

	foreach ( $fonts as $font ) {
		if ( false !== strpos( $font, ':' ) ) {
			$families[] = $font;
		} else {
			$families[] = $font . ':wght@400;700';
		}
	}

	if ( ! empty( $families ) ) {
		$fonts_url = add_query_arg(
			array(
				'family'  => implode( '&family=', $families ),
				'display' => 'swap',
			),
			'https://fonts.googleapis.com/css2'
		);
	}

	return $fonts_url;
}

/**
 * Return social share markup.
 *
 * @since 1.0.0
 *
 * @param int   $id Post ID.
 * @param array $sites Sites array.
 * @return string Social share markup.
 */
function hello_blog_get_social_share( $id, $sites = array() ) {
	if ( empty( $sites ) || ! is_array( $sites ) ) {
		$sites = array( 'facebook', 'twitter', 'pinterest', 'linkedin' );
	}

	$links = array();

	$post_title     = wp_strip_all_tags( get_the_title( $id ) );
	$post_permalink = get_permalink( $id );

	$image_details  = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full' );
	$post_image_url = ( ! empty( $image_details ) ) ? $image_details[0] : '';

	foreach ( $sites as $site ) {
		$item = array();

		$item['id'] = $site;

		$url = null;

		switch ( $site ) {
			case 'facebook':
				$url = 'https://www.facebook.com/sharer/sharer.php?display=popup&u=' . rawurlencode( $post_permalink );
				break;

			case 'twitter':
				$url = 'http://twitter.com/share?text=' . rawurlencode( $post_title ) . '&amp;url=' . rawurlencode( $post_permalink );
				break;

			case 'pinterest':
				$url = 'https://pinterest.com/pin/create/button/?media=' . esc_url( $post_image_url ) . '&amp;description=' . rawurlencode( $post_title ) . '&amp;url=' . rawurlencode( $post_permalink );
				break;

			case 'linkedin':
				$url = 'https://www.linkedin.com/shareArticle?mini=true&amp;title=' . rawurlencode( $post_title ) . '&amp;source=' . rawurlencode( $post_permalink ) . '&amp;url=' . rawurlencode( $post_permalink );
				break;

			default:
				break;
		}

		if ( $url ) {
			$item['url'] = $url;

			$links[] = $item;
		}
	}

	$output = '';

	if ( ! empty( $links ) ) {
		$output .= '<ul>';

		foreach ( $links as $link ) {
			$output .= '<li><a href="' . esc_url( $link['url'] ) . '" class="' . esc_attr( $link['id'] ) . '" target="_blank">' . hello_blog_get_theme_svg( $link['id'], 'social' ) . '</a></li>';
		}

		$output .= '</ul>';
	}

	return $output;
}

/**
 * Output SVG.
 *
 * @since 1.0.0
 *
 * @param string $svg_name The name of the icon.
 * @param string $group    The group the icon belongs to.
 * @param string $color    Color code.
 */
function hello_blog_the_theme_svg( $svg_name, $group = 'ui', $color = '' ) {
	echo hello_blog_get_theme_svg( $svg_name, $group, $color ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in hello_blog_get_theme_svg().
}

/**
 * Get information about the SVG icon.
 *
 * @since 1.0.0
 *
 * @param string $svg_name The name of the icon.
 * @param string $group    The group the icon belongs to.
 * @param string $color    Color code.
 */
function hello_blog_get_theme_svg( $svg_name, $group = 'ui', $color = '' ) {
	// Make sure that only our allowed tags and attributes are included.
	$svg = wp_kses(
		Hello_Blog_SVG_Icons::get_svg( $svg_name, $group, $color ),
		array(
			'svg'     => array(
				'class'       => true,
				'xmlns'       => true,
				'width'       => true,
				'height'      => true,
				'viewbox'     => true,
				'aria-hidden' => true,
				'role'        => true,
				'focusable'   => true,
			),
			'path'    => array(
				'fill'      => true,
				'fill-rule' => true,
				'd'         => true,
				'transform' => true,
			),
			'polygon' => array(
				'fill'      => true,
				'fill-rule' => true,
				'points'    => true,
				'transform' => true,
				'focusable' => true,
			),
		)
	);

	if ( ! $svg ) {
		return false;
	}
	return $svg;
}

/**
 * Apply theme shortcode.
 *
 * @since 1.0.0
 *
 * @param string $string Content.
 * @return string Modified content.
 */
function hello_blog_apply_theme_shortcode( $string ) {
	if ( empty( $string ) ) {
		return $string;
	}

	$search = array( '[the-year]', '[the-site-title]' );

	$replace = array(
		date_i18n( esc_html_x( 'Y', 'year date format', 'hello-blog' ) ),
		esc_html( get_bloginfo( 'name', 'display' ) ),
	);

	$string = str_replace( $search, $replace, $string );

	return $string;
}

/**
 * Fallback for primary menu.
 *
 * @since 1.0.0
 */
function hello_blog_menu_fallback() {
	echo '<ul id="menu-main-menu" class="menu">';

	echo '<li class="menu-item"><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'hello-blog' ) . '</a></li>';

	wp_list_pages(
		array(
			'title_li' => '',
			'depth'    => 1,
			'number'   => 4,
		)
	);

	echo '</ul>';
}

/**
 * Return user details.
 *
 * @since 1.0.0
 *
 * @param int $user_id User ID.
 * @return array User details.
 */
function hello_blog_get_user_details( $user_id ) {
	$output = array();

	$userdata = get_userdata( $user_id );

	if ( false === $userdata ) {
		return $output;
	}

	$output['name']    = $userdata->display_name;
	$output['email']   = $userdata->user_email;
	$output['website'] = $userdata->user_url;
	$output['bio']     = get_user_meta( $user_id, 'description', true );

	return $output;
}
