<?php
/**
 * Blog Options
 *
 * @package Hello_Blog
 */

use Nilambar\CustomizerUtils\Control\Number;
use Nilambar\CustomizerUtils\Control\Sortable;
use Nilambar\CustomizerUtils\Control\Switcher;
use Nilambar\CustomizerUtils\Control\Text;
use Nilambar\CustomizerUtils\Helper\Callback;
use Nilambar\CustomizerUtils\Helper\Sanitize;

// Blog Section.
$wp_customize->add_section(
	'section_blog',
	array(
		'title'    => esc_html__( 'Blog/Archive', 'hello-blog' ),
		'priority' => 100,
		'panel'    => 'theme_option_panel',
	)
);

// Setting blog_meta.
$wp_customize->add_setting(
	'theme_options[blog_meta]',
	array(
		'default'           => $default['blog_meta'],
		'sanitize_callback' => array( Sanitize::class, 'sortable' ),
	)
);
$wp_customize->add_control(
	new Sortable(
		$wp_customize,
		'theme_options[blog_meta]',
		array(
			'label'    => esc_html__( 'Post Meta', 'hello-blog' ),
			'section'  => 'section_blog',
			'settings' => 'theme_options[blog_meta]',
			'priority' => 100,
			'choices'  => array(
				'date'       => esc_html__( 'Date', 'hello-blog' ),
				'author'     => esc_html__( 'Author', 'hello-blog' ),
				'categories' => esc_html__( 'Categories', 'hello-blog' ),
			),
		)
	)
);

// Setting show_excerpt.
$wp_customize->add_setting(
	'theme_options[show_excerpt]',
	array(
		'default'           => $default['show_excerpt'],
		'sanitize_callback' => array( Sanitize::class, 'checkbox' ),
	)
);
$wp_customize->add_control(
	new Switcher(
		$wp_customize,
		'theme_options[show_excerpt]',
		array(
			'label'    => esc_html__( 'Show Excerpt', 'hello-blog' ),
			'section'  => 'section_blog',
			'priority' => 100,
		)
	)
);

// Setting excerpt_length.
$wp_customize->add_setting(
	'theme_options[excerpt_length]',
	array(
		'default'           => $default['excerpt_length'],
		'sanitize_callback' => array( Sanitize::class, 'number' ),
	)
);
$wp_customize->add_control(
	new Number(
		$wp_customize,
		'theme_options[excerpt_length]',
		array(
			'label'             => esc_html__( 'Excerpt Length', 'hello-blog' ),
			'section'           => 'section_blog',
			'priority'          => 100,
			'input_attrs'       => array(
				'min'   => 1,
				'max'   => 200,
				'style' => 'width: 60px;',
			),
			'active_callback'   => array( Callback::class, 'active' ),
			'conditional_logic' => array(
				array(
					array(
						'key'     => 'theme_options[show_excerpt]',
						'compare' => '==',
						'value'   => true,
					),
				),
			),
		)
	)
);

// Setting readmore_text.
$wp_customize->add_setting(
	'theme_options[readmore_text]',
	array(
		'default'           => $default['readmore_text'],
		'sanitize_callback' => array( Sanitize::class, 'text' ),
	)
);
$wp_customize->add_control(
	new Text(
		$wp_customize,
		'theme_options[readmore_text]',
		array(
			'label'             => esc_html__( 'Read More Text', 'hello-blog' ),
			'section'           => 'section_blog',
			'priority'          => 100,
			'active_callback'   => array( Callback::class, 'active' ),
			'conditional_logic' => array(
				array(
					array(
						'key'     => 'theme_options[show_excerpt]',
						'compare' => '==',
						'value'   => true,
					),
				),
			),
		)
	)
);
