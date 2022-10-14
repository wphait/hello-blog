<?php
/**
 * Header Options
 *
 * @package Hello_Blog
 */

use Nilambar\CustomizerUtils\Control\Number;
use Nilambar\CustomizerUtils\Control\Switcher;
use Nilambar\CustomizerUtils\Helper\Sanitize;

// Setting logo_height.
$wp_customize->add_setting(
	'theme_options[logo_height]',
	array(
		'default'           => $default['logo_height'],
		'sanitize_callback' => array( Sanitize::class, 'number' ),
	)
);
$wp_customize->add_control(
	new Number(
		$wp_customize,
		'theme_options[logo_height]',
		array(
			'label'           => esc_html__( 'Height of Logo (in px)', 'hello-blog' ),
			'section'         => 'title_tagline',
			'priority'        => 9,
			'input_attrs'     => array(
				'min'   => 30,
				'max'   => 100,
				'style' => 'width: 60px;',
			),
			'active_callback' => function ( $control ) {
				if ( ! empty( $control->manager->get_setting( 'custom_logo' )->value() ) ) {
					return true;
				} else {
					return false;
				}
			},
		)
	)
);

// Setting hide_site_title.
$wp_customize->add_setting(
	'theme_options[hide_site_title]',
	array(
		'default'           => $default['hide_site_title'],
		'sanitize_callback' => array( Sanitize::class, 'checkbox' ),
	)
);
$wp_customize->add_control(
	new Switcher(
		$wp_customize,
		'theme_options[hide_site_title]',
		array(
			'label'    => esc_html__( 'Hide Site Title', 'hello-blog' ),
			'section'  => 'title_tagline',
			'priority' => 10,
		)
	)
);

// Setting hide_tagline.
$wp_customize->add_setting(
	'theme_options[hide_tagline]',
	array(
		'default'           => $default['hide_tagline'],
		'sanitize_callback' => array( Sanitize::class, 'checkbox' ),
	)
);
$wp_customize->add_control(
	new Switcher(
		$wp_customize,
		'theme_options[hide_tagline]',
		array(
			'label'    => esc_html__( 'Hide Tagline', 'hello-blog' ),
			'section'  => 'title_tagline',
			'priority' => 10,
		)
	)
);
