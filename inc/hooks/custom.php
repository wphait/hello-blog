<?php
/**
 * Custom hooks
 *
 * @package Hello_Blog
 */

/**
 * Add Google fonts.
 *
 * @since 1.0.0
 *
 * @param array $fonts An array of Google fonts.
 * @return array Modified array of fonts.
 */
function hello_blog_add_google_fonts( $fonts ) {
	$fonts[] = 'Nunito Sans';

	return $fonts;
}

add_filter( 'hello_blog_google_fonts', 'hello_blog_add_google_fonts' );

/**
 * Customize breadcrumb status.
 *
 * @since 1.0.0
 *
 * @param bool $status Status.
 * @return bool Modified status.
 */
function hello_blog_customize_breadcrumb_status( $status ) {
	$status = false;

	$enable_breadcrumb = hello_blog_get_option( 'enable_breadcrumb' );

	if ( true === $enable_breadcrumb ) {
		$status = true;
	}

	// Check WooCommerce.
	if ( is_archive() && class_exists( 'WooCommerce', false ) && is_woocommerce() && false === $enable_breadcrumb ) {
		$status = false;
	}

	// Dont show breadcrumb in any case.
	if ( is_front_page() || is_home() || is_404() ) {
		$status = false;
	}

	return $status;
}

add_filter( 'hello_blog_breadcrumb_status', 'hello_blog_customize_breadcrumb_status' );

/**
 * Customize related posts status.
 *
 * @since 1.0.0
 *
 * @param bool $status Status.
 * @return bool Modified status.
 */
function hello_blog_customize_related_posts_status( $status ) {
	$status = false;

	$show_related_posts = hello_blog_get_option( 'show_related_posts' );

	if ( true === $show_related_posts && 'post' === get_post_type() ) {
		$status = true;
	}

	return $status;
}

add_filter( 'hello_blog_related_posts_status', 'hello_blog_customize_related_posts_status' );

/**
 * Customize featured posts status.
 *
 * @since 1.0.0
 *
 * @param bool $status Status.
 * @return bool Modified status.
 */
function hello_blog_customize_featured_posts_status( $status ) {
	$status = false;

	$enable_featured_posts = hello_blog_get_option( 'enable_featured_posts' );

	if ( true === $enable_featured_posts && is_front_page() && is_home() ) {
		$status = true;
	}

	return $status;
}

add_filter( 'hello_blog_featured_posts_status', 'hello_blog_customize_featured_posts_status' );

/**
 * Customize featured posts classes.
 *
 * @since 1.0.0
 *
 * @param array $classes Array of classes.
 * @return array Modified array of classes.
 */
function hello_blog_customize_featured_posts_classes( $classes ) {
	$classes[] = 'cols-3';

	return $classes;
}

add_filter( 'hello_blog_featured_posts_classes', 'hello_blog_customize_featured_posts_classes' );
