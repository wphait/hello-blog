<?php
/**
 * Init
 *
 * @package Hello_Blog
 */

/**
 * Hooks.
 */
require_once HELLO_BLOG_DIR . '/inc/hooks/setup.php';
require_once HELLO_BLOG_DIR . '/inc/hooks/layout.php';
require_once HELLO_BLOG_DIR . '/inc/hooks/basic.php';
require_once HELLO_BLOG_DIR . '/inc/hooks/custom.php';
require_once HELLO_BLOG_DIR . '/inc/hooks/styles.php';

/**
 * Helpers.
 */
require_once HELLO_BLOG_DIR . '/inc/helpers/core.php';
require_once HELLO_BLOG_DIR . '/inc/helpers/common.php';
require_once HELLO_BLOG_DIR . '/inc/helpers/utils.php';
require_once HELLO_BLOG_DIR . '/inc/helpers/template-tags.php';

/**
 * Customizer additions.
 */
require_once HELLO_BLOG_DIR . '/inc/customizer/customizer.php';

/**
 * Welcome page.
 */
require_once HELLO_BLOG_DIR . '/inc/welcome/welcome.php';

require_once HELLO_BLOG_DIR . '/inc/classes/class-svg-icons.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce', false ) ) {
	require_once HELLO_BLOG_DIR . '/inc/support/woocommerce.php';
}
