<?php
/**
 * Saaya manage the Customizer options of general panel.
 *
 * @package Mystery Themes
 * @subpackage Saaya
 * @since 1.0.0
 */

// Toggle field for Enable/Disable preloader.
Kirki::add_field(
	'saaya_config', array(
		'type'     => 'toggle',
		'settings' => 'saaya_enable_preloader',
		'label'    => esc_html__( 'Enable Preloader', 'saaya' ),
		'section'  => 'saaya_section_site',
		'default'  => '1',
		'priority' => 5,
	)
);

 // Toggle field for Enable/Disable wow animation.
Kirki::add_field(
	'saaya_config', array(
		'type'     => 'toggle',
		'settings' => 'saaya_enable_wow_animation',
		'label'    => esc_html__( 'Enable Wow Animation', 'saaya' ),
		'section'  => 'saaya_section_site',
		'default'  => '1',
		'priority' => 5,
	)
);


// Radio Image field for Site layout
Kirki::add_field(
	'saaya_config', array(
		'type'     => 'radio-image',
		'settings' => 'saaya_site_layout',
		'label'    => esc_html__( 'Site Layout', 'saaya' ),
		'section'  => 'saaya_section_site',
		'default'  => 'site-layout--wide',
		'priority' => 5,
		'choices'  => array(
			'site-layout--wide'   => array(
				'src' => get_template_directory_uri() . '/assets/images/full-width.png',
				'alt' => __( 'Full Width', 'saaya' )
			),
			'site-layout--boxed'   => array(
				'src' => get_template_directory_uri() . '/assets/images/boxed-layout.png',
				'alt' => __( 'Boxed', 'saaya' )
			)
		),
	)
);

// Color Picker field for Primary Color
Kirki::add_field( 
	'saaya_config', array(
		'type'        => 'color',
		'settings'    => 'saaya_primary_color',
		'label'       => __( 'Primary Color', 'saaya' ),
		'section'     => 'colors',
		'default'     => '#f47e00',
	)
);


// Toggle field for Enable/Disable site mode.
Kirki::add_field(
	'saaya_config', array(
		'type'     => 'toggle',
		'settings' => 'saaya_enable_site_mode',
		'label'    => esc_html__( 'Enable site mode switcher', 'saaya' ),
		'section'  => 'saaya_section_site',
		'priority' => 35,
	)
);

// Site layout
Kirki::add_field(
	'saaya_config', array(
		'type'     => 'radio-image',
		'settings' => 'saaya_select_site_mode',
		'label'    => esc_html__( 'Site Mode', 'saaya' ),
		'section'  => 'saaya_section_site',
		'default'  => 'light',
		'priority' => 40,
		'choices'  => array(
			'light'   => get_template_directory_uri() . '/assets/images/clean-mode.png',
			'dark'  => get_template_directory_uri() . '/assets/images/dark-mode.png'
		),
		'active_callback' => array(
			array(
				'setting'  => 'saaya_enable_site_mode',
				'value'    => false,
				'operator' => '==',
			),
		)
	)
);




