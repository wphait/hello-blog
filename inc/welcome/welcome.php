<?php
/**
 * Welcome
 *
 * @package Hello_Blog
 */

use Nilambar\Welcome\Welcome;

add_action(
	'wp_welcome_init',
	function() {
		$args = array(
			'mode' => 'theme',
			'slug' => 'hello-blog',
		);

		$args['page'] = array(
			/* translators: %s: theme name. */
			'menu_title'  => sprintf( esc_html__( 'About %s', 'hello-blog' ), esc_html__( 'Hello Blog', 'hello-blog' ) ),
			'menu_slug'   => 'about-' . HELLO_BLOG_SLUG,
			'parent_page' => 'themes.php',
		);

		$args['admin_notice'] = array(
			'screens' => array( 'themes', 'dashboard' ),
		);

		$args['quick_links'] = array(
			array(
				'text' => esc_html__( 'View Demos', 'hello-blog' ),
				'url'  => 'https://dandure.com/hello-blog/',
				'type' => 'primary',
			),
			array(
				'text' => esc_html__( 'Theme Homepage', 'hello-blog' ),
				'url'  => 'https://wphait.com/themes/hello-blog/',
				'type' => 'secondary',
			),
		);

		$args['sidebar'] = array(
			'render_callback' => 'hello_blog_render_welcome_page_sidebar',
		);

		$args['tabs'] = array(
			'getting-started' => array(
				'title' => esc_html__( 'Getting Started', 'hello-blog' ),
				'type'  => 'grid',
				'items' => array(
					'customize'     => array(
						'title'       => esc_html__( 'Customize Everything', 'hello-blog' ),
						'icon'        => 'dashicons dashicons-admin-customizer',
						'description' => esc_html__( 'Theme uses Customizer API for theme options. Start customizing every aspect of the website with customizer.', 'hello-blog' ),
						'button_text' => esc_html__( 'Go to Customizer', 'hello-blog' ),
						'button_url'  => wp_customize_url(),
						'button_type' => 'primary',
					),
					'support'       => array(
						'title'       => esc_html__( 'Get Support', 'hello-blog' ),
						'icon'        => 'dashicons dashicons-editor-help',
						'description' => esc_html__( 'Got theme support question or found bug or got some feedbacks? Please visit support forum in the WordPress.org directory.', 'hello-blog' ),
						'button_text' => esc_html__( 'Visit Support', 'hello-blog' ),
						'button_url'  => 'https://wordpress.org/support/theme/hello-blog/#new-post',
						'button_type' => 'secondary',
						'is_new_tab'  => true,
					),
					'documentation' => array(
						'title'       => esc_html__( 'Documentation', 'hello-blog' ),
						'icon'        => 'dashicons dashicons-admin-page',
						'description' => 'Kindly check our theme documentation for detailed information and instructions.',
						'button_text' => esc_html__( 'View Documentation', 'hello-blog' ),
						'button_url'  => 'https://dandure.com/documentation/hello-blog/',
						'button_type' => 'secondary',
						'is_new_tab'  => true,
					),
					'child-theme'   => array(
						'title'       => esc_html__( 'Child Theme', 'hello-blog' ),
						'icon'        => 'dashicons dashicons-admin-appearance',
						'description' => 'Want to customize theme file? Please use a child theme.',
						'button_text' => esc_html__( 'About Child Theme', 'hello-blog' ),
						'button_url'  => 'https://developer.wordpress.org/themes/advanced-topics/child-themes/',
						'button_type' => 'secondary',
						'is_new_tab'  => true,
					),
				),
			),
			'free-vs-pro' => array(
				'title'          => esc_html__( 'Free Vs. Pro', 'hello-blog' ),
				'type'           => 'comparison',
				'upgrade_button' => array(
					'url' => 'https://wphait.com/themes/hello-blog/',
				),
				'items'          => array(
					array(
						'title' => 'Show / Hide Site Title',
						'free'  => 'yes',
						'pro'   => 'yes',
					),
					array(
						'title' => 'Show / Hide Site Tagline',
						'free'  => 'yes',
						'pro'   => 'yes',
					),
					array(
						'title' => 'Logo Height Option',
						'free'  => 'yes',
						'pro'   => 'yes',
					),
					array(
						'title' => 'Full Width Banner',
						'free'  => 'yes',
						'pro'   => 'yes',
					),
					array(
						'title' => 'Featured Posts on Home Page',
						'free'  => 'yes',
						'pro'   => 'yes',
					),
					array(
						'title'       => 'Breadcrumb',
						'description' => 'Rank Math or Yoast SEO',
						'free'        => 'yes',
						'pro'         => 'yes',
					),
					array(
						'title'       => 'Post Meta Options',
						'description' => 'Drag and drop and enable/disable',
						'free'        => 'yes',
						'pro'         => 'yes',
					),
					array(
						'title' => 'Social Share',
						'free'  => 'yes',
						'pro'   => 'yes',
					),
					array(
						'title' => 'Related Posts',
						'free'  => 'yes',
						'pro'   => 'yes',
					),
					array(
						'title' => 'WooCommerce Support',
						'free'  => 'yes',
						'pro'   => 'yes',
					),
					array(
						'title' => 'Page Speed Optimized',
						'free'  => 'yes',
						'pro'   => 'yes',
					),
					array(
						'title' => 'Search Engine Optimized',
						'free'  => 'yes',
						'pro'   => 'yes',
					),
					array(
						'title'       => 'Page Builder Compatibility',
						'description' => 'Compatible with page builders like Elementor',
						'free'        => 'yes',
						'pro'         => 'yes',
					),
					array(
						'title' => 'Google Core Web Vitals Optimized',
						'free'  => 'yes',
						'pro'   => 'yes',
					),
					array(
						'title' => 'No jQuery',
						'free'  => 'yes',
						'pro'   => 'yes',
					),
					array(
						'title' => 'Dark Skin',
						'free'  => 'no',
						'pro'   => 'yes',
					),
					array(
						'title' => 'Sticky Navigation',
						'free'  => 'no',
						'pro'   => 'yes',
					),
					array(
						'title' => 'Color and Typography',
						'free'  => 'no',
						'pro'   => 'yes',
					),
					array(
						'title' => 'Blog Layouts',
						'free'  => '1',
						'pro'   => '5',
					),
					array(
						'title' => 'Sticky Sidebar',
						'free'  => 'no',
						'pro'   => 'yes',
					),
					array(
						'title'       => 'Sidebar Options',
						'description' => 'Left, Right and No Sidebar',
						'free'        => 'no',
						'pro'         => 'yes',
					),
					array(
						'title' => 'Customize Powered By Text',
						'free'  => 'no',
						'pro'   => 'yes',
					),
					array(
						'title' => 'Author Box',
						'free'  => 'no',
						'pro'   => 'yes',
					),
					array(
						'title' => 'Theme Support',
						'free'  => 'Forum',
						'pro'   => 'Dedicated / Forum',
					),
				),
			),
			'plugins' => array(
				'title' => esc_html__( 'Recommended Plugins', 'hello-blog' ),
				'type'  => 'plugin',
				'items' => array(
					array(
						'name'        => esc_html__( 'WooCommerce Product Tabs', 'hello-blog' ),
						'description' => esc_html__( 'Plugin to add new tabs for WooCommerce products.', 'hello-blog' ),
						'slug'        => 'woocommerce-product-tabs',
					),
					array(
						'name'        => esc_html__( 'Admin Customizer', 'hello-blog' ),
						'description' => esc_html__( 'Customize admin interface of your WordPress site.', 'hello-blog' ),
						'slug'        => 'admin-customizer',
					),
					array(
						'name'        => esc_html__( 'Advanced Google reCAPTCHA', 'hello-blog' ),
						'description' => esc_html__( 'Protect your WordPress website against spam comments and brute-force attacks using Google reCAPTCHA.', 'hello-blog' ),
						'slug'        => 'advanced-google-recaptcha',
					),
					array(
						'name'        => esc_html__( 'Coming Soon & Maintenance Mode Page', 'hello-blog' ),
						'description' => esc_html__( 'Simple and easy to setup Coming soon, Under Construction and Maintenance page plugin.', 'hello-blog' ),
						'slug'        => 'nifty-coming-soon-and-under-construction-page',
					),
					array(
						'name'        => esc_html__( 'Post Grid Elementor Addon', 'hello-blog' ),
						'description' => esc_html__( 'Elementor page builder addon to display posts in a grid.', 'hello-blog' ),
						'slug'        => 'post-grid-elementor-addon',
					),
					array(
						'name'        => esc_html__( 'Majestic Before After Image', 'hello-blog' ),
						'description' => esc_html__( 'Elementor addon to show the comparison of two images with a draggable handle.', 'hello-blog' ),
						'slug'        => 'majestic-before-after-image',
					),
				),
			)
		);

		// Pass welcome arguments through filter.
		$config = apply_filters( 'hello_blog_welcome_args', $args );

		if ( ! ( isset( $config['mode'] ) && isset( $config['slug'] ) ) ) {
			return;
		}

		// Instantiate Welcome object.
		$obj = new Welcome( $config['mode'], $config['slug'] );

		if ( isset( $config['page'] ) ) {
			$obj->set_page( $config['page'] );
		}

		if ( isset( $config['admin_notice'] ) ) {
			$obj->set_admin_notice( $config['admin_notice'] );
		}

		if ( isset( $config['quick_links'] ) ) {
			$obj->set_quick_links( $config['quick_links'] );
		}

		if ( isset( $config['sidebar'] ) ) {
			$obj->set_sidebar( $config['sidebar'] );
		}

		if ( isset( $config['tabs'] ) && is_array( $config['tabs'] ) ) {
			foreach ( $config['tabs'] as $tab_key => $tab ) {
				$obj->add_tab( array_merge( array( 'id' => $tab_key ), $tab ) );
			}
		}

		$obj->run();
	}
);

