<?php
/**
 * Featured posts options
 *
 * @package Hello_Blog
 */

use Nilambar\CustomizerUtils\Control\DropdownTaxonomies;
use Nilambar\CustomizerUtils\Control\Switcher;
use Nilambar\CustomizerUtils\Helper\Callback;
use Nilambar\CustomizerUtils\Helper\Sanitize;

// Featured Posts Section.
$wp_customize->add_section(
	'section_featured_posts',
	array(
		'title'    => esc_html__( 'Featured Posts', 'hello-blog' ),
		'priority' => 100,
		'panel'    => 'theme_option_panel',
	)
);

// Setting enable_featured_posts.
$wp_customize->add_setting(
	'theme_options[enable_featured_posts]',
	array(
		'default'           => $default['enable_featured_posts'],
		'sanitize_callback' => array( Sanitize::class, 'checkbox' ),
	)
);
$wp_customize->add_control(
	new Switcher(
		$wp_customize,
		'theme_options[enable_featured_posts]',
		array(
			'label'    => esc_html__( 'Enable Featured Posts', 'hello-blog' ),
			'section'  => 'section_featured_posts',
			'priority' => 100,
		)
	)
);

// Setting featured_posts_categories.
$wp_customize->add_setting(
	'theme_options[featured_posts_categories]',
	array(
		'default'           => $default['featured_posts_categories'],
		'sanitize_callback' => array( Sanitize::class, 'select_multiple' ),
	)
);
$wp_customize->add_control(
	new DropdownTaxonomies(
		$wp_customize,
		'theme_options[featured_posts_categories]',
		array(
			'label'             => esc_html__( 'Select Categories', 'hello-blog' ),
			'section'           => 'section_featured_posts',
			'priority'          => 100,
			'multiple'          => true,
			'active_callback'   => array( Callback::class, 'active' ),
			'conditional_logic' => array(
				array(
					array(
						'key'     => 'theme_options[enable_featured_posts]',
						'compare' => '==',
						'value'   => true,
					),
				),
			),
		)
	)
);
