<?php
/**
 * Breadcrumb Options
 *
 * @package Hello_Blog
 */

use Nilambar\CustomizerUtils\Control\Radio;
use Nilambar\CustomizerUtils\Control\Switcher;
use Nilambar\CustomizerUtils\Helper\Callback;
use Nilambar\CustomizerUtils\Helper\Sanitize;

// Breadcrumb Section.
$wp_customize->add_section(
	'section_breadcrumb',
	array(
		'title'    => esc_html__( 'Breadcrumb', 'hello-blog' ),
		'priority' => 100,
		'panel'    => 'theme_option_panel',
	)
);

// Setting enable_breadcrumb.
$wp_customize->add_setting(
	'theme_options[enable_breadcrumb]',
	array(
		'default'           => $default['enable_breadcrumb'],
		'sanitize_callback' => array( Sanitize::class, 'checkbox' ),
	)
);
$wp_customize->add_control(
	new Switcher(
		$wp_customize,
		'theme_options[enable_breadcrumb]',
		array(
			'label'    => esc_html__( 'Enable Breadcrumb', 'hello-blog' ),
			'section'  => 'section_breadcrumb',
			'priority' => 100,
		)
	)
);

// Setting breadcrumb_type.
$wp_customize->add_setting(
	'theme_options[breadcrumb_type]',
	array(
		'default'           => $default['breadcrumb_type'],
		'sanitize_callback' => array( Sanitize::class, 'select' ),
	)
);
$wp_customize->add_control(
	new Radio(
		$wp_customize,
		'theme_options[breadcrumb_type]',
		array(
			'label'             => esc_html__( 'Breadcrumb Type', 'hello-blog' ),
			'section'           => 'section_breadcrumb',
			'priority'          => 100,
			'choices'           => array(
				'rankmath' => esc_html__( 'Rank Math', 'hello-blog' ),
				'yoast'    => esc_html__( 'Yoast SEO', 'hello-blog' ),
			),
			'active_callback'   => array( Callback::class, 'active' ),
			'conditional_logic' => array(
				array(
					array(
						'key'     => 'theme_options[enable_breadcrumb]',
						'compare' => '==',
						'value'   => true,
					),
				),
			),
		)
	)
);
