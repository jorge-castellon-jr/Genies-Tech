<?php
/**
 * Customizer sections.
 *
 * @package ThoriumDesign
 */

/**
 * Register the section sections.
 */
function thd_customize_sections( $wp_customize ) {

	// Register additional scripts section.
	$wp_customize->add_section(
		'thd_additional_scripts_section',
		array(
			'title'    => esc_html__( 'Additional Scripts', 'thorium-design' ),
			'priority' => 10,
			'panel'    => 'site-options',
		)
	);

	// Register a footer section.
	$wp_customize->add_section(
		'thd_footer_section',
		array(
			'title'    => esc_html__( 'Footer Customizations', 'thorium-design' ),
			'priority' => 90,
			'panel'    => 'site-options',
		)
	);
}
add_action( 'customize_register', 'thd_customize_sections' );