/**
 * Render welcome page sidebar.
 *
 * @since 1.0.0
 *
 * @param Welcome $object Instance of Welcome class.
 */
function hello_blog_render_welcome_page_sidebar( $object ) {
	$object->render_sidebar_box(
		array(
			'title'        => esc_html__( 'Upgrade to Pro', 'hello-blog' ),
			'content'      => esc_html__( 'Upgrade to pro version for additional features and options.', 'hello-blog' ),
			'class'        => 'gray',
			'button_text'  => esc_html__( 'Upgrade Now', 'hello-blog' ),
			'button_url'   => 'https://wphait.com/themes/hello-blog/',
			'button_class' => 'button button-primary button-upgrade',
		),
		$object
	);

	$object->render_sidebar_box(
		array(
			'title'        => esc_html__( 'Leave a Review', 'hello-blog' ),
			/* translators: %s: theme name. */
			'content'      => $object->get_stars() . sprintf( esc_html__( 'Are you enjoying %s? We would appreciate a review.', 'hello-blog' ), $object->get_name() ),
			'button_text'  => esc_html__( 'Submit Review', 'hello-blog' ),
			'button_url'   => 'https://wordpress.org/support/theme/hello-blog/reviews/#new-post',
			'button_class' => 'button',
		),
		$object
	);

	$object->render_sidebar_box(
		array(
			'title'   => esc_html__( 'Our Themes', 'hello-blog' ),
			'content' => '<ol><li><a href="https://wphait.com/themes/nari/" target="_blank">Nari - Feminine WordPress Blog Theme</a></li><li><a href="https://wphait.com/themes/dhor/" target="_blank">Dhor - Minimal WordPress Blog Theme</a></li><li><a href="https://wphait.com/themes/hello-blog/" target="_blank">Hello Blog - Elegant WordPress Blog theme</a></li><li><a href="https://wphait.com/themes/blog-up/" target="_blank">Blog Up - Clean WordPress Blog theme</a></li><li><a href="https://wphait.com/themes/hait/" target="_blank">Hait - Multipurpose WordPress Blog Theme</a></li></ol>',
		),
		$object
	);
}
