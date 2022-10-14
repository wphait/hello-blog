<?php
/**
 * Blog Single Options
 *
 * @package Hello_Blog
 */

use Nilambar\CustomizerUtils\Control\Number;
use Nilambar\CustomizerUtils\Control\Sortable;
use Nilambar\CustomizerUtils\Control\Switcher;
use Nilambar\CustomizerUtils\Control\Text;
use Nilambar\CustomizerUtils\Helper\Callback;
use Nilambar\CustomizerUtils\Helper\Sanitize;

// Blog Single Section.
$wp_customize->add_section(
	'section_blog_single',
	array(
		'title'    => esc_html__( 'Blog Detail (Single Post)', 'hello-blog' ),
		'priority' => 100,
		'panel'    => 'theme_option_panel',
	)
);

// Setting post_header_meta.
$wp_customize->add_setting(
	'theme_options[post_header_meta]',
	array(
		'default'           => $default['post_header_meta'],
		'sanitize_callback' => array( Sanitize::class, 'sortable' ),
	)
);
$wp_customize->add_control(
	new Sortable(
		$wp_customize,
		'theme_options[post_header_meta]',
		array(
			'label'    => esc_html__( 'Post Meta', 'hello-blog' ),
			'section'  => 'section_blog_single',
			'settings' => 'theme_options[post_header_meta]',
			'priority' => 100,
			'choices'  => array(
				'date'       => esc_html__( 'Date', 'hello-blog' ),
				'author'     => esc_html__( 'Author', 'hello-blog' ),
				'categories' => esc_html__( 'Categories', 'hello-blog' ),
				'comments'   => esc_html__( 'Comments', 'hello-blog' ),
				'tags'       => esc_html__( 'Tags', 'hello-blog' ),
			),
		)
	)
);

// Setting post_footer_meta.
$wp_customize->add_setting(
	'theme_options[post_footer_meta]',
	array(
		'default'           => $default['post_footer_meta'],
		'sanitize_callback' => array( Sanitize::class, 'sortable' ),
	)
);
$wp_customize->add_control(
	new Sortable(
		$wp_customize,
		'theme_options[post_footer_meta]',
		array(
			'label'    => esc_html__( 'Post Footer Meta', 'hello-blog' ),
			'section'  => 'section_blog_single',
			'settings' => 'theme_options[post_footer_meta]',
			'priority' => 100,
			'choices'  => array(
				'date'       => esc_html__( 'Date', 'hello-blog' ),
				'author'     => esc_html__( 'Author', 'hello-blog' ),
				'categories' => esc_html__( 'Categories', 'hello-blog' ),
				'comments'   => esc_html__( 'Comments', 'hello-blog' ),
				'tags'       => esc_html__( 'Tags', 'hello-blog' ),
			),
		)
	)
);

// Setting enable_social_share.
$wp_customize->add_setting(
	'theme_options[enable_social_share]',
	array(
		'default'           => $default['enable_social_share'],
		'sanitize_callback' => array( Sanitize::class, 'checkbox' ),
	)
);
$wp_customize->add_control(
	new Switcher(
		$wp_customize,
		'theme_options[enable_social_share]',
		array(
			'label'    => esc_html__( 'Enable Social Share', 'hello-blog' ),
			'section'  => 'section_blog_single',
			'priority' => 100,
		)
	)
);


// Setting social_share_heading.
$wp_customize->add_setting(
	'theme_options[social_share_heading]',
	array(
		'default'           => $default['social_share_heading'],
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new Text(
		$wp_customize,
		'theme_options[social_share_heading]',
		array(
			'label'             => esc_html__( 'Heading', 'hello-blog' ),
			'section'           => 'section_blog_single',
			'priority'          => 100,
			'active_callback'   => array( Callback::class, 'active' ),
			'conditional_logic' => array(
				array(
					array(
						'key'     => 'theme_options[enable_social_share]',
						'compare' => '==',
						'value'   => true,
					),
				),
			),
		)
	)
);

// Setting show_related_posts.
$wp_customize->add_setting(
	'theme_options[show_related_posts]',
	array(
		'default'           => $default['show_related_posts'],
		'sanitize_callback' => array( Sanitize::class, 'checkbox' ),
	)
);
$wp_customize->add_control(
	new Switcher(
		$wp_customize,
		'theme_options[show_related_posts]',
		array(
			'label'    => esc_html__( 'Show Related Posts', 'hello-blog' ),
			'section'  => 'section_blog_single',
			'priority' => 100,
		)
	)
);

// Setting related_posts_heading.
$wp_customize->add_setting(
	'theme_options[related_posts_heading]',
	array(
		'default'           => $default['related_posts_heading'],
		'sanitize_callback' => array( Sanitize::class, 'text' ),
	)
);
$wp_customize->add_control(
	new Text(
		$wp_customize,
		'theme_options[related_posts_heading]',
		array(
			'label'             => esc_html__( 'Heading', 'hello-blog' ),
			'section'           => 'section_blog_single',
			'priority'          => 100,
			'active_callback'   => array( Callback::class, 'active' ),
			'conditional_logic' => array(
				array(
					array(
						'key'     => 'theme_options[show_related_posts]',
						'compare' => '==',
						'value'   => true,
					),
				),
			),
		)
	)
);

// Setting related_posts_number.
$wp_customize->add_setting(
	'theme_options[related_posts_number]',
	array(
		'default'           => $default['related_posts_number'],
		'sanitize_callback' => array( Sanitize::class, 'number' ),
	)
);
$wp_customize->add_control(
	new Number(
		$wp_customize,
		'theme_options[related_posts_number]',
		array(
			'label'             => esc_html__( 'Number of Related Posts', 'hello-blog' ),
			'section'           => 'section_blog_single',
			'priority'          => 100,
			'input_attrs'       => array(
				'min'   => 2,
				'max'   => 10,
				'style' => 'width: 60px;',
			),
			'active_callback'   => array( Callback::class, 'active' ),
			'conditional_logic' => array(
				array(
					array(
						'key'     => 'theme_options[show_related_posts]',
						'compare' => '==',
						'value'   => true,
					),
				),
			),
		)
	)
);
