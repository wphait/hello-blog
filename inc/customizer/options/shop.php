<?php
/**
 * Shop Options
 *
 * @package Hello_Blog
 */

use Nilambar\CustomizerUtils\Control\Number;
use Nilambar\CustomizerUtils\Control\Radio;
use Nilambar\CustomizerUtils\Control\Select;
use Nilambar\CustomizerUtils\Control\Switcher;
use Nilambar\CustomizerUtils\Helper\Sanitize;

// Shop Section.
$wp_customize->add_section(
	'section_shop',
	array(
		'title'    => esc_html__( 'Shop', 'hello-blog' ),
		'priority' => 100,
		'panel'    => 'theme_option_panel',
	)
);

// Setting shop_layout.
$wp_customize->add_setting(
	'theme_options[shop_layout]',
	array(
		'default'           => $default['shop_layout'],
		'sanitize_callback' => array( Sanitize::class, 'select' ),
	)
);
$wp_customize->add_control(
	new Radio(
		$wp_customize,
		'theme_options[shop_layout]',
		array(
			'label'    => esc_html__( 'Shop Layout', 'hello-blog' ),
			'section'  => 'section_shop',
			'priority' => 100,
			'choices'  => array(
				'with-sidebar' => esc_html__( 'Sidebar', 'hello-blog' ),
				'no-sidebar'   => esc_html__( 'No Sidebar', 'hello-blog' ),
			),
		)
	)
);

// Setting product_per_page.
$wp_customize->add_setting(
	'theme_options[product_per_page]',
	array(
		'default'           => $default['product_per_page'],
		'sanitize_callback' => array( Sanitize::class, 'number' ),
	)
);
$wp_customize->add_control(
	new Number(
		$wp_customize,
		'theme_options[product_per_page]',
		array(
			'label'       => esc_html__( 'Products Per Page', 'hello-blog' ),
			'description' => esc_html__( 'Total number of products shown per page', 'hello-blog' ),
			'section'     => 'section_shop',
			'input_attrs' => array(
				'min'   => 4,
				'max'   => 20,
				'style' => 'width: 60px;',
			),
			'priority'    => 100,
		)
	)
);

// Setting product_number_per_row.
$wp_customize->add_setting(
	'theme_options[product_number]',
	array(
		'default'           => $default['product_number'],
		'sanitize_callback' => array( Sanitize::class, 'number' ),
	)
);
$wp_customize->add_control(
	new Radio(
		$wp_customize,
		'theme_options[product_number]',
		array(
			'label'       => esc_html__( 'Products Per Row', 'hello-blog' ),
			'description' => esc_html__( 'Number of products shown per row', 'hello-blog' ),
			'section'     => 'section_shop',
			'priority'    => 100,
			'choices'     => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
			),
			'layout'      => 'horizontal',
		)
	)
);

// Setting hide_product_sorting.
$wp_customize->add_setting(
	'theme_options[hide_product_sorting]',
	array(
		'default'           => $default['hide_product_sorting'],
		'sanitize_callback' => array( Sanitize::class, 'checkbox' ),
	)
);
$wp_customize->add_control(
	new Switcher(
		$wp_customize,
		'theme_options[hide_product_sorting]',
		array(
			'label'    => esc_html__( 'Disable Product Sorting Option', 'hello-blog' ),
			'section'  => 'section_shop',
			'priority' => 100,
		)
	)
);
