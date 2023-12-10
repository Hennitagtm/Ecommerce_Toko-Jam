<?php
/**
 * Saaya manage the Customizer options of design settings panel.
 *
 * @package Mystery Themes
 * @subpackage Saaya
 * @since 1.0.0
 */

// Radio Image field for archive/blog sidebar layout.
Kirki::add_field(
	'saaya_config', array(
		'type'     => 'radio-image',
		'settings' => 'saaya_archive_sidebar_layout',
		'label'    => esc_html__( 'Archive/Blog Sidebar Layout', 'saaya' ),
		'section'  => 'saaya_section_archive_settings',
		'default'  => 'no-sidebar',
		'priority' => 5,
		'choices'  => array(
			'left-sidebar'   => array(
				'src' => get_template_directory_uri() . '/assets/images/left-sidebar.png',
				'alt' => __( 'Left Sidebar', 'saaya' )
			),
			'right-sidebar'   => array(
				'src' => get_template_directory_uri() . '/assets/images/right-sidebar.png',
				'alt' => __( 'Right Sidebar', 'saaya' )
			),
			'no-sidebar'   => array(
				'src' => get_template_directory_uri() . '/assets/images/no-sidebar.png',
				'alt' => __( 'No Sidebar', 'saaya' )
			),
			'no-sidebar-center'   => array(
				'src' => get_template_directory_uri() . '/assets/images/no-sidebar-center.png',
				'alt' => __( 'No Sidebar Center', 'saaya' )
			)
		),
	)
);

// Radio Image field for archive/blog style.
Kirki::add_field(
	'saaya_config', array(
		'type'     => 'radio-image',
		'settings' => 'saaya_archive_style',
		'label'    => esc_html__( 'Archive/Blog Style', 'saaya' ),
		'section'  => 'saaya_section_archive_settings',
		'default'  => 'mt-archive--masonry-style',
		'priority' => 10,
		'choices'  => array(
			'mt-archive--block-grid-style' => array(
				'src'	=> get_template_directory_uri() . '/assets/images/archive-block-grid.png',
				'alt'	=> __( 'Grid', 'saaya' )
			),
			'mt-archive--masonry-style'    => array(
				'src'	=> get_template_directory_uri() . '/assets/images/archive-masonry.png',
				'alt'	=> __( 'Masonry', 'saaya' )
			)
		)
	)
);

// Text filed for archive read more button.
Kirki::add_field(
	'saaya_config', array(
		'type'     => 'text',
		'settings' => 'saaya_archive_read_more',
		'label'    => esc_html__( 'Read More Button', 'saaya' ),
		'section'  => 'saaya_section_archive_settings',
		'default'  => esc_html__( 'Discover', 'saaya' ),
		'priority' => 15,
	)
);

// Radio Image field for single posts sidebar layout.
Kirki::add_field(
	'saaya_config', array(
		'type'     => 'radio-image',
		'settings' => 'saaya_posts_sidebar_layout',
		'label'    => esc_html__( 'Posts Sidebar Layout', 'saaya' ),
		'section'  => 'saaya_section_post_settings',
		'default'  => 'right-sidebar',
		'priority' => 5,
		'choices'  => array(
			'left-sidebar'   => array(
				'src' => get_template_directory_uri() . '/assets/images/left-sidebar.png',
				'alt' => __( 'Left Sidebar', 'saaya' )
			),
			'right-sidebar'   => array(
				'src' => get_template_directory_uri() . '/assets/images/right-sidebar.png',
				'alt' => __( 'Right Sidebar', 'saaya' )
			),
			'no-sidebar'   => array(
				'src' => get_template_directory_uri() . '/assets/images/no-sidebar.png',
				'alt' => __( 'No Sidebar', 'saaya' )
			),
			'no-sidebar-center'   => array(
				'src' => get_template_directory_uri() . '/assets/images/no-sidebar-center.png',
				'alt' => __( 'No Sidebar Center', 'saaya' )
			)
		),
	)
);

// Toggle field for Enable/Disable related posts.
Kirki::add_field(
	'saaya_config', array(
		'type'     => 'toggle',
		'settings' => 'saaya_enable_related_posts',
		'label'    => esc_html__( 'Enable Related Posts', 'saaya' ),
		'section'  => 'saaya_section_post_settings',
		'default'  => '1',
		'priority' => 15,
	)
);

// Radio Image field for single page sidebar layout.
Kirki::add_field(
	'saaya_config', array(
		'type'     => 'radio-image',
		'settings' => 'saaya_pages_sidebar_layout',
		'label'    => esc_html__( 'Pages Sidebar Layout', 'saaya' ),
		'section'  => 'saaya_section_page_settings',
		'default'  => 'right-sidebar',
		'priority' => 5,
		'choices'  => array(
			'left-sidebar'   => array(
				'src' => get_template_directory_uri() . '/assets/images/left-sidebar.png',
				'alt' => __( 'Left Sidebar', 'saaya' )
			),
			'right-sidebar'   => array(
				'src' => get_template_directory_uri() . '/assets/images/right-sidebar.png',
				'alt' => __( 'Right Sidebar', 'saaya' )
			),
			'no-sidebar'   => array(
				'src' => get_template_directory_uri() . '/assets/images/no-sidebar.png',
				'alt' => __( 'No Sidebar', 'saaya' )
			),
			'no-sidebar-center'   => array(
				'src' => get_template_directory_uri() . '/assets/images/no-sidebar-center.png',
				'alt' => __( 'No Sidebar Center', 'saaya' )
			)
		),
	)
);