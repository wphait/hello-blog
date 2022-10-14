<?php
/**
 * WooCommerce Compatibility File
 *
 * @package Hello_Blog
 */

/**
 * WooCommerce setup function.
 *
 * @since 1.0.0
 */
function hello_blog_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	$gallery_zoom = hello_blog_get_option( 'enable_gallery_zoom' );

	if ( true === $gallery_zoom ) {
		add_theme_support( 'wc-product-gallery-zoom' );
	}
}

add_action( 'after_setup_theme', 'hello_blog_woocommerce_setup' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @since 1.0.0
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes Modified to include 'woocommerce-active' class.
 */
function hello_blog_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}

add_filter( 'body_class', 'hello_blog_woocommerce_active_body_class' );

/**
 * Customize Woo hooks.
 *
 * @since 1.0.0
 */
function hello_blog_init_woo_hooks() {
	// Remove default WooCommerce wrapper.
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

	// Remove Breadcrumb.
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

	// Conditional sidebar.
	if ( 'no-sidebar' === hello_blog_get_option( 'shop_layout' ) ) {
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	}

	// Disable related products.
	if ( true === hello_blog_get_option( 'disable_related_products' ) ) {
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
	}

	// Remove sorting option.
	if ( true === hello_blog_get_option( 'hide_product_sorting' ) ) {
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
	}

	// Customize upsell products.
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	add_action( 'woocommerce_after_single_product_summary', 'hello_blog_output_upsells', 15 );

	// Remove add to cart button from product listing.
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
}

add_action( 'init', 'hello_blog_init_woo_hooks' );

/**
 * Customize number of products per page.
 *
 * @since 1.0.0
 *
 * @param int $number Products number.
 * @return int Modified number.
 */
function hello_blog_new_loop_shop_per_page( $number ) {
	$product_per_page = hello_blog_get_option( 'product_per_page' );

	$number = absint( $product_per_page );

	return $number;
}

add_filter( 'loop_shop_per_page', 'hello_blog_new_loop_shop_per_page', 20 );

/**
 * Customize number of products per row.
 *
 * @since 1.0.0
 *
 * @return int Number.
 */
function hello_blog_product_columns() {
	$product_number = hello_blog_get_option( 'product_number' );

	return absint( $product_number );
}

add_filter( 'loop_shop_columns', 'hello_blog_product_columns' );

/**
 * Customize number of related products.
 *
 * @since 1.0.0
 *
 * @param array $args Related products arguments.
 * @return array Modified arguments.
 */
function hello_blog_related_products_args( $args ) {
	$product_number = hello_blog_get_option( 'product_number' );

	$args['columns'] = absint( $product_number );

	$args['posts_per_page'] = absint( $product_number );

	return $args;
}

add_filter( 'woocommerce_output_related_products_args', 'hello_blog_related_products_args' );

/**
 * Render upsells.
 *
 * @since 1.0.0
 */
function hello_blog_output_upsells() {
	$product_number = hello_blog_get_option( 'product_number' );

	woocommerce_upsell_display( absint( $product_number ), absint( $product_number ) );
}

/**
 * Before Content.
 *
 * Wraps all WooCommerce content in wrappers which match the theme markup.
 *
 * @since 1.0.0
 */
function hello_blog_woocommerce_wrapper_before() {
	?>
		<main id="primary" class="site-main">
	<?php
}

add_action( 'woocommerce_before_main_content', 'hello_blog_woocommerce_wrapper_before' );

/**
 * After Content.
 *
 * Closes the wrapping divs.
 *
 * @since 1.0.0
 */
function hello_blog_woocommerce_wrapper_after() {
	?>
		</main><!-- #primary -->
	<?php
}

add_action( 'woocommerce_after_main_content', 'hello_blog_woocommerce_wrapper_after' );

/**
 * Update number of items in cart and total after Ajax.
 *
 * @since 1.0.0
 *
 * @param array $fragments Cart fragments.
 * @return array Modified cart fragments.
 */
function hello_blog_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
	<span class="cart-value hello-blog-cart-fragment"> <?php echo wp_kses_data( WC()->cart->get_cart_contents_count() ); ?></span>
	<?php
	$fragments['span.hello-blog-cart-fragment'] = ob_get_clean();

	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'hello_blog_header_add_to_cart_fragment' );
