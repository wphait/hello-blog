<?php
/**
 * Layout hooks
 *
 * @package Hello_Blog
 */

/**
 * Add main header.
 *
 * @since 1.0.0
 */
function hello_blog_add_main_header() {
	get_template_part( 'template-parts/header/main' );
}

add_action( 'hello_blog_header', 'hello_blog_add_main_header' );

/**
 * Add breadcrumb.
 *
 * @since 1.0.0
 */
function hello_blog_add_breadcrumb() {
	if ( true !== apply_filters( 'hello_blog_breadcrumb_status', false ) ) {
		return;
	}

	get_template_part( 'template-parts/header/breadcrumb' );
}

add_action( 'hello_blog_after_header', 'hello_blog_add_breadcrumb' );

/**
 * Add featured posts.
 *
 * @since 1.0.0
 */
function hello_blog_add_featured_posts() {
	if ( true !== apply_filters( 'hello_blog_featured_posts_status', false ) ) {
		return;
	}

	get_template_part( 'template-parts/general/featured' );
}

add_action( 'hello_blog_before_content', 'hello_blog_add_featured_posts' );

/**
 * Add sidebar.
 *
 * @since 1.0.0
 */
function hello_blog_add_sidebar() {
	if ( true !== apply_filters( 'hello_blog_sidebar_status', true ) ) {
		return;
	}

	get_sidebar();
}

add_action( 'hello_blog_sidebar', 'hello_blog_add_sidebar' );

/**
 * Add main footer.
 *
 * @since 1.0.0
 */
function hello_blog_add_main_footer() {
	get_template_part( 'template-parts/footer/main' );
}

add_action( 'hello_blog_footer', 'hello_blog_add_main_footer' );

/**
 * Add footer widgets.
 *
 * @since 1.0.0
 */
function hello_blog_add_footer_widgets() {
	get_template_part( 'template-parts/footer/widgets' );
}

add_action( 'hello_blog_before_footer', 'hello_blog_add_footer_widgets' );

/**
 * Add goto top.
 *
 * @since 1.0.0
 */
function hello_blog_add_goto_top() {
	if ( true !== hello_blog_get_option( 'enable_back_to_top' ) ) {
		return;
	}

	echo '<div id="back_to_top">&uarr;</div>';
}

add_action( 'hello_blog_body_bottom', 'hello_blog_add_goto_top' );

/**
 * Add pagination.
 *
 * @since 1.0.0
 */
function hello_blog_add_pagination() {
	the_posts_pagination(
		array(
			'prev_text' => '&larr;',
			'next_text' => '&rarr;',
		)
	);
}

add_action( 'hello_blog_pagination', 'hello_blog_add_pagination' );

/**
 * Add single navigation.
 *
 * @since 1.0.0
 */
function hello_blog_add_single_navigation() {
	the_post_navigation(
		array(
			'prev_text' => '<span class="nav-arrow">&larr;</span> <span class="nav-subtitle">%title</span>',
			'next_text' => '<span class="nav-subtitle">%title</span> <span class="nav-arrow">&rarr;</span>',
		)
	);
}

add_action( 'hello_blog_single_after_content', 'hello_blog_add_single_navigation' );

/**
 * Add related posts.
 *
 * @since 1.0.0
 */
function hello_blog_add_related_posts() {
	if ( true !== apply_filters( 'hello_blog_related_posts_status', false ) ) {
		return;
	}

	get_template_part( 'template-parts/related-posts' );
}

add_action( 'hello_blog_single_after_content', 'hello_blog_add_related_posts' );

/**
 * Add footer copyright.
 *
 * @since 1.0.0
 */
function hello_blog_add_footer_copyright() {
	$copyright = '';

	$copyright_text = hello_blog_get_option( 'copyright_text' );

	if ( ! empty( $copyright_text ) ) {
		$copyright = hello_blog_apply_theme_shortcode( wp_kses_post( $copyright_text ) );
	}

	if ( $copyright ) {
		echo '<div class="copyright">';
		echo do_shortcode( $copyright ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '</div><!-- .copyright -->';
	}
}

add_action( 'hello_blog_credits', 'hello_blog_add_footer_copyright', 10 );

/**
 * Add footer poweredby.
 *
 * @since 1.0.0
 */
function hello_blog_add_footer_poweredby() {
	/* translators: 1: Theme name, 2: Theme author. */
	printf( esc_html__( ' Theme: %1$s by %2$s', 'hello-blog' ), esc_html__( 'Hello Blog', 'hello-blog' ), '<a href="https://wphait.com/" target="_blank">WP Hait</a>' );
}

add_action( 'hello_blog_credits', 'hello_blog_add_footer_poweredby', 20 );
