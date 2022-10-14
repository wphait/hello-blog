<?php
/**
 * Dynamic CSS
 *
 * @package Hello_Blog
 */

/**
 * Render dynamic styles.
 *
 * @since 1.0.0
 */
function hello_blog_dynamic_styles() {
	$custom_css = '';

	$logo_height = absint( hello_blog_get_option( 'logo_height' ) );

	$custom_css .= ".site-branding img { max-height: {$logo_height}px; }";

	if ( $custom_css ) {
		wp_add_inline_style( 'hello-blog-style', $custom_css ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

add_action( 'wp_enqueue_scripts', 'hello_blog_dynamic_styles' );

