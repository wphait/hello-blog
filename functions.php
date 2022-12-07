<?php
/**
 * Functions
 *
 * @package Hello_Blog
 */

define( 'HELLO_BLOG_VERSION', '1.0.3' );
define( 'HELLO_BLOG_SLUG', 'hello-blog' );
define( 'HELLO_BLOG_DIR', rtrim( get_template_directory(), '/' ) );
define( 'HELLO_BLOG_URL', rtrim( get_template_directory_uri(), '/' ) );

// Include autoload.
if ( file_exists( HELLO_BLOG_DIR . '/vendor/autoload.php' ) ) {
	require_once HELLO_BLOG_DIR . '/vendor/autoload.php';
	require_once HELLO_BLOG_DIR . '/vendor/wptt/webfont-loader/wptt-webfont-loader.php';
	require_once HELLO_BLOG_DIR . '/vendor/ernilambar/ns-customizer-utilities/init.php';
	require_once HELLO_BLOG_DIR . '/vendor/ernilambar/wp-welcome/init.php';
}

// Init.
require_once HELLO_BLOG_DIR . '/inc/init.php';
