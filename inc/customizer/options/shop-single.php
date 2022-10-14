<?php
/**
 * Shop Single Options
 *
 * @package Hello_Blog
 */

use Nilambar\CustomizerUtils\Control\Switcher;
use Nilambar\CustomizerUtils\Helper\Sanitize;

// Shop Single Section.
$wp_customize->add_section(
	'section_shop_single',
	array(
		'title'    => esc_html__( 'Shop Single (Product Detail)', 'hello-blog' ),
		'priority' => 100,
		'panel'    => 'theme_option_panel',
	)
);

// Setting enable_gallery_zoom.
$wp_customize->add_setting(
	'theme_options[enable_gallery_zoom]',
	array(
		'default'           => $default['enable_gallery_zoom'],
		'sanitize_callback' => array( Sanitize::class, 'checkbox' ),
	)
);
$wp_customize->add_control(
	new Switcher(
		$wp_customize,
		'theme_options[enable_gallery_zoom]',
		array(
			'label'    => esc_html__( 'Enable Image Zoom', 'hello-blog' ),
			'section'  => 'section_shop_single',
			'priority' => 100,
		)
	)
);

// Setting disable_related_products.
$wp_customize->add_setting(
	'theme_options[disable_related_products]',
	array(
		'default'           => $default['disable_related_products'],
		'sanitize_callback' => array( Sanitize::class, 'checkbox' ),
	)
);
$wp_customize->add_control(
	new Switcher(
		$wp_customize,
		'theme_options[disable_related_products]',
		array(
			'label'    => esc_html__( 'Disable Related Products', 'hello-blog' ),
			'section'  => 'section_shop_single',
			'priority' => 100,
		)
	)
);
