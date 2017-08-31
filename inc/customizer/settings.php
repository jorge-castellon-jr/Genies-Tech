<?php
/**
 * Customizer settings.
 *
 * @package ThoriumDesign
 */

/**
 * Register additional scripts.
 */
function thd_customize_additional_scripts( $wp_customize ) {

	// Register a setting.
	$wp_customize->add_setting(
		'thd_header_scripts',
		array(
			'default'           => '',
			'sanitize_callback' => 'force_balance_tags',
		)
	);

	// Create the setting field.
	$wp_customize->add_control(
		'thd_header_scripts',
		array(
			'label'       => esc_html__( 'Header Scripts', 'thorium-design' ),
			'description' => esc_html__( 'Additional scripts to add to the header. Basic HTML tags are allowed.', 'thorium-design' ),
			'section'     => 'thd_additional_scripts_section',
			'type'        => 'textarea',
		)
	);

	// Register a setting.
	$wp_customize->add_setting(
		'thd_footer_scripts',
		array(
			'default'           => '',
			'sanitize_callback' => 'force_balance_tags',
		)
	);

	// Create the setting field.
	$wp_customize->add_control(
		'thd_footer_scripts',
		array(
			'label'       => esc_html__( 'Footer Scripts', 'thorium-design' ),
			'description' => esc_html__( 'Additional scripts to add to the footer. Basic HTML tags are allowed.', 'thorium-design' ),
			'section'     => 'thd_additional_scripts_section',
			'type'        => 'textarea',
		)
	);
}
add_action( 'customize_register', 'thd_customize_additional_scripts' );

/**
 * Register a social icons setting.
 */
function thd_customize_social_icons( $wp_customize ) {

	// Create an array of our social links for ease of setup.
	$social_networks = array( 'facebook', 'googleplus', 'instagram', 'linkedin', 'twitter' );

	// Loop through our networks to setup our fields.
	foreach ( $social_networks as $network ) {

		// Register a setting.
		$wp_customize->add_setting(
			'thd_' . $network . '_link',
			array(
				'default' => '',
				'sanitize_callback' => 'esc_url',
			)
		);

		// Create the setting field.
		$wp_customize->add_control(
			'thd_' . $network . '_link',
			array(
				'label'   => /* translators: the social network name. */ sprintf( esc_html__( '%s Link', 'thorium-design' ), ucwords( $network ) ),
				'section' => 'thd_social_links_section',
				'type'    => 'text',
			)
		);
	}
}
add_action( 'customize_register', 'thd_customize_social_icons' );

/**
 * Register copyright text setting.
 */
function thd_customize_copyright_text( $wp_customize ) {

	// Register a setting.
	$wp_customize->add_setting(
		'thd_copyright_text',
		array(
			'default' => '',
		)
	);

	// Create the setting field.
	$wp_customize->add_control(
		new Text_Editor_Custom_Control(
			$wp_customize,
			'thd_copyright_text',
			array(
				'label'       => esc_html__( 'Copyright Text', 'thorium-design' ),
				'description' => esc_html__( 'The copyright text will be displayed in the footer. Basic HTML tags allowed.', 'thorium-design' ),
				'section'     => 'thd_footer_section',
				'type'        => 'textarea',
			)
		)
	);
}
add_action( 'customize_register', 'thd_customize_copyright_text' );
